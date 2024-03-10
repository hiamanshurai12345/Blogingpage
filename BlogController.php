<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    function upload_blogs()
    {
        return view("upload_blogs");
    }

    function save_blog(Request $request)
    {
        // fetch form data
        $t1 = $request->t1;
        $d1 = $request->d1;

        // logic for photo upload

        // rename file
        $k = uniqid().".".$request->f1->extension();

        // move()
        $request->f1->move(public_path("uploads"),$k);

        // save all values to database

        $obj = new Blog();

        $obj->title = $t1;
        $obj->description = $d1;
        $obj->photo = $k;

        $obj->save();

        echo "Blog has been Uploaded Succcessfully.";

    }


    function display_blog()
    {
        // fetch data from blogs table
        $k = Blog::all();

        return view("display_blog",compact('k'));

        // data send controller -----> view : compact()
    }

    function delete_blog($id)
    {
        Blog::find($id)->delete();

        return redirect("display_blog");
    }

    function logout()
    {
        Auth::logout();
        return redirect("login");

    }
}
