<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AboutPageTest extends TestCase
{
    public function testCanViewAboutPage(){
        $resp = $this->get('/about');

        $resp->assertStatus(200);

        $resp->assertSee('About me');
    }
}
