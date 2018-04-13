<?php
/**
 * Created by PhpStorm.
 * User: antera
 * Date: 2018/4/13
 * Time: 11:14
 */

namespace App\Http\Controllers;


class TestController extends Controller
{
    public function index(){
        return view('test');
    }
}