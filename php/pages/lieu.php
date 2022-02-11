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
               <?php
                  $reponse = $bdd->query("SELECT * FROM structure
                                          WHERE structure.id_structure = " . $_GET['id']);
                  while ($donnees = $reponse->fetch()) {
                     $nom_structure = $donnees['nom_structure'];
                     $adresse_structure = $donnees['adresse_structure'];
                     $coordonnees_structure = $donnees['coordonnees_structure'];
                     $surface_structure = $donnees['surface_structure'];
                     $image_structure = $donnees['image_structure'];
                  }
                  ?><h1> <?php echo($nom_structure); ?> </h1><?php
               ?>
               <h1></h1>
            </div>
            
         </main>
         <?php
         include('header/footer.php');
      }
?>