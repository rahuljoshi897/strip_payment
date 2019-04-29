<?php 
require_once("libs/phpmailer/phpmailer/src/PHPMailer.php");
include_once('config.php');
class Mail{

    function __construct(){
        $this->noreply="noreply@cloverrecruit.com";
        $this->domain = "@cloverrecruit.com";
      
    }

    function sendEmail($subject, $body,$from, $to,$fromname,$toname=false){
       // $mailer = new PHPMailer();
       $mailer = new PHPMailer\PHPMailer\PHPMailer();
        $mailer->From = $from;
        $mailer->FromName = $fromname;
        $mailer->isHTML(true);
        //To address and name
        if ($toname){
            $mailer->addAddress($to, $toname);
        }else{
            $mailer->addAddress($to);
        }

        $mailer->Subject = $subject;
        $mailer->Body = $body;
        return $mailer->send();

    }


    function sendRegistrationConfirmation($link, $name,$to){
        $subject = "Registration confirmation";
        $body = "<p>Hello ".$name."!</p><p>Thank you for registration! Please click link below to confirm email address:
            <a href='".$link."' >Confirm email address</a>
            </p><p>Thank your, best regards <br>Clover recruit team!</p>";
        return $this->sendEmail($subject, $body,$this->noreply, $to,$this->noreply,$name);
    }

    function sendReferenceNumber( $name,$to, $referenceNumber, $jobTitle, $jobId){
        $subject = "Thank you for job apply";
        $body = "<p>Hello ".$name."!</p><p>Thank you for applying job <a href='".CORS_ORIGIN.'/job_details.php?id='.$jobId."'>".$jobTitle."</a>!</p>
        <p>Your reference number is ".$referenceNumber."</p>
        <p>Thank your, best regards <br>Cloverrecruit team!</p>";
        return $this->sendEmail($subject, $body,$this->noreply, $to,$this->noreply,$name);
    }
}