<?php
include_once("../../include/config.php");
$result_array = array();
$result_array['experience'] = isset($_POST['experience'])?getExperienceList():null;
$result_array['education'] = isset($_POST['education'])?getEducationQualificationList():null;
$result_array['nationality'] = isset($_POST['nationality'])?getNationalities():null;
$result_array['country']=isset($_POST['country'])?getCountriesList():null;
$result_array['currency'] = isset($_POST['currency'])?getCurrencyLIst():null;
echo json_encode($result_array);
