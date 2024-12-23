<?php
// Mulai sesi
session_start();

// Proses form login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi username dan password
    if ($username === 'admin1' && $password === 't-man') {
        $_SESSION['admin'] = $username;
        header("Location: admin.php");
        exit();
    } else {
        $_SESSION['error'] = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="css/loginadmin.css">
</head>

<body>
  <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
      <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
  <?php endif; ?>

  <div class="container">
  <div class="left-box">
    <div class="form-box">
      <form action="" method="POST">
            <h1>Login Admin</h1>
            <div class="input-box">
              <input type="text" name="username" placeholder="Username" required>
              <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
              <input type="password" name="password" placeholder="Password" required>
              <i class='bx bxs-lock'></i>
            </div>
            <button type="submit" name="login" class="btn">Masuk</button>
      </form>
      </div>
    </div>
  </div>

  <script src="js/login.js"></script>
</body>

</html>
