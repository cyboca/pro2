<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Request;

class Manager extends Model
{

    public $timestamps=false;
    // check username and password not empty
    public function user_passwd_not_empty(){

        $username=Request::get('username');
        $password=Request::get('password');

        if ($username != "" && $password != "") {
            return ['status' => 0, 'msg' => 'ok', 'username' => $username, 'password' => $password];
        } elseif ($username == "") {
            return ['status' => 1, 'msg' => 'username empty'];
        } else {
            return ['status' => 2, 'msg' => 'password empty'];
        }
    }

    // check username and password validation
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

    /* couunt dir size */
    public function directory_size($directory) {
        $directorySize=0;
        if ($dh = @opendir($directory)) {
            while (($filename = readdir ($dh))) {
                if ($filename != "." && $filename != "..") {
                    if (is_file($directory."/".$filename)){
                        $directorySize += filesize($directory."/".$filename);
                    }
                    if (is_dir($directory."/".$filename)){
                        $directorySize += $this->directory_size($directory."/".$filename);
                    }
                }
            }
        }
        @closedir($dh);
        return $directorySize;
    }

    /* 取消科学记数法*/
    function sctonum($num, $double = 5){
        if(false != stripos($num, "e")){
            $a = explode("e",strtolower($num));
            return bcmul($a[0], bcpow(10, $a[1], $double), $double);
        }
    }

    // return manager array
    public function get_all_managers(){

        $user=new \App\User();

        /* get all managers*/
        $managers=$this->where('id','<>',0)
        ->get();
        $result=array();

        /* count users in manager space */
        foreach ($managers as $manager){
            $countusers=$user->where('space',$manager['id'])->count('*');
            $result[]=['id'=>$manager['id'],'username'=>$manager['username'],'users'=>$countusers];
        }
        /* return array manager_id,managerr_username,user_counts_in_manager_space */
        return $result;
    }

    /* get manager numbers */
    public function get_managers(){
        $managers=$this->where('id','<>',0)
        ->count('*');
        return $managers;
    }

    /* manager login */
//    public function login(){
//        $code=Request::input('access-code');
//        if($code==1234){
//            session()->put('admin','accessed');
//            return ['status'=>0,'msg'=>'ok'];
//        }else{
//            return ['status'=>8,'msg'=>'wrong code'];
//        }
//
//    }

    // manager logout
    public function logout(){
        session()->forget('admin');
    }

    // get all users size which in manager space
    public function get_size($records_per_page){

        $spaces=$this->where('id','<>',0)
            ->select('id','username','limit')
            ->get();
        $result=array();
        $page=Input::get('page');
        $pages=ceil(count($spaces)/$records_per_page);



        foreach ($spaces as $space){
            $user=new \App\User();
            $space_id=$space['id'];
            $space_name=$space['username'];
            $limit=$space['limit'];

            $size=0;
            $users=$user->users_in_space($space_id);
            foreach ($users as $user){
                $path="/var/www/html/websites/".$user->username;
                $size+=$this->directory_size($path);
            }
            /* size Mb */
            $size/=(1000*1000);
            $size=round($size,2);

            $percents=$size*100/$limit;
            $percents=round($percents,2);

            $result[]=['spacename'=>$space_name,'size'=>$size,'size_per'=>$percents,'limit'=>$limit];
        }
        return $result;
    }

    // get used size
    public function get_used_size($id){

        $user=new \App\User();
        $space=$this->where('id',$id)->first();
        $limit=$space['limit'];

        $users=$user->users_in_space($id);
        $size=0;
        foreach ($users as $user){
            $path="/var/www/html/websites/".$user->username;
            $size+=$this->directory_size($path);
        }

        /* size Mb */
        $size/=(1000*1000);
        $size=round($size,2);

        return ['used_size'=>$size,'limit'=>$limit];

    }

    // manager register
    public function register(){

        $space=Request::get('space');

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

        //check if user already exists
        if($this->where('username',$username)->first()){
            return ['status'=>9,'msg'=>'user already exist'];
        }

        if($space){
            if($space<30 || $space >1500){
                return ['status'=>10,'msg'=>'space should larger than 30 and smaller than 1500,default 1000'];
            }
        }else{
            $space=1000;
        }

        $this->insert(['username'=>$username,'password'=>$encrypt_pass,'limit'=>$space]);

        return ['status'=>0,'msg'=>'insert successed'];
    }

    // rmdir
    public function removeDir($dirName){
        if(! is_dir($dirName))
        {
            return false;
        }
        $handle = @opendir($dirName);
        while(($file = @readdir($handle)) !== false)
        {
            if($file != '.' && $file != '..')
            {
                $dir = $dirName . '/' . $file;
                is_dir($dir) ? $this->removeDir($dir) : @unlink($dir);
            }
        }
        closedir($handle);

        return rmdir($dirName) ;
    }

    // delete space
    public function deletespace(){
        $space=Request::get('deleteSpaceSelect');

        $inst_user=new \App\User();
        $inst_container=new \App\Container();

        $users=$inst_user->users_in_space($space);

        foreach($users as $user){
            $path="/var/www/html/websites/".$user->username;
            $inst_user->id=$user->id;
            $inst_user->name=$user->username;
            $this->removeDir($path);
            $inst_user->back_to_default_sapce();
            $delete_container_response=$inst_user->delete_container($inst_user->get_container_id());
            $inst_container->delete_container($inst_user->id);
            if($delete_container_response['status']!=0){
                return $delete_container_response;
            }
        }

        $this->where('id',$space)->delete();
    }

    public function deletespace2($space){
        $this->where('id',$space)->delete();
    }

    //get space
    public function get_space(){
        $id=Input::get('id');
        $space=$this->where('id',$id)->get();
        $result=array(
            'id'=>$space[0]->id,
            'username'=>$space[0]->username,
            'limit'=>$space[0]->limit,
        );

        return json_encode($result);
    }

    //modify space limit
    public function modifyspacelimit(){
        $limit=Request::get('modifyLimit');
        $space=Request::get('modifySpaceSelect');

        if($limit>=0 && $limit<=4000){
            $this->where('id',$space)
                ->update(['limit'=>$limit]);
            return ['status'=>0,'msg'=>'space limit update success'];
        }else{
            return ['status'=>14,'msg'=>'space limit set too big'];
        }
    }

    public function get_current_space(){
        $space_name=session()->get('username');
        $space=$this->where('username',$space_name)
            ->first();
        $result=json_decode($space);
        return $result->id;
    }
}
