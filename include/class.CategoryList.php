<?php
include_once("config.php");
include_once("config.db.php");
class CategoryList{
function __construct($db=null){
    $this->db = getMYSQLIConnection($db);
}

function getList($raw=true){
    $array = array();
    $sql = "select id, name from category_list";
    $result = $this->db->query($sql);
    while($row = $result->fetch_assoc()){
        if ($raw){
            array_push($array,$row);
        }else{
            $array[$row['id']]=$row['name'];
        }
      

    }
    return $array;
}

function addToList($name){
    $sql  = "insert into category_list (name) values('".$name."')";
    
    $result = $this->db->query($sql);
    return $result;
}

function updateCategory($id, $name){
    $sql = "update category_list set name = '".$name."' where id = $id";
    return $this->db->query($sql);
}

function deleteCategory($id){
    $sql = "delete from category_list where id = $id";
    return $this->db->query($sql);
}
}

?>