<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Masuk Candi Prambanan</title>
    <link rel="stylesheet" href="css/destination1.css">
    <link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>
<body>
    <header>
        <a href="#" class="logo">T-Man</a>
        <!-- <div class="bx bx-menu" id="menu-icon"></div> -->

        <ul class="navbar">
            <li><a href="homepage.php">Home</a></li>
            <li><a href="destination.php">Destinasi</a></li>
            <li><a href="ticket.php">Tiket</a></li>
            <li><a href="akun.php">Akun</a></li>
        </ul>
    </header>
        <div class="image-gallery">
            <img src="img/prambanan.jpg" alt="Candi Prambanan" class="main-image">
            <img src="img/prambanan.jpg" alt="Visitors at Prambanan" class="gallery-image">
            <img src="img/prambanan.jpg" alt="Temple garden" class="gallery-image">
            <img src="img/prambanan.jpg" alt="Couple at temple" class="gallery-image">
            <img src="img/prambanan.jpg" alt="Tour vehicle" class="gallery-image">
        </div>

        <div class="content">
            <div class="tabs">
                <a href="#" class="tab active">Ringkasan</a>
                <a href="#description" class="tab">Deskripsi</a>
                <a href="#map" class="tab">Lokasi</a>
            </div>
            
            <h1 class="title">Tiket Masuk Candi Prambanan</h1>

            <div class="location">
            <a href="#"><i class='bx bxs-map'></i></a>
                Prambanan Temple, Jalan Raya Solo - Yogyakarta, Kranggan, Bokoharjo, Sleman Regency
            </div>

            <div class="hours">
                <a href=""><i class='bx bxs-time' ></i></a>
                Buka - Setiap Hari · 06:30 - 17:00
            </div>

            <h3>Candi Prambanan</h3>
            <div class="description" id="description">
                <div class="description-card">
                Candi Prambanan adalah candi yang dikenal sebagai candi Lara Jonggarang, konon Lara Jonggarang adalah nama seorang putri dari raja yang berkuasa pada saat itu. Candi Prambanan menjadi wisata wajib dikunjungi saat liburan di Jogja. Nikmati petualangan jalan-jalan di Yogyakarta dengan mengunjungi berbagai tempat wisata hits bersama orang yang kamu cintai, keluarga, bersama pasangan, dan teman-temanmu.
                Selama perjalanan, kamu akan mengunjungi beberapa tempat wisata di Jogja yang terkenal. Di Candi Prambanan, kamu akan disuguhkan kisah Roro Jonggrang yang memberikan tantangan bagi Bandung Bondowoso untuk membangun 1.000 candi dalam waktu 1 malam. Candi Prambanan adalah candi yang dikenal sebagai candi Lara Jonggarang, konon Lara Jonggarang adalah nama seorang putri dari raja yang berkuasa pada saat itu. 
                Candi Prambanan menjadi wisata wajib dikunjungi saat liburan di Jogja. Nikmati petualangan jalan-jalan di Yogyakarta dengan mengunjungi berbagai tempat wisata hits bersama orang yang kamu cintai, keluarga, bersama pasangan, dan teman-temanmu. Selama perjalanan, kamu akan mengunjungi beberapa tempat wisata di Jogja yang terkenal. Di Candi Prambanan, kamu akan disuguhkan kisah Roro Jonggrang yang memberikan tantangan bagi Bandung Bondowoso untuk membangun 1.000 candi dalam waktu 1 malam. Dapatkan cashback 10%
                <span>Candi Prambanan menjadi wisata wajib dikunjungi saat liburan di Jogja. Nikmati petualangan jalan-jalan di Yogyakarta dengan mengunjungi berbagai tempat wisata hits bersama orang yang kamu cintai, keluarga, bersama pasangan, dan teman-temanmu. Selama perjalanan, kamu akan mengunjungi beberapa tempat wisata di Jogja yang terkenal. Di Candi Prambanan, kamu akan disuguhkan kisah Roro Jonggrang yang memberikan tantangan bagi Bandung Bondowoso untuk membangun 1.000 candi dalam waktu 1 malam.</span>
                </div>
            </div>

    </div>

    <div id="map" style="width: 100%; height: 400px; margin-top: 20px;">


    <script>
  // Inisialisasi peta
  const map = L.map('map').setView([-7.7533, 110.4898], 13); // Koordinat untuk Candi Prambanan

  // Tambahkan tile layer dari OpenStreetMap
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  // Tambahkan marker di lokasi tertentu
  L.marker([-7.7533, 110.4898]).addTo(map)
    .bindPopup('Candi Prambanan')
    .openPopup();
