<?php
      // Récuperation des élement de la session de l'utilisateur
      session_start();
      // Vérification si l'utilisateur est bien connécté
      if($_SESSION['email'] != "") {
         $email = $_SESSION['email'];
         $admin = $_SESSION['admin'];
         // Affichage du header de la page
         include('header/header.php');
         ?>
         <main id="main_principal">
            <div class="slide_bar">

               <!-- Liste de test -->
               <?php require('list.php');?>
            </div>

            <!-- Partie principal au centre de la page -->
            <div class="main_display">
               <div class="head_structure">
                  <button class="menu_button"><img src="../../img/icon/menu_off.png" alt="" id="button_click"  onclick="hideList()"></button>
                  <?php require('structure_path.php');?>
               </div>
            </div>
            
         </main>
         <?php
         include('header/footer.php');
      }
?>