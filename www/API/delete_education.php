<?php
include_once("config.auth.php");
include_once("../../include/class.Education.php");
if (isset($_POST['id'])){
    $id = $_POST['id'];
    echo (new Education())->deleteEducation($id);
}else{
    echo 0;
}