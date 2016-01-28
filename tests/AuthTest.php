<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class AuthTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * @test Register user test
     */
    public function a_user_may_register_for_an_account_but_must_confirm_their_email_address()
    {
        $this->visit('register')
             ->type('John','first_name')
             ->type('Doe','last_name')
             ->type('john.doe@example.com','email')
             ->type('password','password')
             ->press('Register');

        $this->see('Verify your email address')
             ->seeInDatabase('users',['email' => 'john.doe@example.com', 'verified' => '0']);

        $user = User::whereEmail('john.doe@example.com')->first();

        $this->login($user)->see('Could not sign you in');

        $this->visit("register/confirm/{$user->token}")
             ->see('You are now confirmed')
             ->seeInDatabase('users',['email' => 'john.doe@example.com', 'verified' => '1']);
    }

    public function a_user_may_login()
    {
        $this->login()->see('You are now logged in');
    }

    protected function login($user = null)
    {
        $user = $user ?: $this->factory->create('App\User',['password' => bcrypt('password')]);
    }
}
