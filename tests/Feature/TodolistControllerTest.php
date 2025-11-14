<?php

namespace Tests\Feature;

use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "user" => "danny",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Danny"
                ],
                [
                    "id" => "2",
                    "todo" => "Parlin"
                ],
            ]
        ])
        ->get('/todolist')
        ->assertSeeText("1")
        ->assertSeeText("danny") // harus sesuai session
        ->assertSeeText("2")
        ->assertSeeText("Parlin");
    }
}
