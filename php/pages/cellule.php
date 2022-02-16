<?php
// Page html qui affiche une cellule


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
            <h1><b> <?php echo($nom_structure); ?> </b></h1>

            <section class="id_structure">
               <div class="img_section">

                  <!-- Affichage des différents données correspondant à la structure -->
                  <ul>
                     <li><b>Surface</b> : <?php echo($surface_structure); ?> m²</li>
                  </ul>

               </div>
            </section>
         </div>
      </div>
      
   </main>
   <?php
   include('header/footer.php');
}
?>