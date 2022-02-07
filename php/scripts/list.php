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
      public $nom_structure;
      public $adresse_structure;
      public $coordonnees_structure;
      public $image_structure;
      public $content = array();

      public function __construct($id_structure, $nom_structure, $adresse_structure, $coordonnees_structure, $image_structure) {
         $this->id_structure = $id_structure;
         $this->nom_structure = $nom_structure;
         $this->adresse_structure = $adresse_structure;
         $this->id_struccoordonnees_structureture = $coordonnees_structure;
         $this->image_structure = $image_structure;
      }
   }

   $array_structure = array();
   $reponse = $bdd->query("SELECT * FROM structure, lieu
                           WHERE structure.id_structure = lieu.id_structure");
   while ($donnees = $reponse->fetch()) {
      $my_structure = new Structure($donnees['id_structure'],
                                    $donnees['nom_structure'],
                                    $donnees['adresse_structure'],
                                    $donnees['coordonnees_structure'],
                                    $donnees['image_structure']);
      array_push($array_structure, $my_structure);
   }
   
   ?>
   <ul>
      <?php
         foreach ($array_structure as $lieu) {
            ?> <li>
                  <img src="../../img/icon/right_white.png" alt="">
                  <a href=""><?php echo($lieu->nom_structure); ?></a>
               </li> <?php
            $reponse = $bdd->query("SELECT * FROM structure, batiment
                                    WHERE structure.id_structure = batiment.id_structure
                                    AND batiment.id_lieu = " . $lieu->id_structure);
            ?> 
            <ul>
               <?php
                  while ($donnees = $reponse->fetch()) {
                     $my_structure = new Structure($donnees['id_structure'],
                                                   $donnees['nom_structure'],
                                                   $donnees['adresse_structure'],
                                                   $donnees['coordonnees_structure'],
                                                   $donnees['image_structure']);
                     array_push($lieu->content, $my_structure);
                  }
                  foreach ($lieu->content as $batiment) {
                     ?> <li>
                           <img src="../../img/icon/right_white.png" alt="">
                           <a href=""><?php echo($batiment->nom_structure); ?></a>
                        </li> <?php
                     $reponse = $bdd->query("SELECT * FROM structure, etage
                                             WHERE structure.id_structure = etage.id_structure
                                             AND etage.id_batiment = " . $batiment->id_structure);
                     ?>
                     <ul>
                        <?php
                           while ($donnees = $reponse->fetch()) {
                              $my_structure = new Structure($donnees['id_structure'],
                                                            $donnees['nom_structure'],
                                                            $donnees['adresse_structure'],
                                                            $donnees['coordonnees_structure'],
                                                            $donnees['image_structure']);
                              array_push($batiment->content, $my_structure);
                           }
                           foreach ($batiment->content as $etage) {
                              ?> <li>
                                    <img src="../../img/icon/right_white.png" alt="">
                                    <a href=""><?php echo($etage->nom_structure); ?></a>
                                 </li> <?php
                              $reponse = $bdd->query("SELECT * FROM structure, cellule
                                                      WHERE structure.id_structure = cellule.id_structure
                                                      AND cellule.id_etage = " . $etage->id_structure);
                              ?>
                              <ul>
                                 <?php
                                    while ($donnees = $reponse->fetch()) {
                                       $my_structure = new Structure($donnees['id_structure'],
                                                                     $donnees['nom_structure'],
                                                                     $donnees['adresse_structure'],
                                                                     $donnees['coordonnees_structure'],
                                                                     $donnees['image_structure']);
                                       array_push($etage->content, $my_structure);
                                    }
                                    foreach ($etage->content as $cellule) {
                                       ?> <li>
                                             <img src="../../img/icon/right_white.png" alt="">
                                             <a href=""><?php echo($cellule->nom_structure); ?></a>
                                          </li> <?php
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
   <?php
   // print_r($array_structure);
?>