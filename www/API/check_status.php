<?php 
include_once('config.cors.php');
include_once('../../include/class.ApplyJob.php');

$job = new ApplyJob();


if (isset($_POST['ref_number'])){
    $refNumber = $_POST['ref_number'];
    $result = $job->checkRefNumber($refNumber);
    if ($result){
        $candidateData = $job->getCandidateInfoByRefNumber($refNumber);
        echo json_encode(array('error'=>0, 'message'=>$result,'info'=>$candidateData));
    }else{
        echo json_encode(array('error'=>1, 'message'=>'There is no such reference number in the system'));
    }
}else{
    echo json_encode(array('error'=>1, 'message'=>'something went wrong'));
}