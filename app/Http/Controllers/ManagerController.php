<?php
/**
 * Created by PhpStorm.
 * User: antera
 * Date: 2018/4/15
 * Time: 13:50
 */

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;

class ManagerController extends Controller
{
    public function index(){

        if(Input::get('page')){
            $current_page=Input::get('page');
            $current_page =$current_page <=0 ?1:$current_page;
        }else{
            $current_page=1;
        }
        $perPage=2;

        $managers=new \App\Manager();
        $result=$managers->get_all_managers();

        $item=array_slice($result,($current_page-1)*$perPage,$perPage);
        $total=count($result);
        $paginator=new LengthAwarePaginator($item,$total,$perPage,$current_page,[
            'path'=>Paginator::resolveCurrentPage(),
            'pageName'=>'page',
        ]);
        $paginator=$paginator->setPath('/spaces');

        return view('spaces',['spaces'=>$paginator]);
    }
    public function register(){
        $manager=new \App\Manager();
        $result=$manager->register();
        return redirect('spaces')->with($result);
    }

    public function chosespace(){

    }
}