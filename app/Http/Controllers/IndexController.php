<?php
/**
 * Created by PhpStorm.
 * User: antera
 * Date: 2018/4/9
 * Time: 10:13
 */

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;


class IndexController extends Controller
{
    public function index(){
        //$users=DB::select('select username from users where deployed=1');
//        $users=DB::table('users')->paginate(4);
        $user=new \App\User();
        $users=$user->get_deployed_websites();
        return view('index',['users'=>$users]);
    }
}