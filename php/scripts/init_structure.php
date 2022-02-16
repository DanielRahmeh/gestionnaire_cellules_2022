<?php
// Fichier permettant de gérer le niveau structurel et ainsi de gérer la liste déroulante

// Appel du fichier permettant de se connecter à la bdd
require ('connect_to_db.php');
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

// Classe initiant une structure (lieu, batiment, etage, cellule)
class Structure {
   public $id_structure;
   public $link_structure;
   public $rang_structure;
   public $nom_structure;
   public $adresse_structure;
   public $coordonnees_structure;
   public $surface_structure;
   public $image_structure;
   public $path;
   public $content = array(); // tableau represantant les sous-structures

   public function __construct($id_structure, $link_structure, $rang_structure, $nom_structure, $adresse_structure, 
                              $coordonnees_structure, $surface_structure, $image_structure) {
      $this->id_structure = $id_structure;
      $this->link_structure = $link_structure;
      $this->rang_structure = $rang_structure;
      $this->nom_structure = $nom_structure;
      $this->adresse_structure = $adresse_structure;
      $this->id_struccoordonnees_structureture = $coordonnees_structure;
      $this->id_struccoordonnees_structureture = $surface_structure;
      $this->image_structure = $image_structure;
   }
}

$i = 0;

// initialisation du tableau d'objet
$array_structure = array();
// Requete pour récupérer les lieux
$reponse = $bdd->query("SELECT * FROM structure, lieu
                        WHERE structure.id_structure = lieu.id_structure");
while ($donnees = $reponse->fetch()) {
   $my_structure = new Structure($donnees['id_structure'],
                                 $i,
                                 'lieu',
                                 $donnees['nom_structure'],
                                 $donnees['adresse_structure'],
                                 $donnees['coordonnees_structure'],
                                 $donnees['surface_structure'],
                                 $donnees['image_structure']);
   array_push($array_structure, $my_structure);
}
foreach ($array_structure as $lieu) {
   $lieu->link_structure = $i;
   $lieu->path = $i;
   $i++;
   // Requete pour récupérer les batiments
   $reponse = $bdd->query("SELECT * FROM structure, batiment
                           WHERE structure.id_structure = batiment.id_structure
                           AND batiment.id_lieu = " . $lieu->id_structure);
   while ($donnees = $reponse->fetch()) {
      $my_structure = new Structure($donnees['id_structure'],
                                    $i,
                                    'batiment',
                                    $donnees['nom_structure'],
                                    $donnees['adresse_structure'],
                                    $donnees['coordonnees_structure'],
                                    $donnees['surface_structure'],
                                    $donnees['image_structure']);
      array_push($lieu->content, $my_structure);
   }
   foreach ($lieu->content as $batiment) {
      $batiment->link_structure = $i;
      $batiment->path = $lieu->path . '/' . $i;
      $i++;
      // Requete pour récupérer les étages
      $reponse = $bdd->query("SELECT * FROM structure, etage
                              WHERE structure.id_structure = etage.id_structure
                              AND etage.id_batiment = " . $batiment->id_structure);
      while ($donnees = $reponse->fetch()) {
         $my_structure = new Structure($donnees['id_structure'],
                                       $i,
                                       'etage',
                                       $donnees['nom_structure'],
                                       $donnees['adresse_structure'],
                                       $donnees['coordonnees_structure'],
                                       $donnees['surface_structure'],
                                       $donnees['image_structure']);
         array_push($batiment->content, $my_structure);
      }
      foreach ($batiment->content as $etage) {
         $etage->link_structure = $i;
         $etage->path = $batiment->path . '/' . $i;
         // Requete pour récupérer les cellules
         $reponse = $bdd->query("SELECT * FROM structure, cellule
                                 WHERE structure.id_structure = cellule.id_structure
                                 AND cellule.id_etage = " . $etage->id_structure);
         $i++;
         while ($donnees = $reponse->fetch()) {
            $my_structure = new Structure($donnees['id_structure'],
                                          $i,
                                          'cellule',
                                          $donnees['nom_structure'],
                                          $donnees['adresse_structure'],
                                          $donnees['coordonnees_structure'],
                                          $donnees['surface_structure'],
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


function find_path($array_structure, $link) {

   foreach ($array_structure as $lieu) {
      if ($link == $lieu->link_structure)
         $finded_path = $lieu->path;
      foreach ($lieu->content as $batiment) {
         if ($link == $batiment->link_structure)
            $finded_path = $batiment->path;
         foreach ($batiment->content as $etage) {
            if ($link == $etage->link_structure)
               $finded_path = $etage->path;
            foreach ($etage->content as $cellule) {
               if ($link == $cellule->link_structure)
                  $finded_path = $cellule->path;
            }
         }
      }
   }
   return($finded_path);
}

function get_level($i) {

   if ($i == 0)
      $level = 'lieu';
   if ($i == 1)
      $level = 'batiment';
   if ($i == 2)
      $level = 'etage';
   if ($i == 3)
      $level = 'cellule';
   return($level);
}

function find_name_path($array_structure, $finded_path){

   $finded_name_path = array('level' => array(), 'name' => array(), 'id' => array(), 'link' => array());
   $tab_path = explode('/', $finded_path);
   for ($i = 0; $i < count($tab_path); $i++) {
      foreach ($array_structure as $lieu) {
         if ($tab_path[$i] == $lieu->link_structure) {
            array_push($finded_name_path['level'], get_level($i));
            array_push($finded_name_path['name'], $lieu->nom_structure);
            array_push($finded_name_path['id'], $lieu->id_structure);
            array_push($finded_name_path['link'], $lieu->link_structure);
         }
         foreach ($lieu->content as $batiment) {
            if ($tab_path[$i] == $batiment->link_structure) {
               array_push($finded_name_path['level'], get_level($i));
               array_push($finded_name_path['name'], $batiment->nom_structure);
               array_push($finded_name_path['id'], $batiment->id_structure);
               array_push($finded_name_path['link'], $batiment->link_structure);
            }
            foreach ($batiment->content as $etage) {
               if ($tab_path[$i] == $etage->link_structure) {
                  array_push($finded_name_path['level'], get_level($i));
                  array_push($finded_name_path['name'], $etage->nom_structure);
                  array_push($finded_name_path['id'], $etage->id_structure);
                  array_push($finded_name_path['link'], $etage->link_structure);
               }
               foreach ($etage->content as $cellule) {
                  if ($tab_path[$i] == $cellule->link_structure) {
                     array_push($finded_name_path['level'], get_level($i));
                     array_push($finded_name_path['name'], $cellule->nom_structure);
                     array_push($finded_name_path['id'], $cellule->id_structure);
                     array_push($finded_name_path['link'], $cellule->link_structure);
                  }
               }
            }
         }
      }
   }
   return ($finded_name_path);
}