<?php
   require ('connect_to_db.php');
   $db = new Database();
   $bdd = $db->getConnection();
   if (!$bdd) {
         die("Error connecting to the database");
      }
   $reponse = $bdd->query("SELECT * FROM user");
   $count = 0;
   while ($donnees = $reponse->fetch()) {
         
         if ($_POST['email'] == $donnees['email_user'] && $_POST['password'] == $donnees['password_user']) {
               $count = 1;
               $admin = $donnees['admin_user'];
            }
      }
   if ($count == 0)
      header('Location: ../index.php?erreur=1');
   else {
         session_start();
         $_SESSION['email'] = $_POST['email'];
         $_SESSION['admin'] = $admin;
         header('Location: ../pages/principal.php');
      }
?>