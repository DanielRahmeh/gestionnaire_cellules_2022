<?php
   // Appel du fichier permettant l'initialisation du tableau d'objet des structures (Lieu, Batiment, Etage et Cellules)
   include('../scripts/init_structure.php');
   // echo('<pre>');
   // print_r($array_structure);
   // echo('</pre>');
?>

<!-- Header des pages en général -->

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" href="#">


   <!-- Intégration de bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
   rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
   integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

   <!-- Intégration de jquery -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

   <!-- Intégration de TableFilter librairie jquery permmettant d'intégrer de tableau filtrable et triable -->
   <script src="../../TableFilter-master/dist/tablefilter/tablefilter.js"></script>

   <!-- Intégration du CSS -->
   <link rel="stylesheet" href="../../css/style.css" type="text/css" />
   <link rel="stylesheet" href="../../css/responsive.css" type="text/css" />
   
   <!-- Integration du JS -->
   <script type ="text/javascript" src="../../js/list.js"></script>
   <script type ="text/javascript" src ="../../js/map.js"></script>

   <title>Numerica GDC</title>
</head>

<?php
   // Initialisation du chemin pour arriver jusqu'à la structure affichée
   $path = '';

   // Verification de la structure affichée
   if (isset($_GET['link'])){
      // Appel des fonctions permettant la création du chemin
      $path = find_path($array_structure, $_GET['link']);
      $tab_path = find_name_path($array_structure, $path);
   }
?>

<body onload="checkList('<?php echo($path); ?>');">
   <!-- Partie header des pages -->
   <header>

      <!-- Logo principal -->
      <a href="principal.php" id="banniere">
         <img src="../../img/logo/logo_image.png" alt="Retour à l'accueil">
         <h3>GDC Numerica</h3>
      </a>

      <!-- Bar de recherche -->
      <form action="" id="search_bar_header">
         <input type="text" name="search" placeholder="Entrer votre recherche" class="search_bar" required>
         <button type="submit" name="btnEnvoiForm" title="Search" class="search_button"><img src="../../img/icon/search.png" class="icon_search" /></button>
      </form>

      <!-- Boutons de navigation -->
      <nav>
         <?php if ($_SESSION['admin'] == 1) {?>
            <a href="settings_admin.php"  id="settings">
               <img src="../../img/icon/settings.png" alt="" class="icon_nav">
            </a>
            <?php }?>
         <a href="settings.php" id="user"><img src="../../img/icon/user.png" alt="" class="icon_nav"></a>
         <a href="../scripts/disconnect.php"  id="power-button"><img src="../../img/icon/power-button.png" alt="" class="icon_nav"></a>
      </nav>
   </header>