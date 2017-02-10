<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class LoginController extends Controller
{
    public function doLogin(Request $request){
        $data = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if(Auth::attempt($data))
        {
          $new_token  = str_random(500);
          $find = \App\User::find(Auth::user()->id);
          $find->update(['token' => $new_token]);

          $res['code']      = 200;
          $res['message']   = 'success';
          $res['user']      = \App\User::find(Auth::user()->id);

        }
        else{
          $res['code']      = 400;
          $res['message']   = 'Username or Password error';
        }

        return $res;
    }
}
