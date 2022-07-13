<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        return view('login');
    }
    public function check_login(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect('admin/category');
        } else {
            dd('sai');
        }

    }
    public function logout(){
            Auth::logout();
            return redirect('login');
    }
}
