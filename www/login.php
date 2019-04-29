<?php
include_once("../include/config.php");
include_once("../include/functions.Parser.php");
include_once("../include/class.Candidate.php");
$candidate = new Candidate();
if (isset($_GET["key"])){
    $candidate->logout();
}
if (isLoggedIn()){
    header('Location: /');
    exit;
}
$activatationMessage="";
$isActivation = 0;
if (isset($_GET["key"])){
    
    $key = $_GET["key"];
    
    $activated = $candidate->verifyCandidate($key);
    if ($activated){
        $isActivation=1;
        $activatationMessage="Thank you for confirmation! Please login!";

    }else{
        $isActivation = 0;
        $activatationMessage = "Something went wrong!";
    }
}


$countries = getCountriesList();
$industry = getIndustryList();
$educationQualification = getEducationQualificationList();
$experienceList = getExperienceList();
echo parsePage("login.html", array(
    'message'=>$activatationMessage,
    'activation' => $isActivation,
    'countries' => $countries,
    'industry' =>$industry,
    'education'=>$educationQualification,
    'experience'=>$experienceList
));
?>