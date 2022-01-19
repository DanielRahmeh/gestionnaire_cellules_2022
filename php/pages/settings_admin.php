<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<body>
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
      <div id="new_user_container">
         <h3>Créer un nouveau compte utilisateur</h3><br />
         <form name="new_user" method="POST" action="../scripts/new_user.php">
            <!-- Champs pour l'email -->
            <div class="elem_setting">
               <label>Email</label><br />
               <input type="email" id="email" placeholder="Entrer l'email" name="email" title="Adresse email valide" required>
            </div>
            <div class="elem_setting" id="generate" >
               <label>Genérer un mot de passe</label>
               <input type="checkbox"  name="generate" id="generateCheckBox" title="Le mot de passe sera envoyé par mail" onclick="checkGeneratePass()">
            </div>
            <div class="elem_setting" id="form_pass">
               <!-- Champs pour le mot de passe -->
               <label>Mot de passe</label><br />
               <input type="password" id="pass" placeholder="Entrer le mot de passe" name="pass" 
               pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,40}$" 
               title="- Minimum 6 charactère &#10;- Au moins une MAJ (A-Z) &#10;- Au moins une MIN (a-z) &#10;- Au moins un NUM (1-9)"
               required>
               <br />
               </div>
               <div id="check_pass">
                  <div class="validity_pass">
                     <div>
                        <input type="checkbox" id="len_password_check" class="password_check" onclick="lenPasswordCheckClick()"> 
                        <div id="password_text_info">Nombre de charactères : </div>
                        <div id="len_password_text" class="password_text">Minimum 0</div> 
                     </div>
                     <input type="range" min="1" max="40" value="6" id="len_password_val" class="password_val" oninput="lenPasswordCheckClick()">
                  </div>
                  <div class="validity_pass">
                     <div>
                        <input type="checkbox" id="maj_password_check" class="password_check" onclick="majPasswordCheckClick()">
                        <div id="password_text_info">Nombre de majuscules (A-Z) : </div>
                        <div id="maj_password_text" class="password_text">Minimum 0</div>                    
                     </div>
                     <input type="range" min="1" max="10" value="0" id="maj_password_val" class="password_val" oninput="majPasswordCheckClick()">
                  </div>
                  <div class="validity_pass">
                     <div>
                        <input type="checkbox" id="min_password_check" class="password_check" onclick="minPasswordCheckClick()">
                        <div id="password_text_info">Nombre de minuscules (a-z) : </div>
                        <div id="min_password_text" class="password_text">Minimum 0</div>
                     </div>
                     <input type="range" min="1" max="10" value="0" id="min_password_val" class="password_val" oninput="minPasswordCheckClick()">
                  </div>
                  <div class="validity_pass">
                     <div>
                        <input type="checkbox" id="num_password_check" class="password_check" onclick="numPasswordCheckClick()">
                        <div id="password_text_info">nombre (1-9) : </div> 
                        <div id="num_password_text" class="password_text">Minimum 0</div>
                     </div>
                     <input type="range" min="1" max="10" value="0" id="num_password_val" class="password_val" oninput="numPasswordCheckClick()">
                  </div>
                  <br>
               </div>   
               <!-- Champs pour la confirmation de mot de passe -->
               <div class="elem_setting" id="confirm_pass">
                  <label>Confirmation mot de passe</label><br />
                  <input type="password" id="nPass" placeholder="Confirmer le mot de passe" name="nPass" 
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
                     <button type="button" onclick="location.href='param_admin.php'">non</button>
                     <input type="submit" id='submit' value='oui' title="Confirmer la création du compte">
               </div> 
            </div>  
         </form>
         <?php
         if(isset($_GET['erreur']))
            ?> <div class="error">L'adresse mail possède déjà un compte utilisateur</div> <?php
         if (isset($_GET['valide']))
            ?> <div class="valide">Création du compte utilisateur validé</div>
      </div>
   </main>
   <script src="../../js/settings_admin.js"></script>
</body>
</html>