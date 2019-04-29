<?php
include_once("config.auth.php");
include_once("../../include/class.WorkExperience.php");
if (isset($_POST['id'])){
    $id = $_POST['id'];
    echo (new WorkExperience())->deleteWorkExp($id);
}else{
    echo 0;
}