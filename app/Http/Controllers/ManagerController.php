<?php
/**
 * Created by PhpStorm.
 * User: antera
 * Date: 2018/4/15
 * Time: 13:50
 */

namespace App\Http\Controllers;


class ManagerController extends Controller
{
    public function index(){
        $managers=new \App\Manager();
        $result=$managers->get_all_managers();
        return view('managers',['managers'=>$result]);
    }
    public function register(){
        $manager=new \App\Manager();
        $result=$manager->register();
        return redirect('managers')->with($result);
    }
}