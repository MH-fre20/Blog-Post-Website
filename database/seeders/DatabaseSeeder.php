<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
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

        DB::table('users')->insert([
            'name' => 'phpunit',
            'email' => 'phpunit@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        // \App\Models\User::factory(10)->create();
        //factory(App\User::class, 20)->create;
        User::factory()->count(5)->create();
    }
}
