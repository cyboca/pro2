<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user=new \App\User();
        $check=$request->session()->get('check');
        $manager=new \App\Manager();
        $result=$manager->get_all_managers();

        if($check){
            $chosed_space=$user->check_space();
            return view('home',['chosed_space'=>$chosed_space['space'],'spaces'=>$result]);
        }else{
            $space=$manager->get_current_space();
            $users=$user->get_deployed_websites($space);
            return view('home',['users'=>$users,'spaces'=>$result]);
        }


    }
}
