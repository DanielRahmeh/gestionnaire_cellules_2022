<?php
// Page html qui affiche les résultat de la recherche

// Récuperation des élement de la session de l'utilisateur
session_start();

// Vérification si l'utilisateur est bien connécté
if($_SESSION['email'] != "") {
   $email = $_SESSION['email'];
   $admin = $_SESSION['admin'];

   // Affichage du header de la page
   include('header/header.php');
   $searching = $_POST['searching'];
   ?>
   <main id="main_principal">

      <div class="slide_bar">
         <!-- Appel du fichier permettant d'afficher la liste déroulante de navigation -->
         <?php require('list.php');?>
      </div>

      <!-- Partie principal au centre de la page -->
      <div class="main_display">
         <h3 style="margin-bottom: 30px;">Recherche pour : <b><?php echo($_POST['searching']); ?></b></h3>
         
         <div style="margin-bottom: 30px;">
            <h4 style="margin-bottom: 20px;"><b>Structure</b></h4>
            <div id="list-structure">
               <input type="text" class="search" placeholder="Rechercher">
               <button class="sort" data-sort="name">Trier par Nom</button>
               <button class="sort" data-sort="level">Trier par Niveau</button>
               <ul class="list">
               <?php
                  $reponse = $bdd->query("SELECT * 
                                          FROM structure, lieu
                                          WHERE structure.id_structure = lieu.id_structure
                                          AND lower(structure.nom_structure) LIKE lower('%" . $searching . "%')");
                  $count = 0;
                  while ($donnees = $reponse->fetch()) {
                     ?>
                     <li>
                        <?php
                        $link = get_link_serach($donnees['id_structure'], $array_structure);
                        $url = "lieu.php?id=" . $donnees['id_structure'] . "&link=" . $link;
                        ?> 
                        <div class="name">Structure : <?php echo($donnees['nom_structure']); ?></div>
                        <div class="level">Niveau : Lieu</div>
                        <a href="<?php echo($url) ?>">Voir</a>
                     </li>
                     <?php
                     $count++;
                  }
                  $reponse = $bdd->query("SELECT * 
                                          FROM structure, batiment
                                          WHERE structure.id_structure = batiment.id_structure
                                          AND lower(structure.nom_structure) LIKE lower('%" . $searching . "%')");
                  while ($donnees = $reponse->fetch()) {
                     ?>
                     <li>
                     <?php
                        $link = get_link_serach($donnees['id_structure'], $array_structure);
                        $url = "batiment.php?id=" . $donnees['id_structure'] . "&link=" . $link;
                        ?> 
                        <div class="name">Structure : <?php echo($donnees['nom_structure']); ?></div>
                        <div class="level">Niveau : Batiment</div>
                        <a href="<?php echo($url) ?>">Voir</a>
                     </li>
                     <?php
                     $count++;
                  }
                  $reponse = $bdd->query("SELECT * 
                                          FROM structure, etage
                                          WHERE structure.id_structure = etage.id_structure
                                          AND lower(structure.nom_structure) LIKE lower('%" . $searching . "%')");
                  while ($donnees = $reponse->fetch()) {
                     ?>
                     <li>
                        <?php
                        $link = get_link_serach($donnees['id_structure'], $array_structure);
                        $url = "etage.php?id=" . $donnees['id_structure'] . "&link=" . $link;
                        ?> 
                        <div class="name">Structure : <?php echo($donnees['nom_structure']); ?></div>
                        <div class="level">Niveau : Etage</div>
                        <a href="<?php echo($url) ?>">Voir</a>
                     </li>
                     <?php
                     $count++;
                  }
                  $reponse = $bdd->query("SELECT * 
                                          FROM structure, cellule
                                          WHERE structure.id_structure = cellule.id_structure
                                          AND lower(structure.nom_structure) LIKE lower('%" . $searching . "%')");
                  while ($donnees = $reponse->fetch()) {
                     ?>
                     <li>
                        <?php
                        $link = get_link_serach($donnees['id_structure'], $array_structure);
                        $url = "cellule.php?id=" . $donnees['id_structure'] . "&link=" . $link;
                        ?> 
                        <div class="name">Structure : <?php echo($donnees['nom_structure']); ?></div>
                        <div class="level">Niveau : Cellule</div>
                        <a href="<?php echo($url) ?>">Voir</a>
                     </li>
                     <?php
                     $count++;
                  }
                  if ($count == 0) {
                     ?> <p style="font-size: 20px;"><i>Aucun résultat</i> </p> <?php
                  }
               ?>
               </ul>
            </div>
            <script>
               var options = {
                  valueNames: [ 'name', 'level' ]
               };
               if (typeof myList == 'undefined') {
                  var i = 0;
                  var myList = new Array();
                  
               }
               var id = 'list-structure';
               myList[i] = new List(id, options);
               i++;
            </script>
         </div>

         <div style="margin-bottom: 30px;">
            <h4 style="margin-bottom: 20px;"><b>Equipement</b></h4>
            <div id="list-equipement">
               <input type="text" class="search" placeholder="Rechercher">
               <button class="sort" data-sort="name">Trier par Nom</button>
               <button class="sort" data-sort="type">Trier par Type</button>
               <button class="sort" data-sort="cat">Trier par Catégorie</button>
               <button class="sort" data-sort="cellule">Trier par Cellule</button>
               <ul class="list">
               <?php
                  $reponse = $bdd->query("SELECT equipement.nom_equipement AS nom,
                                          type_equipement.libelle AS type_equipement,
                                          cat_equipement.libelle AS cat_equipement,
                                          structure.nom_structure AS nom_structure,
                                          structure.id_structure AS id_structure
                                          FROM equipement, type_equipement, cat_equipement, structure
                                          WHERE equipement.id_structure = structure.id_structure
                                          AND equipement.id_type_equipement = type_equipement.id_type_equipement
                                          AND type_equipement.id_cat_equipement = cat_equipement.id_cat_equipement
                                          AND lower(equipement.nom_equipement) LIKE lower('%" . $searching . "%')");
                  $count = 0;
                  while ($donnees = $reponse->fetch()) {
                     ?>
                     <li>
                        <?php
                        $link = get_link_serach($donnees['id_structure'], $array_structure);
                        $url = "cellule.php?id=" . $donnees['id_structure'] . "&link=" . $link;
                        ?> 
                        <div class="name">Equipement : <?php echo($donnees['nom']); ?></div>
                        <div class="sortie">Type : <?php echo($donnees['type_equipement']); ?></div>
                        <div class="entree">Catégorie : <?php echo($donnees['cat_equipement']); ?></div>
                        <div class="cellule">Cellule : <?php echo($donnees['nom_structure']); ?></div>
                        <a href="<?php echo($url) ?>">Voir</a>
                     </li>
                     <?php
                     $count++;
                  }
                  if ($count == 0) {
                     ?> <p style="font-size: 20px;"><i>Aucun résultat</i> </p> <?php
                  }
               ?>
               </ul>
            </div>
            <script>
               var options = {
                  valueNames: [ 'name', 'type', 'cat', 'cellule' ]
               };
               if (typeof myList == 'undefined') {
                  var i = 0;
                  var myList = new Array();
                  
               }
               var id = 'list-equipement';
               myList[i] = new List(id, options);
               i++;
            </script>
         </div>

         <div style="margin-bottom: 30px;">
            <h4 style="margin-bottom: 20px;"><b>Organisme</b></h4>
            <div id="list-organisme">
               <input type="text" class="search" placeholder="Rechercher">
               <button class="sort" data-sort="name">Trier par Nom</button>
               <button class="sort" data-sort="sortie">Trier par Date d'entrée</button>
               <button class="sort" data-sort="entree">Trier par Date de sortie</button>
               <button class="sort" data-sort="cellule">Trier par Cellule</button>
               <ul class="list">
               <?php
                  $reponse = $bdd->query("SELECT * 
                                          FROM organisme, cellule, bail, structure
                                          WHERE structure.id_structure = cellule.id_structure
                                          AND cellule.id_cellule = bail.id_cellule
                                          AND bail.id_organisme = organisme.id_organisme
                                          AND lower(organisme.nom_organisme) LIKE lower('%" . $searching . "%')");
                  $count = 0;
                  while ($donnees = $reponse->fetch()) {
                     ?>
                     <li>
                        <?php
                        $date = date('Y-m-d');
                        if ($donnees['date_sortie'] >= $date || $donnees['date_sortie'] = '0000-00-00') {
                           $link = get_link_serach($donnees['id_structure'], $array_structure);
                           $url = "cellule.php?id=" . $donnees['id_structure'] . "&link=" . $link;
                           ?> 
                              <div class="name">Organisme : <?php echo($donnees['nom_organisme']); ?></div>
                              <div class="sortie">Date d'entrée : <?php echo(date("d/m/Y", strtotime($donnees['date_entree']))); ?></div>
                              <div class="entree">Date de sortie : <?php echo(date("d/m/Y", strtotime($donnees['date_sortie']))); ?></div>
                              <div class="cellule">Cellule : <?php echo($donnees['nom_structure']); ?></div>
                              <a href="<?php echo($url) ?>">Voir</a>
                           <?php
                        }
                        ?>
                     </li>
                     <?php
                     $count++;
                  }
                  if ($count == 0) {
                     ?> <p style="font-size: 20px;"><i>Aucun résultat</i> </p> <?php
                  }
               ?>
               </ul>
            </div>
            <script>
               var options = {
                  valueNames: [ 'name', 'sortie', 'entree', 'cellule' ]
               };
               if (typeof myList == 'undefined') {
                  var i = 0;
                  var myList = new Array();
                  
               }
               var id = 'list-organisme';
               myList[i] = new List(id, options);
               i++;
            </script>
         </div>

      </div>
   </main>
   <?php
   include('header/footer.php');
}
?>