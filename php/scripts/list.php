<?php
   // Appel du fichier permettant de se connecter à la bdd
   require ('connect_to_db.php');
   $db = new Database();
   $bdd = $db->getConnection();
   if (!$bdd) {
      die("Error connecting to the database");
   }

   class Structure {
      public $id_structure;
      public $rang_structure;
      public $nom_structure;
      public $adresse_structure;
      public $coordonnees_structure;
      public $image_structure;
      public $content = array();

      public function __construct($id_structure, $rang_structure, $nom_structure, $adresse_structure, $coordonnees_structure, $image_structure) {
         $this->id_structure = $id_structure;
         $this->rang_structure = $rang_structure;
         $this->nom_structure = $nom_structure;
         $this->adresse_structure = $adresse_structure;
         $this->id_struccoordonnees_structureture = $coordonnees_structure;
         $this->image_structure = $image_structure;
      }
   }

   function get_link($url, $structure, $i) {
      ?><img src="../../img/icon/right_white.png" alt=""
         onclick="dispList('<?php echo($structure->rang_structure);?>', '<?php echo($i);?>')">
      <?php $link = $url . $structure->id_structure; ?>
      <a href="<?php echo($link); ?>"><?php echo($structure->nom_structure); ?></a>
      <!-- Appel du fichier js regroupant tous les script liés à la page setting_admin.php -->
      <script src="../../js/list.js"></script>
      <?php
   }

   $i=0;
   $id = 'structure' . $i;
   $array_structure = array();
   $reponse = $bdd->query("SELECT * FROM structure, lieu
                           WHERE structure.id_structure = lieu.id_structure");
   while ($donnees = $reponse->fetch()) {
      $my_structure = new Structure($donnees['id_structure'],
                                    'lieu',
                                    $donnees['nom_structure'],
                                    $donnees['adresse_structure'],
                                    $donnees['coordonnees_structure'],
                                    $donnees['image_structure']);
      array_push($array_structure, $my_structure);
   }
   ?>
   <ul id="lieu">
      <?php
         foreach ($array_structure as $lieu) {
            ?> <li><?php get_link('../pages/lieu.php?id=', $lieu, $i); ?></li> <?php
            $reponse = $bdd->query("SELECT * FROM structure, batiment
                                    WHERE structure.id_structure = batiment.id_structure
                                    AND batiment.id_lieu = " . $lieu->id_structure);
            $id = 'structure' . $i;
            $i++;
            ?> 
            <ul id="<?php echo($id); ?>">
               <?php
                  while ($donnees = $reponse->fetch()) {
                     $my_structure = new Structure($donnees['id_structure'],
                                                   $id,
                                                   $donnees['nom_structure'],
                                                   $donnees['adresse_structure'],
                                                   $donnees['coordonnees_structure'],
                                                   $donnees['image_structure']);
                     array_push($lieu->content, $my_structure);
                     array_push($array_structure, $my_structure);
                  }
                  foreach ($lieu->content as $batiment) {
                     ?> <li><?php get_link('../pages/batiment.php?id=', $batiment, $i); ?></li> <?php
                     $reponse = $bdd->query("SELECT * FROM structure, etage
                                             WHERE structure.id_structure = etage.id_structure
                                             AND etage.id_batiment = " . $batiment->id_structure);
                     $id = 'structure' . $i;
                     $i++;
                     ?> 
                     <ul id="<?php echo($id); ?>">
                        <?php
                           while ($donnees = $reponse->fetch()) {
                              $my_structure = new Structure($donnees['id_structure'],
                                                            $id,
                                                            $donnees['nom_structure'],
                                                            $donnees['adresse_structure'],
                                                            $donnees['coordonnees_structure'],
                                                            $donnees['image_structure']);
                              array_push($batiment->content, $my_structure);
                              array_push($array_structure, $my_structure);
                           }
                           foreach ($batiment->content as $etage) {
                              ?> <li><?php get_link('../pages/etage.php?id=', $etage, $i); ?></li> <?php
                              $reponse = $bdd->query("SELECT * FROM structure, cellule
                                                      WHERE structure.id_structure = cellule.id_structure
                                                      AND cellule.id_etage = " . $etage->id_structure);
                              $id = 'structure' . $i;
                              $i++;
                              ?> 
                              <ul id="<?php echo($id); ?>">
                                 <?php
                                    while ($donnees = $reponse->fetch()) {
                                       $my_structure = new Structure($donnees['id_structure'],
                                                                     "",
                                                                     $donnees['nom_structure'],
                                                                     $donnees['adresse_structure'],
                                                                     $donnees['coordonnees_structure'],
                                                                     $donnees['image_structure']);
                                       array_push($etage->content, $my_structure);
                                       array_push($array_structure, $my_structure);
                                    }
                                    foreach ($etage->content as $cellule) {
                                       ?> <li><?php get_link('../pages/cellule.php?id=', $cellule, $i); ?></li> <?php
                                    }
                                 ?>
                              </ul>
                              <?php
                           }
                        ?>
                     </ul>
                     <?php
                  }
               ?>
            </ul>
            <?php
         }
      ?>
   </ul>