<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{    
    public function index()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        try {

            $validator = Validator::make(
                $request->all(),
                [
                    'username' => 'required',
                    'password' => 'required',
                ], [
                    'username.required' => 'Username is required.',
                    'password.required' => 'Password is required.',
                ]
            );      
            
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $admin = Admin::where('username', $request->username)->first();

            if (empty($admin)) {
                throw new Exception('Account not exist with provided username.');
            }

            if (! password_verify($request->password, $admin->password)) {
                throw new Exception('Password is invalid.');
            }

            Auth::login($admin);

            // Redirect to the intended URL if available, otherwise to dashboard
            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            return redirect()->route('login.index')->with('alertmsg', $e->getMessage());
        }
    }  
    
    public function logout(Request $request)
    {
        // Store the current URL in session before logging out
        $request->session()->put('url.intended', url()->previous());

        Auth::logout();

        return redirect(route('login.index'));
    }    

}
