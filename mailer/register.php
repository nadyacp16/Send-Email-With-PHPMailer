<?php
  include 'connection.php';
  include 'mail.php';

  if(isset($_POST['signup']))
  {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cmfpassword = md5($_POST['cmfpassword']);
    $verifycode = md5(rand(0,10000));
    $mail = new Mailer();


    //status = 0 not verified, 1  verified
    //1 = admin 2 = user

    $sql = "INSERT into user (username,password,email,role,status,verifycode)
            VALUES ('$username','$password','$email','2','0','$verifycode')";
    $sql_get_user = mysqli_query($conn,"SELECT * FROM user where username='$username' or email='$email'") or die (mysql_error());
    
    if($password!=$cmfpassword){
        echo "<script type='text/javascript'>alert('Password doesnt match');location='index.php';</script>";
    }
    else{
        if(mysqli_num_rows($sql_get_user) == 0)
        {
          if ($conn->query($sql) === TRUE) {
    
            $mail->sendEmail($email,$verifycode);
            echo "<script type='text/javascript'>alert('Sign up Success, please check your email for verification');location='index.php';</script>";
          }
          else
          {
            echo "Error updating record: " . mysqli_error($conn);
          }
        }
        else {
          echo "<script type='text/javascript'>alert('Username/Email alerady registerd');location='index.php';</script>";
        }
        exit;
    }
   echo "gagal";
  }
  echo "gagal";
?>