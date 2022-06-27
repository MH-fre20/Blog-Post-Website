<?php

namespace App\Models;

use App\Scopes\LatestScope;
use App\Scopes\DeletedAdminScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Cache;

class BlogPost extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    public function Image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)
        ->withTimestamps();
    }

    //local Scope
    public static function scopeMostCommented($query)
    {
        // comments_count
        return $query->withCount('comments')
        ->orderBy('comments_count', 'desc');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        //we used static to make the use of :: instead of writing
        // $parent = new boot(); we used static which makes the
        // sentance look like this prent::boot();
        static::addGlobalScope(new DeletedAdminScope);
        
        parent::boot();

        static::addGlobalScope(new LatestScope);
        
        static::deleting(function (BlogPost $blogPost)
        {
            $blogPost->comments()->delete();
            Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
        });

        static::updating(function (BlogPost $blogPost) {
            Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
        });
        
        static::restoring(function (BlogPost $blogPost) {
            $blogPost->comments()->restore();
        });
    }
}
