<?php

namespace App\Providers;

use App\Services\TodolistService;
use App\Services\Impl\TodolistServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TodolistServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        TodolistService::class => TodolistServiceImpl::class,
    ];

    public function provides(): array
    {
        return [TodolistService::class];
    }

    public function register(): void
    {
        // Tidak perlu isi apa-apa karena sudah pakai $singletons
    }

    public function boot(): void
    {
        // Kosong juga tidak masalah
    }
}
