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
    public $timestamps = false;

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
    public $name;
    public $id;
    public $container_id;

    /* get deployed websites */
    public function get_deployed_websites($space)
    {
        $users = $this->where([
            ['deployed', '=', 1],
            ['space','=',$space]])
            ->join('containers','users.id','=',
                'containers.user_id')
            ->paginate('2');
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
        $userpatt = "/[a-zA-Z][a-zA-Z0-9]{6,15}/";
        $passpatt = "/[a-zA-Z0-9!@#$%^&*-_=+]{8,20}/";

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
        if (!preg_match($userpatt, $username)) {
            return ['status' => 6, 'msg' => 'user name should just contain alphabet 
                and digit and started with a alphabet'];
        }

        /* check password regular */
        if (!preg_match($passpatt, $password)) {
            return ['status' => 7, 'msg' => 'contain not allowed word'];
        }

        return ['status' => 0, 'msg' => 'ok'];
    }

    /* user login, check user */
    public function login()
    {
        $container = new \App\Container();
        /* check username and password empty */
        $user_passwd_exists = $this->user_passwd_not_empty();
        $type = Request::get('demo-radio');

        if ($user_passwd_exists['status'] != 0) {
            return ['status' => $user_passwd_exists['status'], 'msg' => $user_passwd_exists['msg']];
        }

        /* get user and password from user_passwd_exists() */
        $username = $user_passwd_exists['username'];
        $password = $user_passwd_exists['password'];
        $encrypt_passwd = md5($password);

        if ($type == 1) {
            /* check user and password in database */
            if ($this->where([
                ['username', '=', $username],
                ['password', '=', $encrypt_passwd]
            ])->first()) {
                /* if username and password not empty length good ,set session */
                session()->put('username', $username);
                session()->put('check', 1);

                $user = $this->where('username', $username)
                    ->first();
                $user_id = $user['id'];

                $this->name=$username;
                $this->id=$user_id;

                $port = $container->get_bind_port($user_id);

                session()->put('port', $port);

                return ['status' => 0, 'msg' => 'ok', 'type' => 'user'];
            } else {
                return ['status' => 5, 'msg' => 'user not exists or wrong password'];
            }
        } else {
            if (DB::table('managers')->where([
                ['username', '=', $username],
                ['password', '=', $encrypt_passwd]
            ])->first()) {
                session()->put('username', $username);
                session()->put('check', 0);
                return ['status' => 0, 'msg' => 'ok', 'type' => 'manager'];
            } else {
                return ['status' => 5, 'msg' => 'user not exists or wrong password'];
            }
        }

    }

    /* user logout */
    public function logout()
    {
        session()->forget('username');
        session()->forget('check');
    }

    /* user register func */
    public function register()
    {
        /* check usernamd password empty */
        $user_passwd_exists = $this->user_passwd_not_empty();
        if ($user_passwd_exists['status'] != 0) {
            return ['status' => $user_passwd_exists['status'], 'msg' => $user_passwd_exists['msg']];
        }

        $username = $user_passwd_exists['username'];
        $password = $user_passwd_exists['password'];
        $encrypt_pass = md5($password);

        /* check username and password length */
        $user_passwd_check = $this->user_passwd_valid_check($username, $password);

        /* if username password check get false ,return msg */
        if ($user_passwd_check['status'] != 0) {
            return ['status' => $user_passwd_check['status'], 'msg' => $user_passwd_check['msg']];
        }

        //check if user already exists
        if ($this->where('username', $username)->first()) {
            return ['status' => 9, 'msg' => 'user already exists'];
        }

        // create mysql user and ftp user
        $this->create_account($username, $password);

        $this->insert(['username' => $username, 'password' => $encrypt_pass, 'decrypt_pass' => $password]);
        return ['status' => 0, 'msg' => 'register successed'];
    }

    /* count users */
    public function get_users()
    {
        $users = $this->count('*');
        return $users;
    }

    /* get all users in space */
    public function users_in_space($space)
    {
        $users = $this->where('space', $space)->get();
        $result=json_decode($users);
        return $result;
    }

    // check dir empty
    public function is_dir_empty($path)
    {
        $dir = @opendir($path);
        $i = 0;
        while ($_file = readdir($dir)) {
            $i++;
        }
        if ($i > 2) {
            return false;
        } else {
            return true;
        }
    }

    //config mysql user
    public function config_mysql_user($username)
    {

        $status = 0;
        $arr1 = array();
        $cmd = "mysql -uroot -pjustwe -e 'create database d_$username'";

        exec($cmd, $arr1, $status);

        $cmd = "mysql -uroot -pjustwe -e \"grant all 
            privileges on d_$username.* to u_$username@'%'\"";

        exec($cmd, $arr1, $status);

    }

    //config ftp user
    public function config_ftp_user($username)
    {

        $chroot_list = '/etc/vsftpd/chroot_list';
        $template = '/etc/vsftpd/conf.d/template';
        $new = "/etc/vsftpd/conf.d/$username";

        $fp_chroot_list = fopen($chroot_list, 'a')
        or die('can not open this file' . $chroot_list);
        fwrite($fp_chroot_list, "$username\n");
        fclose($fp_chroot_list);

        $data = file_get_contents($template);

        $data_new = str_replace('tom', $username, $data);

        $fp = fopen($new, 'w');
        fwrite($fp, $data_new);
        fclose($fp);


        exec("mkdir /opt/vsftp/files/$username", $arr1, $status);
        exec("chown virtualusers:virtualusers /opt/vsftp/files/$username",
            $arr1, $status);

    }

    //add mysql user
    public function create_account($username, $password)
    {

        //get mysql passworded string
        $result = DB::select("select password('$password') as password");
        $mysql_pass = $result[0]->password;

        //add mysql user
        $cmd = "mysql -uroot -pjustwe -e \"create user u_$username@'%' 
            identified by '$password'\"";
        $arr1 = array();
        $status = 0;
        exec($cmd, $arr1, $status);

        //add ftp user
        $vsftpd = new \App\Vsftpd();
        $vsftpd->create_ftp_user($username, $mysql_pass);

        //config mysql
        $this->config_mysql_user($username);

        //config ftp
        $this->config_ftp_user($username);
    }

    // deploy website
    public function decompress()
    {

        $username = session()->get('username');
        $path = "/var/www/html/websites/$username";
        $file = "/opt/vsftp/files/$username/$username.zip";

        if(!file_exists($file)){
            return ['status'=>25,'msg'=>'file not exist'];
        }

        $user = $this->where('username', $username)->first();
        $id = $user['space'];

        $space = new \App\Manager();
        $result = $space->get_used_size($id);

        $used = $result['used_size'];
        $limit = $result['limit'];

        if (!is_file($file)) {
            return ['status' => 11, 'msg' => 'file not exist!'];
        }

        $filesize = filesize($file);
        $filesize /= (1000 * 1000);

        if ($filesize + $username >= $limit) {
            return ['status' => 12, 'msg' => 'space over use'];
        }

        $zip = new \ZipArchive();
        $res = $zip->open($file);

        $zip->extractTo($path);
        $zip->close();

        if ($res == true) {
            return ['status' => 0, 'msg' => 'decompress success'];
        } else {
            return ['status' => 10, 'msg' => $res];
        }
    }

    // create container
    public function create_container($username, $image, $port)
    {
        $images=array('nginx',
            'nginx-fpm7',
            'nginx-fpm5',
            'tomcat:7.0.86-jre7',
            'tomcat:7.0.86-jre8',
            'tomcat:8.0.51-jre7',
            'tomcat:8.0.51-jre8',
            );

        if($image>2){
            $bindingpath="/usr/local/tomcat/webapps/ROOT";
            $expost_port="8080/tcp";
        }else{
            $bindingpath = "/var/www/html";
            $expost_port="80/tcp";
        }

        $curl = curl_init();
        $header = [
            "Content-Type: application/json",
        ];

        $user_id = $this->get_id($username);

        curl_setopt($curl, CURLOPT_URL, "http://localhost:5678/containers/create");
        // get response header
        curl_setopt($curl, CURLOPT_HEADER, 0);
        // get header and body
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // set post mode
        curl_setopt($curl, CURLOPT_POST, 1);
        // set request header
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        $path = "/var/www/html/websites/$username";

        $container = array(
            "Image" => $images[$image],
            "HostConfig" => [
                "Binds" => ["$path:$bindingpath"],
                "PortBindings" => [
                    $expost_port => [
                        ["HostIp" => "", "HostPort" => $port]
                    ]
                ],
            ],
        );

        // post data convert to json
        $data = json_encode($container);

        // add post data
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        // get response data
        $result = curl_exec($curl);
        curl_close($curl);

        // convert response data to stdclass
        $response = json_decode($result);

        if ($response->Id != "" && !$response->Warnings) {
            $container = new \App\Container();
            $container->create_container($response->Id, $images[$image],$port, $user_id);

            return ['status' => 0, 'msg' => 'create container success', 'container_id' => $response->Id];
        } else {
            return ['status' => 15, 'msg' => $response->Warnings];
        }
    }

    // start container
    public function start_container($container_id, $type = "start",$username)
    {

        $user_id = $this->get_current_userid();
        $container = new \App\Container();
        $port = $container->get_bind_port($user_id);

        $curl = curl_init();
        $header = ["Content-Type: application/json"];
        $field = "";
        curl_setopt($curl, CURLOPT_URL, "http://localhost:5678/containers/$container_id/$type");
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $field);

        $data = curl_exec($curl);

        $response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        switch ($response_code) {
            case '204':
                session()->put('port', $port);
                $this->register_service($username,$port);
                return ['status' => 0, 'msg' => 'container start success'];
                break;
            case '304':
                return ['status' => 16, 'msg' => 'container alreadt started'];
                break;
            case '404':
                return ['status' => 17, 'msg' => 'no such container'];
                break;
            default:
                return ['status' => 18, 'msg' => 'server error'];
                break;
        }
    }

    // get container_id
    public function get_container_id(){
        $container=new Container();
        if($this->id){
            return $container->get_user_container_id($this->id);
        }else{
            return $container->get_user_container_id($this->get_current_userid());
        }
    }

    // register service
    public function register_service($name,$port){

        $data=array(
            "id"=>$name,
            "name"=>$name,
            "port"=>$port,
            "tags"=>["vs"],
        );

        $curl=curl_init();
        curl_setopt($curl,CURLOPT_URL,"http://localhost:8500/v1/agent/service/register");
        curl_setopt($curl,CURLOPT_HEADER,0);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST,"PUT");
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

        $data_json=json_encode($data);

        curl_setopt($curl,CURLOPT_POSTFIELDS,$data_json);
        $result=curl_exec($curl);
        curl_close($curl);

        $response=json_decode($result);

        if(!$response){
            return ['status'=>0,'msg'=>'register service success'];
        }else{
            return ['status'=>26,'msg'=>'register service failed'];
        }
    }

    // deregister service
    public function deregister_service($id){
        $curl=curl_init();
        curl_setopt($curl,CURLOPT_URL,"http://localhost:8500/v1/agent/service/deregister/$id");
        curl_setopt($curl,CURLOPT_HEADER,0);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST,"PUT");
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

        $result=curl_exec($curl);
        curl_close($curl);

        $response=json_decode($result);

        if(!$response){
            return ['status'=>0,'msg'=>'deregister service success'];
        }else{
            return ['status'=>27,'msg'=>'deregister service failed'];
        }
    }

    // delete container
    public function delete_container($container_id)
    {

        $result = $this->stop_container($container_id);

         //stop container before delete container
        if(!$result['status']==0 || !$result['status']==19){
            return $result;
        }

        $curl = curl_init();
        $header = ["Content-Type: application/json"];

        $field = "";
        if($this->container_id){
            curl_setopt($curl, CURLOPT_URL, "http://localhost:5678/containers/$this->container_id");
        }else{
            curl_setopt($curl, CURLOPT_URL, "http://localhost:5678/containers/$container_id");
        }

        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');

        $data = curl_exec($curl);
        $response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        switch ($response_code) {
            case '204':
                session()->forget('port');
                return ['status' => 0, 'msg' => 'container delete success'];
                break;
            case '400':
                return ['status' => 22, 'msg' => 'bad parameter'];
                break;
            case '404':
                return ['status' => 17, 'msg' => 'no such container'];
                break;
            case '409':
                return ['status' => 24, 'msg' => 'conflict'];
                break;
            default:
                print ['status' => 21, 'msg' => 'server error'];
                break;
        }

    }

    // stop container
    public function stop_container($container_id)
    {
        $curl = curl_init();
        $header = ["Content-Type: application/json"];
        $id = "15ebebbb37ec5946f60868f25ab5e641ec756ef43bdab7c2e620b7f7c3394f5d";
        $field = "";
        curl_setopt($curl, CURLOPT_URL, "http://localhost:5678/containers/$container_id/stop");
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $field);

        $data = curl_exec($curl);
        $response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        switch ($response_code) {
            case '204':
                $this->deregister_service($this->name);
                return ['status' => 0, 'msg' => 'stop container success'];
                break;
            case '304':
                return ['status' => 19, 'msg' => 'container already stopd'];
                break;
            case '404':
                return ['status' => 17, 'msg' => 'no such container'];
                break;
            default:
                return ['status' => 21, 'msg' => 'server error'];
                break;
        }

    }

    // restart container
    public function restart_container($container_id,$username)
    {
        $type = "restart";
        $result = $this->start_container($container_id, $type,$username);
        return $result;
    }

    // deploy on container
    public function deploy()
    {
        // decompress files
        $result=$this->decompress();
        if($result['status']!=0){
            return $result;
        }

        $username = session()->get('username');
        $image = Request::get('choseImg');

        $user_id = $this->get_id($username);

        $container = new \App\Container();

        $max_port = $container->get_max_port();
        $max_port = (int)$max_port;
        $max_port++;
        if ($max_port < 30000) {
            $max_port = 30000;
        }
        $max_port = (string)$max_port;

        // delete container if user container already exist
        if ($container_id = $container->get_user_container_id($user_id)) {

            $this->delete_container($container_id);
            $container->delete_container($user_id);
        }

        // create container
        $create_result = $this->create_container($username, $image, $max_port);

        // if create container not success ,return error
        if ($create_result['status'] == 0) {
            $start_result = $this->start_container($create_result['container_id'],"start",$username);

            //if start container not success ,return error
            if ($start_result['status'] == 0 || $start_result['status'] == 16) {
                $this->where('username', $username)
                    ->update(['deployed' => 1]);
                $this->register_service($username,$max_port);
                return ['status' => 0, 'msg' => 'deploy success'];
            } else
                return $start_result;
        } else {
            return $create_result;
        }

    }

    // get current username
    public function get_current_username()
    {
        return session()->get('username');
    }

    //get current userid
    public function get_current_userid()
    {
        $username = $this->get_current_username();
        $user = $this->where('username',$username)->first();
        $user=json_decode($user);
        if($this->id){
            return $this->id;
        }else{
            return $user->id;
        }
    }

    //get mysql ftp password
    public function get_password()
    {
        $username = session()->get('username');
        $user = $this->where('username', $username)->first();
        $result = array(
            'mysqluser' => "u_$username",
            'mysqlpass' => $user['decrypt_pass'],
            'ftpuser' => $username,
            'ftppass' => $user['decrypt_pass'],
        );

        $result = json_encode($result);
        return $result;
    }

    // get user id
    public function get_id($username)
    {
        $user = $this->where('username', $username)
            ->first();
        $user=json_decode($user);
        return $user->id;
    }

    // check add space
    public function check_space()
    {
        $username = session()->get('username');
        $space = $this->where('username', $username)
            ->select('space')->first();

        return ['space' => $space['space']];
    }

    // chose space
    public function chosespace()
    {
        $space = Request::get('chosedspace');
        $username = session()->get('username');

        $this->where('username', $username)
            ->update(['space' => $space]);
        return ['status' => 0, 'msg' => 'add space success'];
    }

    // back to default space
    public function back_to_default_sapce(){
        $this->where('id',$this->id)
            ->update(['space'=>0,'deployed'=>0]);
    }

}
