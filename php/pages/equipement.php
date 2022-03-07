<?php
// Récuperation des élement de la session de l'utilisateur
session_start();

// Vérification si l'utilisateur est bien connécté
if($_SESSION['email'] != "") {
   $email = $_SESSION['email'];
   $admin = $_SESSION['admin'];
}
// Affichage du header de la page
include('header/header.php');
?>
<main id="main_principal">

   <div class="slide_bar">
      <!-- Appel du fichier permettant d'afficher la liste déroulante de navigation -->
      <?php require('list.php');?>
   </div>

   <div class="main_display">
      <?php 
      $url = 'cellule.php?id=' . $_GET['id'] . '&link=' .  $_GET['link'];
      
     
      ?>
      <a href="<?php echo($url); ?>"> < retour </a>
      <?php
      if (isset($_GET['id_equipement'])) {
         ?> <h3 style="margin:20px 0 20px 0;">Modifier l'équipement</h3> <?php
         $url_form1 = '../scripts/edit_equipement.php?id=' . $_GET['id'] . '&link=' . $_GET['link'] . '&id_equipement=' . $_GET['id_equipement'] . '&id_cat_equipement=' . $_GET['id_cat_equipement'];
         $id_equipement = $_GET['id_equipement'];
         $reponse = $bdd->query("SELECT equipement.id_equipement, 
                                 equipement.id_structure,
                                 equipement.nom_equipement,
                                 equipement.code_equipement,
                                 equipement.serial_equipement,
                                 equipement.prix_equipement,
                                 equipement.date_achat,
                                 equipement.date_fin,
                                 equipement.date_maintenance,
                                 equipement.commentaire,
                                 equipement.image, 
                                 equipement.id_type_equipement,
                                 equipement.id_etat,
                                 type_equipement.libelle AS type_libelle,
                                 etat.libelle AS etat_libelle
                                 FROM equipement, type_equipement, etat
                                 WHERE equipement.id_equipement = '$id_equipement'
                                 AND equipement.id_etat = etat.id_etat
                                 AND equipement.id_type_equipement = type_equipement.id_type_equipement");
         ?><form action="<?php echo($url_form1); ?>" method="POST" enctype="multipart/form-data"><?php
            while ($donnees = $reponse->fetch()) {
               $id_equipement = $donnees['id_equipement'];
               $id_structure = $_GET['id'];
               $nom_equipement = $donnees['nom_equipement'];
               $code_equipement = $donnees['code_equipement'];
               $serial_equipement = $donnees['serial_equipement'];
               $prix_equipement = $donnees['prix_equipement'];
               $date_achat = $donnees['date_achat'];
               $date_fin = $donnees['date_fin'];
               $date_maintenance = $donnees['date_maintenance'];
               $commentaire = $donnees['commentaire'];
               $image = $donnees['image'];
               $id_type = $donnees['id_type_equipement'];
               $type_libelle = $donnees['type_libelle'];
               $id_etat = $donnees['id_etat'];
               $etat_libelle = $donnees['etat_libelle'];
               $id_cat_equipement = $_GET['id_cat_equipement'];
               ?>
               <div data-toggle="modal" data-target="#big-picture"><img class="fit-picture" src="<?php echo($image); ?>" alt="" style="width: 200px;"></div>
               <?php
               include ('modal/modal_img_equipement.php');
               ?>
               <input type="file" name="image" style="margin-bottom: 20px;">
               <label for="">Nom de l'equipement</label><br>
               <input type="text" name="nom_equipement" value="<?php echo($nom_equipement); ?>" style="margin-bottom: 20px;"><br>
               <label for="">Type de l'equipement</label><br>
               <select name="type" id="type" style="margin-bottom: 20px;">
                  <?php
                  $reponse = $bdd->query("SELECT *
                                          FROM type_equipement
                                          WHERE id_cat_equipement = '$id_cat_equipement'");
                  while ($donnees = $reponse->fetch()) {
                     if ($donnees['id_type_equipement'] == $id_type) {
                        ?> <option value="<?php echo($id_type); ?>" selected><?php echo($type_libelle); ?></option> <?php
                     }
                     else {
                        ?> <option value="<?php echo($donnees['id_type']); ?>"><?php echo($donnees['libelle']); ?></option> <?php
                     }
                  }
                  ?>
               </select><br>
               <label for="">Etat de validité</label><br>
               <select name="etat" id="etat" style="margin-bottom: 20px;">
                  <?php
                     $reponse = $bdd->query("SELECT *
                                             FROM etat");
                     while ($donnees = $reponse->fetch()) {
                        if ($donnees['id_etat'] == $id_etat) {
                           ?> <option value="<?php echo($id_etat); ?>" selected><?php echo($etat_libelle); ?></option> <?php
                        }
                        else {
                           ?> <option value="<?php echo($donnees['id_etat']); ?>"><?php echo($donnees['libelle']); ?></option> <?php
                        }
                     }
                  ?>
               </select><br>
               <label for="">Code</label><br>
               <input type="text" name="code_equipement" value="<?php echo($code_equipement); ?>" style="margin-bottom: 20px;"><br>
               <label for="">Numero de série</label><br>
               <input type="text" name="serial_equipement" value="<?php echo($serial_equipement); ?>" style="margin-bottom: 20px;"><br>
               <label for="">Prix</label><br>
               <input type="number" step="0.01" name="prix_equipement" value="<?php echo($prix_equipement); ?>" style="margin-bottom: 20px;"><br>
               <label for="">Date d'achat</label><br>
               <input type="date" name="date_achat" value="<?php echo($date_achat) ?>" id="" style="margin-bottom: 20px;"><br>
               <label for="">Date de maintenance</label><br>
               <input type="date" name="date_maintenance" value="<?php echo($date_maintenance) ?>" id="" style="margin-bottom: 20px;"><br>
               <label for="">Date d'achat</label><br>
               <input type="date" name="date_fin" value="<?php echo($date_fin) ?>" id="" style="margin-bottom: 20px;"><br>
               <label for="">Commentaire</label><br>
               <textarea name="commentaire" id="commentaire" cols="30" rows="5"  style="margin-bottom: 20px;"><?php echo($commentaire); ?></textarea><br>
               <input type="submit" value="Modifier" style="margin-bottom: 50px;">
               <?php
            }
         ?></form><?php
      }
      else {
         $url_form2 = '../scripts/edit_equipement.php?id=' . $_GET['id'] . '&link=' . $_GET['link'] . '&id_cat_equipement=' . $_GET['id_cat_equipement'];
         $id_cat_equipement = $_GET['id_cat_equipement'];
         ?> <h3 style="margin:20px 0 20px 0;">Créer un équipement</h3> <?php
         ?><form action="<?php echo($url_form2); ?>" method="POST" enctype="multipart/form-data">
         <label for="">Image de l'equipement</label><br>
         <input type="file" name="image" style="margin-bottom: 20px;">
         <label for="">Nom de l'equipement</label><br>
         <input type="text" name="nom_equipement" style="margin-bottom: 20px;"><br>
         <label for="">Type de l'equipement</label><br>
         <select name="type" id="type" style="margin-bottom: 20px;">
            <?php
            $reponse = $bdd->query("SELECT *
                                    FROM type_equipement
                                    WHERE id_cat_equipement = '$id_cat_equipement'");
            while ($donnees = $reponse->fetch()) {
                     ?> <option value="<?php echo($donnees['id_type_equipement']); ?>"><?php echo($donnees['libelle']); ?></option> <?php
            }
            ?>
         </select><br>
         <label for="">Etat de validité</label><br>
         <select name="etat" id="etat" style="margin-bottom: 20px;">
            <?php
            $reponse = $bdd->query("SELECT *
                                    FROM etat");
            while ($donnees = $reponse->fetch()) {
               ?> <option value="<?php echo($donnees['id_etat']); ?>"><?php echo($donnees['libelle']); ?></option> <?php
            }
            ?>
         </select><br>
         <label for="">Code</label><br>
         <input type="text" name="code_equipement" style="margin-bottom: 20px;"><br>
         <label for="">Numero de série</label><br>
         <input type="text" name="serial_equipement" style="margin-bottom: 20px;"><br>
         <label for="">Prix</label><br>
         <input type="number" step="0.01" name="prix_equipement" style="margin-bottom: 20px;"><br>
         <label for="">Date d'achat</label><br>
         <input type="date" name="date_achat" id="" style="margin-bottom: 20px;"><br>
         <label for="">Date de maintenance</label><br>
         <input type="date" name="date_maintenance" id="" style="margin-bottom: 20px;"><br>
         <label for="">Date d'achat</label><br>
         <input type="date" name="date_fin" id="" style="margin-bottom: 20px;"><br>
         <label for="">Commentaire</label><br>
         <textarea name="commentaire" id="commentaire" cols="30" rows="5"  style="margin-bottom: 20px;"></textarea><br>
         <input type="submit" value="Ajouter" style="margin-bottom: 50px;">
         </form><?php
      }
      ?>
      <?php 
      $url_form = '../scripts/delete_cat.php?id=' . $_GET['id'] . '&link=' .  $_GET['link'];
      ?>

   </div>
</main>
<?php
include('header/footer.php');
?>