<?php
/**
 * Created by PhpStorm.
 * User: antera
 * Date: 2018/4/24
 * Time: 11:16
 */
$curl = curl_init();
$header = ["Content-Type: application/json"];
$id = "79ed7903c8c66cecd962aeeaff3843767fc778bbad42d79712a98fb21f6f0889";
$field = "";
curl_setopt($curl, CURLOPT_URL, "http://localhost:5678/containers/$id/stop");
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $field);

$data = curl_exec($curl);

if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == '204') {

    $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
    $header = substr($data, 0, $header_size);
    $body = substr($data, $header_size);

    echo "code: 204</br>";
    echo "header: $header</br>";
    echo "body: $body</br>";
}

?>