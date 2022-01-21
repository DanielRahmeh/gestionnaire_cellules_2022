<?php
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   require ('connect_to_db.php');
   $db = new Database();
   $bdd = $db->getConnection();
   if (!$bdd) {
         die("Error connecting to the database");
   }
   $email_user = $_POST['email'];
   if (isset($_POST['pass']))
      $password_user = $_POST['pass'];
   else
      $password_user = $_GET['pass'];
   $hash_password = password_hash($password_user, PASSWORD_DEFAULT);
   $admin_user = 0;
   if (isset($_POST['rights']))
      $admin_user = 1;
   $date_inscription = date('y-m-d');
   $reponse = $bdd->query("SELECT * FROM user");
   $count = 0;
   while ($donnees = $reponse->fetch())
       {
         if ($email_user == $donnees['email_user'])
            $count = 1;
       }
   if ($count == 1)
      header('Location: ../pages/settings_admin.php?erreur=1');
   else {
      echo("email : " . $email_user . " password : " . $password_user . " rights : " . $admin_user . " date : ". $date_inscription);
      $query = $bdd->prepare("INSERT INTO user(email_user, password_user, admin_user, date_inscription) 
                              VALUES(:email_user, :hash_password, :admin_user, :date_inscription)");
      $query->execute(array(
                           'email_user' => $email_user,
                           'hash_password' => $hash_password,
                           'admin_user' => $admin_user,
                           'date_inscription' => $date_inscription));
      // Protocole d'envoi de mail
      require '../../PHPMailer/src/Exception.php';
      require '../../PHPMailer/src/PHPMailer.php';
      require '../../PHPMailer/src/SMTP.php';
      $mail = new PHPMailer();
      $mail->Charset 	= 'UTF-8';
      $body = utf8_decode("Bonjour,<br />
                           Vous avez été inscrit sur l'application \'Gestionnaire de cellules\'.<br />
                           Voici vos identifiants : <br />
                           -email : <b>" . $email_user . "</b><br />
                           -mot de passe : <b>" . $password_user . "</b><br />
                           Nous vous remercions de votre confiance.<br />
                           Cordialement,<br />
                           L'équipe technique de Numerica.");
      $mail->IsSMTP();
      $mail->SMTPAuth   = true;
      $mail->SMTPSecure = "ssl";
      $mail->Host       = "smtp.gmail.com";
      $mail->Port       = 465;
      $mail->Username   = "gdc.numerica@gmail.com";
      $mail->Password   = "@bcdef1234!";
      $mail->AddReplyTo("gdc.numerica@gmail.com","gdc.numerica");
      $mail->From       = "gdc.numerica@gmail.com";
      $mail->FromName   = "gdc.numerica";
      $mail->Subject    = "Inscription au gestionnaire de cellules";
      $mail->AltBody    = 'ok';
      $mail->WordWrap   = 50;
      $mail->MsgHTML($body);
      $mail->AddAddress($email);
      $mail->IsHTML(true);
      if(!$mail->Send())
         echo $mail->ErrorInfo;
      $mail->SmtpClose();
      unset($mail);
      header('Location: ../pages/settings_admin.php?valide=1');     
   }
?>