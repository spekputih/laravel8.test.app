<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_home_page_is_working_correctly()
    {
        $response = $this->get('/');

        $response->assertSeeText('Hello world');
    }

    public function text_contact_page_is_working_correctly()
    {
        $response = $this->get('/contact');

        $response->assertSeeText('this is contact page');
    }
}
