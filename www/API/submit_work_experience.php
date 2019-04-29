<?php
include_once("config.auth.php");
include_once("../../include/class.WorkExperience.php");

if (isset($_POST['from']) && isset($_POST['to']) && 
    isset($_POST['designition']) && isset($_POST['key']) && isset($_POST['work']) && isset($_POST['company'])){
        
        $company = $_POST['work'];
        $resp = $_POST['key'];
        $designition = $_POST['designition'];
        $from = $_POST['from'];
        $to=$_POST['to'];
        $candidate = getCandidateId();
        $company = $_POST['company'];
        if (isset($_POST['id']) && (!empty($_POST['id']))){
            
            $id = $_POST['id'];
            $result = (new WorkExperience())->updateExperience($id, $company,$resp,$from,$to,$candidate,$designition);
            echo $result?1:0;
        }else{
            $result = (new WorkExperience())->addExperience( $resp, $designition, $from, $to, $candidate,$company );
            echo $result?1:0;
        }
    }else
    echo 0;
?>