<?php
include_once("config.auth.php");
include_once("../../include/class.Education.php");
/*

*/

if (isset($_POST['university']) && isset($_POST['specialization']) && isset($_POST['qualification']) && isset($_POST['degree'])
    && isset($_POST['from']) && isset($_POST['to'])
){
        
      
      
        $from = $_POST['from'];
        $to=$_POST['to'];
        $candidate = getCandidateId();
        $university = $_POST['university'];
        $specialization = $_POST['specialization'];
        $qualification = $_POST['qualification'];
        $degree = $_POST['degree'];

       
        if (isset($_POST['id']) && (!empty($_POST['id']))){
            
            
            $id = $_POST['id'];
            $result = (new Education())->updateEducation($university, $specialization, $qualification,$degree,$from,$to,$id);
            echo $result?1:0;
        }else{
            $result = (new Education())->addEducation($candidate,$university, $specialization, $qualification,$degree,$from,$to);
            echo $result?1:0;
        }
    }else
    echo 0;
?>