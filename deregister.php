<?php
    $curl=curl_init();
    $id="henry";
    curl_setopt($curl,CURLOPT_URL,"http://localhost:8500/v1/agent/service/deregister/$id");
    curl_setopt($curl,CURLOPT_HEADER,0);
    curl_setopt($curl,CURLOPT_CUSTOMREQUEST,"PUT");
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

    $result=curl_exec($curl);
    curl_close($curl);

    $response=json_decode($result);

    if(!$response){
        echo "true";
    }else{
        echo "false";
    }
?>