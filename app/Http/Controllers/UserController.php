<?php
/**
 * Created by PhpStorm.
 * User: antera
 * Date: 2018/4/11
 * Time: 21:34
 */

namespace App\Http\Controllers;
use \App\User;

class UserController extends Controller
{
    public function login(){
        $user=new \App\User();
        $result=$user->login();

        if($result['status']!=0)
            return redirect('index')->with($result);
        else
            return redirect('home');
    }

    public function logout(){
        $user=new \App\User();
        $user->logout();
        return redirect('index');
    }

    public function register(){
        $user=new \App\User();
        $result=$user->register();
        return redirect('index')->with($result);
    }

    public function showaccounts(){
        $user=new \App\User();
    }

    public function getpassword(){
        $user=new \App\User();
        $result=$user->get_password();
        return redirect('test')->with($result);
    }

    public function deploy(){
        $user=new \App\User();
        $result=$user->deploy();

        return redirect('home')->with($result);
    }

    public function chosespace(){
        $user=new \App\User();
        $user->chosespace();

        $result=$user->chosespace();
        return redirect('home')->with($result);
    }
}