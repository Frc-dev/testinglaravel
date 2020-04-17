<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreatePostTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * @group create-post
     */
    public function testAuthUserCanCreatePost(){
        $user = factory(User::class)->create();

        $this->browse(function(Browser $browser) use ($user){
            $browser->loginAs($user)
                ->visit('/create-post')
                ->type('title', 'New post')
                ->type('body', 'New body')
                ->press('Save Post')
                ->assertPathIs('/posts')
                ->assertSee('New post')
                ->assertSee('New body');
        });
    }

    /**
     * @group create-post-auth
     * @throws \Throwable
     */
    public function testOnlyAuthUserCanCreatePost(){

        $this->browse(function(Browser $browser){
            $browser
                ->logout()
                ->visit('/create-post')
                ->assertPathIs('/login');
        });
    }
}
