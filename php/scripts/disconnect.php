<?php
// Scrtipt permettant la déconnexion de l'utilisateur


   // Supression des données dans les cookies du navigateur
   if (isset($_COOKIE['email']) && isset($_COOKIE['password']) && isset($_COOKIE['admin'])) {
      unset($_COOKIE['email']);
      unset($_COOKIE['password']);
      unset($_COOKIE['admin']);
      setcookie('email', null, -1, '/');
      setcookie('password', null, -1, '/');
      setcookie('admin', null, -1, '/');
   }
   
   session_start();

   // Destruction de la session utilisateur
   session_destroy();

   // Redirection vers la page de login
   header('Location: ../pages/login.php');
   exit();
?>