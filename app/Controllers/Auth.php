<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function loginUser(): string
    {
        $data = [
            'title' => 'Login user',
            'header' => 'Login',
            'register' => '/register-user'
        ];
        return view('auth/login', $data);
    }

    public function loginAdmin(): string
    {
        $data = [
            'title' => 'Login Admin',
            'header' => 'Login Admin',
            'register' => '/admin/register'
        ];
        return view('auth/login', $data);
    }

    public function registerUser(): string
    {
        $data = [
            'title' => 'Register user',
            'header' => 'Register',
            'login' => '/login-user'
        ];
        return view('auth/register', $data);
    }

    public function registerAdmin(): string
    {
        $data = [
            'title' => 'Register admin',
            'header' => 'Register admin',
            'login' => '/admin/login'
        ];
        return view('auth/register', $data);
    }
}