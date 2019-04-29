<?php
include_once("config.db.php");
include_once ("config.php");

class Token {
    function __construct($db=null){
        $this->db = getMYSQLIConnection($db);
    }

    function  generateToken(){
        return time().getRandomString(5);
     }

     function addToken($token, $candidateid){
         $sql = "insert into token (value, candidate) values('".$token."', $candidateid)";
        $result =  $this->db->query($sql);
        return $this->db->insert_id;
        }

        function generateTokenLink($token){
            return PROJECT_URL."login.php?key=".$token;
        }

        function validateToken($token){
            $sql = "select candidate from token where value ='".$token."'";
            $result = $this->db->query($sql);
            while ($row=$result->fetch_assoc()){
                return $row['candidate'];
            }
            return false;
        }

        function deleteToken($token){
            $sql = "delete from token where value='".$token."'";
            return $this->db->query($sql);
        }
}
?>