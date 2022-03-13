<?php
include('header/header_no_connected.php');
// Appel du fichier permettant de se connecter à la bdd
require ('../scripts/connect_to_db.php');
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}
if (isset($_GET['new'])) {
   $alpha = "abcdefghijklmnopqrstuvwxyz";
   $len = strlen($alpha);
   $password_user = '';
   for ($i = 0; $i < 6; $i++) {
      $password_user .= $alpha[rand(0, $len - 1)];
  }
  $new_password = $password_user;
  $password_user = password_hash($password_user, PASSWORD_DEFAULT);
  $email_user = $_POST['email_user'];
  $query = $bdd->prepare('UPDATE user 
                        SET password_user = :password_user
                        WHERE email_user = :email_user');
   $query->execute(array(
      'password_user' => $password_user,
      'email_user' => $email_user));
   require '../../PHPmailer/src/send_mail.php';
   send_mail('Modification de votre mot de passe',
            'Bonjour,<br /><br />
            Vous avez demandé un nouveau mot de passe sur l\'application \'Gestionnaire de cellules\'.<br />
            Voici votre mot de passe : <br />
            -mot de passe : <b>' . $new_password . '</b><br /><br />
            Vous pourrez à tout moment le modifier via vos paramètre utilisateur.
            Nous vous remercions de votre confiance.<br /><br />
            Cordialement,<br />
            L\'équipe technique de Numerica.',
            $email_user);
   // Redirection vers la page précédent avec message de validation de création
   header('Location: ../pages/settings_admin.php?valide=1');     
}
?>
</body>
<main id="main_principal_2" style="background-color: white;">
   <h3 style="margin-top: 30px;">Demande d'un nouveau mot de passe</h3>
   <p>Le mot de passe vous sera envoyé par mail</p>
   <form action="forgot_password.php?new=0" method="POST">
      <label for="">Indiquez votre adresse mail</label><br>
      <input type="mail" name="email_user"><br>
      <input type="submit" value="Envoyez" style="margin-top: 10px;">
   </form>
</main>
<?php
include('header/footer.php');
?>
</body>
</html>

