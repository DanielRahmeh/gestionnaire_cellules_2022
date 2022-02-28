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
            <div class="title-structure">
               <h1 id="title-text"><b> <?php echo($nom_structure); ?> </b></h1>
               <?php
               $url = '../scripts/edit_structure_name.php?id=' . $_GET['id'] . '&link=' . $_GET['link'] . '&rang=cellule';
               ?>
               <form action="<?php echo($url); ?>" method="Post" id='title-form' style="margin-top: 25px;display: none;">
                  <label for="">Modifier le nom de la cellule</label> <br>
                  <input type="text" name="new_title" value="<?php echo($nom_structure); ?>" style="margin-bottom: 25px;"  
                  onchange="this.form.submit()">
               </form>
               <img src="../../img/icon/modify.png.png" alt="" onclick="changeTitle('title-text', 'title-form')">
            </div>
            <section class="id_structure">
               <div class="img_section">
                  <img src="<?php echo($image_structure); ?>" alt="" class="img_structure">
                  <!-- Affichage des différents données correspondant à la structure -->
                  <div style="width: 100%;">
                     <ul class="cell-list">
                        <?php
                        $reponse = $bdd->query("SELECT cat_cellule.libelle as cat_cel, type_cellule.libelle as type_cel
                                                FROM cat_cellule, type_cellule, cellule
                                                WHERE cellule.id_type_cellule = type_cellule.id_type_cellule
                                                AND type_cellule.id_cat_cellule = cat_cellule.id_cat_cellule
                                                AND cellule.id_structure = " . $_GET['id'] . "");
                        while ($donnees = $reponse->fetch()) {
                           ?> <li><b>Catégorie</b> : <?php echo($donnees['cat_cel']) ?></li><hr> <?php
                           ?> <li><b>Type</b> : <?php echo($donnees['type_cel']) ?></li><hr> <?php
                        }
                        ?>
                        <li><b>Surface</b> : <?php echo($surface_structure); ?> m²</li><hr> 
                        <button data-toggle="modal" data-target="#exampleModalLong" class="little-button">Modifier</button>

                        <?php
                        include('modal/modal_info.php');
                        ?>

                     </ul>
                     <ul class="cell-list" id="organisme-info">
                        <?php
                        $count = 0;
                        $reponse = $bdd->query("SELECT *
                                                FROM bail, organisme
                                                WHERE organisme.id_organisme = bail.id_organisme
                                                AND bail.id_cellule = " .  $id_cellule . "");
                        while ($donnees = $reponse->fetch()) {
                           ?> <li><b>Organimse locataire</b> : <?php echo($donnees['nom_organisme']); ?></li><hr> <?php
                           ?> <li><b>Num. téléphone</b> : <?php echo($donnees['tel_organisme']); ?></li><hr> <?php
                           ?> <li><b>Date d'entrée</b> : <?php echo($donnees['date_entree']); ?></li><hr> <?php
                           ?> <li><b>Date de sortie</b> : <?php echo($donnees['date_sortie']); ?></li> <?php
                           ?>
                           <button data-toggle="modal" data-target="#exampleModalLong" class="little-button">Modifier</button>
                           <button data-toggle="modal" data-target="#exampleModalLong" class="little-button" id="delete-little-button">Supprimer</button>
                           <?php 
                           $count++;
                        }
                        if ($count == 0) {
                           ?>
                           <li><b>Organimse locataire</b> : /</li><hr>
                           <li><b>Num. téléphone</b> : /</li><hr>
                           <li><b>Date d'entrée</b> : /</li><hr>
                           <li><b>Date de sortie</b> : /</li>
                           <button data-toggle="modal" data-target="#exampleModalLong" class="little-button" id="add-little-button">Ajouter</button>
                           <?php
                        }
                        ?>
                        </ul>
                        
                  </div>

               </div>
            </section>
         </div>
      </div>
      
   </main>
   <?php
   include('header/footer.php');
}
?>