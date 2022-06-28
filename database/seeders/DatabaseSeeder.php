<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use HasFactory;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        /* DB::table('users')->insert([
            'name' => 'unit',
            'email' => 'unit@gmail.com',
            'email_verified_at' => now(),
            'password' => '$XUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'is_admin' => '0'
        ]); */
        // \App\Models\User::factory(10)->create();
        //factory(App\User::class, 20)->create;

        $this->call([
            UserTableSeeder::class,
            BlogPostTableSeeder::class,
            CommentTableSeeder::class,
            TagsTableSeeder::class,
            BlogPostTagTableSeeder::class
        ]);

        //$user = User::factory()->count(5)->create();
        //Tag::factory()->count(5)->create();

        /* $user = User::factory()->count(23)->create();

        BlogPost::factory()->make()->each(function($post) use ($user) {
            $post->user_id = $user->random()->id;
            $post->save(); */

        //dd($user);

        /* $this->call(
            TagsTableSeeder::class
        ); */
    }
}
