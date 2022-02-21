<?php
   // Récuperation des élement de la session de l'utilisateur
   session_start();
   // Vérification si l'utilisateur est bien connécté
   if($_SESSION['email'] != "") {
      $email = $_SESSION['email'];
      $admin = $_SESSION['admin'];
      // Affichage du header de la page
      include('header/header.php');
      ?>
      <main id="main_principal">
         <!-- Partie listant les structures de Numerica à gauche de la page -->
         <div class="slide_bar">

            <!-- Liste de test -->
            <?php 
            require('list.php');
            ?>
         </div>

         <!-- Partie principal au centre de la page -->
         <div class="main_display">
            <div class="head_structure">
            <button class="menu_button" id="button_click" onclick="hideList()">
               <img src="../../img/icon/menu_off.png" alt="" id="img_click">
            </button>
            <?php
            // Message de bienvenue vérifiant les droits administrateurs de l'utilisateur
            if ($admin == 1) {
                  ?><p id="path">
                     Bonjour, vous êtes connecté au compte de : <b> <?php echo($email); ?></b> en tant qu'administrateur</br>
                  </p>
                  <?php
               }
            else {
                  ?><p id="path">
                     Bonjour, vous êtes connecté au compte de : <b> <?php echo($email); ?></b></br>
                  </p>
                  <?php
               }
            ?>
            </div>
            <HR ALIGN=LEFT WIDTH="99%">

         </div>
      </main>
      <?php
      }

// Si l'utilisateur atterit sur cette page sans session active
else {
      header('Location: ../../index.php');
}
include('header/footer.php');
?>
</body>
</html>