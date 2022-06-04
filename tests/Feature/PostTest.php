<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

     /** @test */
    public function PostTest()
    {
        $user = User::factory()->create();
        $post = BlogPost::factory(['user_id' => $user->id])->count(4);
        $post = new BlogPost();
        $post->title = 'New title';
        $post->content = 'the content';
        $post->user_id = $user->id;
        $post->save();

        $this->assertSame($user->id, $post->user_id);
        //to be sure about the post  belongsTo a user
        $this->assertInstanceOf(User::class, $post->user);
        //$this->assertInstanceOf(HasMany::class, $post);
        //method 2
        $this->assertEquals(1, $user->BlogPost->count());

        $hello = 'hello';
        $world = 'hello';
        $true = true;
        $this->assertEquals($hello, $world);
        $this->assertTrue($true);

        //Act
        $response = $this->get('/posts');

        //Assert
        $response->assertSeeText('New title');
    }
}
