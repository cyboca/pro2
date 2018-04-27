<?php
/**
 * Created by PhpStorm.
 * User: antera
 * Date: 2018/4/24
 * Time: 15:48
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    public $timestamps = false;

    // insert into containers
    public function create_container($container_id, $image,$port, $user_id)
    {
        $this->insert([
            'container_id' => $container_id,
            'image'=>$image,
            'port' => $port,
            'user_id' => $user_id,
        ]);
    }

    // get max port
    public function get_max_port()
    {
        $max_port = $this->orderBy('port', 'desc')
            ->pluck('port')
            ->first();
        return $max_port;
    }

    //get user container
    public function get_user_container_id($user_id)
    {
        $result = $this->where('user_id', $user_id)
            ->first();
        return $result['container_id'];
    }

    // get bind port
    public function get_bind_port($user_id)
    {
        $result = $this->where('user_id', $user_id)
            ->first();
        return $result['port'];
    }

    // delete container
    public function delete_container($user_id)
    {
        $num = $this->where('user_id', $user_id)
            ->delete();
        return $num;
    }

}