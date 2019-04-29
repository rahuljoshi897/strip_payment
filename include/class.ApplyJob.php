<?php
include_once("config.db.php");
include_once ("config.php");
class ApplyJob{

function __construct($db=null){
    $this->db = getMYSQLIConnection($db);
}
// applied, in process, 
function generateRefNumber($uid){
    return $uid.time();
}
function applyForJob($jobId, $candidateId, $status='applied'){
    $refNumber = $this->generateRefNumber($candidateId);
    $sql ="insert into applied_job ( `job_id`, `candidate_id`, `applied_date`, `status`, `reference_number`)".
            "values($jobId,$candidateId, NOW(), '".$status."', '".$refNumber."')";
    $this->db->query($sql);
   // echo $sql;

    return $this->db->insert_id;
}

function ifJobAlreadyApplied($jobId,$candidateId){
    $sql = "select id from applied_job where job_id=$jobId and candidate_id=$candidateId";
  $result=  $this->db->query($sql);
    //echo $this->num_rows;
    
    return $result->num_rows;
}

function getDetailsById ($field, $id){
    $sql = "select ".$field." from applied_job where id=".$id;
    $r = $this->db->query($sql);
    while($row=$r->fetch_assoc()){
        return $row[$field];
    }
    return false;
}

function checkRefNumber($refNumber){
    $sql = "select status from applied_job where reference_number ='".$refNumber."'";
  //  echo $sql;
    $result = $this->db->query($sql);
    while($row = $result->fetch_assoc()){
        return $row['status'];
    }

    return false;
}

function getAppliedJob($candidateId){
    $result_array = array();
    $sql = "SELECT `reference_number`,`status`,`applied_date`,title, job.id   FROM `applied_job`,job WHERE 1 and job.id=applied_job.job_id and `candidate_id`=$candidateId";
    $result=$this->db->query($sql);
    while($row = $result->fetch_assoc()){
        array_push($result_array,$row);
    }
    return $result_array;
}

function getCandidateInfoByRefNumber($refNumber){
    $sql="select comment,applied_date, full_name, date_of_birth from applied_job, candidate where candidate.id = applied_job.candidate_id and reference_number='".$refNumber."'";
  // echo $sql;
    $result = $this->db->query($sql);
    while($row=$result->fetch_assoc()){
        return $row;
    }
    return array();
}
}

