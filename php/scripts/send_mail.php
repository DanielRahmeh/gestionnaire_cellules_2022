<?php
// Script permmettant l'envoi d'un mail
// Utilisé avec l'adresse suivant :
// - Email           : gdc.numerica.contact@gmail.com
// - Mot de passe    : Numerica!2022.gdc
// vu sur : https://github.com/PHPMailer/PHPMailer


// Appel des fichiers utiles au fonctionnment du protocol de mailing
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

// Fonction a appelé lors de la mise en place d'un evoie de mail
// prend en paramètre : le sujet du mail / le message du mail / l'adresse mail du destinataire
function send_mail($subject, $body, $destinator) {
   try {
      $mail = new PHPMailer(true);
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'gdc.numerica.contact@gmail.com';
      $mail->Password   = 'Numerica!2022.gdc';
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $mail->Port       = 465;
      $mail->setFrom('gdc.numerica.contact@gmail.com', 'GDC Numerica');
      $mail->addAddress($destinator);
      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body = $body;
      $mail->send();
      $mail->SmtpClose();
      unset($mail);
   }
   catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
   }
}
?>