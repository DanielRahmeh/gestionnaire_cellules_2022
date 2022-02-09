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
      public $link_structure;
      public $nom_structure;
      public $adresse_structure;
      public $coordonnees_structure;
      public $image_structure;
      public $path;
      public $content = array();

      public function __construct($id_structure, $link_structure, $nom_structure, $adresse_structure, 
                                 $coordonnees_structure, $image_structure) {
         $this->id_structure = $id_structure;
         $this->link_structure = $link_structure;
         $this->nom_structure = $nom_structure;
         $this->adresse_structure = $adresse_structure;
         $this->id_struccoordonnees_structureture = $coordonnees_structure;
         $this->image_structure = $image_structure;
      }
   }

   $i = 0;
   $array_structure = array();
   $reponse = $bdd->query("SELECT * FROM structure, lieu
                           WHERE structure.id_structure = lieu.id_structure");
   while ($donnees = $reponse->fetch()) {
      $my_structure = new Structure($donnees['id_structure'],
                                    $i,
                                    $donnees['nom_structure'],
                                    $donnees['adresse_structure'],
                                    $donnees['coordonnees_structure'],
                                    $donnees['image_structure']);
      array_push($array_structure, $my_structure);
   }
   foreach ($array_structure as $lieu) {
      $lieu->link_structure = $i;
      $lieu->path = $i;
      $i++;
      $reponse = $bdd->query("SELECT * FROM structure, batiment
                              WHERE structure.id_structure = batiment.id_structure
                              AND batiment.id_lieu = " . $lieu->id_structure);
      while ($donnees = $reponse->fetch()) {
         $my_structure = new Structure($donnees['id_structure'],
                                       $i,
                                       $donnees['nom_structure'],
                                       $donnees['adresse_structure'],
                                       $donnees['coordonnees_structure'],
                                       $donnees['image_structure']);
         array_push($lieu->content, $my_structure);
      }
      foreach ($lieu->content as $batiment) {
         $batiment->link_structure = $i;
         $batiment->path = $lieu->path . '/' . $i;
         $i++;
         $reponse = $bdd->query("SELECT * FROM structure, etage
                                 WHERE structure.id_structure = etage.id_structure
                                 AND etage.id_batiment = " . $batiment->id_structure);
         while ($donnees = $reponse->fetch()) {
            $my_structure = new Structure($donnees['id_structure'],
                                          $i,
                                          $donnees['nom_structure'],
                                          $donnees['adresse_structure'],
                                          $donnees['coordonnees_structure'],
                                          $donnees['image_structure']);
            array_push($batiment->content, $my_structure);
         }
         foreach ($batiment->content as $etage) {
            $etage->link_structure = $i;
            $etage->path = $batiment->path . '/' . $i;
            $reponse = $bdd->query("SELECT * FROM structure, cellule
                                    WHERE structure.id_structure = cellule.id_structure
                                    AND cellule.id_etage = " . $etage->id_structure);
            $i++;
            while ($donnees = $reponse->fetch()) {
               $my_structure = new Structure($donnees['id_structure'],
                                             $i,
                                             $donnees['nom_structure'],
                                             $donnees['adresse_structure'],
                                             $donnees['coordonnees_structure'],
                                             $donnees['image_structure']);
               array_push($etage->content, $my_structure);
            }
            foreach ($etage->content as $cellule) {
               $cellule->link_structure = $i;
               $cellule->path = $etage->path . '/' . $i;
               $i++;
            }
         }
      }
   }


   function find_path ($array_structure, $link) {
      $i = 0;
      foreach ($array_structure as $lieu) {
         if ($link == $lieu->link_structure)
            $finded_path = $lieu->path;
         $i++;
         foreach ($lieu->content as $batiment) {
            if ($link == $batiment->link_structure)
               $finded_path = $batiment->path;
            $i++;
            foreach ($batiment->content as $etage) {
               if ($link == $etage->link_structure)
                  $finded_path = $etage->path;
               $i++;
               foreach ($etage->content as $cellule) {
                  if ($link == $cellule->link_structure)
                     $finded_path = $cellule->path;
                  $i++;
               }
            }
         }
      }
      return($finded_path);
   }