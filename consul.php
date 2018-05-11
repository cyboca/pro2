<?php
/**
 * Created by PhpStorm.
 * User: antera
 * Date: 2018/5/6
 * Time: 10:24
 */

    $curl=curl_init();
    curl_setopt($curl,CURLOPT_URL,"http://localhost:8500/v1/agent/service/register");
    curl_setopt($curl,CURLOPT_HEADER,0);
    curl_setopt($curl,CURLOPT_CUSTOMREQUEST,"PUT");
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

    $data=array(
        "id"=>"jame",
        "name"=>"jame",
        "port"=>9011,
        "tags"=>["dev"],
    );

    $data_json=json_encode($data);

    curl_setopt($curl,CURLOPT_POSTFIELDS,$data_json);
    $result=curl_exec($curl);
    curl_close($curl);

    $response=json_decode($result);

    if(!$response){
        echo "true";
    }else{
        echo "false";
    }
?>