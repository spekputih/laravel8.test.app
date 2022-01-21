<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use app\Models\BlogPost;
use app\Models\Comment;

class PostTest extends TestCase
{
    use RefreshDatabase;
    public function test_no_blog_posts_when_nothing_in_database()
    {
        $response = $this->get('/posts');
        $response->assertSeeText('No posts found');
    }

    public function testPostIndexWithNoComment()
    {
        // arrange
        $post = $this->createDummyBlogPost();

        // action
        $response = $this->get('/posts');
        
        // assert
        $response->assertSeeText('New titles');
        $response->assertSeeText('No comment yet');
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New titles'
        ]);
    }

    public function testPostIndexWithComment(){
        $post = $this->createDummyBlogPost();
        Comment::factory()->count(3)->create([
            'blog_post_id' => $post->id
        ]);
        $response = $this->get('/posts');
        $response->assertSeeText('3 comments');
    }

    public function testStoreValid(){
        // add valid parameters to be inserted into the database through post route
        $params = [
            'title' => 'Valid title',
            'content' => 'At least 10 characters'
        ];
        // action: send the params to the /posts route
        // use assertStatus to check whether the response has successfull redirect action
        // use assertSessionHas to identify whether the response has 'status' parameters in it 
        $this->post('/posts', $params)->assertStatus(302)->assertSessionHas('status');

        // use assertEquals to validate that the 'status' possess in the session has the same value as expected
        $this->assertEquals(session('status'), 'The post has been created!');
    }
    
    public function testStoreFail(){
        // Objective: to check the validation action is working properly by introducing the invalid params and expect the app is going to display an error message and reject the request
        // add valid parameters to be inserted into the database through post route
        $params = [
            'title' => 'x',
            'content' => 'x'
        ];
        // action: send the params to the /posts route
        // use assertStatus to check whether the response has successfull redirect action
        // use assertSessionHas to identify whether the response has 'status' parameters in it 
        $this->post('/posts', $params)->assertStatus(302)->assertSessionHas('errors');

        // store the errors message in the $message variable
        $message = session('errors')->getMessages();

        // use assertEquals to validate the particular $message variable has the same value as what is expected
        $this->assertEquals($message['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($message['content'][0], 'The content must be at least 5 characters.');
    }
    public function testUpdateValid(){
        // create new post as a reference for update action after this.
        $post = $this->createDummyBlogPost();
        
        // check if the insertion into database successfull
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New titles',
            'content' => 'Content of the blog post'
        ]);
        
        // configure update action
        $params = [
            'title' => 'A new update for title',
            'content' => 'A new update for content'
        ];

        // update action
        $this->put("/posts/{$post->id}", $params)->assertStatus(302)->assertSessionHas('status');
        $this->assertEquals(session('status'), 'Blog Post has been Updated!');
        $this->assertDatabaseMissing('blog_posts', $post->toArray());
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'A new update for title', 
        ]);
    }

    public function testDelete(){
        $post = $this->createDummyBlogPost();
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New titles',
            'content' => 'Content of the blog post'
        ]);
        $this->delete("/posts/{$post->id}")->assertStatus(302)->assertSessionHas('status');
        $this->assertEquals(session('status'), 'The post was deleted!');
    }

    private function createDummyBlogPost(): BlogPost{
        // $post = new BlogPost();
        // $post->title = 'New titles';
        // $post->content = 'Content of the blog post';
        // $post->save();
        // return $post;
        return BlogPost::factory()->newPost()->create();
    }





}

