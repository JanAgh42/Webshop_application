<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            return redirect()->to('/');
        }

        return redirect("/")->with("success", "Login details are not valid");
        
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6'
        ]);

        $data = $request->all();

        $user = new Customer();

        $user->id = Str::uuid();
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        $credentials = $request->only('email', 'password');

        Auth::attempt($credentials);

        return redirect()->to('/');
    }

    function logout(){
        session()->flush();
        Auth::logout();
        return redirect()->back();
    }

    //Admin part

    function registerAdmin(Request $request){
        $request->validate([
            'email' => 'required|email|unique:admins',
            'password' => 'required',
        ]);

        $data = $request->all();

        $admin = new Admin();

        $admin->id = Str::uuid();
        $admin->email = $data['email'];
        $admin->password = Hash::make($data['password']);
        $admin->save();

        return redirect()->to('/admin/product/add');
    }

    function loginAdmin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->guard('admin')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])){
            return redirect()->to('/admin/product/add')->with('success','You are Logged in sucessfully.');
    }

    return redirect()->to('/admin/login');
}

    function logoutAdmin(){
        auth()->guard('admin')->logout();
        session()->flush();
        return redirect()->to('/admin/login');
    }
}
