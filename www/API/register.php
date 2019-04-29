<?php
include_once ("../../include/class.Candidate.php");
$result = 0;
/*LATER:
put server validation
*/
//print_r($_POST);
if (isset($_POST['email']) && isset($_POST['address']) && isset($_POST['full_name']) && isset($_POST['city'])
&& isset($_POST['country']) && isset($_POST['dateofbirth'])  && isset($_POST['industry'])
&& isset($_POST['disignation']) && isset($_POST['education'] ) && isset($_POST['experience']) && isset($_POST['gender'])
&& isset($_POST['password'])
){
    $email=$_POST['email'];
    $address=$_POST['address'];
    $full_name=$_POST['full_name'];
    $city=$_POST['city'];
    $country=$_POST['country'];
    $dateofbirth=$_POST['dateofbirth'];
    $industry=$_POST['industry'];
    $disignation=$_POST['disignation'];
    $education=$_POST['education'];
    $experience=$_POST['experience'];
     $gender=$_POST['gender'];
     $password=$_POST['password'];
    $c = new Candidate();
    $emailExist = $c-> isEmailAlreadyRegistered($email);
    if ($emailExist>0){
        die('0');
    }
    $result = $c->Register ($email,$address,$full_name,$city,$country,$dateofbirth,$industry,
    $disignation,$education,$experience, $gender,$password);

}

echo $result;

