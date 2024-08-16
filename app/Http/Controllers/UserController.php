<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails())
        {
            return response()->json(['status'=>false,'errors'=>$validator->messages()]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return response()->json(['status'=>true,'redirect'=>route('login')]);
    }

    public function login_check(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $redirect = $this->dashboard();
            return response()->json(['status'=>true,'redirect'=>$redirect]);
        }
    }

    public function dashboard()
    {
        if(Auth::check())
        {
            return route('dashboard');
        }
        else
        {
            return route('login');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function index()
    {
        $title = 'Users - Flawless Beauty';

        $users = User::get();

        return view('admin.users.listing',compact('title','users'));
    }

    public function create()
    {
        $title = "Add User - Flawless Beauty";
        return view('admin.users.addEditUser',compact('title'));
    }

    public function edit($id)
    {
        $title = 'Edit User - Flawless Beauty';
        $user = User::find($id);
        return view('admin.users.addEditUser',compact('title','user'));
    }
}
