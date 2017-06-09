<?php
/**
 * Created by PhpStorm.
 * User: Ibrahima
 * Date: 09/06/2017
 * Time: 11:56
 */
class  SendEmail
{
    private $host;
    private $smtpAuth;
    private $username;
    private $password;
    private $smtpSecure;
    private $port;
    public function __construct()
    {
        $this->host = 'smtp.gmail.com';
        $this->smtpAuth = true;
        $this->username = 'mail.albasoft@gmail.com';
        $this->password = 'Albasoft2017';
        $this->smtpSecure = 'tls';
        $this->port = 587;
    }

    public  function sendEmail ($to, $subject, $body, $name)
    {

        $mail = new PHPMailer;

        $mail->SMTPDebug = 1;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $this->host;  // Specify main and backup SMTP servers
        $mail->SMTPAuth = $this->smtpAuth;                               // Enable SMTP authentication
        $mail->Username = $this->username;                 // SMTP username
        $mail->Password = $this->password;                           // SMTP password
        $mail->SMTPSecure = $this->smtpSecure;                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $this->port;                                    // TCP port to connect to

        $mail->setFrom($this->username,$name);
        $mail->addAddress($to);     // Add a recipient

//        $mail->addAttachment('/var/tmp/file.tar.gz');
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body    = "$body";
//        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
           return true;
        }
    }
}