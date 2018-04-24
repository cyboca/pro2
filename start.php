<?php
/**
 * Created by PhpStorm.
 * User: antera
 * Date: 2018/4/24
 * Time: 11:16
 */
    $curl=curl_init();
    $header=["Content-Type: application/json"];
    $id="15ebebbb37ec5946f60868f25ab5e641ec756ef43bdab7c2e620b7f7c3394f5d";
    $field="";
    curl_setopt($curl,CURLOPT_URL,"http://192.168.27.210:5678/containers/$id/start");
    curl_setopt($curl,CURLOPT_HEADER,1);
    curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($curl,CURLOPT_POST,true);
    curl_setopt($curl,CURLOPT_POSTFIELDS,$field);

    $data=curl_exec($curl);

    if(curl_getinfo($curl,CURLINFO_HTTP_CODE)=='204'){

        $header_size=curl_getinfo($curl,CURLINFO_HEADER_SIZE);
        $header=substr($data,0,$header_size);
        $body=substr($data,$header_size);

        echo "code: 204</br>";
        echo "header: $header</br>";
        echo "body: $body</br>";
    }
    print_r($data);

?>