<?php

namespace App\Models;

use App\Scopes\LatestScope;
use App\Scopes\LatestScopeComment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Filesystem\Cache;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    protected static function boot()
    {
        static::addGlobalScope(new LatestScope);

        parent::boot();

        static::creating(function (Comment $comment) {
            if ($comment->commentable_type === BlogPost::class) {
            cache()->tags(['blog-post'])->forget("blog-post-{$comment->commentable_id}"); 
            cache()->tags(['blog-post'])->forget('mostCommented');
        
        }
        });

    }
}
