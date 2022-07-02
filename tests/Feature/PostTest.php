<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PostTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic feature test example.
     *
     * @return void
     */

     /** @test */

    public function test_Post_Test()
    {
        $user = User::factory()->create();
        $post = BlogPost::factory(['user_id' => $user->id])->count(4);
        $post = new BlogPost();
        $post->title = 'New title';
        $post->content = 'the content';
        $post->user_id = $user->id;
        $post->save();

        $this->assertSame($user->id, $post->user_id);
        //to be sure about the post belongsTo a user
        $this->assertInstanceOf(User::class, $post->user); 
        //$this->assertInstanceOf(HasMany::class, $post);
        //method 2

        //to see if we have BlogPost function in user class
        /* $this->assertEquals(1, $user->BlogPost->count()); */
        $post = new BlogPost();
        $post->title = 'New title';
        $post->content = 'the content';
        $post->user_id = $user->id;
        $post->save();

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

    public function test_blog_posts()
    {
        $blogpost = $this->get('/posts');
        $blogpost->assertSeeText('No posts Found!!!');
    }

    public function test_see_blog_post()
    {
        $user = User::factory()->create();
        $post = new BlogPost();
        $post->title = 'hellow';
        $post->content = 'content';
        $post->user_id = $user->id;
        $post->save();

        $object = $this->get('/posts');
        $object->assertSeeText('hellow');

        $this->assertDatabaseHas('blog_posts',[
            'title' => 'hellow'
        ]);
    }

    public function test_in_database()
    {
        $user = User::factory()->create();
        $post = new BlogPost();
        $post->title = 'hellow';
        $post->content = 'content';
        $post->user_id = $user->id;
        $post->save();

        $this->get('/posts')->assertSeeText('hellow');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'hellow'
        ]);

        $this->get('/posts')
        ->assertSeeText('hellow');
    }

    public function test_if_stored()
    {
        
        $param = [
            'title' => 'nihaw',
            'content' => 'haha'
        ];
    
        $this->post('/posts', $param)
        ->assertStatus(302);
    }

    public function test_if_updated()
    {
        $user = $this->user();
        $post = new BlogPost();
        $post->title = 'hellow';
        $post->content = 'content';
        $post->user_id = $user->id;
        $post->save();

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'hellow'
        ]);

        $param = [
            'title' => 'hellow darkness',
            'content' => 'i am good'
        ];

        $this->put("/posts/{$post->id}", $param)
        ->assertStatus(302);
    }

    public function test_if_deleted()
    {
        $user = User::factory()->create();
        $post = new BlogPost();
        $post->title = 'hellow';
        $post->content = 'content';
        $post->user_id = $user->id;
        $post->save();

        $this->delete("/posts/{$post->id}")
        ->assertStatus(302);
    }
}
