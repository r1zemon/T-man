<?php
session_start();
require 'connect.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $destinasi_id = $_POST['destinasi_id'];
    $harga_satuan = $_POST['harga_satuan'];
    $jumlah_tiket = 1; // Anda dapat menambahkan input jumlah tiket jika diperlukan
    $total_harga = $harga_satuan * $jumlah_tiket;
    $user_id = $_SESSION['user_id'];
    $status_tiket = 'Active';

    $sql = "INSERT INTO tiket (destinasi_id, jumlah_tiket, harga_satuan, total_harga, user_id, status_tiket) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiddis", $destinasi_id, $jumlah_tiket, $harga_satuan, $total_harga, $user_id, $status_tiket);
    
    if ($stmt->execute()) {
        header('Location: ticket.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>