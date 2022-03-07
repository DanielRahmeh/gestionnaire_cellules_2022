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
      <a href="<?php echo($url); ?>" > < retour </a>
      <?php
      $id_cat_equipement = $_GET['id_cat_equipement'];
      $reponse = $bdd->query("SELECT * FROM cat_equipement WHERE id_cat_equipement = '$id_cat_equipement '");
      while ($donnees = $reponse->fetch()) {
         $libelle_cat = $donnees['libelle'];
      }
      ?>
      <h3 style="margin:40px 0px 20px 0px;">Ajouter un nouveau type à la catégorie "<?php echo($libelle_cat); ?>"</h3>
      <?php
      $url = "../scripts/add_type.php?id=" . $_GET['id'] . "&link=" .  $_GET['link'] . "&id_cat_equipement=" . $id_cat_equipement;
      ?>
      <form action="<?php echo($url) ?>" method="POST">
         <input type="text" name="libelle">
         <input type="submit" value="Ajouter">
      </form>
      <h3 style="margin:60px 0 15px 0;">Modifier un type à la catégorie "<?php echo($libelle_cat); ?>"</h3>
      <?php 
      $url_form = '../scripts/edit_type.php?id=' . $_GET['id'] . '&link=' .  $_GET['link'] . "&id_cat_equipement=" . $id_cat_equipement;
      ?>
      <form action="<?php echo($url_form); ?>" method="POST" enctype="multipart/form-data">
         <label for="">Sélectionnez un type à modifier</label><br>
         <select name="type" id="type" style="margin-bottom:20px;" >
            <?php
            $reponse = $bdd->query("SELECT * 
                                    FROM type_equipement 
                                    WHERE id_cat_equipement = '$id_cat_equipement'");
            while ($donnees = $reponse->fetch()) {
               ?> <option value="<?php echo($donnees['id_type_equipement']); ?>"><?php echo($donnees['libelle']); ?></option> <?php
            }  
            ?>
         </select> <br>
         <label for="">Nom du type</label><br>
         <input type="text" name="libelle" style="margin-bottom:20px;">
         <input type="submit" value="Modifier" style="margin-top: 5px;">
      </form>
      <?php
      $url = "../scripts/delete_type.php?id=" . $_GET['id'] . "&link=" .  $_GET['link'] . "&id_cat_equipement=" . $id_cat_equipement;
      ?>
      <h3 style="margin-top:40px;">Supprimer un type de la catégorie "<?php echo($libelle_cat); ?>"</h3>
      <p>Attention : Si le type est supprimé tous  ses équipements seront supprimé sur tous le site.</p>
      <form action="<?php echo($url) ?>" method="POST">
         <select name="type" id="">
         <?php
         $reponse = $bdd->query("SELECT * 
                                 FROM type_equipement 
                                 WHERE id_cat_equipement = '$id_cat_equipement'");
         while ($donnees = $reponse->fetch()) {
            ?> <option value="<?php echo($donnees['id_type_equipement']); ?>"><?php echo($donnees['libelle']); ?></option> <?php
         }
         ?>
         </select> <br>
         <input type="submit" value="Supprimer" style="margin-top: 20px;">
      </form>
   </div>
</main>
<?php
include('header/footer.php');
?>