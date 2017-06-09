<?php
require 'SendEmail.php';
require 'PHPMailer/PHPMailerAutoload.php';
if (!empty($_POST)) {
    $erreurs = array();
    $company = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "Votre email n'est pas valide";
    }
    if (empty($message)) {
        $erreurs['message'] = "Votre message n'est pas valide";
    }
    if (empty($erreurs)) {
        $mail = new PHPMailer;

        $mail->SMTPDebug = 1;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'mail.albasoft@gmail.com';                 // SMTP username
        $mail->Password = 'Albasoft2017';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('mail.albasoft@gmail.com',$company);
        $mail->addAddress('ibrahima-sory.diallo@albasoft.fr');     // Add a recipient

//        $mail->addAttachment('/var/tmp/file.tar.gz');
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $addtext  = $message."<br /><br /> Email : <b>$email</b>";

        $mail->Body    = "$addtext";
        if(!$mail->send()) {
            echo 'Message could not be sent.';
        }else {
           header('Location: index.html');

           $body  = "Bonjour, <br /><br>Nous accusons bonne r&eacute;ception de votre message et nous vous remercions de l'int&eacute;r&ecirc;t que vous portez &agrave; notre entreprise.<br /><br>

                    Nous allons &eacute;tudier votre demande et vous r&eacute;pondre d	&egrave;s que possible.
                    <br /><br />
                    Cordialement.
                    <br > <br > <br >
                    <strong>Albasoft</strong><br>
                     Sicap foire<br />
                     271 <br />
                     Dakar, S&eacute;n&eacute;gal <br />
                    <b>Phone : </b> 00221 33 867 36 25 <br />
                    <b>Email : </b> contact@albasoft.fr
                    ";
           $send = new SendEmail;
           $send->sendEmail($email, $subject, $body, 'Albasoft');
        }
    }
}

