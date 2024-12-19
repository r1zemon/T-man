<?php
$conn = new mysqli("localhost", "root", "", "t-man"); // ganti nama_database_anda dengan nama database Anda

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>