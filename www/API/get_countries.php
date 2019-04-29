<?php
include_once('config.cors.php');
include_once('../../include/class.Job.php');
include_once('../../include/class.CountryList.php');
$job = new Job();
//$countries = getCountriesList();
$countries = (new CountryList())->getManagedCountryList();

$result_array = array();
$result_array['countries']=$countries;
$result_array['category']= $job->getGropQuery ('category');
$result_array['city_sugr']= $job->getGropQuery ('city');
$countryList = $job->getGropQuery ('country');
for($i=0; $i<count($countryList); $i++){
    $countryList[$i]['search_by'] = $countryList[$i]['name'];
    $countryList[$i]['name'] = getCountryNameByShortName( $countryList[$i]['name']);
}
//$result_array['countryList'] = $countryList;
$result_array['company_name'] = $job->getGropQuery ('company_name');
echo json_encode($result_array);