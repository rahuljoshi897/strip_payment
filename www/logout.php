<?php
include_once("../include/config.php");
include_once("../include/functions.Parser.php");
include_once("../include/class.Candidate.php");
(new Candidate())->Logout();
header('Location: /login.php');
