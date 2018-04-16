<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use function PHPSTORM_META\type;
use Request;
use DB;

class User extends Model
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
                session()->put('check',1);
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
                session()->put('check',0);
                return ['status'=>0,'msg'=>'ok','type'=>'manager'];
            }else{
                return ['status'=>5,'msg'=>'user not exists or wrong password'];
            }
        }

    }

    /* user logout */
    public function logout()
    {
        session()->flush();
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

        // create mysql user and ftp user
        $this->create_account($username,$password);

        /* check username and password length */
        $user_passwd_check = $this->user_passwd_valid_check($username, $password);

        /* if username password check get false ,return msg */
        if ($user_passwd_check['status'] != 0) {
            return ['status' => $user_passwd_check['status'], 'msg' => $user_passwd_check['msg']];
        }

        //check if user already exists
        if($this->where('username',$username)->first()){
            return ['status'=>9,'msg'=>'user already exists'];
        }

        $this->insert(['username'=>$username,'password'=>$encrypt_pass,'decrypt_pass'=>$password]);
        return ['status'=>0,'msg'=>'insert successed'];
    }

    /* count users */
    public function get_users(){
        $users=$this->count('*');
        return $users;
    }

    /* get all users in space */
    public function users_in_space($space){
        $users=$this->where('space',$space)->get();
        return $users;
    }

    // check dir empty
    public function is_dir_empty($path){
        $dir=@opendir($path);
        $i=0;
        while($_file=readdir($dir)){
            $i++;
        }
        if($i>2){
            return false;
        }else{
            return true;
        }
    }

    //config mysql user
    public function config_mysql_user($username){

        $status=0;
        $arr1=array();
        $cmd="mysql -uroot -pjustwe -e 'create database d_$username'";

        exec($cmd,$arr1,$status);

        $cmd = "mysql -uroot -pjustwe -e \"grant all 
            privileges on d_$username.* to u_$username@'%'\"";

        exec($cmd,$arr1,$status);

    }

    //config ftp user
    public function config_ftp_user($username){

        $chroot_list='/etc/vsftpd/chroot_list';
        $template='/etc/vsftpd/conf.d/template';
        $new="/etc/vsftpd/conf.d/$username";

        $fp_chroot_list = fopen($chroot_list, 'a')
        or die('can not open this file'.$chroot_list);
        fwrite($fp_chroot_list, "$username\n");
        fclose($fp_chroot_list);

        $data = file_get_contents($template);

        $data_new = str_replace('tom', $username, $data);

        $fp = fopen($new, 'w');
        fwrite($fp, $data_new);
        fclose($fp);


        exec("mkdir /opt/vsftp/files/$username",$arr1,$status);
        exec("chown virtualusers:virtualusers /opt/vsftp/files/$username",$arr1,$status);

    }

    //add mysql user
    public function create_account($username,$password){

        //get mysql passworded string
        $result=DB::select("select password('$password') as password");
        $mysql_pass=$result[0]->password;

        //add mysql user
        $cmd="mysql -uroot -pjustwe -e \"create user u_$username@'%' 
            identified by '$password'\"";
        $arr1=array();
        $status=0;
        exec($cmd,$arr1,$status);

        //add ftp user
        $vsftpd=new \App\Vsftpd();
        $vsftpd->create_ftp_user($username,$mysql_pass);

        //config mysql
        $this->config_mysql_user($username);

        //config ftp
        $this->config_ftp_user($username);
    }

    // deploy website
    public function deploy(){

        $username=$this->user_passwd_not_empty()['username'];
        $path="/var/www/html/websites/$username";
        $file="/opt/vsftp/files/$username/$username.zip";

        $zip=new ZipArchive();
        $res=$zip->open($file);
        if($res==true){
            $zip->extractTo($path);
            $zip->close();
            $this->where('username',$username)
                ->update(['deployed'=>1]);
            return ['statua'=>0,'msg'=>'ok'];
        }else{
            return ['status'=>10,'msg'=>$res];
        }
    }

    public function get_password(){
        $username=session()->get('username');
        $user=$this->where('username',$username)->first();
        $result=array(
            'mysqluser'=>"u_$username",
            'mysqlpass'=>$user['decrypt_pass'],
            'ftpuser'=>$username,
            'ftppass'=>$user['decrypt_pass'],
        );

        $result=json_encode($result);
        return $result;
    }

}
