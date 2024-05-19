<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller 
{

    public function show()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $rules = [
            'name' => 'required',
            'password' => 'required'
        ];

        $validator = Validator::make($input, $rules);

        if ($validator->passes()) {
            $attempt = Auth::attempt([
                'name' => $input['name'],
                'password' => $input['password']
            ]);

            if ($attempt) {
                return redirect()->to('students');
            }

            return redirect()->to('login')
                    ->withErrors(['fail' => 'Name or password is wrong!']);
        }

        // Fails
        return redirect()->to('login')
                    ->withErrors(['fail' => 'Email or password is wrong!']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->to('');
    }

}
