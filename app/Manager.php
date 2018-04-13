<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Request;

class Manager extends Model
{
    //
    public function get_all_managers(){
        $managers=$this->get();
        return ['managers'=>$managers];
    }
    public function get_managers(){
        $managers=$this->count('*');
        return $managers;
    }
    public function login(){
        $code=Request::input('access-code');
        if($code==1234){
            session()->put('admin','accessed');
            return ['status'=>0,'msg'=>'ok'];
        }else{
            return ['status'=>8,'msg'=>'wrong code'];
        }

    }
    public function logout(){
        session()->forget('admin');
    }
}
