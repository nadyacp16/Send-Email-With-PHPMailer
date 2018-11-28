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


<!DOCTYPE html>
<html lang="en">
<head>
  <title>NekoBundle</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/Login&Register.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
  <div class="topRow">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <div class="brand navbar-brand">
            <a class="navbar-brand" href="Home.php"><img src="assets/image/Logo.png"></a>
          </div>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <div class="navbarKanan">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="Home.php"">Home</a></li>
              <li><a href="Bundle.php">Bundle</a></li>
              <li><a href="Store.php">Store</a></li>
              <li><a href="About.php">About</a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </div>       
  <div class="thirdRow">
    <div class="container">
      <div class="signupTextcss">
        <p class="signupText">S</p>
        <p class="signupText">I</p>
        <p class="signupText">G</p>
        <p class="signupText">N</p>
        <p class="signupText">U</p>
        <p class="signupText">P</p>
        <img class="garisText2" src="assets/image/garis2.png">
      </div>
      <div class="signupInput">
        <div class="signupInputcss">
          <div class="container">
            <form class="SignupForm" method="post">
              <input class="usernameSignup" id="usernameSignup" type="text" placeholder="Username" name="usernameSignup" required><br>
              <br>
              <input class="emailSignup" id="emailSignup" type="email" placeholder="Email" name="emailSignup" required><br>
              <br>
              <input class="passwordSignup" id="passwordSignup" type="password" placeholder="Password" name="passwordSignup" required><br>
              <br>
              <input class="retypeSignup" id="retypeSignup" type="password" placeholder="Re-type Password" 
              name="retype" required><br>
              <br><br>
              <input class="Signup" id="Signup" type="submit" name="submit" value="Signup"><br><br><br> 
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="footer">
    <div class="container-fluid">
      <img class="footerLogo" src="assets/image/Logo.png">
      <div class="footersecondRow">
        <article>No additional library (except JQuery) used to built this website.</article>
      </div>
      <div class="footerthirdRow">
        <article>&copy; 2018 Developer. All rights reserved.</article>
      </div>
    </div>
  </div>
  </html>