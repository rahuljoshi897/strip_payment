<?php
include_once("config.db.php");
include_once ("config.php");
class WorkExperience{

function __construct($db=null){
    $this->db = getMYSQLIConnection($db);
}

function addExperience( $resp, $designition, $from, $to, $candidate,$company){
    $sql = "INSERT INTO `work_experience`( `candidate`, `from_date`, `to_date`, `key_responsibility`, `designation`, company)".
                               " VALUES ($candidate,'".$from."','".$to."','".$resp."','".$designition."','".$company."')";
    
    $this->db->query($sql);
    return $this->db->insert_id;

}

function getExperience($where){
    $result_array = array();
    $sql = "select * from work_experience where ".$where;
    $result = $this->db->query($sql);
    while($row = $result->fetch_assoc()){
        array_push($result_array,$row);
    }
    return $result_array;
}

function deleteWorkExp($id){
    $sql = "delete from work_experience where id = $id";
   return  $this->db->query($sql);

}

function updateExperience($id, $company,$resp,$from,$to,$candidate,$designation){
    $sql = "update work_experience set candidate=$candidate, from_date='".$from."', to_date='".$to."', key_responsibility='".$resp."', designation='".$designation."',company='".$company."' 
            where id=$id";
            
    return $this->db->query($sql);
}
}

