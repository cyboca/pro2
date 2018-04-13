<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $username=$request->session()->get('username');
        $path="http://192.168.27.210/websites/$username";
        if(file_exists($path."/index.html")){
            return view('home',['path'=>$path]);
        }else{
            return view('home',['path'=>$path]);
        }
    }
}
