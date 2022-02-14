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
            <div class="slide_bar">

               <!-- Liste de test -->
               <?php require('list.php');?>
            </div>

            <!-- Partie principal au centre de la page -->
            <div class="main_display">
               <div class="head_structure">
                  <button class="menu_button"><img src="../../img/icon/menu_off.png" alt="" id="button_click"  onclick="hideList()"></button>
                  <?php require('structure_path.php');?>
               </div>
               <?php
               $reponse = $bdd->query("SELECT * FROM structure
                                       WHERE structure.id_structure = " . $_GET['id']);
               while ($donnees = $reponse->fetch()) {
                  $nom_structure = $donnees['nom_structure'];
                  $adresse_structure = $donnees['adresse_structure'];
                  $coordonnees_structure = $donnees['coordonnees_structure'];
                  $surface_structure = $donnees['surface_structure'];
                  $image_structure = $donnees['image_structure'];
               }
               ?><h1> <?php echo($nom_structure); ?> </h1>
               <section class="id_structure">
                  <div class="img_section">
                     <img src="<?php echo($image_structure); ?>" alt="" class="img_structure">
                     <ul>
                        <li><b>Adresse</b> : <?php echo($adresse_structure); ?> </li>
                        <li><b>Surface</b> : <?php echo($surface_structure); ?> m²</li>
                     </ul>
                  </div>
                  <div class="map_section">
                     <h2>Localisation</h2>
                     <div id="map"></div>
                  </div>
               
               </section>

               <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
               <script type="text/javascript">
                  tab_coor = get_coor('<?php echo($coordonnees_structure); ?>');
                  lat = parseFloat(get_lat(tab_coor));
                  long = parseFloat(get_long(tab_coor));
                  name_coor = get_name('<?php echo($nom_structure); ?>')
               </script>
               <script src="../../js/map.js"></script>
               <script
                  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0jTUhQHFFFtrzAGl688mWwQ1hnFOsPZQ&callback=initMap&libraries=&v=weekly"
                  async>
               </script>
            </div>
            
         </main>
         <?php
         include('header/footer.php');
      }
?>