<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'blog_post_id' => BlogPost::factory(),
            'tag_id' => Tag::factory()
        ];
    }
}
