<?php $name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$formcontent = "From: $name n email: $email n Message: $message";
$recipient = 'email address here';
$subject = 'Message from Website';
$mailheader = "From: $email rn";
$captcha;
{
  if(isset($_POST['g-recaptcha-response']))
    {
      $captcha=$_POST['g-recaptcha-response'];
    }
  if(!$captcha)
    {
      echo '<script language="javascript">';
      echo 'alert("Please check the Captcha")';
      echo '</script>';
      exit;  
    }
  $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
  if($response.success==false)
  {
    echo '<h2>Please do not try and spam here.</h2>';
  }else
  {
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
echo '<script language="javascript">';
echo 'alert("Your Message successfully sent, we will get back to you ASAP.");';
echo 'window.location.href="index.html";';
echo '</script>';
  }
} ?>