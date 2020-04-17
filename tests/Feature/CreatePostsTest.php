<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreatePostsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     * @group create-post
     */
    public function testCanCreatePost(){
        //arrage
        //action
        $resp = $this->post('/store-post', [
            'title' => 'new post title',
            'body' => 'new post body'
            ]);
        //assert
        $this->assertDatabaseHas('posts', [
            'title' => 'new post title',
            'body' => 'new post body'
        ]);

        $post = Post::find(1);
        $this->assertEquals('new post title', $post->title);
        $this->assertEquals('new post body', $post->body);

    }

    /**
     * @group title-req
     */
    public function testTitleIsRequiredToCreatePost(){
        $resp = $this->post('/store-post', [
            'title' => null,
            'body' => 'new post body'
        ]);

        $resp->assertSessionHasErrors('title');
    }

    /**
     * @group body-req
     */
    public function testBodyIsRequiredToCreatePost(){
        $resp = $this->post('/store-post', [
            'title' => 'new post title',
            'body' => null
        ]);

        $resp->assertSessionHasErrors('body');
    }
}
