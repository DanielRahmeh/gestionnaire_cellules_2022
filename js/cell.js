function getVal(batiment, etage, list) {
   var batiment = document.getElementById(batiment);
   var etage = document.getElementById(etage);

   var li = document.getElementById(list).getElementsByTagName('li');
   for(i = 0; i < li.length; i++) {
      myLi = li[i];
      if (batiment.value == 'Tous' && etage.value == 'Tous')
         myLi.style.display = 'block';
      else if (batiment.value == '/')
         myLi.style.display = 'none';
      else if (batiment.value == 'Tous' && etage.value != 'Tous') {
         var id = '/' +  etage.value;
         if (myLi.id.includes(id))
            myLi.style.display = 'block';
         else
            myLi.style.display = 'none';
      }
      else if (etage.value == 'Tous') {
         var id = batiment.value + '/';
         if (myLi.id.includes(id))
            myLi.style.display = 'block';
         else
            myLi.style.display = 'none';
      }
      else {
         var id = batiment.value + '/' + etage.value;
         if (myLi.id == id)
            myLi.style.display = 'block';
         else
            myLi.style.display = 'none';
      }
   }
}

// Fonction permettant d'afficher ou masquer le plan sur la page étage
function dispPlan() {
   var button = document.getElementById('plan_button');
   var plan = document.getElementById('plan');

   if (plan.style.display == "none") {
      plan.style.display = "block";
      button.innerHTML = 'Masquer le plan';
   }
   else {
      plan.style.display = "none";
      button.innerHTML = 'Afficher le plan';
   }
}

function newElemSelect(select, text) {
   var newElem = document.getElementById(select);
   var newText = document.getElementById(text);
   
   newText.value = '';
}

function newElem(select, text) {
   var newElem = document.getElementById(select);
   var newText = document.getElementById(text);

   if (newText.value != '')
      newElem.selectedIndex = (newElem.length - 1);
   else
      newElem.selectedIndex = 0;
}