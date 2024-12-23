<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $nama_destinasi = $_POST['nama_destinasi'];
    
    $sql = "INSERT INTO tiket (username, nama_destinasi) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $nama_destinasi);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Tiket berhasil dibeli!";
        header("Location: ticket.php");
        exit();
    } else {
        $_SESSION['error'] = "Gagal membeli tiket: " . $conn->error;
        header("Location: destination_detail.php?id=" . $_POST['destinasi_id']);
        exit();
    }
}
?>