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
      <h3 style="margin-top:20px;">Supprimer un organisme</h3>
      <p>Attiention : Supprimer un organisme engendra la supression de tous les locations liés à cette organimse</p>
      <?php 
      $url_form = '../scripts/delete_organisme.php?id=' . $_GET['id'] . '&link=' .  $_GET['link'];
      ?>
      <form action="<?php echo($url_form); ?>" method="POST">
         <label>Organisme</label><br />
         <select name="organisme" id="cat">
            <?php
            $reponse = $bdd->query("SELECT *
                                    FROM organisme");
            while ($donnees = $reponse->fetch()) {
                  ?>
                  <option value="<?php echo($donnees['id_organisme']); ?>"><?php echo($donnees['nom_organisme']); ?></option>
                  <?php
            }
            ?>
         </select>
         <input type="submit" value="Supprimer">
      </form>
   </div>
</main>
<?php
include('header/footer.php');
?>