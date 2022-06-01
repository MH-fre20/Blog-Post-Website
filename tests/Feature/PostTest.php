<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        //$response = $this->get('/posts');

        $this->assertTrue(true);
    }

    public function testSeeOneBlogPost()
    {
        /* $post = new BlogPost();
        $post->title = "new title";
        $post->content = "content of the post";
        $post->save(); */
        $post = $this->createDummyBlogPost();

        // Act
        $response = $this->get('/posts');

        //Assert
        $response->assertSeeText("new title");

        $this->assertDatabaseHas('blog_posts', [
            'title' => "new title"
        ]);
    }

    public function testStore() 
    {
        $param = [
            'title' => 'valid title',
            'content' => 'At least 10'
        ];

        $this->post('/posts', $param)->assertStatus(302)->assertSessionHas('status');

        $this->assertEquals(session('status'), 'blog was 
        created by yourself');
    }

    public function teststorefail() 
    {
        $paramss = [
            'title' => 'x',
            'content' => 'x'
        ];

        $this->post('/posts', $paramss)->assertStatus(302)->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');

        $this->assertEquals($messages['content'][0], 'The content must be at least 5 characters.');
        /* dd($messages->getMessages()); */
    }

    public function testupdatevalid()
    {
        /* $post = new BlogPost();
        $post->title = "new title";
        $post->content = "content of the post";
        $post->save(); */
        $post = $this->createDummyBlogPost();

        $this->assertDatabaseHas('blog_posts', [
            'title' => "new title"
        ]);

        $paramss = [
            'title' => 'x new',
            'content' => 'x new one'
        ];

        $this->put("/posts/{$post->id}", $paramss)->assertStatus(302)->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was updated');

        $this->assertDatabaseMissing('blog_posts', [
            'title' => "new title"
        ]);
    }

    public function testDelete()
    {
        $post = $this->createDummyBlogPost();

        $this->assertDatabaseHas('blog_posts', [
            'title' => "new title"
        ]);

        $this->delete("/posts/{$post->id}")->assertStatus(302)->assertSessionHas('status');

        $this->assertEquals(session('status'), 'blog post was deleted');

        $this->assertDatabaseMissing('blog_posts', [
            'title' => "new title"
        ]);

    }

    private function createDummyBlogPost(): BlogPost
    {
        $post = new BlogPost();
        $post->title = "new title";
        $post->content = "content of the post";
        $post->save();
        return $post;
    }

}
