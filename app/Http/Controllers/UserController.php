<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(): SymfonyResponse
    {
        return response()->view('user.login', [
            'title' => 'Login',
        ]);
    }

    public function doLogin(Request $request): SymfonyResponse
    {
        $user = $request->input('user');
        $password = $request->input('password');

        if (empty($user) || empty($password)) {
            return response()->view('user.login', [
                'title' => 'Login',
                'error' => 'User or password is required',
            ]);
        }

        if ($this->userService->login($user, $password)) {
            $request->session()->put('user', $user);
            return redirect('/');
        }

        return response()->view('user.login', [
            'title' => 'Login',
            'error' => 'User or password is wrong',
        ]);
    }

    public function doLogout(Request $request): SymfonyResponse
    {
        $request->session()->forget('user');
        return redirect('/');
    }
}
