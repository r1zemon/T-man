<?php
// Koneksi ke database
session_start();  // Tambahkan ini di baris paling atas
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "t-man");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fungsi untuk mendapatkan destinasi berdasarkan kategori
function getDestinationsByCategory($conn, $category) {
    $sql = "SELECT * FROM destinasi_wisata WHERE kategori = ? ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    return $stmt->get_result();
}

function getDestinationsBySearch($conn, $searchTerm) {
  $sql = "SELECT * FROM destinasi_wisata WHERE judul LIKE ? ORDER BY created_at DESC";
  $searchTerm = "%" . $searchTerm . "%";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $searchTerm);
  $stmt->execute();
  return $stmt->get_result();
}

$categories = ['Sejarah', 'Makanan', 'Alam', 'Hiburan'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/destination.css" />
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    
  </head>
  <body>
  <header>
    <a href="#" class="logo">T-Man</a>
    <div class="bx bx-menu" id="menu-icon"></div>

    <ul class="navbar">
      <li><a href="homepage.php">Home</a></li>
      <li><a href="destination.php">Destinasi</a></li>
      <li><a href="ticket.php">Tiket</a></li>
      <?php if (isset($_SESSION['username'])): ?>
          <li><a href="akun.php"><?php echo $_SESSION['username']; ?></a></li>
      <?php else: ?>
          <li><a href="akun.php">Akun</a></li>
      <?php endif; ?>
  </ul>
</header>
    <section class="section__container header__container">
      <div class="header__image__container">
        <div class="header__content">
          <h1>Nikmati Sleman, yang Nyaman!</h1>
          <p>Pesan tiket destinasi anda sekarang juga!.</p>
        </div>
        <div class="booking__container">
  <form method="GET" action="">
    <div class="form__group">
      <div class="input__group">
        <input type="text" name="search" id="searchInput"/>
        <label>Lokasi</label>
      </div>
      <p>Kemana kamu mau pergi?</p>
    </div>
  </form>
  <button class="btn" onclick="searchDestination()"><i class="ri-search-line"></i></button>
</div>
      </div>
    </section>

    <section class="section__container popular__container">
<?php 
$categories = ['Sejarah', 'Makanan', 'Alam', 'Hiburan'];

// Cek apakah ada parameter pencarian
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchResults = getDestinationsBySearch($conn, $_GET['search']);
    
    echo '<h2 class="section__header">Hasil Pencarian</h2>';
    echo '<div class="popular__grid">';
    
    if ($searchResults->num_rows > 0) {
        while($row = $searchResults->fetch_assoc()) {
            echo '<div class="popular__card" onclick="window.location.href=\'destination_detail.php?id=' . $row['id'] . '\'" style="cursor: pointer;">
                <img src="' . $row['photo1'] . '" alt="' . $row['judul'] . '" />
                <div class="popular__content">
                    <div class="popular__card__header">
                        <h4>' . $row['judul'] . '</h4>
                        <h4>' . $row['harga'] . '</h4>
                    </div>
                    <p>' . $row['lokasi_singkat'] . '</p>
                </div>
            </div>';
        }
    } else {
        echo '<p>Tidak ada destinasi yang ditemukan.</p>';
    }
    echo '</div>';
} else {
    // Jika tidak ada pencarian, tampilkan semua kategori
    foreach($categories as $index => $category) {
        echo '<h2 class="section__header">' . $category . '</h2>';
        echo '<div class="popular__grid">';
        
        $result = getDestinationsByCategory($conn, $category);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="popular__card" onclick="window.location.href=\'destination_detail.php?id=' . $row['id'] . '\'" style="cursor: pointer;">
                    <img src="' . $row['photo1'] . '" alt="' . $row['judul'] . '" />
                    <div class="popular__content">
                        <div class="popular__card__header">
                            <h4>' . $row['judul'] . '</h4>
                            <h4>' . $row['harga'] . '</h4>
                        </div>
                        <p>' . $row['lokasi_singkat'] . '</p>
                    </div>
                </div>';
            }
        } else {
            echo '<p>Belum ada destinasi untuk kategori ini.</p>';
        }
        echo '</div>';
        
        // Tambahkan break line jika bukan kategori terakhir
        if ($index !== array_key_last($categories)) {
            echo '<br>';
        }
    }
}
?>
</section>

    

    <!-- <section class="client">
      <div class="section__container client__container">
        <h2 class="section__header">What our client say</h2>
        <div class="client__grid">
          <div class="client__card">
            <img src="assets/client-1.jpg" alt="client" />
            <p>
              The booking process was seamless, and the confirmation was
              instant. I highly recommend WDM&Co for hassle-free hotel bookings.
            </p>
          </div>
          <div class="client__card">
            <img src="assets/client-2.jpg" alt="client" />
            <p>
              The website provided detailed information about hotel, including
              amenities, photos, which helped me make an informed decision.
            </p>
          </div>
          <div class="client__card">
            <img src="assets/client-3.jpg" alt="client" />
            <p>
              I was able to book a room within minutes, and the hotel exceeded
              my expectations. I appreciate WDM&Co's efficiency and reliability.
            </p>
          </div>
        </div>
      </div>
    </section> -->

    <!-- <section class="section__container">
      <div class="reward__container">
        <p>100+ discount codes</p>
        <h4>Join rewards and discover amazing discounts on your booking</h4>
        <button class="reward__btn">Join Rewards</button>
      </div>
    </section> -->

    <!--Footer-->
<section id="contact">
    <div class="footer">
        <div class="main">
            <div class="list">
                <h4>Links</h4>
                <ul>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Syarat dan Ketentuan</a></li>
                    <li><a href="#">Kebijakan Polisi</a></li>
                    <li><a href="#">Bantuan</a></li>
                    <li><a href="#">Tour</a></li>
                </ul>
            </div>
            <div class="list">
                <h4>Support</h4>
                <ul>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Syarat dan Ketentuan</a></li>
                    <li><a href="#">Kebijakan Polisi</a></li>
                    <li><a href="#">Bantuan</a></li>
                    <li><a href="#">Tour</a></li>
                </ul>
            </div>

            <div class="list">
                <h4>Kontak</h4>
                <ul>
                    <li><a href="#">Jl. Kaliurang KM 14</a></li>
                    <li><a href="#">Sleman, Yogyakarta</a></li>
                    <li><a href="#">0812345678</a></li>
                    <li><a href="#">23523044@gmail.com</a></li>
                    <li><a href="#">0812345678</a></li>
                </ul>
            </div>

            <div class="list">
                <h4>Koneksi</h4>
                <div class="sosial">
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="https://www.instagram.com/khalaidadzia/"><i class='bx bxl-instagram' ></i></a>
                    <a href="#"><i class='bx bxl-twitter' ></i></a>
                    <a href="#"><i class='bx bxl-tiktok' ></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="end-text">
        <p>&copy; 2024 T-Man. All rights reserved. Developed by Brainstorm.</p>
    </div>
</section>

<script type="text/javascript" src="js/script.js"></script>
  </body>
</html>