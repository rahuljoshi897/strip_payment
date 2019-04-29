<?php
include_once("config.db.php");
include_once ("config.php");
class Job{

function __construct($db=null){
    $this->db = getMYSQLIConnection($db);
}

function getJobsList($where="1=1 order by posted_date desc"){
   // $where.=" and enabled=1 ";
    $sql = "select * from job where ".$where;
  //  echo $sql;
    $result = array();
    $rawResult = $this->db->query($sql);
    while($row = $rawResult->fetch_assoc()){
        array_push($result, $row);
        
    }

    return $result;
}

function getGropQuery ($groupField){
    $result = array();
    $sql = "SELECT COUNT(*) as ct, ".$groupField." as name FROM `job` where enabled=1 GROUP by ".$groupField. " order by ct desc";
    $rawResult = $this->db->query($sql);
    while ($row=$rawResult->fetch_assoc()){
        array_push($result,$row);
    }

    return $result;
}

function getDetailById ($field, $id){
    $sql = "select ".$field." from job where id=".$id;
    $r = $this->db->query($sql);
    while($row=$r->fetch_assoc()){
        return $row[$field];
    }
    return false;
}
}

