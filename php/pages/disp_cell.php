<!-- Fichier permettant d'afficher la liste filtrable des cellules -->

<!-- Appel du fichier JS permettant de gérer les options de filtrages -->
<script src="../../js/cell.js"></script>

<?php

//  Recuperation des batiments de la structure affichée
$batiments = array_unique($array_cel['batiment']);
//  Recuperation des étages de la structure affichée
$etages = array_unique($array_cel['etage']);
?>

<div class="check_cel">
   <h2><b>Cellules louées</b></h2>

   <!-- Options de filtrages sur les batiments des cellules louées -->
   <div class="filter-cell">
      <div>
         <label for="">Batiment</label><br />
         <select id="val-batiment-loue" onchange="getVal('val-batiment-loue', 'val-etage-loue', 'cell-list-loue')">
            <option value="/">/</option>
            <option value="Tous">Tous</option>
            <?php
            foreach ($batiments as $batiment) {
               ?> <option value="<?php echo($batiment); ?>"><?php echo($batiment); ?></option> <?php
            }
            ?>
         </select>
      </div>

      <!-- Options de filtrages sur les étages des cellules louées -->
      <div>
         <label for="">Etage</label><br />
         <select id="val-etage-loue" onchange="getVal('val-batiment-loue', 'val-etage-loue', 'cell-list-loue')">
            <option value="Tous">Tous</option>
            <?php
            foreach ($etages as $etage) {
               ?> <option value="<?php echo($etage); ?>"><?php echo($etage); ?></option> <?php
            }
            ?>
         </select>
      </div>
   </div>

   <!-- Affichages de la liste -->
   <ul id='cell-list-loue'>
   <?php
      for ($i = 0; $i < count($array_cel['nom']); $i++) {
         if ($array_cel['organisme'][$i] != '/') {
            $id = $array_cel['batiment'][$i] . '/' . $array_cel['etage'][$i];
            $url = 'cellule.php?id=' . $array_cel['id'][$i] . '&link=' . $array_cel['link'][$i];
            ?> <li id="<?php echo($id); ?>">
               <div class="card">
                  <a href="<?php echo($url); ?>" class="title"><?php echo($array_cel['nom'][$i]); ?></a>
                  <a href="<?php echo($url); ?>" class="organisme"><?php echo($array_cel['organisme'][$i]); ?></a>
               </div>
            </li> <?php
         }
      }
   ?>
   </ul>
</div>

<div class="check_cel">
   <h2><b>Cellules libres</b></h2>

   <!-- Options de filtrages sur les batiments des cellules libres -->
   <div class="filter-cell">
      <div>
         <label for="">Batiment</label><br />
         <select id="val-batiment-libre" onchange="getVal('val-batiment-libre', 'val-etage-libre', 'cell-list-libre')">
            <option value="/">/</option>
            <option value="Tous">Tous</option>
            <?php
            foreach ($batiments as $batiment) {
               ?> <option value="<?php echo($batiment); ?>"><?php echo($batiment); ?></option> <?php
            }
            ?>
         </select>
      </div>

      <!-- Options de filtrages sur les étages des cellules libres -->
      <div>
         <label for="">Etage</label><br />
         <select id="val-etage-libre" onchange="getVal('val-batiment-libre', 'val-etage-libre', 'cell-list-libre')">
            <option value="Tous">Tous</option>
            <?php
            foreach ($etages as $etage) {
               ?> <option value="<?php echo($etage); ?>"><?php echo($etage); ?></option> <?php
            }
            ?>
         </select>
      </div>
   </div>

   <!-- Affichages de la liste -->
   <ul id='cell-list-libre'>
   <?php
      for ($i = 0; $i < count($array_cel['nom']); $i++) {
         if ($array_cel['organisme'][$i] == '/') {
            $id = $array_cel['batiment'][$i] . '/' . $array_cel['etage'][$i];
            $url = 'cellule.php?id=' . $array_cel['id'][$i] . '&link=' . $array_cel['link'][$i];
            ?> <li id="<?php echo($id); ?>">
               <div class="card">
                  <a href="<?php echo($url); ?>" class="title"><?php echo($array_cel['nom'][$i]); ?></a>
                  <a href="<?php echo($url); ?>" class="organisme">Libre</a>
               </div>
            </li> <?php
         }
      }
   ?>
   </ul>
</div>

