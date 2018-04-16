<?php
/**
 * Created by PhpStorm.
 * User: antera
 * Date: 2018/4/16
 * Time: 15:54
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Vsftpd extends Model
{
    protected $connection='mysql_vsftpd';
    protected $table="vsftpd";

    public function create_ftp_user($username,$password){
        $this->insert([
            'username'=>$username,
            'password'=>$password
        ]);
    }

}