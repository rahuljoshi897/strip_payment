<?php 
include_once('config.auth.php');
include_once('../../include/class.ApplyJob.php');
include_once('../../include/class.SaveJob.php');
$candidateId =  getCandidateId();
if (!isset($_GET['save'])){
    $job = new ApplyJob();
    $result = $job->getAppliedJob($candidateId);
}else{
    $job = new SaveJob();
    $result = $job->getSavedJobs($candidateId);
}
echo json_encode(array('data'=>$result));