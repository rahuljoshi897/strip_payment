<?php
include_once("config.db.php");
include_once ("config.php");
class CountryList{

function __construct($db=null){
    $this->db = getMYSQLIConnection($db);
}

function getCountryList(){
    $sql = "select * from country_list";
    $result = $this->db->query($sql);
    $array = array();
    while($row = $result->fetch_assoc()){
        array_push($array,$row);
    }

    return $array;
}


function deleteCountryList(){
    $sql = "delete from country_list";
    return $this->db->query($sql);
}

function updateCountryList($countries){
    $sql = "insert into country_list (code, name ) values ";
    for ($i=0;$i<count($countries);$i++){
            $countryName = getCountryNameByShortName($countries[$i]);
            $sql.="( '".$countries[$i]."', '".$countryName."')";
            if ($i<count($countries)-1)
                $sql.=",";
    }
   
    if ($this->deleteCountryList()){
        return $this->db->query($sql);
    }return false;
}

function getManagedCountryList(){
    $countries = $this->getCountryList();
    $result = [];
    foreach($countries as $element){
        $result[$element['code']] = array('name'=>$element['name']);
    }
    return $result;
}
}

