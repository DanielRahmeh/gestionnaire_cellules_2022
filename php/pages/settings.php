<?php
   // Récupération des données de la session de l'utilisateur
   session_start();
   // Vérification si l'utilisateur à une section active
   if($_SESSION['email'] != "") {
      $email = $_SESSION['email'];
      $admin = $_SESSION['admin'];
   // Affichage du header de la page
   include('header/settings_header.php');
   }
   // Si l'utilisateur atterit sur la page sans session active
   else {
      header('Location: index.php');
   }
?>

<main>
   <!-- Formulaire de modifiaction de mot de passe -->
   <div class="new_user_container" style="margin-bottom: 468px;">
      <a href="principal.php"> < retour</a><br /><br />
      <h3>Modifier votre mot de passe</h3><br />
      <?php $link = "../scripts/new_password.php?email=" . $email; ?>
      <form name="new_password" method="POST" id="new_user_form" action=<?php echo($link);?>>
         <!-- Champs pour le nouveau mot de passe -->
         <div class="elem_setting">
            <label>Mot de passe</label><br />
            <input type="password"  class="settings_input" id="pass" placeholder="Entrer le mot de passe" name="pass" 
            title="mot de passe libre" required>
         </div>
         <!-- Champs pour la confirmation du mot de passe -->
         <div class="elem_setting" id="confirm_pass">
            <label>Confirmation mot de passe</label><br />
            <input type="password" class="settings_input" id="nPass" placeholder="Confirmer le mot de passe" name="nPass" 
            title="Confirmer le mot de passe" required>
         </div>
         <div class="elem_setting">
            <input type="submit" id='create' value='Modifier' title="Modifier le mot de passe">
         </div>
      </form>
      <?php
         // Récéption des massages du script PHP
         if(isset($_GET['mdp'])) {
            ?> <div class="valide">Votre mot de passe a bien été modifié</div> <?php }
      ?>
   </div>
</main>
<script src="../../js/settings_admin.js"></script>
<?php
   include('header/footer.php');
?>
</body>
</html>