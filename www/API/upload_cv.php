<?php
include_once("config.auth.php");
include_once("../../include/class.Candidate.php");
$file = $_FILES['file'];
/*TO DO: server side validation */
$ext = pathinfo($file['name'], PATHINFO_EXTENSION);


if ( 0 < $file['error'] ) {
    echo json_encode(array('error'=>1,'message'=>'OOPS! Something went wrong!'));
    die();
}
    
    
    
    
$candidateInfo = getCandidateInfo();
if ($candidateInfo['cv']){
    if (file_exists('../'.$candidateInfo['cv'])){
       if (!unlink('../'.$candidateInfo['cv'])) {
        echo json_encode(array('error'=>1,'message'=>'Something went wrong! We can not update cv!'));
        die();
       }
    }    
}
$plainFileName = $candidateInfo['id'].'_'.time().'.'.$ext;
$newFileName = CV_UPLOADS.$plainFileName;
$webFileName=CV_UPLOADS_API.$plainFileName;

if (!move_uploaded_file($file['tmp_name'],$newFileName)){
    echo json_encode(array('error'=>1,'message'=>'Something went wrong! We can not update cv!'));
    die();
}

$result=(new Candidate())->updateCandidateInfo(array('cv'=>$webFileName));

if ($result){
    echo json_encode(array('error'=>0,'message'=>'CV has been changed!','path'=>$webFileName));
}
else{
    echo json_encode(array('error'=>1,'message'=>'Something went wrong! We can not update cv!'));
}