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
      <h3 style="margin-top:20px;">Suprimmer une catégorie d'équipement</h3>
      <p>Attention : Si la catégorie est supprimée tous ses types ainsi que ses équipements seront supprimé sur tous le site.</p>
      <?php 
      $url_form = '../scripts/delete_cat.php?id=' . $_GET['id'] . '&link=' .  $_GET['link'];
      ?>
      <form action="<?php echo($url_form); ?>" method="POST" enctype="multipart/form-data">
         <select name="cat" id="cat">
            <?php
             $reponse = $bdd->query("SELECT *
                                    FROM cat_equipement");
            while ($donnees = $reponse->fetch()) {
               if ($donnees['id_cat_equipement'] > 3) {
                  ?> <option value="<?php echo($donnees['id_cat_equipement']); ?>"><?php echo($donnees['libelle']); ?></option> <?php
               }
            }
            ?>
         </select>
         <input type="submit" value="Supprimer" style="margin-top: 5px;">
      </form>
   </div>
</main>
<?php
include('header/footer.php');
?>