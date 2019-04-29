<?php
include_once('config.auth.php');
include_once('../../include/class.Candidate.php');

$arrayForUpdate = $_POST;
$result = (new Candidate())->updateCandidateInfo($_POST);
echo $result?1:0;