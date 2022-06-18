<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = BlogPost::all();
        $CommentCount = max((int)$this->command->ask('how many BlogPost do you want to create?', 5), 1);
        Comment::factory($CommentCount)->make()->each(function($Comment) use ($post) {
            $Comment->blog_post_id = $post->random()->id;
            $Comment->save();
    });
    }
}
