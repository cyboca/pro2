<?php
/**
 * Created by PhpStorm.
 * User: antera
 * Date: 2018/4/25
 * Time: 10:38
 */
$curl = curl_init();
$header = ["Content-Type: application/json"];
$id = "15ebebbb37ec5946f60868f25ab5e641ec756ef43bdab7c2e620b7f7c3394f5d";
$field = "";
curl_setopt($curl, CURLOPT_URL, "http://192.168.27.210:5678/containers/$id");
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'DELETE');

$data = curl_exec($curl);
$response_code=curl_getinfo($curl,CURLINFO_HTTP_CODE);

switch ($response_code){
    case '204':
        print "delete ok";
        break;
    case '400':
        print "bad parameter";
        break;
    case '404':
        print "no such container";
        break;
    case '409':
        print "conflict";
        break;
    default:
        print "server error";
        break;
}


print_r($data);
?>