function get_coor(coor) {
   return (coor.split(','));
}

function get_lat(coor) {
   return coor[0];
}

function get_long(coor) {
   return coor[1];
}

function get_name(name) {
   return name;
}

function initMap() {
   const uluru = { lat: lat, lng: long };
   const map = new google.maps.Map(document.getElementById("map"), {
     zoom: 15,
     center: uluru,
   });
    const contentString = '<h3>' + name_coor + '</h3>';
  const infowindow = new google.maps.InfoWindow({
    content: contentString,
  });
  const marker = new google.maps.Marker({
    position: uluru,
    map,
    title: "Uluru (Ayers Rock)",
  });
  infowindow.open({
   anchor: marker,
   map,
   shouldFocus: false,
   });
  marker.addListener("click", () => {
    infowindow.open({
      anchor: marker,
      map,
      shouldFocus: false,
    });
  });
}