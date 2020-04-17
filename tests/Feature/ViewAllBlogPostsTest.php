<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class ViewAllBlogPostsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @group posts
     */
    public function testCanViewAllBlogPosts(){
        //arrange
        $post1 = factory(Post::class)->create();
        $post2 = factory(Post::class)->create();

        //action
        $resp = $this->get('/posts');
        //assert
        $resp->assertStatus(200);
        $resp->assertSee($post1->title);
        $resp->assertSee($post2->title);
        $resp->assertSee(Str::limit($post1->body));
        $resp->assertSee(Str::limit($post2->body));



    }
}
