<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    function home()
    {
        // fetch from Blog Table
        $k = Blog::all();

        return view("home",compact('k'));

        // compact() - Send Data from Controller to View
    }

    function about()
    {
        return view('about');
    }

    function blog_description($id)
    {
        // Blog Table data fetch on basis of "id"
        // select * from blog where id='$id'

        $z = Blog::find($id); // find() is a function.

        return view("blog_description",compact('z'));


    }

    function contact()
    {
        return view("contact");
    }

    function inquiry(Request $request)
    {
        // fetch form values
        $n1 = $request->n1;
        $m1 = $request->m1;
        $message = $request->message;

        // Logic for Sending Email
        Mail::raw($message,function($k){
            $k->sender("zeeshan@gmail.com","Zeeshan");
            $k->subject("new admission inquiry");
            $k->to("abc@gmail.com","abc");
        });

        echo "We will contact you soon.";
    }
}
