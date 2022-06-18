<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogPostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = Tag::inRandomOrder()->get()->pluck('id');

        BlogPost::all()->each(function (BlogPost $post) use ($tag) {
            $post->tags()->sync($tag);
        });
    }
}
