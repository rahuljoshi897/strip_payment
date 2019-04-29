<?php
include_once('config.cors.php');
include_once('../../include/class.NewsLetter.php');
if (isset($_POST['email'])){
    $email = $_POST['email'];
    $nl = new NewsLetter();
    $result = $nl->addNewsLetter($email);
    echo ($result?1:0);
}else
echo 0;
