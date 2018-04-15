<?php
/**
 * Created by PhpStorm.
 * User: antera
 * Date: 2018/4/15
 * Time: 15:32
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Request;

class Admin extends Model
{
    public function login(){
        $code=Request::input('access-code');
        if($code==1234){
            session()->put('admin','accessed');
            return ['status'=>0,'msg'=>'ok'];
        }else{
            return ['status'=>8,'msg'=>'wrong code'];
        }

    }
}