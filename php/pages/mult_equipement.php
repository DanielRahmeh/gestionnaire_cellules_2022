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
      $url2 = '../scripts/add_mult_equipement.php?id=' . $_GET['id'] . '&link=' . $_GET['link'] . '&id_cat_equipement=' . $_GET['id_cat_equipement'];
      ?>
      <a href="<?php echo($url); ?>"> < retour </a>
      <h3 style="margin: 20px 0 20px 0;">Ajouter plusieurs équipements</h3>
      <form action="<?php echo($url2); ?>" method="POST">
         <label for="">Type de l'equipement</label><br>
         <select  select name="type" id="type" style="margin-bottom: 20px;">
            <?php
            $id_cat_equipement = $_GET['id_cat_equipement'];
            $reponse = $bdd->query("SELECT *
                                    FROM type_equipement
                                    WHERE id_cat_equipement = '$id_cat_equipement'");
            while ($donnees = $reponse->fetch()) {
               ?> <option value="<?php echo($donnees['id_type_equipement']); ?>"><?php echo($donnees['libelle']); ?></option> <?php
            }
            ?>
         </select><br>
         <label for="">Nombre à ajouter</label><br>
         <input type="number" name="num"><br>
         <input type="submit" value="Ajouter" style="margin-top: 20px;">
      </form>
   </div>
</main>
<?php
include('header/footer.php');
?>