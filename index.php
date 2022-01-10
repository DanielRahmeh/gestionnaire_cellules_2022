<!-- Page index par default -->
<!-- Page de connexion -->


<!DOCTYPE html>
<html lang="fr">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Intégration du fichier css -->
   <link rel="stylesheet" href="css/style.css" type="text/css" />
   <title>Conexion</title>
</head>

<body>
   <!-- Zone de connexion -->
   <main id="main_login">
      <div id="connexion">
         <!-- Formulaire de connexion -->
         <div id="img_login"><img src="img/logo/logo_texte.png"></div>
         <form action="php/scripts/authentify.php" method="POST">
            <h2>Connexion</h2>
            <!-- Saisie de l'email  -->
            <div class="lab_login">
               <label><i>Email</i></label>
               <input type="email" class="input_login" name="email" placeholder="Entrer l'email" required>
            </div>
            <!-- Saisie du mot de passe  -->
            <div class="lab_login">
               <label><i>Mot de passe</i></label>
               <input type="password" class="input_login" name="password" placeholder="Entrer le mot de passe" required>
            </div>
            <div id="check_login">
               <div>
                  <!-- Checkbox pour rester connecté -->
                  <label>Rester connecté</label>
                  <input type="checkbox" name="stay_connected" placeholder="Toujours rester connecté">
               </div>
               <!-- Lien vers la demande d'un nouveau mot de passe -->
               <a href="#">Mot de passe oublié</a>
            </div>
            <div id="submit_login_div">
               <!-- Bouton de confirmation  -->
               <input type="submit" id="submit_login" value='Connexion' >
            </div>
         </form>
         <?php
         if(isset($_GET['erreur'])) {
               $err = $_GET['erreur'];
               ?> <div class="error">Utilisateur ou mot de passe incorrect</div> <?php
               // echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
            }
        ?>
      </div>
   </main>
</body>

<script>
   //Array of images which you want to show: Use path you want.
   let images=new Array('http://localhost/gestionnaire_cellules_2022/img/background/HotelTertiaire_Bat.png',
                        'http://localhost/gestionnaire_cellules_2022/img/background/HotelTertiaire_Lieu.png',
                        'http://localhost/gestionnaire_cellules_2022/img/background/Numerica1_Bat.png', 
                        'http://localhost/gestionnaire_cellules_2022/img/background/Numerica2_BatA.png', 
                        'http://localhost/gestionnaire_cellules_2022/img/background/Numerica2_BatB.png',
                        'http://localhost/gestionnaire_cellules_2022/img/background/Numerica2_BatC.png',
                        'http://localhost/gestionnaire_cellules_2022/img/background/Numerica2_Lieu.png');
   
   let i = 0;

   console.log(images);

   function change() {
      if (i == images.length)
         i = 0;
      document.getElementById('main_login').setAttribute("style", "background-image: url('" + images[i] + "');");
      i++;
   }

   window.onload = function () {
      setInterval(change, 5000);
   };

</script>

</html>