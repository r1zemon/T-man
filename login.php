<?php
// Mulai sesi
session_start();

// Set header untuk mencegah caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Expires: Sun, 02 Jan 1990 00:00:00 GMT');

// Redirect ke homepage jika sudah login
if (isset($_SESSION['username'])) {
    header("Location: homepage.php");
    exit();
}

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "t-man");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses form register
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $birthdate = $conn->real_escape_string($_POST['birthdate']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT);

    $sql = "INSERT INTO data_akun (username, email, birthdate, password) VALUES ('$username', '$email', '$birthdate', '$password')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "";
    } else {
        $_SESSION['error'] = "Gagal membuat akun: " . $conn->error;
    }
}

// Proses form login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM data_akun WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id'];
            header("Location: homepage.php");
            exit();
        } else {
            $_SESSION['error'] = "Password salah.";
        }
    } else {
        $_SESSION['error'] = "Username tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>T-man Masuk dan Register</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/auth.css">
</head>

<body>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <div class="container">
        <div class="form-box">
            <form action="" method="POST">
                <h1>Masuk</h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock'></i>
                </div>
                <div class="forgot-link">
                    <a href="#">Lupa Password?</a>
                </div>
                <div class="login-admin">
                    <a href="admin_login.php">Login sebagai admin</a>
                </div>
                <button type="submit" name="login" class="btn">Masuk</button>
            </form>
        </div>

        <div class="form-box register">
            <form action="" method="POST">
                <h1>Registrasi</h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="email" placeholder="Email" required>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="date" name="birthdate" placeholder="Birthdate" required>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock'></i>
                </div>
                <button type="submit" name="register" class="btn">Buat Akun</button>
            </form>
        </div>

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Halo, Selamat Datang!</h1>
                <p>Belum Punya Akun?</p>
                <button class="btn register-btn">Registrasi</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Selamat Datang Lagi!</h1>
                <p>Sudah Punya Akun?</p>
                <button class="btn login-btn">Masuk</button>
            </div>
        </div>
    </div>

    <script src="js/login.js"></script>
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