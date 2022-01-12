<?php
   if (isset($_COOKIE['email']) && isset($_COOKIE['password']) && isset($_COOKIE['admin'])) {
      unset($_COOKIE['email']);
      unset($_COOKIE['password']);
      unset($_COOKIE['admin']);
      setcookie('email', null, -1, '/');
      setcookie('password', null, -1, '/');
      setcookie('admin', null, -1, '/');
   }
   session_start();
   session_destroy(); //destroy the session
   header('Location: ../pages/login.php'); //to redirect back to "index.php" after logging out
   exit();
?>