<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        $domain = "STVW";
        return view("auth.index",[
            'domain' => $domain,
        ]);
    }

    public function submit(LoginRequest $request) {
        if(!Auth::attempt(['username' => $request->get('username'), 'password' => $request->get('password')]))
        {
            return redirect()->back()->withErrors([
                'invalid_auth' => 'false',
                'username' => 'false',
                'password' => 'false'
            ])->withInput();
        }
    }
}
