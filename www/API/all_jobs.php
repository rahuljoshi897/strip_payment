<?php 
include_once('config.cors.php');
include_once("../../include/class.Job.php");
$job = new Job();
//if there is search parametr
//print_r($_POST);
$where = " enabled = 1 ";
if (!empty($_POST)) {
    
    
    if (isset($_POST['country'])){
              $where.=" and country= '".$_POST['country']."'";
    }

    if (isset($_POST['city'])){
        $where.=" and city= '".$_POST['city']."'";
}

    if (isset($_POST['category'])){
        $where.=" and category= '".$_POST['category']."'";
    }

    if (isset($_POST['company_name'])){
        $where.=" and company_name= '".$_POST['company_name']."'";
    }
if (isset($_POST['keywords'])){
    $keywords = $_POST['keywords'];
    $keywords = explode(",", $keywords);
    $keywords = array_map(function ($value){
        return '"'.$value;
    },$keywords);
    $keywords = implode(" ",$keywords);
    $where.=" and MATCH (description,skills,title) against ('".$keywords."' IN BOOLEAN MODE) ";
     
}


     /* order */
     if (isset($_POST['ordertype']) && isset($_POST['orderby'])){
        $where.=" order by ".$_POST['orderby']." ".$_POST['ordertype'];
        
    }
        /* limit */
    if (isset($_POST['limit'])){
        $where.=" limit ".$_POST['limit'];
    }
   
    if (isset($_POST['id'])){
        $where = " enabled=1 and id = ".$_POST['id'];
    }
    $jobs = $job->getJobsList($where);
   
}else{
    $jobs = $job->getJobsList();
}
for ($i = 0; $i<count($jobs);$i++){
   // $jobs[$i]['description']=strip_tags($jobs[$i]['description']);
    //$jobs[$i]['description']=html_entity_decode($jobs[$i]['description']);
    $jobs[$i]['posted_date']=date('l, d F Y',strtotime($jobs[$i]['posted_date']));
    $jobs[$i]['full_country_name'] = getCountryNameByShortName($jobs[$i]['country']);
    $jobs[$i]['j_type'] = str_replace("_"," ",$jobs[$i]['type']);
    

}
echo json_encode($jobs);

