<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;

class UserController extends Controller
{
    public function session(Request $request)
    {
        
    }

    public function get($id) 
    {
        $user = User::where('id', $id)->first();
        return $user;
    }

    public function store(Request $request)
    {
        $user = new User;

        $user->username = $request->username;
        $user->password = Hash::make($request->password);

        $user->save();

        return $user;
    }
}
