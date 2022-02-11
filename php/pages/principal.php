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
            <button class="menu_button"><img src="../../img/icon/menu_off.png" alt="" id="button_click"  onclick="hideList()"></button>
            <?php
            // Message de bienvenue vérifiant les droits administrateurs de l'utilisateur
            if ($admin == 1) {
                  ?><p id="connect_info">
                     Bonjour, vous êtes connecté au compte de : <b> <?php echo($email); ?></b> en tant qu'administrateur</br>
                  </p>
                  <?php
               }
            else {
                  ?><p id="connect_info">
                     Bonjour, vous êtes connecté au compte de : <b> <?php echo($email); ?></b></br>
                  </p>
                  <?php
               }
            ?>
            <HR ALIGN=LEFT WIDTH="99%">

            <!-- Partie de recherche de la page principal -->
            <div id="research_grid">
               <div id="research_main">

                  <!-- Logo de Numerica an niveau de la barre de recherche -->
                  <div id="banniere">
                     <img src="../../img/logo/logo_img2.png" alt="Retour à l'accueil">
                     <h3>Gestionnaire de cellules</h3>
                  </div>
                  <h4><i>RECHERCHER</i></h4>

                  <!-- Formulaire de recherche -->
                  <form action="" id="search_bar_main">
                     <input type="text" name="search" placeholder="Entrer votre recherche" class="search_bar_main" required>
                     <button type="submit" name="btnEnvoiForm" title="Search" class="search_button"><img src="../../img/icon/search.png" class="icon_search" /></button>
                  </form>

               </div>
            </div>

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