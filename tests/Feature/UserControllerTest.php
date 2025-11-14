<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage(): void
    {
        $this->get('/login')
            ->assertSeeText("Login");
    }

    public function testLogoutPageFormMember(): void
    {
        $this->withSession([
            "user" => "danny"
        ])->get('/login')
        ->assertRedirect("/");
    }

    public function testLoginSuccess(): void
    {
        $this->post('/login', [
            "user" => "danny",
            "password" => "rahasia"
        ])->assertRedirect("/")
          ->assertSessionHas("user", "danny");
    }
    public function testLoginSuccessAlreadyLogin(): void
    {
        $this->withSession( [
            "user" => "danny"
        ])->post('/login',[
            "user" => "danny",
            "password" => "rahasia"
        ])->assertRedirect("/");

    }

    public function testLoginValidationError(): void
    {
        $this->post("/login", [])
            ->assertSeeText("User or password is required");
    }

    public function testLoginFailed(): void
    {
        $this->post('/login', [
            "user" => "wrong",
            "password" => "wrong"
        ])->assertSeeText("User or password is wrong");
    }


       public function testLogout(): void
    {
        $this->withSession([
            "user" => "danny"
        ])->post('/logout')
        ->assertRedirect("/")
        ->assertSessionMissing("user");
    }
    public function testLogoutGuest(): void
    {
        $this->post('/logout')
        ->assertRedirect("/");
    }
}
