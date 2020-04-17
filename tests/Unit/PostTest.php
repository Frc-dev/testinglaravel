<?php

namespace Tests\Unit;

use App\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PostTest extends TestCase

{
    use DatabaseMigrations;

    /**
     * @group formatted-date
     *
     */
    public function testCanGetCreatedAtDate(){
        //arrange
        $post = Post::create([
            'title' => 'A simple title',
            'body' => 'A simple body'
        ]);
        //create poost
        //act
        //get value by calling the method
        $formattedDate = $post->createdAt();
        //assert
        //assert that returned value is expected
        $this->assertEquals(
            $post->created_at->toFormattedDateString(),
            $formattedDate
            );
    }
}
