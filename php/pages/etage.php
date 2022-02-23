<?php
// Page html qui affiche un étage


// Récuperation des élement de la session de l'utilisateur
session_start();

// Vérification si l'utilisateur est bien connécté
if($_SESSION['email'] != "") {
   $email = $_SESSION['email'];
   $admin = $_SESSION['admin'];

   // Affichage du header de la page
   include('header/header.php');

    // Appel du fichier permettant d'initialiser la structure séléctionnée
    include('../scripts/get_structure.php');
   
    // Appel du fichier permettant d'établir la structure des cellules composants la structure affichée
    include('../scripts/find_cell.php');

   // Initialisation du tableau composant les cellules de la structure affichée
   $array_cel = find_cell($array_structure, $_GET['id'], $bdd);
   ?>

   <main id="main_principal">

      <div class="slide_bar">
         <!-- Appel du fichier permettant d'afficher la liste déroulante de navigation -->
         <?php require('list.php');?>
      </div>

      <!-- Partie principal au centre de la page -->
      <div class="main_display">
         <div class="head_structure">

            <!-- Boutton pour afficher la liste de navigation -->
            <button class="menu_button" id="button_click" onclick="hideList()">
               <img src="../../img/icon/menu_off.png" alt="" id="img_click">
            </button>

            <!-- Appel du fichier permettant d'afficher les chemin pour arriver à la strcuture affichée -->
            <?php require('structure_path.php');?>

         </div>

         <div class="structure_container">

            <!-- Affichage du nom de la structure -->
            <h1 class="h1-etage"><b> <?php echo($nom_structure); ?> </b></h1>
            <section class="id_structure">
               <button id="plan_button">Afficher le plan</button>
               <img src="<?php echo($image_structure); ?>" alt="" id="plan"> 
               <div class="img_section">
                  
                  <!-- Affichage des différents données correspondant à la structure -->
                  <ul class="list_etage">
                     <li><b>Surface</b> : <?php echo($surface_structure); ?> m²</li>
                     <li><b>Nombre de cellules total</b> : <?php echo(count($array_cel['nom'])); ?></li>
                     <li class="occupe"><b>Nombre de cellules occupées</b> : 
                        <?php echo(count($array_cel['organisme']) - array_count_values($array_cel['organisme'])['/']); ?>
                     </li>
                     <li class="libre"><b>Nombre de cellules libres</b> : 
                        <?php echo(count($array_cel['organisme']) - (count($array_cel['organisme']) - array_count_values($array_cel['organisme'])['/'])); ?>
                     </li>
                  </ul>

               </div>
            </section>
            <?php
            include('disp_cell.php');
            ?>
         </div>
      </div>
      
   </main>
   <?php
   include('header/footer.php');
}
?>