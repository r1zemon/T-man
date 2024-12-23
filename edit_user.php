<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "t-man");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $birthdate = $conn->real_escape_string($_POST['birthdate']);
    
    // Cek apakah password diubah
    if (!empty($_POST['password'])) {
        // Hash password baru
        $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT);
        $sql = "UPDATE data_akun SET 
                username = '$username',
                email = '$email', 
                birthdate = '$birthdate',
                password = '$password'
                WHERE id = $id";
    } else {
        // Jika password tidak diubah, update data lain saja
        $sql = "UPDATE data_akun SET 
                username = '$username',
                email = '$email', 
                birthdate = '$birthdate'
                WHERE id = $id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Ambil data user yang akan diedit
$id = $_GET['id'];
$sql = "SELECT * FROM data_akun WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="form-container">
        <h2>Edit User</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" value="<?php echo $row['username']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Birthdate:</label>
                <input type="date" name="birthdate" value="<?php echo $row['birthdate']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Password: (Kosongkan jika tidak ingin mengubah password)</label>
                <input type="password" name="password">
            </div>
            
            <button type="submit" class="btn">Update</button>
            <a href="admin.php" class="btn">Kembali</a>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>