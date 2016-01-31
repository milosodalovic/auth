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
             ->type('password','password_confirmation')
             ->press('Register');

        $this->see('Verify your email address to access the application')
             ->seeInDatabase('users',['email' => 'john.doe@example.com', 'confirmed' => '0']);

        $user = User::whereEmail('john.doe@example.com')->first();

        $this->login($user)->see('Verify your email address to access the application');

        $this->visit("register/confirm/{$user->token}")
             ->see('Landing Page')
             ->seeInDatabase('users',['email' => 'john.doe@example.com', 'confirmed' => '1']);
    }

    /**
     * @test Login user test
     */
    public function a_user_may_login()
    {
        $this->login()->see('Landing Page');
    }

    protected function login($user = null)
    {
        $user = $user ?: factory(User::class)->create(['password' => bcrypt('password')]);

        $this->visit('login')
             ->type($user->email,'email')
             ->type('password','password')
             ->press('Login');

        return $this;
    }
}
