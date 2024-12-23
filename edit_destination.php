<?php
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "t-man";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];



function handleFileUpload($file, $existing_file) {
    if(isset($file) && $file['error'] == 0) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $new_filename = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;
        
        if(in_array($file_extension, ["jpg", "jpeg", "png", "gif"])) {
            // Load the image
            $source_image = null;
            switch($file_extension) {
                case 'jpg':
                case 'jpeg':
                    $source_image = imagecreatefromjpeg($file["tmp_name"]);
                    break;
                case 'png':
                    $source_image = imagecreatefrompng($file["tmp_name"]);
                    break;
                case 'gif':
                    $source_image = imagecreatefromgif($file["tmp_name"]);
                    break;
            }

            if($source_image) {
                // Calculate dimensions for 16:9 ratio
                $src_width = imagesx($source_image);
                $src_height = imagesy($source_image);
                
                // Calculate target dimensions maintaining 16:9 ratio
                $target_width = 1280; // You can adjust this
                $target_height = round($target_width * (9/16));
                
                // Create target image
                $target_image = imagecreatetruecolor($target_width, $target_height);
                
                // Calculate cropping dimensions
                $src_ratio = $src_width / $src_height;
                $target_ratio = $target_width / $target_height;
                
                if($src_ratio > $target_ratio) {
                    $crop_width = round($src_height * $target_ratio);
                    $crop_height = $src_height;
                    $crop_x = round(($src_width - $crop_width) / 2);
                    $crop_y = 0;
                } else {
                    $crop_width = $src_width;
                    $crop_height = round($src_width / $target_ratio);
                    $crop_x = 0;
                    $crop_y = round(($src_height - $crop_height) / 2);
                }
                
                // Crop and resize
                imagecopyresampled(
                    $target_image, $source_image,
                    0, 0, $crop_x, $crop_y,
                    $target_width, $target_height,
                    $crop_width, $crop_height
                );
                
                // Save the image
                switch($file_extension) {
                    case 'jpg':
                    case 'jpeg':
                        imagejpeg($target_image, $target_file, 90);
                        break;
                    case 'png':
                        imagepng($target_image, $target_file, 9);
                        break;
                    case 'gif':
                        imagegif($target_image, $target_file);
                        break;
                }
                
                // Clean up
                imagedestroy($source_image);
                imagedestroy($target_image);
                
                return $target_file;
            }
        }
    }
    return $existing_file;
}

