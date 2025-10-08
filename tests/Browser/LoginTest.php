<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
 
public function test_login_admin()
{
    $this->browse(function ($browser) {
        $browser->visit('/login')
                ->type('email', 'admin@test.com')
                ->type('password', 'password')
                ->press('Login')
                ->assertPathIs('/admin/dashboard');
    });
}

}
