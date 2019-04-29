<?php
include_once("config.db.php");
include_once ("config.php");
class Education{

function __construct($db=null){
    $this->db = getMYSQLIConnection($db);
}

function addEducation($candidate,$university, $specialization, $qualification,$degree,$from,$to){
    $sql = "INSERT INTO `education`( `candidate`, `university`, `specialization`, `qualification`, `degree`, `from_year`, `to_year`)".
            "VALUES ($candidate,'".$university."','".$specialization."','".$qualification."','".$degree."','".$from."','".$to."')";
    $this->db->query($sql);
    return $this->db->insert_id;
    }

    function getEducation($where){
        $result_array = array();
        $sql = "select * from education where ".$where;
        $result = $this->db->query($sql);
        while($row=$result->fetch_assoc()){
            array_push($result_array,$row);
        }
        return $result_array;
    }

    function updateEducation($university, $specialization, $qualification,$degree,$from,$to,$id){
        $sql = "update education set university = '".$university."', specialization='".$specialization."',"
                ."qualification = '".$qualification."', degree='".$degree."', from_year='".$from."', to_year = '".$to."'"
                ." where id = $id";
        return $this->db->query($sql);
    }

    function deleteEducation($id){
        $sql = "delete from education where id = $id";
        return $this->db->query($sql);
    }
}