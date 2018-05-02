<?php
/**
 * Created by PhpStorm.
 * User: antera
 * Date: 2018/4/13
 * Time: 11:34
 */

namespace App\Http\Controllers;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

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

    public function backend(Request $request){


        if(Input::get('page')){
            $current_page=Input::get('page');
            $current_page =$current_page <=0 ?1:$current_page;
        }else{
            $current_page=1;
        }
        $perPage=2;

        $manager=new \App\Manager();
        /* count managers */
        $managers=$manager->get_managers();

        $user=new \App\User();
        /* count users */
        $users=$user->get_users();

        $sizes=$manager->get_size(2);

        $item=array_slice($sizes,($current_page-1)*$perPage,$perPage);
        $total=count($sizes);
        $paginator=new LengthAwarePaginator($item,$total,$perPage,$current_page,[
            'path'=>Paginator::resolveCurrentPage(),
            'pageName'=>'page',
        ]);
        $paginator=$paginator->setPath('/backend');


        return view('backend',['managers'=>$managers,'users'=>$users,'sizes'=>$paginator]);
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

    public function deletespace(){
        $space=new \App\Manager();
        $space->deletespace();

        return redirect('spaces')->with(['status'=>0,'msg'=>'delete space success']);
    }

    public function modifyspace(){
        $space=new \App\Manager();
        return $space->get_space();
    }

    public function modifyspacelimit(){
        $space=new \App\Manager();
        $result=$space->modifyspacelimit();

        return redirect('spaces')->with($result);
    }
}