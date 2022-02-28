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
      <h3 style="margin-top:20px;">Supprimer un type de cellule</h3>
      <?php 
      $url_form = '../scripts/delete_type_cell.php?id=' . $_GET['id'] . '&link=' .  $_GET['link'];
      ?>
      <form action="<?php echo($url_form); ?>" method="POST">
         <label>Type</label><br />
         <select name="type" id="type" style="width: 300px;">
            <?php
            $reponse = $bdd->query("SELECT *
                                    FROM cat_cellule");
            while ($donnees = $reponse->fetch()) {
               ?>
               <optgroup label="<?php echo($donnees['libelle']); ?>">
               <?php
                  $id_cat_cellule = $donnees['id_cat_cellule'];
                  $reponse2 = $bdd->query("SELECT *
                                          FROM type_cellule
                                          WHERE id_cat_cellule = " . $id_cat_cellule . " 
                                          ORDER BY libelle ASC");
                  while ($donnees = $reponse2->fetch()) {
                     if ($donnees['id_type_cellule'] != 12) {
                        ?>
                        <option value="<?php echo($donnees['id_type_cellule']); ?>"><?php echo($donnees['libelle']); ?></option>
                        <?php
                     }
                  }
               ?>
               </optgroup>
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