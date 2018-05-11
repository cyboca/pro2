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
    public function login()
    {
        $user = new \App\User();
        $result = $user->login();

        if ($result['status'] == 0)
            return redirect('home');
        else
            return redirect('index')->with($result);
    }

    public function logout()
    {
        $user = new \App\User();
        $user->logout();
        return redirect('index');
    }

    public function register()
    {
        $user = new \App\User();
        $result = $user->register();
        return redirect('index')->with($result);
    }

    public function showaccounts()
    {
        $user = new \App\User();
    }

    public function getpassword()
    {
        $user = new \App\User();
        $result = $user->get_password();
        return redirect('test')->with($result);
    }

    public function decompress()
    {
        $user = new \App\User();
        $result = $user->decompress();

        return redirect('home')->with($result);
    }

    public function build()
    {
        $user = new \App\User();
        $result = $user->deploy();

        return redirect('home')->with($result);
    }

    public function restartContainer()
    {
        $user = new \App\User();
        $container = new \App\Container();

        $user_id = $user->get_current_userid();
        $username=$user->get_current_username();
        $container_id = $container->get_user_container_id($user_id);

        $result = $user->restart_container($container_id,$username);
        return redirect('home')->with($result);
    }

    public function deleteContainer()
    {
        $user = new \App\User();
        $container = new \App\Container();

        $user_id = $user->get_current_userid();
        $container_id = $container->get_user_container_id($user_id);

        // udpate info at database containers
        $container->delete_container($user_id);
        // delete container
        $result = $user->delete_container($container_id);
        return redirect('home')->with($result);
    }

    public function chosespace()
    {
        $user = new \App\User();
        $user->chosespace();

        $result = $user->chosespace();
        return redirect('home')->with($result);
    }
}