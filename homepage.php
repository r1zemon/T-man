<?php
session_start();

// Set header untuk mencegah caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><T-man></title>
    <link rel="stylesheet" type="text/css" href="css/index.css"

    <link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">


</head>
<body>
    <!--header-->
    <header>
        <a href="#" class="logo">T-Man</a>
        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
    <li><a href="#home">Home</a></li>
    <li><a href="destination.php">Destinasi</a></li>
    <li><a href="ticket.php">Tiket</a></li>
    <!-- Menampilkan username jika sudah login -->
    <?php if (isset($_SESSION['username'])): ?>
        <li><a href="akun.php"><?php echo $_SESSION['username']; ?></a></li>
    <?php else: ?>
        <li><a href="akun.php">Akun</a></li>
    <?php endif; ?>
</ul>

    </header>

    <!--Home section-->
    <section class="home" id="home">
        <div class="home-text">
            <h1>Teman Touring <br> Sleman</h1>
            <p>Sleman adalah kota yang kaya akan budaya dan sejarah, terletak di kaki Gunung Merapi.</p>
            <a href="#" class="home-btn">Jelajahi Sekarang!</a>
        </div>
    </section>

    <!--Container-->
    <section class="container">
        <div class="text">
            <h2>Mulai Perjalanan Anda <br> di Sleman yang Nyaman!</h2>
        </div>

        <div class="row-items">
            <div class="container-box">
                <div class="container-img">
                    <img src="img/sejarah.png">
                </div>
                <h4>Sejarah</h4>
                <p>10+ Destination</p>
            </div>

            <div class="container-box">
                <div class="container-img">
                    <img src="img/makanan.png">
                </div>
                <h4>Makanan</h4>
                <p>10+ Destination</p>
            </div>
            
            <div class="container-box">
                <div class="container-img">
                    <img src="img/nature.png">
                </div>
                <h4>Alam</h4>
                <p>10+ Destination</p>
            </div>

            <div class="container-box">
                <div class="container-img">
                    <img src="img/hiburan.png">
                </div>
                <h4>Hiburan</h4>
                <p>10+ Destination</p>
            </div>
        </div>
    </section>

    <!--Package Section-->
    <section class="destination" id="destination">
        <div class="title">
            <h2>Rekomendasi <br> Destinasi Wisata</h2>
        </div>

    <div class="package-content";>
        <div class="box">
            <div class="thum">
                <img src="img/heha.jpg">
                <h3>Rp 15.000</h3>
            </div>

            <div class="dest-content">
                <div class="location">
                    <h4>Heha Sky View</h4>
                    <p>Jl. Raya Solo - Yogyakarta</p>
                </div>
                <div class="stars">
                    <a href="#"><i class='bx bxs-star'></i></a>
                    <a href="#"><i class='bx bxs-star'></i></a>
                    <a href="#"><i class='bx bxs-star'></i></a>
                    <a href="#"><i class='bx bxs-star'></i></a>
                    <a href="#"><i class='bx bxs-star'></i></a>
                </div>
            </div>
         </div>

         <div class="box">
            <div class="thum">
                <img src="img/prambanan.jpg">
                <h3>Rp 50.000</h3>
            </div>

            <div class="dest-content">
                <div class="location">
                    <h4>Prambanan</h4>
                    <p>Jl. Raya Solo - Yogyakarta</p>
                </div>
                <div class="stars">
                    <a href="#"><i class='bx bxs-star'></i></a>
                    <a href="#"><i class='bx bxs-star'></i></a>
                    <a href="#"><i class='bx bxs-star'></i></a>
                    <a href="#"><i class='bx bxs-star'></i></a>
                    <a href="#"><i class='bx bxs-star'></i></a>
                </div>
            </div>
         </div>

         <div class="box">
            <div class="thum">
                <img src="img/tamanpintar.jpg">
                <h3>Rp 75.000</h3>
            </div>

            <div class="dest-content">
                <div class="location">
                    <h4>Taman Pintar</h4>
                    <p>Jl. Panembahan Senopati</p>
                </div>
                <div class="stars">
                    <a href="#"><i class='bx bxs-star'></i></a>
                    <a href="#"><i class='bx bxs-star'></i></a>
                    <a href="#"><i class='bx bxs-star'></i></a>
                    <a href="#"><i class='bx bxs-star'></i></a>
                    <a href="#"><i class='bx bxs-star'></i></a>
                </div>
            </div>
         </div>


        </div>
    </div>

    </section>

     <!--Destination Section-->
     <section class="destination" id="destination">
        <div class="title">
            <h2>Destinasi Wisata <br>Paling Populer</h2>
        </div>

        <div class="destination-content">
            <div class="col-content">
                <img src="img/prambanan.jpg">
                <h5>Prambanan</h5>
                <p>Sleman</p>
            </div>

            <div class="col-content">
                <img src="img/prambanan.jpg">
                <h5>Prambanan</h5>
                <p>Sleman</p>
            </div>

            <div class="col-content">
                <img src="img/prambanan.jpg">
                <h5>Prambanan</h5>
                <p>Sleman</p>
            </div>

            <div class="col-content">
                <img src="img/prambanan.jpg">
                <h5>Prambanan</h5>
                <p>Sleman</p>
            </div>

            <div class="col-content">
                <img src="img/prambanan.jpg">
                <h5>Prambanan</h5>
                <p>Sleman</p>
            </div>

            <div class="col-content">
                <img src="img/prambanan.jpg">
                <h5>Prambanan</h5>
                <p>Sleman</p>
            </div>
            
        </div>

     </section>

     <!--Newsletter-->
     <section class="newsletter">
        <div class="news-text">
            <h2>Newsletter</h2>
            <p>Jangan lupa datang ke sleman <br> Agar hati menjadi nyaman</p>
        </div>

        <div class="send">
            <form>
                <input type="text" placeholder="Isi saran & masukkan" required>
                <input type="submit" value="submit">
            </form>
        </div>

     </section>

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
                        <li><a href="https://www.google.com/maps/place/Universitas+Islam+Indonesia/@-7.6876501,110.3380188,13z/data=!4m10!1m2!2m1!1suii!3m6!1s0x2e7a5e970cd4fa51:0xa527d07122b90c40!8m2!3d-7.6876501!4d110.4142365!15sCgN1aWkiA4gBAZIBEnByaXZhdGVfdW5pdmVyc2l0eeABAA!16s%2Fm%2F04n340m?hl=id&entry=ttu&g_ep=EgoyMDI0MTIxMS4wIKXMDSoASAFQAw%3D%3D">Jl. Kaliurang KM 14</a></li>
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
        

    <!--link to js-->
    <script type="text/javascript" src="js/script.js"></script>
    
</body>
</html>