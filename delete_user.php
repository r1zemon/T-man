<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "t-man");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM data_akun WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: admin.php");
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
