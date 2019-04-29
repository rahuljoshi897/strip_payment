<?php
include_once("config.db.php");
include_once ("config.php");
class SaveJob{

function __construct($db=null){
    $this->db = getMYSQLIConnection($db);
}

function saveJob($candidateId, $jobId){
    $sql = "insert into saved_jobs (`job_id`, `candidate_id`, `save_date`) values($jobId,$candidateId,NOW())";
 
    $this->db->query($sql);
     return $this->db->insert_id;
}

function ifJobAlreadySaved($jobId,$candidateId){
    $sql = "select id from saved_jobs where job_id=$jobId and candidate_id=$candidateId";
  $result=  $this->db->query($sql);
    //echo $this->num_rows;
    
    return $result->num_rows;
}

function getSavedJobs($candidateId){
    $result_array = array();
    $sql = "SELECT `save_date`,title, job.id   FROM `saved_jobs`,job WHERE 1 and job.id=saved_jobs.job_id and `candidate_id`=$candidateId";
    $result=$this->db->query($sql);
    while($row = $result->fetch_assoc()){
        array_push($result_array,$row);
    }
    return $result_array;
}
}