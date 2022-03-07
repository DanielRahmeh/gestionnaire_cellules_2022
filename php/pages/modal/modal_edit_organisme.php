<div class="modal fade" id="editOrganisme" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header" style="margin-bottom: 10px;">
         <h3 class="modal-title" id="exampleModalLongTitle">Organisme locataire</h3>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="modal-body">
         <?php
         if (isset($id_bail))
            $url = '../scripts/edit_organisme.php?id=' . $_GET['id'] . '&link=' . $_GET['link'] . '&id_bail=' .  $id_bail;
         else
            $url = '../scripts/edit_organisme.php?id=' . $_GET['id'] . '&link=' . $_GET['link'];
         ?>
         <form action="<?php echo($url); ?>" method="POST" class="form-modal">
            <label for="">Sélectionnez un organisme</label> <br>
            <select name="organisme" id="organisme-select" style="margin-bottom: 15px;" 
            onchange="newElemSelect('organisme-select', 'new-organisme')">
               <?php
               if (isset($id_bail)) {
                  ?> <option value="-">Aucun changement</option> <?php
               }
               $reponse = $bdd->query("SELECT *
                                       FROM organisme");
               while ($donnees = $reponse->fetch()) {
                  ?> <option value="<?php echo($donnees['id_organisme']); ?>"><?php echo($donnees['nom_organisme']); ?></option> <?php
               }
               ?>
               <option value="/">Nouveau ...</option>
            </select> <br>
            <?php
            $url_organisme = 'organisme.php?id=' . $_GET['id'] . '&link=' . $_GET['link'];
            ?>
            <a href="<?php echo($url_organisme); ?>">Supprimer un organisme</a><br> <hr  style="margin: 25px 0px 25px 0px;">
            <h4>Créer un nouvel organisme</h4><br>
            <label for="">Nom de l'organisme</label><br>
            <input type="text" id="new-organisme" name="new_organisme" onKeyUp="newElem('organisme-select', 'new-organisme')">
            <hr  style="margin: 25px 0px 25px 0px;">
            <label for="">Numéro de téléphone</label> <br>
            <?php
            if (isset($tel_organisme)) {
               ?>  <input type="text" name="tel_organisme" value="<?php echo($tel_organisme); ?>" id="num_input"> <?php
            }
            else {
               ?>  <input type="text" name="tel_organisme" id="num_input"> <?php
            }
            ?>
            <label for="" style="margin-right: 10px;">Utilisé numero de téléphone déjà existant</label>
            <input type="checkbox" name="undifined_tel" style="width: auto;" id="num-check" 
            onclick="checkedDiv('num-check', 'num_input')">
            <label for="" style="margin-top: 10px">Date d'entrée</label> <br>
            <input type="date" name="date_entree" value="<?php echo($date_entree); ?>">
            <label for="">Date de sortie</label> <br>
            <input type="date" name="date_sortie" value="<?php echo($date_sortie); ?>" id="sortie-input">
            <label for="" style="margin-right: 10px;">Date de sortie non défini</label>
            <input type="checkbox" name="undifined_date_sortie" style="width: auto;" id="sortie-check" 
            onclick="checkedDiv('sortie-check', 'sortie-input')">
            <input type="submit" value="Confirmer" class="modal-submit">
         </form>
      </div>
      </div>
   </div>
</div>