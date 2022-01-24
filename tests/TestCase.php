<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    // user(): create user instance for authentication purposes.
    protected function user(){
        return User::factory()->create();
    }
}
