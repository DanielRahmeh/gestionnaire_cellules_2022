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
      <h3 style="margin:20px 0 30px 0;">Modifier une catégorie d'équipement</h3>
      <?php 
      $url_form = '../scripts/edit_cat.php?id=' . $_GET['id'] . '&link=' .  $_GET['link'];
      ?>
      <form action="<?php echo($url_form); ?>" method="POST" enctype="multipart/form-data">
         <label for="">Sélectionnez la catégorie à modifier</label><br>
         <select name="cat" id="cat" style="margin-bottom:20px;" >
            <?php
             $reponse = $bdd->query("SELECT *
                                    FROM cat_equipement");
            while ($donnees = $reponse->fetch()) {
               if ($donnees['id_cat_equipement'] > 3) {
                  ?> <option value="<?php echo($donnees['id_cat_equipement']); ?>"><?php echo($donnees['libelle']); ?></option> <?php
               }
            }
            ?>
         </select> <br>
         <label for="">Nom de la catégorie</label><br>
         <input type="text" name="libelle" style="margin-bottom:20px;"><br>
         <label for="">Image de la catégorie</label><br>
         <input type="file" name="image"><br>
         <input type="submit" value="Modifier" style="margin-top: 5px;">
      </form>
   </div>
</main>
<?php
include('header/footer.php');
?>