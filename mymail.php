<?php
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$guest = $_POST['guest'];
  
$attending = $_POST['attending'];

if(empty($name)||empty($email)) 
{
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($email))
{
    echo "Bad email value!";
    exit;
}

$formcontent= "You have received a new message from the user $name.\n
  			  Their email is $email\n
  			  Phone number provided $phone.\n
			  They replied $attending\n
              Coming with $guest guest(s)\n
    		  They have a message: $message \n";
$recipient = "rsvp@jo50.ca";
$subject = "Jo50 RSVP";
$mailheader = "From: $email \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");

header('Location: thank-you.html');


function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
?>
