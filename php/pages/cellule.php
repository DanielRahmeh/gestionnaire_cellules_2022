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
                  <img src="<?php echo($image_structure); ?>" alt="" class="img_structure">
                  <!-- Affichage des différents données correspondant à la structure -->
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

                     <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                           <div class="modal-header">
                              <h3 class="modal-title" id="exampleModalLongTitle">Modifier la celulle</h3>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <div class="modal-body">
                              <?php
                              $link = "../scripts/edit_cell.php?id=" . $_GET['id'];
                              $i = 1;
                              $j = 1;
                              $cat_type_cell =  array();
                              $reponse = $bdd->query("SELECT *
                                                      FROM cat_cellule
                                                      ORDER BY libelle ASC");
                              while ($donnees = $reponse->fetch()) {
                                 $cat_type_cell[$i]['id'] = $donnees['id_cat_cellule'];
                                 $cat_type_cell[$i]['name']  = $donnees['libelle'];
                                 $reponse2 = $bdd->query("SELECT *
                                                         FROM type_cellule
                                                         WHERE id_cat_cellule = " . $cat_type_cell[$i]['id'] . " 
                                                         ORDER BY libelle ASC");
                                 while ($donnees = $reponse2->fetch()) {
                                    $cat_type_cell[$i]['type'][$j]['id'] = $donnees['id_type_cellule'];
                                    $cat_type_cell[$i]['type'][$j]['name'] = $donnees['libelle'];
                                    $j++;
                                 }
                                 $i++;
                              }
                              ?>
                              <form action="<?php echo($link); ?>" method="POST" class="form-modal">
                                 <label>Catégorie de la celulle</label><br />
                                 <select name="cat" id="cat" onchange="newElemSelect('cat', 'cat-input');this.form.submit(); ">
                                    <?php
                                    foreach ($cat_type_cell as $cat) {
                                       ?>
                                       <optgroup label="<?php echo($cat['name']); ?>">
                                          <?php
                                          foreach ($cat['type'] as $type) {
                                             ?>
                                             <option value="<?php $type['id'] ?>"><?php echo($type['name']); ?></option>
                                             <?php
                                          }
                                          ?> 
                                       </optgroup>
                                       <?php
                                    }
                                    ?>
                                    <option value="/">Nouveau</option>
                                 </select>
                                 <script type="text/javascript">
                                    $('#cat').change(function() 
                                    {
                                       $.ajax({
                                          type: 'post',
                                          url: "cellule.php",
                                          data: $("form.cat").serialize(),
                                       });
                                       return false;
                                    });
                                 </script>
                                 <br />
                                 <label>Nouvelle Catégorie</label><br />
                                 <input type="text" name="new-cat" id="cat-input" onKeyUp="newElem('cat', 'cat-input')"><br />
                                 <label>Type de la celulle</label><br />
                                 <select name="type" id="type" onchange="newElemSelect('type', 'type-input')">
                                 <?php
                                    $reponse = $bdd->query("SELECT *
                                                            FROM type_cellule
                                                            ORDER BY libelle ASC");
                                    while ($donnees = $reponse->fetch()) {
                                       ?> <option value="<?php echo($donnees['libelle']); ?>" id="select-cat">
                                          <?php echo($donnees['libelle']); ?>
                                       </option> 
                                       <?php 
                                    }
                                    ?>
                                    <option value="/">Nouveau</option>
                                 </select><br />
                                 <label>Nouveau type</label><br />
                                 <input type="text" name="new-type" id="type-input" onKeyUp="newElem('type', 'type-input')"><br />
                                 <label>Nouvelle Image</label>
                                 <input type="file" name='new-image' class="import-img-button">
                                 <input type="submit" value="Modifier" class="modal-submit">
                              </form>
                           </div>
                           </div>
                        </div>
                     </div>

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