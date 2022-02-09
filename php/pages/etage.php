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
               <?php require('../scripts/list.php');?>
            </div>

            <!-- Partie principal au centre de la page -->
            <div class="main_display">
               <?php
                  echo('<pre>');
                     print_r($array_structure);
                  echo('</pre>');
               ?>
            </div>
            
         </main>
         <?php
         include('header/footer.php');
      }
?>