   <?php
      session_start();
      if($_SESSION['email'] != "") {
         $email = $_SESSION['email'];
         $admin = $_SESSION['admin'];
         include('header/settings_admin_header.php');
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
            <div class="elem_setting" id="generate" >
               <label>Genérer un mot de passe</label>
               <input type="checkbox"  name="generate" id="generateCheckBox" title="Le mot de passe sera envoyé par mail" 
                     onclick="checkGeneratePass();generatePassword()">
            </div>
            <div class="elem_setting" id="form_pass">
               <!-- Champs pour le mot de passe -->
               <label>Mot de passe</label><br />
               <input type="password"  class="settings_input" id="pass" placeholder="Entrer le mot de passe" name="pass" 
               title="mot de passe libre" required>
               <br />
               </div>
               <div id="check_pass">
                  <!-- Critères de validité du mot de passe adaptable et dynamique -->
                  <div class="validity_pass">
                     <div class="text_validity_pass">
                        <!-- Longueur du mot de passe -->
                        <div>
                           <input type="checkbox" id="len_password_check" class="password_check" onclick="lenPasswordCheckClick()"> 
                           <div id="password_text_info">Nombre de charactères : </div>
                        </div>
                        <div id="len_password_text" class="password_text">Minimum 0</div>
                        <div><img src="../../img/icon/cancel.png" class="password_ico"  id="len_password_ico"></div> 
                     </div>
                     <input type="range" min="1" max="30" value="6" id="len_password_val" class="password_val"
                     oninput="lenPasswordCheckClick();checkLivePassword();generatePassword()">
                  </div>
                  <div class="validity_pass">
                     <div class="text_validity_pass">
                        <!-- Majuscule dans le mot de passe -->
                        <div>
                           <input type="checkbox" id="maj_password_check" class="password_check" onclick="majPasswordCheckClick()">
                           <div id="password_text_info">Nombre de majuscules (A-Z) : </div>
                        </div>
                        <div id="maj_password_text" class="password_text">Minimum 0</div>
                        <div><img src="../../img/icon/cancel.png" class="password_ico" id="maj_password_ico"></div>                     
                     </div>
                     <input type="range" min="0" max="10" value="0" id="maj_password_val" class="password_val"
                     oninput="majPasswordCheckClick();checkLivePassword();generatePassword()">
                  </div>
                  <div class="validity_pass">
                     <div class="text_validity_pass">
                        <!-- Minuscule dans le mot de passe -->
                        <div>
                           <input type="checkbox" id="min_password_check" class="password_check" onclick="minPasswordCheckClick()">
                           <div id="password_text_info">Nombre de minuscules (a-z) : </div>
                        </div>
                        <div id="min_password_text" class="password_text">Minimum 0</div>
                        <div><img src="../../img/icon/cancel.png" class="password_ico"  id="min_password_ico"></div>   
                     </div>
                     <input type="range" min="0" max="10" value="0" id="min_password_val" class="password_val"
                     oninput="minPasswordCheckClick();checkLivePassword();generatePassword()">
                  </div>
                  <div class="validity_pass">
                     <div class="text_validity_pass">
                        <!-- Numero dans le mot de passe -->
                        <div>
                           <input type="checkbox" id="num_password_check" class="password_check" onclick="numPasswordCheckClick()">
                           <div id="password_text_info">Nombre de charactères numeriques (1-9) : </div> 
                        </div>
                        <div id="num_password_text" class="password_text">Minimum 0</div>
                        <div><img src="../../img/icon/cancel.png" class="password_ico" id="num_password_ico"></div>   
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
            
            <div class="elem_setting" id="generate_pass" style="display:none">
                  Un mot de passe sera généré et sera envoyé directement par mail.<br />
            </div>
            <!-- Checkbox pour accorder les droits administrateurs -->
            <div class="elem_setting">
               <label>Droits administrateurs</label>
               <input type="checkbox"  id="rights" name="rights" title="Accorder les droits administrateurs au compte">
            </div>
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
         // Récéption des massages du script PHP
         if(isset($_GET['erreur'])){
            ?> <div class="error">L'adresse mail possède déjà un compte utilisateur</div> <?php }
         else if (isset($_GET['valide'])){
            ?> <div class="valide">Création du compte utilisateur validé</div> <?php } ?>
      </div>

      <div class="new_user_container" id="tab_user">
         <h3>Gérer les comptes utilisateurs</h3><br />
         <p>(supprimmer, gerer droits administrateurs)</p>
         <form  name="new" method="POST" id ="display_users" action="settings_admin.php?delete=1">
            <input type="submit" id='submit_disp' value='Afficher les comptes' title="Afficher la liste des comptes">
         </form>
         <form  name="new" method="POST" id ="hide_users" action="settings_admin.php">
            <input type="submit" id='submit_hide' value='Masquer les comptes' title="Masquer la liste des comptes">
         </form>
         <?php
            if(isset($_GET['delete']) || isset($_GET['delete_admin']) || isset($_GET['new_admin'])){
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
               <table>
                  <thead>
                        <tr>
                           <th>Email</th>
                           <th>Droit administrateurs</th>
                           <th>Supprimer</th>
                        </tr>
                  </thead>
                  <?php
                  while ($donnees = $reponse->fetch())
                  {
                        ?>
                        <tbody>
                           <tr>
                              <td><?php echo $donnees['email_user']; ?></td>
                              <?php if ($donnees['admin_user'] == 1) {
                                    $link = "settings_admin.php?delete_admin=" . $donnees['email_user'];?>
                                    <td><button onclick="location.href='<?php echo $link; ?>'">Supprimer</button></td>
                              <?php } else {
                                    $link = "settings_admin.php?new_admin=" . $donnees['email_user'];?>
                                    <td><button onclick="location.href='<?php echo $link; ?>'">Accorder</button></td>
                              <?php }
                              $link = "settings_admin.php?delete=" . $donnees['email_user'];?>
                              <td><button id="delete_user" onclick="location.href='<?php echo $link; ?>'">Supprimer</button></td>
                           </tr>
                        </tbody> 
                        <?php              
                  }
                  ?>
               </table>
               <div id="confirm_delete"> <?php
                  if (isset($_GET['delete_admin']) || isset($_GET['new_admin']) ||
                        (isset($_GET['delete']) && $_GET['delete'] != 1)) {
                           if (isset($_GET['delete_admin'])) {
                              $link = "delete_admin.php?new_admin=" . $_GET['delete_admin'];?>
                              Etes-vous sur de vouloir supprimer les droits administrateur au compte suivant :
                              <?php echo $_GET['delete_admin'];
                           }
                           if (isset($_GET['new_admin'])) {
                              $link = "new_admin.php?new_admin=" . $_GET['new_admin'];?>
                              Etes-vous sur de vouloir accorder les droits administrateurs au compte suivant : 
                              <?php echo $_GET['new_admin'];
                           }
                           if (isset($_GET['delete']) && $_GET['delete'] != 1) {
                              $link = "delete_user.php?delete=" . $_GET['delete'];?>
                              Etes-vous sur de vouloir supprimer le compte suivant : <?php echo $_GET['delete'];
                           } ?>
                           <button type="button" onclick="location.href='settings_admin.php?delete=1'">non</button>
                           <button type="button" onclick="location.href='<?php echo $link; ?>'">oui</button> <?php
                        }
                  ?>
               </div><?php 
               if (isset($_GET['check_delete'])  && $_GET['check_delete'] != 1) {
                  ?> <div id="check_delete">
                     Le compte de <b><?php echo $_GET['check_delete']; ?></b> a bien été supprimer.
                  </div> <?php
               }
               if (isset($_GET['check_new_admin'])) {
                  ?><div id="check_new_admin">
                     Les droits administrateurs on bien été accorder au compte suivant : <b><?php echo $_GET['check_new_admin']; ?><b/>
                  </div><?php
               }
            }                       
         ?>

      </div>
   </main>
   <script src="../../js/settings_admin.js"></script>
</body>
</html>