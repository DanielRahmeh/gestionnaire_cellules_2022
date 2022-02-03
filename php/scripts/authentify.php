<!-- Script permettant de récupérer les données saisi sur la page de connexion et de les comparer aux données de la bdd -->
<!-- Si c'est données sont valides l'utiilisateur sera redirigé sur la page principal.php sionon il sera renvoyer à login.php -->

<?php
   // Appel du fichier permettant de se connecter à la bdd
   require ('connect_to_db.php');
   $db = new Database();
   $bdd = $db->getConnection();
   if (!$bdd) {
         die("Error connecting to the database");
      }
   
   // Requète permettant de récup les données de la table user
   $reponse = $bdd->query("SELECT * FROM user");
   $count = 0;
   while ($donnees = $reponse->fetch()) {
      // Condition permettant de vérifier sir un email et un mot de passe correspponde
      if ($_POST['email'] == $donnees['email_user'] && password_verify($_POST['password'], $donnees['password_user'])) {
         $count = 1;
         // Lancement d'une session utilisateur
         if (!isset($_SESSION))
            session_start();
         $_SESSION['email'] = $_POST['email'];
         $_SESSION['password'] = $_POST['password'];
         $_SESSION['admin'] = $donnees['admin_user'];
         // Si l'utilisateur à décidé de réster connecté ses données sont enregistrées dans les cookies de son navigateur
         if (!empty($_POST["stay_connected"])) {
            setcookie('email', $_POST['email'], time()+36000, '/');
            setcookie('password', $_POST['password'], time()+36000, '/');
            setcookie('admin', $admin, time()+36000, '/');
         }
         // Connexion réussi : redirection vers la page d'accueil (principal.php)
         header('Location: ../pages/principal.php'); 
      }
   }
   // Saisi de l'email ou du mdp incorect, l'utilisateur est revoyé sur la page de connexion accompagné d'un message d'erreur
   if ($count == 0)
      header('Location: ../pages/login.php?erreur=1');
?>