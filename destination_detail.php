<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "t-man");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fungsi untuk membersihkan format teks
function cleanText($text) {
    // Menghapus semua variasi \r\n dan \r\
    $text = preg_replace('/\\\\r\\\\n|\\\\r\\\\|\\r\\n|\\n|\\r/', ' ', $text);
    // Menghapus spasi berlebih
    $text = preg_replace('/\s+/', ' ', $text);
    return trim($text);
}

// Ambil ID destinasi dari URL
$id = $_GET['id'];

// Ambil detail destinasi
$sql = "SELECT * FROM destinasi_wisata WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$destinasi = $result->fetch_assoc();

if (!$destinasi) {
    die("Destinasi tidak ditemukan");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $destinasi['judul']; ?> - T-Man</title>
    <link rel="stylesheet" href="css/destination1.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>
<body>
    <header>
        <a href="#" class="logo">T-Man</a>
        <ul class="navbar">
            <li><a href="homepage.php">Home</a></li>
            <li><a href="destination.php">Destinasi</a></li>
            <li><a href="ticket.php">Tiket</a></li>
            <li><a href="akun.php">Akun</a></li>
        </ul>
    </header>

    <div class="image-gallery">
        <?php
        // Menampilkan foto utama
        if(!empty($destinasi['photo1'])) {
            echo '<img src="'.$destinasi['photo1'].'" alt="'.$destinasi['judul'].'" class="main-image">';
        }
        // Menampilkan foto gallery
        for($i = 2; $i <= 5; $i++) {
            $photo = 'photo'.$i;
            if(!empty($destinasi[$photo])) {
                echo '<img src="'.$destinasi[$photo].'" alt="'.$destinasi['judul'].' photo '.$i.'" class="gallery-image">';
            }
        }
        ?>
    </div>

    <div class="content">
        <div class="tabs">
            <a href="#" class="tab active">Ringkasan</a>
            <a href="#description" class="tab">Deskripsi</a>
            <a href="#map" class="tab">Lokasi</a>
        </div>
        
        <h1 class="title"><?php echo $destinasi['judul']; ?></h1>

        <div class="location">
            <a href="#"><i class='bx bxs-map'></i></a>
            <?php echo $destinasi['lokasi_detail']; ?>
        </div>

        <div class="hours">
            <a href=""><i class='bx bxs-time'></i></a>
            <?php echo $destinasi['hari_buka']; ?>
        </div>

        <h3><?php echo $destinasi['lokasi_singkat']; ?></h3>
        <div class="description" id="description">
            <div class="description-card">
                <?php echo nl2br($destinasi['deskripsi']); ?>
            </div>
        </div>
    </div>

    <!-- Section peta yang baru -->
<div class="map-section">
    <h2 class="map-title">Lokasi</h2>
    <div class="map-container">
        <div id="map"></div>
    </div>
</div>

<style>
.map-section {
    paddingx 5%;
    background-color: #f8f9fa;
}

.map-title {
    font-size: 1.8rem;
    margin-bottom: 20px;
    color: var(--text-dark);
}

.map-container {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

#map {
    width: 152%;
    height: 500px; /* Tinggi peta ditambah */
    border-radius: 10px;
    border: 1px solid #e0e0e0;
}

.price-section {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  background: white;
  padding: 1rem;
  box-shadow: 0 -2px 4px rgba(0,0,0,0.1);
  display: flex;
  justify-content: space-between;
  align-items: center;
}


@media (max-width: 768px) {
    .map-container {
        grid-template-columns: 1fr;
    }
    
    #map {
        height: 300px;
    }
}
</style>

    <!-- <div id="map" style="width: 100%; height: 400px; margin-top: 20px;"></div> -->

    <div class="price-section">
    <div>
        <div>Harga Tiket</div>
        <div class="price"><?php echo $destinasi['harga']; ?></div>
    </div>
    <form id="ticketForm" action="proses_tiket.php" method="post">
        <input type="hidden" name="destinasi_id" value="<?php echo $destinasi['id']; ?>">
        <input type="hidden" name="nama_destinasi" value="<?php echo $destinasi['judul']; ?>">
        <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
        <button type="submit" class="book-button">Beli Tiket</button>
    </form>
</div>

    <div id="ticketPopup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Pembelian Tiket <?php echo $destinasi['judul']; ?></h2>
            <div class="ticket-form">
                <div class="ticket-type">
                    <p>Tiket Reguler - <?php echo $destinasi['harga']; ?>/orang</p>
                    <div class="quantity-control">
                        <button class="quantity-btn minus">-</button>
                        <input type="number" id="ticketQuantity" value="1" min="1" max="10">
                        <button class="quantity-btn plus">+</button>
                    </div>
                </div>
                <div class="total-section">
                    <p>Total Pembayaran:</p>
                    <p class="total-amount"><?php echo $destinasi['harga']; ?></p>
                </div>
                <button class="purchase-btn">Konfirmasi Pembelian</button>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Inisialisasi peta
        const map = L.map('map').setView([<?php echo $destinasi['latitude']; ?>, <?php echo $destinasi['longitude']; ?>], 13);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        L.marker([<?php echo $destinasi['latitude']; ?>, <?php echo $destinasi['longitude']; ?>])
            .addTo(map)
            .bindPopup('<?php echo $destinasi['judul']; ?>')
            .openPopup();
    </script>

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

        // Extract price from PHP variable
        const TICKET_PRICE = <?php echo str_replace(['Rp', '.', ' '], '', $destinasi['harga']); ?>;

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
        if (quantityInput.value < 1) quantityInput.value = 1;
        if (quantityInput.value > 10) quantityInput.value = 10;
        updateTotal();
        document.getElementById('formTicketQuantity').value = quantityInput.value;
    });

        // Calculate and update total amount
        function updateTotal() {
            const quantity = parseInt(quantityInput.value);
            const total = quantity * TICKET_PRICE;
            totalAmount.textContent = `Rp ${total.toLocaleString('id-ID')}`;
        }

        // Handle purchase confirmation
        purchaseBtn.addEventListener('click', () => {
            const quantity = parseInt(quantityInput.value);
            const total = quantity * TICKET_PRICE;
            alert(`Pembelian tiket berhasil!\nJumlah tiket: ${quantity}\nTotal pembayaran: Rp ${total.toLocaleString('id-ID')}`);
            popup.style.display = 'none';
        });
    </script>

    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>

<?php
$conn->close();
?>