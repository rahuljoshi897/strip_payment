<?php
include_once("config.auth.php");
include_once("../../include/class.Candidate.php");
$file = $_FILES['file'];
if ($file['size']>MAX_AVATAR_FILESIZE){

    echo json_encode(array('error'=>1,'message'=>'File size too big!'));
    die();
}

$allowed =  array('gif','png' ,'jpg');

$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
if(!in_array($ext,$allowed) ) {
    echo json_encode(array('error'=>1,'message'=>'Incorrect image type'));
    die();

}

if ( 0 < $file['error'] ) {
    echo json_encode(array('error'=>1,'message'=>'OOPS! Something went wrong!'));
    die();
}
    
    
    
    
$candidateInfo = getCandidateInfo();
if ($candidateInfo['avatar']){
    if (file_exists('../'.$candidateInfo['avatar'])){
       if (!unlink('../'.$candidateInfo['avatar'])) {
        echo json_encode(array('error'=>1,'message'=>'Something went wrong! We can not update picture!'));
        die();
       }
    }    
}
$plainFileName = $candidateInfo['id'].'_'.time().'.'.$ext;
$newFileName = AVATAR_UPLOADS.$plainFileName;
$webFileName=AVATAR_UPLOADS_API_PATH.$plainFileName;

if (!move_uploaded_file($file['tmp_name'],$newFileName)){
    echo json_encode(array('error'=>1,'message'=>'Something went wrong! We can not update picture!'));
    die();
}

$result=(new Candidate())->updateCandidateInfo(array('avatar'=>$webFileName));

if ($result){
    echo json_encode(array('error'=>0,'message'=>'Avatar has been changed!','path'=>$webFileName));
}
else{
    echo json_encode(array('error'=>1,'message'=>'Something went wrong! We can not update picture!'));
}









    