<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_if_there_are_register_button_in_login_page()
    {
        $this->visit('/login')->see('You can register here');
//        $this->assertTrue(true);
    }
}
