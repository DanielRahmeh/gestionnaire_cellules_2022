<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<body>
   <?php
      session_start();
      if($_SESSION['email'] != "") {
         $email = $_SESSION['email'];
         $admin = $_SESSION['admin'];
         if ($admin == 1) {
               echo 'Bonjour, vous êtes connecté au compte de : <b>' . $email . '</b> en tant qu\'administrateur</br>';
               ?><a href="param_admin.php">Paramètre administrateur</a><?php
            }
         else
            echo 'Bonjour, vous êtes connecté au compte de : <b>' . $email . '</b></br>';
            ?><a href="../scripts/deconnect.php">Se déconnecter</a><?php
      }
      else {
            header('Location: login.php');
      }
    ?>
</body>
</html>