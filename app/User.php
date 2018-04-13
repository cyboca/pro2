<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Request;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

//    /* check login user or manager */
//    public function check_type(){
//        $type=Request::get('demo-radio');
//        if($type==0){
//            $result=$this->user_login();
//            return $result;
//        }else{
//            $result=$this->manager_login();
//            return $result;
//        }
//    }

    /* get deployed websites */
    public function get_deployed_websites()
    {
        $users = $this->where('deployed', '=', 1)->paginate(3);
        return $users;
    }

    /* check username and password empty */
    public function user_passwd_not_empty()
    {
        $username = Request::get('username');
        $password = Request::get('password');
        if ($username != "" && $password != "") {
            return ['status' => 0, 'msg' => 'ok', 'username' => $username, 'password' => $password];
        } elseif ($username == "") {
            return ['status' => 1, 'msg' => 'username empty'];
        } else {
            return ['status' => 2, 'msg' => 'password empty'];
        }
    }

    /* username and password validation check */
    public function user_passwd_valid_check($username, $password)
    {
        $userlen = 0;
        $passlen = 0;

        $userpatt="/[a-zA-Z][a-zA-Z0-9]{5,}/";
        $passpatt="/[a-zA-Z0-9!@#$%^&*-_=+]{8,}/";

        $userlen = strlen($username);
        $passlen = strlen($password);

        /* check username length */
        if ($userlen < 6 || $userlen > 15) {
            return ['status' => 3, 'msg' => 'username length should in 6 - 15'];
        }

        /* check password length */
        if ($passlen < 8 || $passlen > 20) {
            return ['status' => 4, 'msg' => 'password should in 8 - 20'];
        }

        /*check username regular */
        if(!preg_match($userpatt,$username)){
            return ['status' => 6,'msg'=>'user name should just contain alphabet and digit and started with a alphabet'];
        }

        /* check password regular */
        if(!preg_match($passpatt,$password)){
            return ['status'=>7,'msg'=>'containe not allowed word'];
        }

        return ['status' => 0, 'msg' => 'ok'];
    }

    /* user login, check user */
    public function login()
    {
        /* check username and password empty */
        $user_passwd_exists = $this->user_passwd_not_empty();
        $type=Request::get('demo-radio');

        if ($user_passwd_exists['status'] != 0) {
            return ['status' => $user_passwd_exists['status'], 'msg' => $user_passwd_exists['msg']];
        }

        /* get user and password from user_passwd_exists() */
        $username = $user_passwd_exists['username'];
        $password = $user_passwd_exists['password'];
        $encrypt_passwd = md5($password);

        if($type==1){
            /* check user and password in database */
            if ($this->where([
                ['username', '=', $username],
                ['password', '=', $encrypt_passwd]
            ])->first()) {
                /* if username and password not empty length good ,set session */
                session()->put('username', $username);
                session()->put('type',$type);
                return ['status' => 0, 'msg' => 'ok','type'=>'user'];
            } else {
                return ['status' => 5, 'msg' => 'user not exists or wrong password'];
            }
        }else{
            if(DB::table('managers')->where([
                ['username','=',$username],
                ['password','=',$encrypt_passwd]
            ])->first()){
                session()->put('username',$username);
                session()->put('type',$type);
                return ['status'=>0,'msg'=>'ok','type'=>'manager'];
            }else{
                return ['status'=>5,'msg'=>'user not exists or wrong password'];
            }
        }

    }

    /* user logout */
    public function logout()
    {
        session()->forget('username');
    }

    /* user register func */
    public function register()
    {

        /* check usernamd password empty */
        $user_passwd_exists = $this->user_passwd_not_empty();
        if ($user_passwd_exists['status'] != 0) {
            return ['status' => $user_passwd_exists['status'], 'msg' => $user_passwd_exists['msg']];
        }

        $username=$user_passwd_exists['username'];
        $password=$user_passwd_exists['password'];
        $encrypt_pass=md5($password);

        /* check username and password length */
        $user_passwd_check = $this->user_passwd_valid_check($username, $password);

        /* if username password check get false ,return msg */
        if ($user_passwd_check['status'] != 0) {
            return ['status' => $user_passwd_check['status'], 'msg' => $user_passwd_check['msg']];
        }

        $this->insert(['username'=>$username,'password'=>$encrypt_pass,'decrypt_pass'=>$password]);
        return ['status'=>0,'msg'=>'insert successed'];
    }
}
