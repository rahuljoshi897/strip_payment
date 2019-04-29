<?php
require_once("libs/twig/twig/lib/Twig/Autoloader.php");
include_once("config.php");
include_once("class.Candidate.php");

function parsePage($name, $data)
{
    $candidate = new Candidate();
    Twig_Autoloader::register();
  
        $loader = new Twig_Loader_Filesystem(realpath(dirname(__FILE__) . '/../') . '/' . TEMPLATE_URL);
        $twig = new Twig_Environment($loader, array('cache' => dirname(__FILE__) . '/cache/',
        ));
    $twig->enableAutoReload();
     $data['candidate'] = array();
     if (isLoggedIn()){
         $data['candidate'] = getCandidateInfo();
     }
     $data['frontend'] = FRONTEND;

    
    return $twig->render($name, $data);
}

function parseString($source, $data)
{
    Twig_Autoloader::register();
    return (new Twig_Environment(new Twig_Loader_String()))->render($source, $data);
}

function throwErrorPage($message = array('message' => 'Unfortunately, the page you were looking for could not be found. It may be temporarily unavailable, moved or no longer exists', 'code' => 404))
{
   
    return parsePage("error.html", $message);
}
?>