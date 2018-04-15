<?php
/**
 * Created by PhpStorm.
 * User: antera
 * Date: 2018/4/13
 * Time: 11:34
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;
use Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin');
    }
    public function login(){
       $admin=new \App\Admin();
       $result=$admin->login();
       if($result['status']!=0){
           return redirect('test')->with('error','wrong code');
       }else{
           return redirect('backend');
        }
    }

    public function backend(){

        $manager=new \App\Manager();
        /* count managers */
        $managers=$manager->get_managers();

        $user=new \App\User();
        /* count users */
        $users=$user->get_users();

        $sizes=$manager->get_size();

        return view('backend',['managers'=>$managers,'users'=>$users,'sizes'=>$sizes]);
    }

//    public function managers(){
//        $manager=new \App\Manager();
//        $result=$manager->get_all_managers();
//        return view('managers',$result);
//    }

    public function space(){
        return view('space');
    }
    public function logout(){
        $manager=new \App\Manager();
        $manager->logout();
        return redirect('index');
    }
    /* print managers list */
    public function test(){
        $manager=new \App\Manager();
        $result=$manager->get_size();
        return view('test',['sizes'=>$result]);
    }
}