<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Request;

class Manager extends Model
{
    /* couunt dir size */
    function directory_size($directory) {
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
    //
    public function get_all_managers(){
        $managers=$this->get();
        return $managers;
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

    public function get_size(){
        $spaces=$this->select('id','username','limit')->get();
        $result=array();

        $user=new \App\User();

        foreach ($spaces as $space){

            $space_id=$space['id'];
            $space_name=$space['username'];
            $limit=$space['limit'];

            $size=0;
            $users=$user->users_in_space($space_id);
            foreach ($users as $user){
                $path="/var/www/html/websites/".$user['username'];
                $size+=$this->directory_size($path);
            }
            /* size Mb */
            $size/=(1000*1000);
            $size=round($size,2);

            $percents=$size*100/$limit;
            $percents=round($percents,2);


            $result[]=['spacename'=>$space_name,'size'=>$size,'size_per'=>$percents];
        }
        return $result;
    }

}
