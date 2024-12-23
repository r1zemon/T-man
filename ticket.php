<?php
session_start();
include 'connect.php';

// Set header untuk mencegah caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Expires: Sun, 02 Jan 1990 00:00:00 GMT');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM tiket WHERE username = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Saya - T-Man</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&display=swap" rel="stylesheet">
    <style>
        .container {
            max-width: 1200px;
            margin: 120px auto 20px;
            padding: 0 20px;
        }

        .ticket-list table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .ticket-list th,
        .ticket-list td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .ticket-list th {
            background-color: var(--main-color);
            color: var(--bg-color);
            font-weight: 500;
        }

        .ticket-list tr:hover {
            background-color: #f5f5f5;
        }

        h1 {
            color: var(--text-color);
            font-size: 2rem;
            margin-bottom: 30px;
            text-align: center;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #e3fcef;
            color: #00875a;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .logo {
            color: black;
        }
        
        .navbar a {
            color: black;
        }

        #contact {
            margin-top: auto;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <a href="#" class="logo">T-Man</a>
        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
            <li><a href="homepage.php">Home</a></li>
            <li><a href="destination.php">Destinasi</a></li>
            <li><a href="ticket.php" class="active">Tiket</a></li>
            <li><a href="akun.php"><?php echo $_SESSION['username']; ?></a></li>
        </ul>
    </header>

    <div class="container">
        <h1>Tiket Saya</h1>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
        <?php endif; ?>

        <div class="ticket-list">
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Nama Destinasi</th>
                        <th>Tanggal Pembelian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['nama_destinasi']); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($row['created_at'])); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
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
                        <a href="https://www.instagram.com/khalaidadzia/"><i class='bx bxl-instagram'></i></a>
                        <a href="#"><i class='bx bxl-twitter'></i></a>
                        <a href="#"><i class='bx bxl-tiktok'></i></a>
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

<?php
$conn->close();
?>