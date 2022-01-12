<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../../css/style.css" type="text/css" />
   <title>Document</title>
</head>
<body>
   <header>
      <a href="principal.php" id="banniere">
         <img src="../../img/logo/logo_image.png" alt="Retour à l'accueil" id="principal_logo">
         <h3>Gestionnaire de cellules</h3>
      </a>
      <nav>
         <?php if ($_SESSION['admin'] == 1)?>
            <a href="settings_admin.php"><img src="../../img/icon/admin_settings.png" alt="" class="icon_nav"></a>
         <a href="settings.php"><img src="../../img/icon/settings.png" alt="" class="icon_nav" id="little_icon_nav"></a>
         <a href="../scripts/disconnect.php"><img src="../../img/icon/power.png" alt="" class="icon_nav" id="little_icon_nav"></a>
      </nav>
   </header>
</body>
</html>