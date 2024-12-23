<?php
session_start();
include 'connect.php'; 

// Set header untuk mencegah caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Expires: Sun, 02 Jan 1990 00:00:00 GMT');

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM data_akun WHERE username = '$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Proses update profil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $new_username = $conn->real_escape_string($_POST['username']);
    $new_email = $conn->real_escape_string($_POST['email']);
    $new_birthdate = $conn->real_escape_string($_POST['birthdate']);

    $update_sql = "UPDATE data_akun SET username = '$new_username', email = '$new_email', birthdate = '$new_birthdate' WHERE username = '$username'";

    if ($conn->query($update_sql) === TRUE) {
        $_SESSION['username'] = $new_username;
        $_SESSION['message'] = "Profil berhasil diperbarui.";
        header("Location: akun.php");
        exit();
    } else {
        $_SESSION['error'] = "Gagal memperbarui profil: " . $conn->error;
    }
}

// Proses ubah password
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Verifikasi password saat ini
    $verify_sql = "SELECT password FROM data_akun WHERE username = '$username'";
    $verify_result = $conn->query($verify_sql);
    $verify_user = $verify_result->fetch_assoc();

    if (password_verify($current_password, $verify_user['password'])) {
        // Periksa apakah password baru sama
        if ($new_password === $confirm_password) {
            // Hash password baru
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update password di database
            $update_password_sql = "UPDATE data_akun SET password = '$hashed_password' WHERE username = '$username'";

            if ($conn->query($update_password_sql) === TRUE) {
                $_SESSION['message'] = "Password berhasil diubah.";
                header("Location: akun.php");
                exit();
            } else {
                $_SESSION['error'] = "Gagal mengubah password: " . $conn->error;
            }
        } else {
            $_SESSION['error'] = "Password baru tidak cocok.";
        }
    } else {
        $_SESSION['error'] = "Password saat ini salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Akun - T-Man</title>
    <link rel="stylesheet" type="text/css" href="css/akun.css">
    <link href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <!--header-->
    <header>
        <a href="index.php" class="logo">T-Man</a>
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

    <section class="akun-section">
        <div class="container">
            <?php 
            if (isset($_SESSION['message'])) {
                echo "<div class='alert alert-success'>" . $_SESSION['message'] . "</div>";
                unset($_SESSION['message']);
            }
            if (isset($_SESSION['error'])) {
                echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
                unset($_SESSION['error']);
            }
            ?>

            <div class="akun-content">
                <div class="profile-section">
                    <h2>Profil Saya</h2>
                    <form method="POST">
                        <div class="input-box">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                        </div>
                        
                        <div class="input-box">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="birthdate">Tanggal Lahir</label>
                            <input type="date" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($user['birthdate']); ?>" required>
                        </div>
                        <button type="submit" name="update_profile">Update Profil</button>
                    </form>
                </div>

                <div class="password-section">
                    <h2>Ubah Password</h2>
                    <form method="POST">
                        <div class="input-box">
                            <label for="current_password">Password Saat Ini</label>
                            <input type="password" id="current_password" name="current_password" required>
                        </div>
                        <div class="input-box">
                            <label for="new_password">Password Baru</label>
                            <input type="password" id="new_password" name="new_password" required>
                        </div>
                        <div class="input-box">
                            <label for="confirm_password">Konfirmasi Password Baru</label>
                            <input type="password" id="confirm_password" name="confirm_password" required>
                        </div>
                        <button type="submit" name="change_password">Ubah Password</button>

                        <div class="logout-section" style="margin-top: 20px; text-align: center;">
        <a href="logout.php" class="logout-btn" style="display: inline-block; padding: 10px 20px; background-color: #ff4444; color: white; text-decoration: none; border-radius: 5px;">Logout</a>
    </div>
                    </form>
                </div>
            </div>
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
    <script>
    // Mencegah navigasi kembali setelah logout
    window.history.forward();
    function noBack() {
        window.history.forward();
    }
    </script>
</body>
</html>

<?php
$conn->close();
?>