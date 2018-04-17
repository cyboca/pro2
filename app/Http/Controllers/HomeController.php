<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user=new \App\User();
        $username=$request->session()->get('username');

        $managers=new \App\Manager();
        $result=$managers->get_all_managers();

        $space=$user->check_space();
        return view('home',$space,['managers'=>$result]);

    }
}
