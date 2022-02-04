// Fonction permettant de détécter si l'utilisateur souhaite génerer un mot de passe ou le saisir
// lors de l création d'un nouveau compte utilisataur

function checkGeneratePass() {
   var checkBox = document.getElementById("generateCheckBox");
   var genPass = document.getElementById("generate_pass");
   var formPass = document.getElementById("form_pass");
   var confirmPass = document.getElementById("confirm_pass");
   var pass = document.getElementById("pass");
   var nPass = document.getElementById("nPass");

   if (checkBox.checked == true || (checkBox.checked == true && window.location.href.includes("param_admin.php?gen=1") == true)){
      genPass.style.display = "block";
      formPass.style.display = "none";
      confirmPass.style.display = "none";
      formPass.setAttribute("pattern", "");
      pass.required = false;
      nPass.required = false;
   } else {
      genPass.style.display = "none";
      formPass.style.display = "block";
      confirmPass.style.display = "block";
   }
}

// Récupération des éléments permettant de mettre en place des critère de validité du mot de passe
// A chaque manipulation d'un de ces élément par l'utilisateur la fonction 'PasswordCheckClick' est appelé
// permettant de mettre à jour les critères de validités

// Longueur du mot de passe
var lenPasswordText = document.getElementById("len_password_text");
var lenPasswordVal = document.getElementById("len_password_val");
var lenPasswordCheck = document.getElementById("len_password_check");
var lenPasswordIco = document.getElementById("len_password_ico");
function lenPasswordCheckClick() { 
   PasswordCheckClick(lenPasswordCheck, lenPasswordVal, lenPasswordText, lenPasswordIco, 0);
}

// Nombre de majuscules
var majPasswordText = document.getElementById("maj_password_text");
var majPasswordVal = document.getElementById("maj_password_val");
var majPasswordCheck = document.getElementById("maj_password_check");
var majPasswordIco = document.getElementById("maj_password_ico");
function majPasswordCheckClick() { 
   PasswordCheckClick(majPasswordCheck, majPasswordVal, majPasswordText, majPasswordIco, 1);
}

// Nombre de minuscules
var minPasswordText = document.getElementById("min_password_text");
var minPasswordVal = document.getElementById("min_password_val");
var minPasswordCheck = document.getElementById("min_password_check");
var minPasswordIco = document.getElementById("min_password_ico");
function minPasswordCheckClick() { 
   PasswordCheckClick(minPasswordCheck, minPasswordVal, minPasswordText, minPasswordIco, 2);
}

// Nombre de numéros
var numPasswordText = document.getElementById("num_password_text");
var numPasswordVal = document.getElementById("num_password_val")
var numPasswordCheck = document.getElementById("num_password_check");
var numPasswordIco = document.getElementById("num_password_ico");
function numPasswordCheckClick() { 
   PasswordCheckClick(numPasswordCheck, numPasswordVal, numPasswordText, numPasswordIco, 3);
}

// Tableau contenant la valeur des critère de validité du mot de passe
// arrayPasswordCheck[0] -> longueur minimum du mot de passe
// arrayPasswordCheck[1] -> nombre minimum de maj dans le mot de passe
// arrayPasswordCheck[2] -> nombre minimum de min dans le mot de passe
// arrayPasswordCheck[3] -> nombre minimum de num dans le mot de passe
var arrayPasswordCheck = [0, 0, 0, 0];

var pass = document.getElementById('pass');

// Fonction permettant de mettre à jour les valeur du tableau arrayPasswordCheck
function PasswordCheckClick(check, val, text, ico, index) {
   if (check.checked == true) {
      val.style.display = "block";
      ico.style.display = "block";
      text.style.textDecoration = "none";
      arrayPasswordCheck[index] = parseInt(val.value);
      var tot = arrayPasswordCheck[1] + arrayPasswordCheck[2] + arrayPasswordCheck[3];
      if (tot > arrayPasswordCheck[0]) {
         if (index == 0)
            val.value = tot;
         else
            val.value = arrayPasswordCheck[index] - (tot - arrayPasswordCheck[0]);
         arrayPasswordCheck[index] =  parseInt(val.value);
      } 
      text.innerHTML=('Minimum ' + arrayPasswordCheck[index]);
   }
   else {
      val.style.display = "none";
      ico.style.display = "none";
      text.style.textDecoration = "line-through";
      text.innerHTML=('Minimum 0')
      arrayPasswordCheck[index] = 0;
   }
   // Mise à jour des formulaires html en fonction des critères défini par la fonction
   pass.setAttribute("title", "- Minimum " + arrayPasswordCheck[0] + 
                              " charactère \r\n- Au moins " + arrayPasswordCheck[1] +
                              " MAJ (A-Z) \r\n- Au moins " + arrayPasswordCheck[2] + 
                              " MIN (a-z) \r\n- Au moins " + arrayPasswordCheck[3] + " NUM (1-9)");
   
   pass.setAttribute("pattern", "^(?=.*[a-z]{" + arrayPasswordCheck[2] +
                                 "})(?=.*[A-Z]{" + arrayPasswordCheck[1] +
                                 "})(?=.*[0-9]{" + arrayPasswordCheck[3] +
                                 "}).{" + arrayPasswordCheck[0] + ",40}$");
}

