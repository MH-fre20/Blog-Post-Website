<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends  Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $attributes = [
        'is_admin' => false
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commentOn()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function Image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function BlogPost()
    {
        return $this->hasMany(BlogPost::class);
    }

    public static function scopeWithMostBlogPost($query)
    {
        return $query->withCount('BlogPost')->orderBy('blog_post_count', 'desc');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
