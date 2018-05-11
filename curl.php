<?php
/**
 * Created by PhpStorm.
 * User: antera
 * Date: 2018/4/23
 * Time: 20:11
 */
    $curl=curl_init();
    $header="Content-Type: application/json";

    curl_setopt($curl,CURLOPT_URL,"http://localhost:5678/containers/json");
    curl_setopt($curl,CURLOPT_HEADER,0);
    curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

    $data=curl_exec($curl);
    curl_close($curl);

    $result=json_decode($data);

    print_r($data);
    echo "<br>";
    echo $result[0]->Ports[0]->PublicPort;
?>