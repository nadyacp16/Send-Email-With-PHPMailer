<?php
  include 'db.php';
  include 'mail.php';

    $kode = $_GET['verifycode'];
    $email = $_GET['email'];

    $sql = "select * from signup where emailSignup ='$email' and verification_code = '$kode'";

    if($result=mysqli_query($con,$sql))
    {
      if(mysqli_num_rows(mysqli_query($con,$sql)) != 0)
      {
        $sql1 = "update signup set verified=1 where emailSignup='$email'";

        if ($con->query($sql1) === TRUE) {
          echo "<script type='text/javascript'>alert('Success Verification');location='Login.php';</script>";
        }
        else
        {
          echo "<script type='text/javascript'>alert('Failed Verification');location='Login.php';</script>";
        }

      }
      else
      {
        echo "<script type='text/javascript'>alert('Wrong Data');location='Login.php';</script>";
      }
      exit;
  }
  else
  {
      echo "error".mysqli_error($con);
  }
?>