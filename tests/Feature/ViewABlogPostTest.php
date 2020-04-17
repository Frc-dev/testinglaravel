<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewABlogPostTest extends TestCase
{
    use DatabaseMigrations;

    public function testCanViewABlogPost()
    {
        //ARRANGEMENT
        //creating a blog post
        $post = Post::create([
            'title' => 'A simple title',
            'body' => 'A simple body'
        ]);
        //ACTION
        //visiting a route
        $resp = $this->get("/post/{$post->id}");
        //ASSERT
        //assert status code 200
        $resp->assertStatus(200);
        //assert that we see post title
        $resp->assertSee($post->title);
        //assert that we see post body
        $resp->assertSee($post->body);
        //assert that we see published date
        $resp->assertSee($post->created_at->toFormattedDateString());
    }

    /**
     * @group post-not-found
     *
     */

    public function testViews404PageWhenPostNotFound(){
        //ACTION
        $resp = $this->get('post/INVALID_ID');
        //ASSERT
        $resp->assertStatus(404);
        $resp->assertSee("The page you are looking for cannot be found");
    }
}
