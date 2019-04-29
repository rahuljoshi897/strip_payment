<?php
include_once("../include/config.php");
include_once("../include/config.auth.php");
include_once("../include/functions.Parser.php");
include_once("../include/class.WorkExperience.php");
include_once("../include/class.Education.php");
$candidateInfo =getCandidateInfo();

$candidateInfo['country'] = getCountryNameByShortName($candidateInfo['country']);

$candidateInfo['gender'] = $candidateInfo['gender']=='m'?'male':'female';
$candidateInfo['experience'] = getExperienceTitleByKey($candidateInfo['experience']);
$nationalityList  = getNationalities();
$industryList= getIndustryList();
$workList = (new WorkExperience())->getExperience(" candidate = ".getCandidateId()." order by from_date desc");



echo parsePage("index.html", array(
    'country'=> $candidateInfo['country'],
    'gender' =>$candidateInfo['gender'],
    'experience'=>$candidateInfo['experience'],
    'filesize' => MAX_AVATAR_FILESIZE,
    'nationality' => $nationalityList,
    'countryList' =>getCountriesList(),
    'educationList'=>getEducationQualificationList(),
    'currency'=>getCurrencyLIst(),
    'industry' =>$industryList[$candidateInfo['industry']],
    'industryList'=>getIndustryList(),
    'experienceList'=>getExperienceList(),
    'preferred_country'=>getCountryNameByShortName($candidateInfo['preferred_country']),
    'workList'=>$workList,
    'degreeList'=>getDegreeList(),
    'educations' => (new Education())->getEducation(" candidate=".getCandidateId()." order by from_year desc")
    
));
?>