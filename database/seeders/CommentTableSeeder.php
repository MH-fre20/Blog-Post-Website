<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
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
        $user = User::all();

        if ($post->count() === 0 || $user->count() === 0) {
            $this->command->info('There are no blog posts or users, so no comments will be added');
            return;
        }

        $CommentCount = max((int)$this->command->ask('how many Comments do you want to create?', 5), 1);

        Comment::factory($CommentCount)->make()->each(function ($Comment) use ($post, $user) {
            $Comment->Commentable_id = $post->random()->id;
            $Comment->Commentable_type = BlogPost::class;
            $Comment->user_id = $user->random()->id;
            $Comment->save();
        });

        Comment::factory($CommentCount)->make()->each(function ($Comment) use ($user) {
            $Comment->Commentable_id = $user->random()->id;
            $Comment->Commentable_type = User::class;
            $Comment->user_id = $user->random()->id;
            $Comment->save();
        });
    }
}
