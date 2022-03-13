<?php
// Page html qui affiche un lieu


// Récuperation des élement de la session de l'utilisateur
session_start();

// Vérification si l'utilisateur est bien connécté
if($_SESSION['email'] != "") {
   $email = $_SESSION['email'];
   $admin = $_SESSION['admin'];

   // Affichage du header de la page
   include('header/header.php');

   // Appel du fichier permettant d'initialiser la structure séléctionnée
   include('../scripts/get_structure.php');

   // Appel du fichier permettant d'établir la structure des cellules composants la structure affichée
   include('../scripts/find_cell.php');

   // Initialisation du tableau composant les cellules de la structure affichée
   $array_cel = find_cell($array_structure, $_GET['id'], $bdd);
   ?>

   <main id="main_principal">

      <div class="slide_bar">
         <!-- Appel du fichier permettant d'afficher la liste déroulante de navigation -->
         <?php require('list.php');?>
      </div>

      <!-- Partie principal au centre de la page -->
      <div class="main_display">
         <div class="head_structure">

            <!-- Boutton pour afficher la liste de navigation -->
            <button class="menu_button" id="button_click" onclick="hideList()">
               <img src="../../img/icon/menu_off.png" alt="" id="img_click">
            </button>

            <!-- Appel du fichier permettant d'afficher les chemin pour arriver à la strcuture affichée -->
            <?php require('structure_path.php');?>

         </div>

         <div class="structure_container">

            <!-- Affichage du nom de la structure -->
            <div class="title-structure">
               <h1 id="title-text"><b> <?php echo($nom_structure); ?> </b></h1>
               <?php
               $url = '../scripts/edit_structure_name.php?id=' . $_GET['id'] . '&link=' . $_GET['link'] . '&rang=lieu';
               ?>
               <form action="<?php echo($url); ?>" method="Post" id='title-form' style="margin-top: 25px;display: none;">
                  <label for="">Modifier le nom du lieu</label> <br>
                  <input type="text" name="new_title" value="<?php echo($nom_structure); ?>" style="margin-bottom: 25px;"  
                  onchange="this.form.submit()">
               </form>
               <img src="../../img/icon/modify.png.png" alt="" onclick="changeTitle('title-text', 'title-form')">
            </div>

            <section class="id_structure">
               <div class="img_section">

                  <!-- Affichage de l'image de la structure -->
                  <img src="<?php echo($image_structure); ?>" alt="" class="img_structure">

                  <!-- Affichage des différents données correspondant à la structure -->
                  <ul>
                     <li><b>Adresse</b><br/><?php echo($adresse_structure); ?> </li><hr>
                     <?php
                        $surface = 0;
                        for ($i = 0; $i < count($array_cel['surface']); $i++) {
                           $surface = $surface + $array_cel['surface'][$i];
                        }
                     ?>
                     <li><b>Surface</b><br/><?php echo($surface); ?> m²</li><hr>
                     <li><b>Nombre de cellules total</b><br/><?php echo(count($array_cel['nom'])); ?></li><hr>
                     <li class="occupe"><b>Nombre de cellules occupées</b><br/> 
                        <?php echo(count($array_cel['organisme']) - array_count_values($array_cel['organisme'])['/']); ?>
                     </li><hr>
                     <li class="libre"><b>Nombre de cellules libres</b><br/>
                        <?php echo(count($array_cel['organisme']) - (count($array_cel['organisme']) - array_count_values($array_cel['organisme'])['/'])); ?>
                     </li>
                  </ul>

               </div>

               <!-- Section où s'affiche la map via l'api Google Map -->
               <div class="map_section">
                  <h2><b>Localisation</b></h2>
                  <div id="map"></div>
               </div>
               
            </section>

            <!-- Appel des script permettant l'affichage de la map google -->
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

            <?php
            // Appel du fichier permettant d'afficher la liste filtrable des cellules
            include('disp_cell.php');
            ?>
            

         </div>
      </div>
   </main>
   <?php
   include('header/footer.php');
}
?>