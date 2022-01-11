<?php
   if(isset($_COOKIE['email']) && isset($_COOKIE['password']) && isset($_COOKIE['admin'])) {
      session_start();
      $_SESSION['email'] = $_COOKIE['email'];
      $_SESSION['password'] = $_COOKIE['password'];
      $_SESSION['admin'] = $_COOKIE['admin'];
      header('Location: php/pages/principal.php');
   }
   else
      header('Location: php/pages/login.php');
?>