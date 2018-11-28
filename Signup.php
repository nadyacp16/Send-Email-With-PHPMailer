<?php
require_once('db.php');
require_once('mail.php');

$verifycode = md5(rand(0,10000));
$mail = new Mailer();

if(isset($_POST['submit'])){
  $usernameSignup = mysqli_real_escape_string($con,$_POST['usernameSignup']);
  $emailSignup = mysqli_real_escape_string($con,$_POST['emailSignup']);
  $passwordSignup = mysqli_real_escape_string($con,$_POST['passwordSignup']);
  $konfirmasi = mysqli_escape_string($con,$_POST['retype']);

  $q = "SELECT * FROM signup ORDER BY signup.user_id DESC LIMIT 1";
  $r = mysqli_query($con, $q);
  if(mysqli_num_rows($r) > 0){
    $row = mysqli_fetch_array($r);
    $user_id = $row['user_id'];
    $user_id = $user_id + 1;
  }
  else{
    $user_id = 1;
  }
  if(empty($usernameSignup) or empty($emailSignup) or empty($passwordSignup)){
    $error = "All Fields Required, Try Again";
  }
  else{
    $passwordSignup = md5($passwordSignup);
    $insert_query = "INSERT INTO 
    `signup`(`user_id`, `usernameSignup`, `emailSignup`, `passwordSignup`, `role_id`,`verification_code`) 
    VALUES ('$user_id','$usernameSignup','$emailSignup','$passwordSignup',2,'$verifycode')";
    if(mysqli_query($con, $insert_query)){
      $mail->sendEmail($emailSignup,$verifycode);
      header("Refresh:0 Login.php");
    }
    else{
      $error = "Error occured";
    }
  }
}
?>
