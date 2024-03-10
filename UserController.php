<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function register()
    {
        return view("register");
    }

    function save(Request $request)
    {
        // Fetch Form Values
        // $variable = $request->columnname;

        $n1 = $request->n1;
        $e1 = $request->e1;
        $p1 = Hash::make($request->p1); // encrypt password

        // Save to Users Table

        // Create Object of User Model
        $k = new User();
        $k->name = $n1;
        $k->email = $e1;
        $k->password = $p1;

        $k->save();


        // go to login page
        return redirect('login');

    }

    function login()
    {
        return view("login");
    }

    function login_check(Request $request)
    {
        // fetch form
        $e1 = $request->e1;
        $p1 = $request->p1;

        // Logic Login
        $k = Auth::attempt(['email'=>$e1, 'password'=>$p1]);

        if($k)
        {
            return redirect("dashboard");
        }
        else
        {
            echo "Invalid Login";
        }
    }

    function dashboard()
    {
        return view("dashboard");
    }
}
