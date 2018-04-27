<?php
/**
 * Created by PhpStorm.
 * User: antera
 * Date: 2018/4/24
 * Time: 10:49
 */
    $curl=curl_init();
    $header=[
        "Content-Type: application/json",
    ];

    curl_setopt($curl,CURLOPT_URL,"http://localhost:5678/containers/create");
    // get response header
    curl_setopt($curl,CURLOPT_HEADER,0);
    // get header and body
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    // set post mode
    curl_setopt($curl,CURLOPT_POST,1);
    // set request header
    curl_setopt($curl,CURLOPT_HTTPHEADER,$header);

    $image="tomcat:7.0.86-jre7";
    $port="8084";
    $path="/var/www/html/websites/henry2";

    $container=array(
        "Image"=>$image,
        "HostConfig"=>[
            "Binds"=>["$path:/usr/local/tomcat/webapps/helloworld"],
            "PortBindings"=>[
                "8080/tcp"=>[
                    ["HostIp"=>"","HostPort"=>$port]
                ]
            ],
        ],
    );

    $data=json_encode($container);
//    print_r($result);

    curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
    $result=curl_exec($curl);
    curl_close($curl);

    $response=json_decode($result);
    echo "<br>";
    echo $response->Id;
    echo "<br>";

    print_r($result);
    echo "<br>";

    $code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
    echo $code;


    if($response->Id!="" && !$response->Warnings){
        echo "<p>create container success 2 </p>";
    }
?>