<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Silakan login terlebih dahulu']);
    exit();
}

$conn = new mysqli("localhost", "root", "", "t-man");
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Koneksi database gagal']);
    exit();
}

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $destinasi_id = isset($_POST['destinasi_id']) ? (int)$_POST['destinasi_id'] : 0;
    $jumlah_tiket = isset($_POST['jumlah_tiket']) ? (int)$_POST['jumlah_tiket'] : 0;
    $harga_satuan = isset($_POST['harga_satuan']) ? (int)$_POST['harga_satuan'] : 0;
    $total_harga = $jumlah_tiket * $harga_satuan;

    if ($destinasi_id <= 0 || $jumlah_tiket <= 0 || $harga_satuan <= 0) {
        $response['message'] = 'Data tidak valid';
    } else {
        $sql = "INSERT INTO tiket (user_id, destinasi_id, jumlah_tiket, harga_satuan, total_harga, tanggal_pembelian) 
                VALUES (?, ?, ?, ?, ?, NOW())";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiiii", $user_id, $destinasi_id, $jumlah_tiket, $harga_satuan, $total_harga);
        
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Pembelian tiket berhasil';
        } else {
            $response['message'] = 'Gagal menyimpan data tiket';
        }
        
        $stmt->close();
    }
}

$conn->close();
echo json_encode($response);
?>