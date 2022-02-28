<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header" style="margin-bottom: 10px;">
         <h3 class="modal-title" id="exampleModalLongTitle">Modifier la celulle</h3>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="modal-body">
         <?php
         $link = "../scripts/edit_cell.php?id=" . $_GET['id'] . '&link=' . $_GET['link'];
         $i = 1;
         $j = 1;
         $cat_type_cell =  array();
         $reponse = $bdd->query("SELECT *
                                 FROM cat_cellule");
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
         <form action="<?php echo($link); ?>" method="POST" class="form-modal" enctype="multipart/form-data">

            <label>Sélectionnez un type de cellule</label>
            
            <br />
            <select name="modify" id="modify" 
            onchange="newElemSelect('modify', 'cat-input'); newElemSelect('modify', 'type-input')">
            <option value="-">Aucun changement</option>
               <?php
               foreach ($cat_type_cell as $cat) {
                  ?>
                  <optgroup label="<?php echo($cat['name']); ?>">
                     <?php
                     foreach ($cat['type'] as $type) {
                        ?>
                        <option value="<?php echo($type['id']); ?>"><?php echo($type['name']); ?></option>
                        <?php
                     }
                     ?> 
                  </optgroup>
                  <?php
               }
               ?>
               <option value="/">Nouveau ...</option>
               
            </select>
            <?php
            $url_cat = 'cat_cell.php?id=' . $_GET['id'] . '&link=' . $_GET['link'];
            $url_type = 'type_cell.php?id=' . $_GET['id'] . '&link=' . $_GET['link'];
            ?>
            <a href="<?php echo($url_cat); ?>">Supprimer une catégorie</a><br>
            <a href="<?php echo($url_type); ?>">Supprimer un type</a>
            <hr style="margin: 20px 0px 10px 0px;">
            <br />
            <h4>Créer un nouveau type</h4><br>
            <label>Sélectionnez une catégorie de cellule</label>
            <select name="cat" id="cat" onchange="newElemSelect('cat', 'cat-input')">
            <?php
               foreach ($cat_type_cell as $cat) {
                  ?>
                  <option value="<?php echo($cat['id']); ?>"><?php echo($cat['name']); ?></option>
                  <?php
               }
            ?>
            <option value="/">Nouveau ...</option>
            </select>
            <label>Nouvelle Catégorie</label><br />
            <input type="text" name="new-cat" id="cat-input" onKeyUp="newElem('cat', 'cat-input'); newElem('modify', 'cat-input')"><br />
            <label>Nouveau type</label><br />
            <input type="text" name="new-type" id="type-input" onKeyUp="newElem('modify', 'type-input')"><br />
            <hr style="margin: 20px 0px 30px 0px;">
            <label>Surface</label>
            <input type="number" name="surface" step="0.01" value="<?php echo($surface_structure); ?>">
            <hr style="margin: 20px 0px 30px 0px;">
            <label>Nouvelle Image</label>
            <input type="file" name='new-image' class="import-img-button">
            <?php
            $url = '../scripts/reset_image.php?id=' . $_GET['id'] . '&link=' . $_GET['link'];
            ?>
            <a href="<?php echo($url); ?>">Supprimer l'image</a>
            <input type="submit" value="Modifier" class="modal-submit">
         </form>
      </div>
      </div>
   </div>
</div>