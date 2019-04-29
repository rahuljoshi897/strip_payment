<?php
include_once('config.cors.php');
include_once('../../include/class.ApplyJob.php');
include_once('../../include/class.SaveJob.php');
include_once('../../include/class.Mail.php');
include_once('../../include/class.Job.php');
$j = new ApplyJob();
$s = new SaveJob();
$m = new Mail();
$job = new Job();
$headerString=CORS_ORIGIN.'/?action=apply';
if (isset($_GET['jid'])){
  $jobId= $_GET['jid'];
  if (isLoggedIn()){
    $uid =  getCandidateId();
    /* check if already apply */
    if (!isset($_GET['save'])){

    if (!($j->ifJobAlreadyApplied($jobId,$uid))){
        $result = $j->applyForJob($jobId, $uid);
        if ($result){
          $refNumber = $j->getDetailsById ('reference_number', $result);
          
          $candidateInfo = getCandidateInfo();
          if ($candidateInfo){
            $name = $candidateInfo['name'];
            $to = $candidateInfo['email'];
            $jobTitle = $job->getDetailById ('title', $jobId);
            $m->sendReferenceNumber( $name,$to, $refNumber, $jobTitle, $jobId);
          }
         $headerString.='&error=0&description=Thank you for applying the job. Your reference number is '.$refNumber;
        }else{
         $headerString.='&error=1&description=something went wrong';

        }
    }else{
     $headerString.='&error=1&description=You have already  applied for this job!';
    }
  } else{
      if (!$s->ifJobAlreadySaved($jobId,$uid)){
          $result = $s->saveJob($uid, $jobId);
          if ($result){
            $headerString.='&error=0&description= You save the job!';
          }else{
            $headerString.='&error=1&description=something went wrong';
          }
      }else{
        $headerString.='&error=1&description=You have already  saved for this job!';
      }
  }

  
  }else{
   $headerString.='&error=1&description=redir&action_after=login';
    }
 
}else{


$headerString.='error=1&description=something went wrong';
}
//echo $headerString;
header('location: '.$headerString);