</script>
<script>
  // Inisialisasi peta
  const map = L.map('map').setView([-7.7533, 110.4898], 13);

  // Tambahkan tile layer
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  // Tambahkan routing
  L.Routing.control({
    waypoints: [
      L.latLng(-7.8000, 110.5000), // Contoh lokasi pengguna
      L.latLng(-7.7533, 110.4898) // Lokasi Candi Prambanan
    ],
    routeWhileDragging: true
  }).addTo(map);
</script>
</div>


    <div class="price-section">
        <div>
            <div>Harga Tiket</div>
            <div class="price">IDR 50.000</div>
        </div>
        <button class="book-button">Beli Tiket</button>
    </div>

    <div id="ticketPopup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <h2>Pembelian Tiket Candi Prambanan</h2>
        <div class="ticket-form">
            <div class="ticket-type">
                <p>Tiket Reguler - IDR 50.000/orang</p>
                <div class="quantity-control">
                    <button class="quantity-btn minus">-</button>
                    <input type="number" id="ticketQuantity" value="1" min="1" max="10">
                    <button class="quantity-btn plus">+</button>
                </div>
            </div>
            <div class="total-section">
                <p>Total Pembayaran:</p>
                <p class="total-amount">IDR 50.000</p>
            </div>
            <button class="purchase-btn">Konfirmasi Pembelian</button>
        </div>
    </div>
</div>

<script>
// Get DOM elements
const popup = document.getElementById('ticketPopup');
const closeBtn = document.querySelector('.close');
const buyButton = document.querySelector('.book-button');
const quantityInput = document.getElementById('ticketQuantity');
const minusBtn = document.querySelector('.minus');
const plusBtn = document.querySelector('.plus');
const totalAmount = document.querySelector('.total-amount');
const purchaseBtn = document.querySelector('.purchase-btn');

// Price per ticket
const TICKET_PRICE = 50000;

// Show popup when buy button is clicked
buyButton.addEventListener('click', () => {
    popup.style.display = 'block';
    updateTotal();
});

// Close popup when X is clicked
closeBtn.addEventListener('click', () => {
    popup.style.display = 'none';
});

// Close popup when clicking outside
window.addEventListener('click', (e) => {
    if (e.target === popup) {
        popup.style.display = 'none';
    }
});

// Decrease quantity
minusBtn.addEventListener('click', () => {
    const currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
        updateTotal();
    }
});

// Increase quantity
plusBtn.addEventListener('click', () => {
    const currentValue = parseInt(quantityInput.value);
    if (currentValue < 10) {
        quantityInput.value = currentValue + 1;
        updateTotal();
    }
});

// Update total when quantity changes
quantityInput.addEventListener('change', () => {
    // Ensure value is between 1 and 10
    if (quantityInput.value < 1) quantityInput.value = 1;
    if (quantityInput.value > 10) quantityInput.value = 10;
    updateTotal();
});

// Calculate and update total amount
function updateTotal() {
    const quantity = parseInt(quantityInput.value);
    const total = quantity * TICKET_PRICE;
    totalAmount.textContent = `IDR ${total.toLocaleString('id-ID')}`;
}

// Handle purchase confirmation
purchaseBtn.addEventListener('click', () => {
    const quantity = parseInt(quantityInput.value);
    const total = quantity * TICKET_PRICE;
    alert(`Pembelian tiket berhasil!\nJumlah tiket: ${quantity}\nTotal pembayaran: IDR ${total.toLocaleString('id-ID')}`);
    popup.style.display = 'none';
});
</script>

    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>