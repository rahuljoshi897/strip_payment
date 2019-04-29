<?php 
include_once("../../include/config.php");
if (isset($_SERVER['HTTP_ORIGIN'])){
    $http_origin = $_SERVER['HTTP_ORIGIN'];
    if ($http_origin=='http://'.CORS_ORIGIN || $http_origin=='https://'.CORS_ORIGIN
        || $http_origin=='http://www.'.CORS_ORIGIN ||  $http_origin=='https://www.'.CORS_ORIGIN){
            header('Access-Control-Allow-Origin: '.$http_origin);
            header('Access-Control-Allow-Methods: GET, POST');
            header("Access-Control-Allow-Headers: X-Requested-With");
        }
 

}







