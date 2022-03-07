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
      <h3 style="margin-top:20px;">Ajouter une nouvelle catégorie d'équipement</h3>
      <?php 
      $url_form = '../scripts/add_cat.php?id=' . $_GET['id'] . '&link=' .  $_GET['link'];
      ?>
      <form action="<?php echo($url_form); ?>" method="POST" enctype="multipart/form-data">
         <label for="" style="margin-top: 30px;">Nom de la catégorie</label><br>
         <input type="text" name="libelle" required> <br>
         <label for="" style="margin-top: 20px;">Image de la catégorie (facultatif)</label><br>
         <input type="file" name="image"> <br>
         <input type="submit" value="Ajouter" style="margin-top: 5px;">
      </form>
   </div>
</main>
<?php
include('header/footer.php');
?>