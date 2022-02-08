<?php
   // Récuperation des élement de la session de l'utilisateur
   session_start();
   // Vérification si l'utilisateur est bien connécté
   if($_SESSION['email'] != "") {
      $email = $_SESSION['email'];
      $admin = $_SESSION['admin'];
      // Affichage du header de la page
      include('header/settings_admin_header.php');
   }
   else {
      header('Location: index.php');
   }
?>
<main>

   <!-- Formulaire de création d'un nouveau compte utilisateur -->
   <div class="new_user_container">
      <a href="principal.php"> < retour</a><br /><br />
      <h3>Créer un nouveau compte utilisateur</h3><br />
      <form name="new_user" method="POST" id="new_user_form" action="../scripts/new_user.php">

         <!-- Champs pour l'email -->
         <div class="elem_setting">
            <label>Email</label><br />
            <input type="email" class="settings_input" id="email" placeholder="Entrer l'email" name="email"
            title="Adresse email valide" required>
         </div>

         <!-- Checkbox pour activer la génération de mot de passe -->
         <div class="elem_setting" id="checkboxed">
            <label>Genérer un mot de passe</label>
            <input type="checkbox"  name="generate" id="generateCheckBox" title="Le mot de passe sera envoyé par mail" 
                  onclick="checkGeneratePass();generatePassword()">
         </div>

         <!-- Champs pour le mot de passe -->
         <div class="elem_setting" id="form_pass">
            <label>Mot de passe</label><br />
            <input type="password"  class="settings_input" id="pass" placeholder="Entrer le mot de passe" name="pass" 
            title="mot de passe libre" required>
            <br />
         </div>

         <!-- Critères de validité du mot de passe adaptable et dynamique -->
         <div id="check_pass">

            <!-- Longueur du mot de passe -->
            <div class="validity_pass">
               <div class="text_validity_pass">

                  <div>
                     <input type="checkbox" id="len_password_check" class="password_check" onclick="lenPasswordCheckClick()"> 
                     <div id="password_text_info">Nombre de charactères : </div>
                  </div>
                  <div>
                     <div id="len_password_text" class="password_text">Minimum 0</div>
                     <div><img src="../../img/icon/cancel.png" class="password_ico"  id="len_password_ico"></div>
                  </div>
               </div>
               <input type="range" min="1" max="30" value="6" id="len_password_val" class="password_val"
               oninput="lenPasswordCheckClick();checkLivePassword();generatePassword()">
            </div>

            <!--Nombre de majuscule dans le mot de passe -->
            <div class="validity_pass">
               <div class="text_validity_pass">
                  <div>
                     <input type="checkbox" id="maj_password_check" class="password_check" onclick="majPasswordCheckClick()">
                     <div id="password_text_info">Nombre de majuscules (A-Z) : </div>
                  </div>
                  <div>
                     <div id="maj_password_text" class="password_text">Minimum 0</div>
                     <div><img src="../../img/icon/cancel.png" class="password_ico" id="maj_password_ico"></div>
                  </div>                 
               </div>
               <input type="range" min="0" max="10" value="0" id="maj_password_val" class="password_val"
               oninput="majPasswordCheckClick();checkLivePassword();generatePassword()">
            </div>

            <!--Nombre de minuscule dans le mot de passe -->
            <div class="validity_pass">
               <div class="text_validity_pass">
                  <div>
                     <input type="checkbox" id="min_password_check" class="password_check" onclick="minPasswordCheckClick()">
                     <div id="password_text_info">Nombre de minuscules (a-z) : </div>
                  </div>
                  <div>
                     <div id="min_password_text" class="password_text">Minimum 0</div>
                     <div><img src="../../img/icon/cancel.png" class="password_ico"  id="min_password_ico"></div>
                  </div>
               </div>
               <input type="range" min="0" max="10" value="0" id="min_password_val" class="password_val"
               oninput="minPasswordCheckClick();checkLivePassword();generatePassword()">
            </div>

            <!--Nombre de numéro dans le mot de passe -->
            <div class="validity_pass">
               <div class="text_validity_pass">
                  <div>
                     <input type="checkbox" id="num_password_check" class="password_check" onclick="numPasswordCheckClick()">
                     <div id="password_text_info">Nombre de charactères numeriques (1-9) : </div> 
                  </div>
                  <div>
                     <div id="num_password_text" class="password_text">Minimum 0</div>
                     <div><img src="../../img/icon/cancel.png" class="password_ico" id="num_password_ico"></div>
                  </div>   
               </div>
               <input type="range" min="0" max="10" value="0" id="num_password_val" class="password_val"
               oninput="numPasswordCheckClick();checkLivePassword();generatePassword()">
            </div>

            <br>
         </div>

         <!-- Champs pour la confirmation de mot de passe -->
         <div class="elem_setting" id="confirm_pass">
            <label>Confirmation mot de passe</label><br />
            <input type="password" class="settings_input" id="nPass" placeholder="Confirmer le mot de passe" name="nPass" 
            title="Confirmer le mot de passe" required>
         </div>

         <!-- Message de confirmation de generation de mot de passe -->
         <div class="elem_setting" id="generate_pass" style="display:none">
               Un mot de passe sera généré et sera envoyé directement par mail.<br />
         </div>

         <!-- Checkbox pour accorder les droits administrateurs -->
         <div class="elem_setting" id="checkboxed">
            <label>Droits administrateurs</label>
            <input type="checkbox"  id="rights" name="rights" title="Accorder les droits administrateurs au compte">
         </div>

         <!-- Bouton de confirmation et d'envoi du formulaire -->
         <div class="elem_setting">
            <button id="create" type="button">Créer</button>
            <div id="confirm" style="display: none;">
                  <div id="confirm_text"></div>
                  <button type="button" onclick="location.href='settings_admin.php'">non</button>
                  <input type="submit" id='submit' value='oui' title="Confirmer la création du compte">
            </div> 
         </div> 

      </form>
      <?php

      // Gestion d'erreur des données saisie
      if(isset($_GET['erreur'])){
         ?> <div class="error">L'adresse mail possède déjà un compte utilisateur</div> <?php }
      else if (isset($_GET['valide'])){
         ?> <div class="valide">Création du compte utilisateur validé</div> <?php } ?>
   </div>

   <!-- Partie de gestion des compte utilisateurs existants -->
   <div class="new_user_container" id="tab_user">
      <h3>Gérer les comptes utilisateurs</h3><br />
      <p>(supprimmer, gerer droits administrateurs)</p>

      <?php
         // Vérification si l'utilisateur a cliqué sur "afficher les comptes"
         if(isset($_GET['delete']) || isset($_GET['delete_admin']) || isset($_GET['new_admin'])) {

            // Affichage du lien pour masquer les comptes
            ?><a href="settings_admin.php">Masquer la liste des comptes</a>

            <!-- Demande de confirmation en cas d'action sur un compte -->
            <div id="confirm_delete"> <?php
               if (isset($_GET['delete_admin']) || isset($_GET['new_admin']) ||
                     (isset($_GET['delete']) && $_GET['delete'] != 1)) {
                        if (isset($_GET['delete_admin'])) {
                           $link = "../scripts/delete_admin.php?new_admin=" . $_GET['delete_admin'];?>
                           <p>Etes-vous sur de vouloir supprimer les droits administrateur au compte suivant :
                           <b><?php echo $_GET['delete_admin'];?></b></p><?php
                        }
                        if (isset($_GET['new_admin'])) {
                           $link = "../scripts/new_admin.php?new_admin=" . $_GET['new_admin'];?>
                           <p>Etes-vous sur de vouloir accorder les droits administrateurs au compte suivant : 
                           <b><?php echo $_GET['new_admin'];?></b></p><?php
                        }
                        if (isset($_GET['delete']) && $_GET['delete'] != 1) {
                           $link = "../scripts/delete_user.php?delete=" . $_GET['delete'];?>
                           <p>Etes-vous sur de vouloir supprimer le compte suivant : <b><?php echo $_GET['delete'];?></b></p><?php
                        } ?>
                        <button type="button" onclick="location.href='settings_admin.php?delete=1'">non</button>
                        <button type="button" onclick="location.href='<?php echo $link; ?>'">oui</button> <?php
                     }
               ?>
            </div>

            <!-- Message de confirmation en cas d'action validé par l'utilisateur -->
            <?php 
            if (isset($_GET['check_delete'])  && $_GET['check_delete'] != 1) {
               ?> <div class="error">
                  Le compte de <b><?php echo $_GET['check_delete']; ?></b> a bien été supprimer.
               </div> <?php
            }
            if (isset($_GET['check_new_admin'])) {
               ?><div class="valide">
                  Les droits administrateurs on bien été accorder au compte suivant : <b><?php echo $_GET['check_new_admin']; ?></b>
            </div><?php
            }
            if (isset($_GET['check_delete_admin'])) {
               ?><div class="error">
                  Les droits administrateurs on bien été supprimer du compte suivant : <b><?php echo $_GET['check_delete_admin']; ?></b>
            </div><?php
            }

            // Connexion à la base de données
            require ('../scripts/connect_to_db.php');
            $db = new Database();
            $bdd = $db->getConnection();
            if (!$bdd) {
               die("Error connecting to the database");
            }

            // Requete récupération des données des utilisateurs
            $reponse = $bdd->query("SELECT * FROM user");
            ?>

            <!-- Affichage du tableau contenant les données récupérés -->
            <table class="excel-table">
               <thead>
                     <tr>
                        <th _sorttype="string">Email</th>
                        <th _sorttype="string">Droit administrateurs</th>
                        <th _sorttype="string">Supprimer le compte</th>
                     </tr>
               </thead>
               <tbody>
               <?php
               while ($donnees = $reponse->fetch())
               {
                     ?>
                        <tr>
                           <td data-label="Email"><?php echo $donnees['email_user']; ?></td>
                           <?php if ($donnees['admin_user'] == 1) {
                                 $link = "settings_admin.php?delete_admin=" . $donnees['email_user'];?>
                                 <td data-label="Droits administrateurs"><a href="<?php echo($link); ?>">Supprimer</a></td>
                           <?php } else {
                                 $link = "settings_admin.php?new_admin=" . $donnees['email_user'];?>
                                 <td data-label="Droits administrateurs"><a href="<?php echo($link); ?>" class="table_link_pos">Accorder</a></td>
                           <?php }
                           $link = "settings_admin.php?delete=" . $donnees['email_user'];?>
                           <td data-label="Supprimer le compte"><a href="<?php echo($link); ?>">Supprimer</a></td>
                        </tr>
                     
                     <?php              
               }
               ?>
               </tbody> 
            </table>            
         <?php
         }

         // Vérification si l'utilisateur n'a pas cliqué sur "afficher les comptes"
         else {
            ?><a href="settings_admin.php?delete=1">Afficher les comptes</a><?php
         } 

      ?>
   </div>
</main>

<!-- Appel du fichier js regroupant tous les script liés à la page setting_admin.php -->
<script src="../../js/settings_admin.js"></script>
<?php
   include('header/footer.php');
?>
</body>
</html>