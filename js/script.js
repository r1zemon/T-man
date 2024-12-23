const header = document.querySelector("header");

window.addEventListener("scroll", function() {
    header.classList.toggle("sticky", window.scrollY > 0);
});

let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('open');
};

window.onscroll = () => {
    menu.classList.remove('bx-x');
    navbar.classList.remove('open');
};

navigator.geolocation.getCurrentPosition(
    position => {
      const userLat = position.coords.latitude;
      const userLng = position.coords.longitude;
  
      // Gunakan koordinat ini di fungsi routing
      L.Routing.control({
        waypoints: [
          L.latLng(userLat, userLng),
          L.latLng(-7.7533, 110.4898) // Lokasi tujuan
        ],
        routeWhileDragging: true
      }).addTo(map);
    },
    error => {
      console.error('Error getting location:', error);
    }
  );
  
  function searchDestination() {
    var searchTerm = document.getElementById('searchInput').value;
    // Redirect ke halaman yang sama dengan parameter pencarian
    window.location.href = 'destination.php?search=' + encodeURIComponent(searchTerm);
}

