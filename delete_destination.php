<?php
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "t-man";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // First get the destination details to delete associated images
    $sql = "SELECT photo1, photo2, photo3, photo4, photo5 FROM destinasi_wisata WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $destination = $result->fetch_assoc();
    
    // Delete the images from the server
    $photos = ['photo1', 'photo2', 'photo3', 'photo4', 'photo5'];
    foreach ($photos as $photo) {
        if (!empty($destination[$photo]) && file_exists($destination[$photo])) {
            unlink($destination[$photo]);
        }
    }
    
    // Delete the record from the database
    $sql = "DELETE FROM destinasi_wisata WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>
            alert('Destinasi berhasil dihapus!');
            window.location.href = 'admin_destination.php';
        </script>";
    } else {
        echo "<script>
            alert('Error menghapus destinasi: " . $stmt->error . "');
            window.location.href = 'admin_destination.php';
        </script>";
    }
} else {
    header("Location: admin_destination.php");
}

$conn->close();
?>