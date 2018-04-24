<?php
/**
 * Created by PhpStorm.
 * User: antera
 * Date: 2018/4/24
 * Time: 10:57
 */

    function br($times=1){
        for($i=0;$i<$times;$i++){
            echo "</br>";
        }
    }

    $curl=curl_init();

    curl_setopt($curl,CURLOPT_URL,"localhost:5678/containers/dba2d85a7a4c/json");
    // get response header
    curl_setopt($curl,CURLOPT_HEADER,0);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

    $data=curl_exec($curl);

    curl_close($curl);

    $http_code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
    $header_size=curl_getinfo($curl,CURLINFO_HEADER_SIZE);
    $header=substr($data,0,$header_size);
    $body=substr($data,$header_size);

    print_r($data);
    echo "</br>";
    echo "--------------------------------------------------------";
    echo "</br>";
    $result=json_decode($data,true);
    var_dump($result);

    br(2);
    echo $result["Id"];

    br(2);
    echo $result["HostConfig"]["Binds"][0];

    br(2);
    echo $result['HostConfig']["PortBindings"]["80/tcp"][0]["HostPort"];

    br(2);
    echo $result["Image"];
?>