function dispList (structure, i) {
   i = parseInt(i);
   id = 'structure' + i;
   listToShow = document.getElementById(id);
   if (listToShow.style.display == "block") {
      listToShow.style.display = "none";
      console.log('a cacher');
   }
   else {
      listToShow.style.display = "block";
      console.log('a afficher');
   }
   // console.log('Structure a agir:');
   // console.log(id);
   // console.log('Siblings of div-01:');
   // console.log(listToShow);
   // console.log(listToShow.innerHTML);
}