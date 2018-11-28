<?php
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/SMTP.php';

class Mailer
{
    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer\PHPMailer\PHPMailer(true);
    }

    public function sendEmail($email,$verifycode){
    $this->mail->SMTPDebug = false;
    $this->mail->IsSMTP();
    $this->mail->Host = 'smtp.gmail.com';
    $this->mail->Port = 587;
    $this->mail->SMTPSecure = 'tls';
    $this->mail->SMTPAuth = true;
    $this->mail->Username = 'nekobundle@gmail.com';
    $this->mail->Password = 'nekobundle123';

    $this->mail->setFrom('nekobundle@gmail.com','Neko Bundle');
    $this->mail->addAddress($email);

    $this->mail->isHTML(true);
    $this->mail->Subject = 'Validate Your Email Account';
    $this->mail->Body = 
    'Please Click on Link Below to activate your account:<br><br>
    <a href="http://localhost/NekoBundle/NekoBundle/User/verification.php?email=' . $email . '&verifycode=' . $verifycode . '">

    Click Here to Activate your account</a>';

    if($this->mail->send()) {
      return true;
    }
    else{
      return false;
    }

  }
}
?>