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
        return redirect('index')->with($result);
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
}