<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
  public function testGuest()
  {
    $this->get('/')
    ->assertRedirect("/login");
  }

  public function testMember()
  {
    $this->withSession([
        "user"=> "danny"
    ])->get('/')
    ->assertRedirect("/todolist");
  }
}

