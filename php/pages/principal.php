   <?php
      session_start();
      if($_SESSION['email'] != "") {
         $email = $_SESSION['email'];
         $admin = $_SESSION['admin'];
         include('header/header.php');
         ?>
         <main id="main_principal">
            <div class="slide_bar">

               <!-- Liste de test -->
               <ul>
                  <li>Numerica 1
                     <ul>
                        <li>Batiment A
                           <ul>
                              <li>Etage1
                                 <ul>
                                    <li>1.01</li>
                                    <li>1.02</li>
                                    <li>1.03</li>
                                    <li>1.04</li>
                                    <li>1.05</li>
                                 </ul>
                              </li>
                              <li>Etage2</li>
                           </ul>
                        </li>
                     </ul>
                  </li>
                  <li>Numerica 2
                     <ul>
                        <li>Etage1</li>
                        <li>Etage2</li>
                     </ul>
                  </li>
                  <li>Numerica 3
                     <ul>
                        <li>Etage1</li>
                        <li>Etage2</li>
                     </ul>
                  </li>
               </ul>
               <!-- Liste de test -->

            </div>
            <div class="main_display">
               <?php
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
               <div id="research_grid">
                  <div id="research_main">
                     <div id="banniere">
                        <img src="../../img/logo/logo_img2.png" alt="Retour à l'accueil">
                        <h3>Gestionnaire de cellules</h3>
                     </div>
                     <h4><i>RECHERCHER</i></h4>
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
      else {
            header('Location: login.php');
      }
    ?>
</body>
</html>