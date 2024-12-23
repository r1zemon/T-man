<?php
// Database connection configuration
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "t-man";

// Create database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


function handleFileUpload($file) {
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
    return null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kategori = $conn->real_escape_string($_POST['kategori']);
    $judul = $conn->real_escape_string($_POST['judul']);
    $lokasi_singkat = $conn->real_escape_string($_POST['lokasi_singkat']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
    $latitude = floatval($_POST['latitude']);
    $longitude = floatval($_POST['longitude']);
    $harga = $conn->real_escape_string($_POST['harga']);
    $lokasi_detail = $conn->real_escape_string($_POST['lokasi_detail']);
    $hari_buka = $conn->real_escape_string($_POST['hari_buka']);
    
    // Handle photo uploads
    $photo1 = handleFileUpload($_FILES['photo1']);
    $photo2 = handleFileUpload($_FILES['photo2']);
    $photo3 = handleFileUpload($_FILES['photo3']);
    $photo4 = handleFileUpload($_FILES['photo4']);
    $photo5 = handleFileUpload($_FILES['photo5']);
    
    $sql = "INSERT INTO destinasi_wisata (
        kategori,
        judul, 
        lokasi_singkat,
        deskripsi,
        latitude,
        longitude,
        photo1, 
        photo2, 
        photo3, 
        photo4, 
        photo5, 
        harga,
        lokasi_detail,
        hari_buka
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ssssddssssssss", 
            $kategori,
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
            $hari_buka
        );
        
        if ($stmt->execute()) {
            echo "<script>alert('Data berhasil disimpan!');</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    }
}

// Fetch existing destinations
$sql = "SELECT * FROM destinasi_wisata ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <title>T-man Admin</title>
    <style>
        .destination-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .destination-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
        }
        .destination-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 4px;
        }
        .form-actions {
            margin-top: 20px;
        }
        .form-actions button {
            padding: 10px 20px;
            background-color: #3C91E6;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
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
                <a href="#">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">Destinasi</span>
                </a>
            </li>
            <li>
                <a href="login.php" class="logout">
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
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="#">Destinasi</a></li>
                    </ul>
                </div>
            </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Tambah Destinasi Baru</h3>
                    </div>
                    <div class="form-container">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="judul">Judul Destinasi</label>
                                <input type="text" id="judul" name="judul" required>
                            </div>
                            <div class="form-group">
                                <label for="lokasi_singkat">Lokasi Singkat</label>
                                <input type="text" id="lokasi_singkat" name="lokasi_singkat" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea id="deskripsi" name="deskripsi" rows="5" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="lokasi_detail">Lokasi Detail</label>
                                <input type="text" id="lokasi_detail" name="lokasi_detail" required>
                            </div>
                            <div class="form-group">
                                <label for="hari_buka">Hari Buka</label>
                                <input type="text" id="hari_buka" name="hari_buka" required>
                            </div>
                            <div class="form-group">
                                <label>Lokasi Map</label>
                                <div id="map" style="height: 300px; margin-bottom: 10px;"></div>
                                <input type="text" id="latitude" name="latitude" placeholder="Latitude" required readonly>
                                <input type="text" id="longitude" name="longitude" placeholder="Longitude" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="photo1">Foto 1 (Utama - Akan diatur ke rasio 16:9)</label>
                                <input type="file" id="photo1" name="photo1" accept="image/*" required>
                                <small>Rekomendasi: Upload gambar dengan resolusi minimal 1280x720 piksel</small>
                            </div>
                            <div class="form-group">
                                <label for="photo2">Foto 2</label>
                                <input type="file" id="photo2" name="photo2" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="photo3">Foto 3</label>
                                <input type="file" id="photo3" name="photo3" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="photo4">Foto 4</label>
                                <input type="file" id="photo4" name="photo4" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="photo5">Foto 5</label>
                                <input type="file" id="photo5" name="photo5" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga Tiket</label>
                                <input type="text" id="harga" name="harga" required>
                            </div>
                            <div class="form-actions">
                                <button type="submit">Simpan Destinasi</button>
                            </div>
                                                        <!-- Di bagian form pada admin_destination.php -->
                            <div class="form-group">
                                <label for="kategori">Kategori Wisata</label>
                                <select id="kategori" name="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Sejarah">Sejarah</option>
                                    <option value="Makanan">Makanan</option>
                                    <option value="Alam">Alam</option>
                                    <option value="Hiburan">Hiburan</option>
                                </select>
                            </div>
                            <!-- Sisa form tetap sama -->
                        </form>
                    </div>
                </div>
            </div>

            <!-- Display existing destinations -->
            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Daftar Destinasi</h3>
                    </div>
                    <div class="destination-grid">
    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="destination-card">
                <img src="<?php echo $row['photo1']; ?>" alt="<?php echo $row['judul']; ?>">
                <h3><?php echo $row['judul']; ?></h3>
                <p>Harga: <?php echo $row['harga']; ?></p>
                <p><?php echo $row['lokasi_singkat']; ?></p>
                <div class="action-buttons">
                    <a href="edit_destination.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                    <a href="delete_destination.php?id=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus destinasi ini?')">Delete</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Belum ada destinasi wisata.</p>
    <?php endif; ?>
</div>
                </div>
            </div>
        </main>
    </section>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-7.7956, 110.3695], 10);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var marker;
        map.on('click', function(e) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker(e.latlng).addTo(map);
            document.getElementById('latitude').value = e.latlng.lat.toFixed(6);
            document.getElementById('longitude').value = e.latlng.lng.toFixed(6);
        });
    </script>

// Di bagian bawah file sebelum </body>
<script>
document.getElementById('photo1').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Cek apakah sudah ada preview sebelumnya
            let preview = document.querySelector('.photo1-preview');
            if (!preview) {
                preview = document.createElement('div');
                preview.className = 'image-preview photo1-preview';
                const img = document.createElement('img');
                preview.appendChild(img);
                e.target.parentNode.appendChild(preview);
            }
            preview.querySelector('img').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>

    <script src="js/admin.js"></script>
</body>
</html>

<?php
$conn->close();
?>