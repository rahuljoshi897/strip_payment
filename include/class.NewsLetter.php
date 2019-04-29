<?php
include_once("config.db.php");
include_once ("config.php");
class NewsLetter{

function __construct($db=null){
    $this->db = getMYSQLIConnection($db);
}

function addNewsLetter($email, $page='landing'){
    $sql  = "INSERT INTO `newsletter`( `email`, `page`, request_time) VALUES ('".$email."', '".$page."', NOW())";
  //  echo $sql;
    $this->db->query($sql);
    return $this->db->insert_id;
}
}