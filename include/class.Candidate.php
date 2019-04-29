<?php
include_once("config.db.php");
include_once ("config.php");

include_once("class.Token.php");
include_once ("class.Mail.php");
class Candidate{
function __construct($db=null){
    $this->db = getMYSQLIConnection($db);
}

function hashPassword($password){
    return md5($password);
}
function Register ($email,$address,$full_name,$city,$country,$dateofbirth,$industry,
                    $disignation,$education,$experience, $gender,$password)
    {

        $sql = "INSERT INTO `candidate`( `email`, `address`, `full_name`, `city`, `country`, `date_of_birth`, `industry`, `disignation`, `education`, `experience`, `gender`, `password`) VALUES".
                                       " ('".$email."','".$address."','".$full_name."','".$city."','".$country."','".$dateofbirth."','".$industry."','".$disignation."','".$education."','".$experience."','".$gender."', '".$this->hashPassword($password)."')";
         $this->db->query($sql);

         $candidateid= $this->db->insert_id;
        if ($candidateid){
            $t = new Token();
            $token = $t->generateToken();
            $tokenadded =  $t->addToken($token,$candidateid);
            if ($tokenadded){
                $m = new Mail();
                $link = $t->generateTokenLink($token);
                $m->sendRegistrationConfirmation($link, $full_name,$email);
            }
            return $candidateid;
        } return false;

    }

    function verifyCandidate($token){
        $t = new Token();
        $candidate = $t->validateToken($token);
        if ($candidate){
            $t->deleteToken($token);
            return $this->activateCandidate($candidate);
        }
        return false;
    }

    function activateCandidate($id){
        $sql  = "update candidate set activated=1 where id=$id";
        return $this->db->query($sql);
    }



    function Login($email, $password){
        $password = $this->hashPassword($password);
        $sql = "select * from candidate where  email = '".$email."' and password='".$password."'";

        $result = $this->db->query($sql);
        if ($row = $result->fetch_assoc()){
            $_SESSION['candidate'] = $row;
            $_SESSION['test_name'] = array('my'=>'Name','you'=>'joshi');
            return true;
        }
        return false;
    }

    function Logout(){
        unset($_SESSION['candidate']);
    }

    function updateCandidateInfo($array){
        $candidateInfo = getCandidateInfo();
        $id = $candidateInfo['id'];
        $sql = "update candidate set ";
        $i = 0;
        $arrayKeys=array_keys($array);

       foreach ( $arrayKeys as $key){
        $i++;

            $sql.= $key."='".$array[$key]."'";
            if ($i<count($arrayKeys))
                $sql.=',';

        }
        $sql.=" where id = $id";

        if ($this->db->query($sql)){

            return  changeUserDetail($array);
        }

        return false;

    }


    function isEmailAlreadyRegistered($email){
        $sql = "select * from candidate where email = '".$email."'";
        $result = $this->db->query($sql);
        return $result->num_rows;
    }





}
?>