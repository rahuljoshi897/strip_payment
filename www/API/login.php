<?php
include_once ("../../include/class.Candidate.php");
$response = 0;

if (isset($_POST['username']) && isset($_POST['password'])){
    $candidate = new Candidate();
    $email = $_POST['username'];
    $password = $_POST['password'];
    $makeLogin = $candidate->Login($email,$password);
    if ($makeLogin){
        $candidateDetails = getCandidateInfo();
        if (isset($candidateDetails['activated']) && $candidateDetails['activated']==0){
            $response = 2;
        }else{
        $response = 1;
        }
    }
}
echo $response;