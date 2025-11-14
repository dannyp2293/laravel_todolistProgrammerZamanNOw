<?php

namespace App\Services\Impl;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImpl implements TodolistService
{
    public function saveTodo(string $id, string $todo): void
    {
        if (!Session::has("todoList")) {
            Session::put("todoList", []);
        }

        Session::push("todoList", [
            "id" => $id,
            "todo" => $todo
        ]);
    }

    public function getTodolist(): array
    {
        return Session::get("todoList", []);
    }

    public function removeTodo(string $todoId): void
    {
        $todolist = Session::get("todoList");

        foreach ($todolist as $index => $value) {
            if ($value['id'] === $todoId) {
                unset($todolist[$index]);
                break;
            }
        }

        Session::put("todoList", $todolist);
    }
}
