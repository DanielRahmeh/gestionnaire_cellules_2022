<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta content="width=device-width, initial-scale=1" name="viewport" />
   <link rel="stylesheet" href="../../css/style.css" type="text/css" />
   <link rel="stylesheet" href="../../css/responsive.css" type="text/css" />
   <title>Paramètres admin</title>
</head>
<body>
   <header>
      <a href="principal.php" id="banniere">
         <img src="../../img/logo/logo_img2.png" alt="Retour à l'accueil">
         <h3>Gestionnaire de cellules</h3>
      </a>
         <form action="" id="search_bar_header">
            <input type="text" name="search" placeholder="Entrer votre recherche" class="search_bar" required>
            <button type="submit" name="btnEnvoiForm" title="Search" class="search_button"><img src="../../img/icon/search.png" class="icon_search" /></button>
         </form>
      <nav>
         <?php if ($_SESSION['admin'] == 1) {?>
            <a href="settings_admin.php"  id="settings_active">
               <img src="../../img/icon/settings.png" alt="" class="icon_nav">
            </a>
            <?php }?>
         <a href="settings.php" id="user"><img src="../../img/icon/user.png" alt="" class="icon_nav"></a>
         <a href="../scripts/disconnect.php"  id="power-button"><img src="../../img/icon/power-button.png" alt="" class="icon_nav"></a>
      </nav>
   </header>
</body>
</html>