// Fetch existing destination data
$sql = "SELECT * FROM destinasi_wisata WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$destination = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $conn->real_escape_string($_POST['judul']);
    $lokasi_singkat = $conn->real_escape_string($_POST['lokasi_singkat']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
    $latitude = floatval($_POST['latitude']);
    $longitude = floatval($_POST['longitude']);
    $harga = $conn->real_escape_string($_POST['harga']);
    $lokasi_detail = $conn->real_escape_string($_POST['lokasi_detail']);
    $hari_buka = $conn->real_escape_string($_POST['hari_buka']);
    
    // Handle photo uploads
    $photo1 = handleFileUpload($_FILES['photo1'], $destination['photo1']);
    $photo2 = handleFileUpload($_FILES['photo2'], $destination['photo2']);
    $photo3 = handleFileUpload($_FILES['photo3'], $destination['photo3']);
    $photo4 = handleFileUpload($_FILES['photo4'], $destination['photo4']);
    $photo5 = handleFileUpload($_FILES['photo5'], $destination['photo5']);
    
    $sql = "UPDATE destinasi_wisata SET 
            judul = ?, 
            lokasi_singkat = ?,
            deskripsi = ?,
            latitude = ?,
            longitude = ?,
            photo1 = ?, 
            photo2 = ?, 
            photo3 = ?, 
            photo4 = ?, 
            photo5 = ?, 
            harga = ?,
            lokasi_detail = ?,
            hari_buka = ?
            WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("sssddssssssssi", 
            $judul,
            $lokasi_singkat,
            $deskripsi,
            $latitude,
            $longitude,
            $photo1,
            $photo2,
            $photo3,
            $photo4,
            $photo5,
            $harga,
            $lokasi_detail,
            $hari_buka,
            $id
        );
        
        if ($stmt->execute()) {
            echo "<script>
                alert('Data berhasil diupdate!');
                window.location.href = 'admin_destination.php';
            </script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <title>Edit Destinasi - T-man Admin</title>
</head>
<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">T-man Admin</span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="admin.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Users</span>
                </a>
            </li>
            <li class="active">
                <a href="admin_destination.php">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">Destinasi</span>
                </a>
            </li>
            <li>
                <a href="html/login.php" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Keluar</span>
                </a>
            </li>
        </ul>
    </section>

    <!-- CONTENT -->
    <section id="content">
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Edit Destinasi</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a href="admin_destination.php">Destinasi</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="#">Edit</a></li>
                    </ul>
                </div>
            </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Edit Destinasi</h3>
                    </div>
                    <div class="form-container">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="judul">Judul Destinasi</label>
                                <input type="text" id="judul" name="judul" value="<?php echo $destination['judul']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="lokasi_singkat">Lokasi Singkat</label>
                                <input type="text" id="lokasi_singkat" name="lokasi_singkat" value="<?php echo $destination['lokasi_singkat']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea id="deskripsi" name="deskripsi" rows="5" required><?php echo $destination['deskripsi']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="lokasi_detail">Lokasi Detail</label>
                                <input type="text" id="lokasi_detail" name="lokasi_detail" value="<?php echo $destination['lokasi_detail']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="hari_buka">Hari Buka</label>
                                <input type="text" id="hari_buka" name="hari_buka" value="<?php echo $destination['hari_buka']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Lokasi Map</label>
                                <div id="map" style="height: 300px; margin-bottom: 10px;"></div>
                                <input type="text" id="latitude" name="latitude" value="<?php echo $destination['latitude']; ?>" required readonly>
                                <input type="text" id="longitude" name="longitude" value="<?php echo $destination['longitude']; ?>" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="photo1">Foto 1 (Utama - Akan diatur ke rasio 16:9)</label>
                                <?php if($destination['photo1']): ?>
                                    <img src="<?php echo $destination['photo1']; ?>" alt="Current Photo 1" style="max-width: 200px;">
                                <?php endif; ?>
                                <input type="file" id="photo1" name="photo1" accept="image/*">
                                <small>Rekomendasi: Upload gambar dengan resolusi minimal 1280x720 piksel</small>
                            </div>
                            <div class="form-group">
                                <label for="photo2">Foto 2</label>
                                <?php if($destination['photo2']): ?>
                                    <img src="<?php echo $destination['photo2']; ?>" alt="Current Photo 2" style="max-width: 200px;">
                                <?php endif; ?>
                                <input type="file" id="photo2" name="photo2" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="photo3">Foto 3</label>
                                <?php if($destination['photo3']): ?>
                                    <img src="<?php echo $destination['photo3']; ?>" alt="Current Photo 3" style="max-width: 200px;">
                                <?php endif; ?>
                                <input type="file" id="photo3" name="photo3" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="photo4">Foto 4</label>
                                <?php if($destination['photo4']): ?>
                                    <img src="<?php echo $destination['photo4']; ?>" alt="Current Photo 4" style="max-width: 200px;">
                                <?php endif; ?>
                                <input type="file" id="photo4" name="photo4" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="photo5">Foto 5</label>
                                <?php if($destination['photo5']): ?>
                                    <img src="<?php echo $destination['photo5']; ?>" alt="Current Photo 5" style="max-width: 200px;">
                                <?php endif; ?>
                                <input type="file" id="photo5" name="photo5" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga Tiket</label>
                                <input type="text" id="harga" name="harga" value="<?php echo $destination['harga']; ?>" required>
                            </div>
                            <div class="form-actions">
                                <button type="submit">Update Destinasi</button>
                                <a href="admin_destination.php" class="btn-cancel">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </section>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([<?php echo $destination['latitude']; ?>, <?php echo $destination['longitude']; ?>], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var marker = L.marker([<?php echo $destination['latitude']; ?>, <?php echo $destination['longitude']; ?>]).addTo(map);

        map.on('click', function(e) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker(e.latlng).addTo(map);
            document.getElementById('latitude').value = e.latlng.lat.toFixed(6);
            document.getElementById('longitude').value = e.latlng.lng.toFixed(6);
        });
    </script>
    <script src="js/admin.js"></script>
</body>
</html>

<?php
$conn->close();
?>