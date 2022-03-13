<div class="modal fade" id="<?php echo($id_modal2) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
   <div class="modal-dialog" role="document" id="modal-lieux">
      <div class="modal-content" id="modal-lieux-width" >
      <div class="modal-header" style="margin-bottom: 10px;">
         <h3 class="modal-title" id="exampleModalLongTitle">Gestion d'équipement</h3>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="modal-body">
         <?php
            $id_cat = (int) filter_var($id_modal2, FILTER_SANITIZE_NUMBER_INT);
            $url = "edit_type_equipement.php?id=" . $_GET['id'] . '&link=' . $_GET['link'] . '&id_cat_equipement=' . $id_cat;
            $url2 = "equipement.php?id=" . $_GET['id'] . '&link=' . $_GET['link'] . '&id_cat_equipement=' . $id_cat;
            $url3 = "mult_equipement.php?id=" . $_GET['id'] . '&link=' . $_GET['link'] . '&id_cat_equipement=' . $id_cat;
         ?>
         <a href="<?php echo($url); ?>" class="equipement-link">Gerez les types</a><br> 
         <a href="<?php echo($url2); ?>" class="equipement-link">Ajouter un équipement</a><br> 
         <a href="<?php echo($url3); ?>" class="equipement-link">Ajouter plusieurs équipements</a>
         <hr style="margin-bottom: 30px;">
         <?php

         // Requete récupération des données des utilisateurs
         $id_structure = $_GET['id'];
         $reponse2 = $bdd->query("SELECT equipement.id_equipement AS id_equipement, 
                                 equipement.nom_equipement AS nom_equipement,
                                 equipement.image AS image_equipement,
                                 equipement.date AS date,
                                 type_equipement.libelle AS nom_type, 
                                 etat.id_etat AS id_etat,
                                 etat.libelle AS nom_etat,
                                 etat.color AS color 
                                 FROM equipement, type_equipement, etat
                                 WHERE equipement.id_structure = '$id_structure'
                                 AND equipement.id_type_equipement = type_equipement.id_type_equipement
                                 AND type_equipement.id_cat_equipement = '$id_cat'
                                 AND equipement.id_etat = etat.id_etat");
         
         ?>
         <!-- Affichage du tableau contenant les données récupérés -->
         <?php
         $id_list = 'equipement' . $i;
         ?>
         <div id="<?php echo($id_list) ?>">
            <input type="text" class="search" placeholder="Rechercher">
            <button class="sort" data-sort="name">Trier par Type</button>
            <button class="sort" data-sort="type">Trier par Nom</button>
            <button class="sort" data-sort="etat">Trier par Date</button>
            <button class="sort" data-sort="etat">Trier par Etat</button>
         <ul class="list">
            <?php
            while ($donnees = $reponse2->fetch()) {
               ?>
               <li>
                  <div class="title-list">
                     <h4 class="name" style="margin-bottom: 0;"><b><?php echo($donnees['nom_type']);?></b></h4>
                     <h4 class="type"><?php echo($donnees['nom_equipement']); ?></h4>
                     <p class="date" style="margin: 0;"><?php echo(date('d/m/Y', strtotime($donnees['date']))); ?></p>
                     
                  </div>
                  <?php $style = 'background-color: ' . $donnees['color'] . ';margin: 10px 0 10px 0; padding: 5px 0px 3px 0px; color: white; border-radius: 5px; text-align: center;';?>
                  <p class="etat" style="display: none;"><?php echo($donnees['id_etat']); ?></p>
                  <p class="etat_equipement" style="<?php echo($style); ?>"><?php echo($donnees['nom_etat']); ?></p>
                  <?php
                  $url = "equipement.php?id=" . $_GET['id'] . '&link=' . $_GET['link'] . '&id_equipement=' . $donnees['id_equipement'] . '&id_cat_equipement=' . $id_cat;
                  $url2 = "../scripts/delete_equipement.php?id=" . $_GET['id'] . '&link=' . $_GET['link'] . '&id_equipement=' . $donnees['id_equipement'];
                  ?>
                  <div class="link-modify">
                     <a href="<?php echo($url);?>"  class="equipement-link">Modifier</a>
                     <a href="<?php echo($url2);?>"  class="equipement-link" id="delete-equipement">Supprimer</a>
                  </div>
               </li>
               <?php
            }
            ?>
         </ul>
         </div>
         <script>
            var options = {
               valueNames: [ 'name', 'type', 'date', 'etat' ]
            };
            if (typeof myList == 'undefined') {
               var i = 0;
               var myList = new Array();
               
            }
            var id = 'equipement' + (i + 5);
            myList[i] = new List(id, options);
            i++;
         </script>
        
      </div>
      </div>
   </div>
</div>
<script type ="text/javascript" src ="../../js/table.js"></script>

