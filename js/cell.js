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

// valBatiment.onchange = dispCell(batiment, etage, id);
// valEtage.onchange = dispCell(batiment, etage, id);