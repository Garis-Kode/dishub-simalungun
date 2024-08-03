<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        $data = [
            'title' => 'Login',
            'subTitle' => null,
            'page_id' => null
        ];
        return view('auth.login',  $data);
    }

    public function register(){
        $data = [
            'title' => 'Register',
            'subTitle' => null,
            'page_id' => null
        ];
        return view('front.auth.register',  $data);
    }
}
