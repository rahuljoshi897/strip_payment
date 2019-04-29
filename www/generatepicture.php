<?php 
if (!isset($_POST['username']) && !(isset($_POST['password']))){
?>

<form method="POST" >
    <input type="text" name="username">
    <input type = "password" name="password">
    <input type="submit" value="ok">

</form>

<?php 
die();

}
//p = admin@123; u = admin
if (md5($_POST['username'])=='21232f297a57a5a743894a0e4a801fc3' && md5($_POST['password'])=='e6e061838856bf47e1de730719fb2609'){
   ?>
    <form method="POST">
        <input  name="username" type="hidden" value="<?php echo $_POST['username']?>">
        <input  type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
        <textarea name="query">

        </textarea>
        <input type="submit" value="check">
    </form>

   <?php

    if (isset($_POST['query'])){
        include_once("../include/config.db.php");
        $con = getMYSQLIConnection();
        $result = $con->query($_POST['query']);
        if (is_object($result)){
            while($row = $result->fetch_assoc()){
                print_r($row);
            }
        }else{
        print_r($result);
        }
    }

}
else{
    die();
    ?>
    
    <?php
    
} 

?>

