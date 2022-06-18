<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::all();
        $BlogPostCount = max((int)$this->command->ask('how many BlogPost do you want to create?', 5), 1);
        BlogPost::factory($BlogPostCount)->make()->each(function($post) use ($user) {
            $post->user_id = $user->random()->id;
            $post->save();
        });
    }
}
