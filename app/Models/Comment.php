<?php

namespace App\Models;

use App\Scopes\LatestScopeComment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function BlogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new LatestScopeComment);
    }
}
