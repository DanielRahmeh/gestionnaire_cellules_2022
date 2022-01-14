// génération d'un mot de passe ous saisie d'un mot de passe
function checkGeneratePass() {
   var checkBox = document.getElementById("generateCheckBox");
   var genPass = document.getElementById("generate_pass");
   var formPass = document.getElementById("form_pass");
   var pass = document.getElementById("pass");
   var nPass = document.getElementById("nPass");


   if (checkBox.checked == true || (checkBox.checked == true && window.location.href.includes("param_admin.php?gen=1") == true)){
       genPass.style.display = "block";
       formPass.style.display = "none";
       formPass.setAttribute("pattern", "");
       pass.required = false;
       nPass.required = false;
   } else {
       genPass.style.display = "none";
       formPass.style.display = "block";
   }
}