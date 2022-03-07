<div class="modal fade" id="editPlafond" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
   <div class="modal-dialog" role="document" id="modal-lieux">
      <div class="modal-content" id="modal-lieux-width">
      <div class="modal-header" style="margin-bottom: 10px;">
         <h3 class="modal-title" id="exampleModalLongTitle">Gestion du plafond</h3>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="modal-body">
      <?php     
         $id_structure =  $_GET['id'];
         $reponse = $bdd->query("SELECT *
                                 FROM fondation, etat
                                 WHERE fondation.id_structure = '$id_structure'
                                 AND fondation.id_type_equipement = 2
                                 AND etat.id_etat = fondation.id_etat
                                 ORDER BY id_fondation DESC");
         $i = 0;
         $fondation = array();
         while ($donnees = $reponse->fetch()) {
            $id_etat = $donnees['id_etat'];
            $fondation[$i]['id_fondation'] = $donnees['id_fondation'];
            $fondation[$i]['etat'] = $donnees['libelle'];
            $fondation[$i]['image_structure'] = $donnees['image_structure'];
            $fondation[$i]['commentaire']= $donnees['commentaire'];
            $fondation[$i]['date'] = $donnees['date'];
            $i++;
         }
         ?>
         <ul>
            <?php
            foreach($fondation as $fondation) {
               ?>
               <li class="modal-list">
                  <img src="<?php echo($fondation['image_structure']); ?>" alt="" class="img-list">
                  <?php 
                  if (isset($fondation['id_fondation'])){
                  $url = '../scripts/edit_fondation.php?id=' . 
                        $_GET['id'] . '&link=' . $_GET['link'] . '&id_fondation=' . $fondation['id_fondation'] . '&id_type_equipement=' . 2;
                  }
                  ?>
                  <form action="<?php echo($url); ?>" method="POST" enctype="multipart/form-data">
                     <div>
                        <label for="" style="margin-bottom: 0;">Date</label><br>
                        <?php echo (date('d/m/Y', strtotime($fondation['date']))); ?><br>
                        <label for="" style="margin-top: 12px;">Etat de validité</label><br/>
                        <select name="etat" id="etat-select">
                           <?php
                           $reponse = $bdd->query("SELECT *
                                                   FROM etat");
                           while ($donnees = $reponse->fetch()) {
                              if ($fondation['etat'] == $donnees['libelle']) {
                                 ?> <option value="<?php echo($donnees['id_etat']); ?>" selected><?php echo($donnees['libelle']); ?></option> <?php
                              }
                              else {
                                 ?> <option value="<?php echo($donnees['id_etat']); ?>"><?php echo($donnees['libelle']); ?></option> <?php
                              }
                           }
                           ?>
                        
                        </select> <br/>
                        <label for="" style="margin-top: 15px;">Commentaire</label><br/>
                        <textarea name="commentaire" rows="3" cols="33"><?php echo$fondation['commentaire'];?></textarea>
                     </div>
                     <div>
                        <label for="">Modifier l'image</label>
                        <input type="file"  name="new_image" class="file-modal">
                        <div>
                           <?php
                           if (isset($fondation['id_fondation'])){
                           $url = '../scripts/delete_fondation.php?id=' . 
                                 $_GET['id'] . '&link=' . $_GET['link'] . '&id_fondation=' . $fondation['id_fondation'];}
                           ?>
                           <input type="submit" value="Confirmer la modification"  class="modal-submit" id="lieu_submit"> <br/>
                           <div class="delete-lieu"><a href="<?php echo($url); ?>" >Supprimer</a></div>
                        </div>
                     </div>
                  </form>
               </li>
               <hr style="margin: 20px 0 20px 0;">
               <?
            }
            ?>
            <li class="modal-list">
               <img src="https://numerica.rahmeh.fr/img/etat/default_plafond.jpg" alt="" class="img-list">
               <?php
               $url = '../scripts/edit_fondation.php?id=' . 
                     $_GET['id'] . '&link=' . $_GET['link'] . '&id_type_equipement' . 2;
               ?>
               <form action="<?php echo($url); ?>" method="POST" enctype="multipart/form-data">
                  <div>
                     <label for="">Etat de validité</label><br/>
                     <select name="etat" id="etat-select">
                        <?php
                        $reponse = $bdd->query("SELECT *
                                                FROM etat");
                        while ($donnees = $reponse->fetch()) {
                           ?> <option value="<?php echo($donnees['id_etat']); ?>"><?php echo($donnees['libelle']); ?></option> <?php
                        }
                        ?>
                     </select> <br/>
                     <label for="" style="margin-top: 27px;">Commentaire</label><br/>
                     <textarea name="commentaire" rows="5" cols="33"></textarea>
                  </div>
                  <div>
                     <label for="">Ajouter une image</label>
                     <input type="file"  name="new_image" class="file-modal">
                     <div>
                        <input type="submit" value="Ajouter"  class="modal-submit" id="lieu-add"> <br/>
                     </div>
                  </div>
               </form>
            </li>
         </ul>
      </div>
      </div>
   </div>
</div>