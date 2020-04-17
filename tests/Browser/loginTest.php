<?php

namespace Tests\Browser;

use App\User;
use App\Post;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class loginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @group login
     * @throws \Throwable
     */
    public function testUserCanLogin(){
        $user = factory(User::class)->create();

        $this->browse(function(Browser $browser) use ($user){
           $browser->visit('/login')
               ->type('email', $user->email)
               ->type('password', 'secret')
               ->press('Login')
               ->assertPathIs('/home');
        });
    }

    /**
     * @group posts-page
     */
    public function testUserCanViewPost(){
        $post = factory(Post::class)->create();

        $this->browse(function(Browser $browser) use ($post){
            $browser->visit('/posts')
                ->clickLink('View Post Details')
                ->assertPathIs("/post/{$post->id}")
                ->assertSee($post->title)
                ->assertSee($post->body)
                ->assertSee($post->createdAt());
        });
    }


}