// Fonction permettant de génerer un mot de passe
function generatePassword() {
   var checkBox = document.getElementById("generateCheckBox");
   var newUserForm = document.getElementById("new_user_form");
   var alphaMin = "abcdefghijklmnopqrstuvwxyz";
   var alphaMaj = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
   var alphaNum = "0123456789";
   var password = '';
   var len = 0;
   
   if (checkBox.checked) {
      document.getElementById("len_password_ico").src="http://localhost/gestionnaire_cellules_2022/img/icon/check.png";
      document.getElementById("maj_password_ico").src="http://localhost/gestionnaire_cellules_2022/img/icon/check.png";
      document.getElementById("min_password_ico").src="http://localhost/gestionnaire_cellules_2022/img/icon/check.png";
      document.getElementById("num_password_ico").src="http://localhost/gestionnaire_cellules_2022/img/icon/check.png";

      // Longueur du mot de passe généré
      if (arrayPasswordCheck[0] == 0)
         tot_len = 6;
      else
         tot_len = arrayPasswordCheck[0];
      
      // Géneration des majuscules du mot de passe
      for (i = 0; i < arrayPasswordCheck[1]; i++)
         password += alphaMaj.charAt(Math.floor(Math.random() * alphaMaj.length));
      
      len = i;
      // Géneration des minuscules du mot de passe
      for (i = len; i <  arrayPasswordCheck[2] + len; i++)
         password += alphaMin.charAt(Math.floor(Math.random() * alphaMin.length));
      
      len = i;
      // Géneration des numéros du mot de passe
      for (i = len; i < arrayPasswordCheck[3] + len; i++)
         password += alphaNum.charAt(Math.floor(Math.random() * alphaNum.length));

      len = i;
      // Génération des caractrères manquant au mot de passe
      if (len != tot_len) {
         for (i = len; i <  tot_len; i++)
            password += alphaMin.charAt(Math.floor(Math.random() * alphaMin.length));
      }
   }
   else {
      password = '';
      checkLivePassword();
   }
   newUserForm.setAttribute("action", "../scripts/new_user.php?password=" + password);
   console.log(password);
}



var pass = document.getElementById('pass');
// Affichage d'un message d'erreur au niveau du formulaire HTML si le mot de passe saisi ne correspond pas au critère de validité
pass.oninvalid = function(event) {
    event.target.setCustomValidity
    ("- Minimum " + arrayPasswordCheck[0] + 
    " charactère\n- Au moins " + arrayPasswordCheck[1] + 
    " MAJ (A-Z)\n- Au moins " + arrayPasswordCheck[2] + 
    " MIN (a-z)\n- Au moins " + arrayPasswordCheck[3] + " NUM (1-9)");
}


// Fonction permettant d'afficher à l'utilisateur si les critère de validités du mot de passe sont réspecté gràce à des icones
function checkLivePassword() {
   if (pass.value.length >= arrayPasswordCheck[0])
      document.getElementById("len_password_ico").src="http://localhost/gestionnaire_cellules_2022/img/icon/check.png";
   else
      document.getElementById("len_password_ico").src="http://localhost/gestionnaire_cellules_2022/img/icon/cancel.png";
   if (pass.value.length - pass.value.replace(/[A-Z]/g, '').length  >= arrayPasswordCheck[1])
      document.getElementById("maj_password_ico").src="http://localhost/gestionnaire_cellules_2022/img/icon/check.png";
   else
      document.getElementById("maj_password_ico").src="http://localhost/gestionnaire_cellules_2022/img/icon/cancel.png";
   if (pass.value.length - pass.value.replace(/[a-z]/g, '').length  >= arrayPasswordCheck[2])
      document.getElementById("min_password_ico").src="http://localhost/gestionnaire_cellules_2022/img/icon/check.png";
   else
      document.getElementById("min_password_ico").src="http://localhost/gestionnaire_cellules_2022/img/icon/cancel.png"; 
   if (pass.value.length - pass.value.replace(/[1-9]/g, '').length  >= arrayPasswordCheck[3])
      document.getElementById("num_password_ico").src="http://localhost/gestionnaire_cellules_2022/img/icon/check.png";
   else
      document.getElementById("num_password_ico").src="http://localhost/gestionnaire_cellules_2022/img/icon/cancel.png";
}

// Cette fonction est appelé à chaque appui sur le clavier de l'utilisateur dans le champs de saisie du mot de passe
pass.onkeyup = checkLivePassword;


// Fonction permettant de vérifier si la confirmation du mot de passe correspond au mot de passe
var pass = document.getElementById("pass");
var nPass = document.getElementById("nPass");

function validatePassword(){
    if(pass.value != nPass.value) {
        nPass.setCustomValidity("Le mot de passe ne correspond pas");
    } else {
        nPass.setCustomValidity('');
    }
}
pass.onchange = validatePassword;
nPass.onkeyup = validatePassword;


// Affichage d'un message d'alerte afin de confirmer la création d'un nouveau compte utilisateur
var createButton = document.getElementById("create");

function confirmation() {
    var email = document.getElementById("email");
    var confirmDiv = document.getElementById("confirm");

    if (email.value != '') {
        document.getElementById("confirm_text").innerHTML = ("Etes vous sur de vouloir créer un compte pour <b>" + email.value + "</b>");
        confirmDiv.style.display = "block";
    }
}

createButton.onclick = confirmation;

// Bouton afficher la liste des comptes ou masquer la liste des comptes
var link = window.location.href;
var display_users = document.getElementById("display_users");
var hide_users = document.getElementById("hide_users");

console.log(link);

// Création du tableau : paramètre utilisateur
var tfConfig = {
   base_path: '../../TableFilter-master/dist/tablefilter/',
   alternate_rows: true,
   rows_counter: {
       text: 'Résultats: '
   },
   btn_reset: {
       text: 'Reset les filtrages'
   },
   clear_filter_text: 'Tous',
   loader: true,
   no_results_message: true,
   col_1: 'select',
   col_2: 'select',
   col_types: [
      'string',
      'string',
      'string',
   ],
   extensions: [{ name: 'sort' }]
};

// Localisation du tableau
var tf = new TableFilter(document.querySelector('table'), tfConfig);
tf.init();