-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2024 at 12:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `t-man`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_akun`
--

CREATE TABLE `data_akun` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_akun`
--

INSERT INTO `data_akun` (`id`, `username`, `email`, `birthdate`, `password`) VALUES
(3, 'haikal', 'haikal@gmail.com', '2024-12-19', '$2y$10$FXk5sFxHhJYheL/TITtsO.BggYRCrdNkqGKTUbp3ev/a24C5FJsZi'),
(4, '123', '123@gmail.com', '2024-12-06', '$2y$10$kBN0eS4.XswKVtXFfw8vduOoYfPZqF/Vu6532aRrRoqnf1uRPgOni'),
(5, 'aisra', 'aisra@gmail.com', '2024-12-14', '$2y$10$EBbwUTE01PmQTleeY49B9u3JFj/8qAkO59I/TXAqnZHJUdgZr.xyi'),
(6, 'aisra', 'aisra@gmail.com', '2024-12-14', '$2y$10$BxPdDNb1vCG/zOFsOvjZm.kj6NrTdRtAjMOxGMb9D7ISs9B.gmPja'),
(7, 'rain', 'rain@gmail.com', '2005-03-24', '$2y$10$k9zZFdbVFLEq28mVmEoeRe7eZ1HO8u7nRTJlF21UVyzJO6pyrDI8K'),
(8, 'ais', 'ais@gmail.com', '2024-12-11', '$2y$10$Zwiam06qajXuhAqjMz7TYOI6mHN1DycuAl.JO9eMgN8PrSFqlRBEi'),
(9, 'uii', 'uii@gmail.com', '2024-12-26', '$2y$10$tpgD2GU11YXwBK10h545NO61Bcge8bZuq6phIrVwS5ix44c2xCXoy'),
(10, 'jia', 'jia@gmail.com', '2024-12-12', '$2y$10$9X/ezPjtteJ3FBSe36cuP.HXWMTyrGUd33htyipqdNUCYhBl8Lcem'),
(11, 'kaffa', 'kaffa@gmail.com', '2024-12-19', '$2y$10$wmpwdB2T.QRoy2rkF5I9Ge1U0SuXlxrrruduax3Gwtl/vVWYw.62O'),
(12, 'kelvin', 'kelvin@gmail.co.id', '2024-11-30', '$2y$10$YdCeREqehn9O0aYV2kUMHe3aUqfQ2tUO.veQoY1snMr5olml8Yude'),
(13, 'cindi cantik', 'syauqifikri2005@gmail.com', '2024-12-05', '$2y$10$9gCiTkhoJCBTC7Kbn.Ssdu/Lnnwy6R6fAZLSF8asA3CSKqT2n1F5u'),
(14, 'Jiaa', 'jiaa@gmail.com', '2024-11-28', '$2y$10$tRxj1GOkVFWbfVC8HxqrFOZDHz2ZnbUuJttduOaXfdPck5MlDJhRG');

-- --------------------------------------------------------

--
-- Table structure for table `destinasi_wisata`
--

CREATE TABLE `destinasi_wisata` (
  `id` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `lokasi_singkat` text NOT NULL,
  `deskripsi` text NOT NULL,
  `photo1` varchar(255) DEFAULT NULL,
  `photo2` varchar(255) DEFAULT NULL,
  `photo3` varchar(255) DEFAULT NULL,
  `photo4` varchar(255) DEFAULT NULL,
  `photo5` varchar(255) DEFAULT NULL,
  `harga` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `latitude` decimal(10,6) DEFAULT NULL,
  `longitude` decimal(10,6) DEFAULT NULL,
  `hari_buka` varchar(255) NOT NULL,
  `lokasi_detail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinasi_wisata`
--

INSERT INTO `destinasi_wisata` (`id`, `kategori`, `judul`, `lokasi_singkat`, `deskripsi`, `photo1`, `photo2`, `photo3`, `photo4`, `photo5`, `harga`, `created_at`, `latitude`, `longitude`, `hari_buka`, `lokasi_detail`) VALUES
(33, 'Hiburan', 'Bhumi Merapi', 'Jl. Kaliurang No.Km.20', 'Yogyakarta, yang dikenal sebagai Kota Pelajar dan Kota Budaya, juga memiliki reputasi sebagai kota wisata. Kota yang terkenal dengan hidangan Gudeg ini menawarkan berbagai destinasi wisata menarik, mulai dari wisata alam, budaya, sejarah, hingga edukasi. Salah satu destinasi edukasi yang layak dikunjungi di Jogja adalah Agrowisata Bhumi Merapi.Terletak di kaki Gunung Merapi, Agrowisata Bhumi Merapi mengusung konsep wisata edukasi. Dengan luas area sekitar 5,2 hektar, tempat ini resmi dibuka pada 20 Desember 2015 dan hingga kini selalu ramai dikunjungi wisatawan. Di sini, pengunjung tidak hanya dapat menikmati wisata tetapi juga belajar tentang peternakan, pertanian, dan perkebunan. Suasana sejuk di kawasan ini menambah kenyamanan para pengunjung.Beragam aktivitas bisa dilakukan di Agrowisata Bhumi Merapi. Di bidang peternakan, pengunjung dapat belajar memerah susu kambing etawa, memberikan susu botol pada anak kambing, mengolah susu menjadi berbagai produk, hingga memanfaatkan kotoran kambing menjadi pupuk organik dan biogas. Selain itu, ada juga kegiatan budidaya kelinci, seperti memberi makan dan merawatnya. Pengunjung juga dapat berinteraksi dengan reptil dan mamalia lain seperti ular, kura-kura, ikan, dan rusa.Di bidang pertanian dan perkebunan, Agrowisata Bhumi Merapi menawarkan pengalaman belajar tentang budidaya tanaman hidroponik. Hasil panen dari sistem ini juga bisa dibeli oleh pengunjung. Selain edukasi, tempat ini menyediakan pendampingan usaha bagi mereka yang tertarik untuk terjun di bidang peternakan, pertanian, atau perkebunan.Tak hanya itu, daya tarik lainnya termasuk area camping dan outbound. Penyewaan peralatan camping dibanderol dengan tarif Rp 650.000, yang sudah mencakup berbagai fasilitas. Pengunjung juga bisa menyewa mobil jeep dengan tarif Rp 150.000 per mobil (kapasitas 5–6 orang) untuk berkeliling area agrowisata dan Kali Kuning.Bagi yang gemar berfoto, terdapat banyak spot menarik di Agrowisata Bhumi Merapi', 'uploads/676928149b41a.jpg', 'uploads/67692814c8b6d.jpeg', 'uploads/67692814e8a2a.jpg', 'uploads/67692815215ed.jpg', 'uploads/6769281545195.jpeg', 'IDR 35.000', '2024-12-23 09:06:29', -7.681324, 110.419318, 'Setiap Hari - 09:00 - 17:00', 'Jl. Kaliurang No.Km.20, Sawungan, Hargobinangun, Kec. Pakem, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55582'),
(35, 'Sejarah', 'Ullen Sentalu', 'Jl. Boyong No.KM 25', 'Selamat datang di Museum Ullen Sentalu yang terletak di kaki triangulasi gunung Turgo, Merapi dan Plawangan. Museum yang memadukan keindahan alam pegunungan dan kebesaran kebudayaan Jawa. Kunjungan Anda akan terbagi menjadi dua: Tur Dipandu (Guided Tour) yang akan ditemani oleh Kurator dan Tur Bebas (Free Tour) yang Anda lakukan sendiri. Pembagian ini dimaksudkan untuk menjamin aspek pendidikan (educational/ learning) dalam kunjungan Anda dan tidak hanya sekedar tamasya (entertainment/ leisure). Melalui Kurator, Anda juga dapat bertanya langsung yang akan lebih lengkap dibandingkan interaksi lewat touch-stone screen atau keterangan pada caption/ label museum. Perlu dipahami bahwa sebagian besar koleksi kami adalah warisan budaya tak-benda (intangible heritage) yang diabadikan dalam bentuk lukisan naratif, sehingga tidak dapat didokumentasikan oleh pengunjung sebagaima lukisan portrait pada umumnya.Keindahan alam pegunungan Kaliurang yang berhawa sejuk tidak hanya menampilkan keindahan flora dan fauna yang beragam tapi juga menyimpan nilai filosofis yang membentang mulai dari Mataram Kuno hingga Mataram Kini. Rute Andesit yang membentang dari Candi Borobudur di Barat dan kompleks Candi Prambanan di Timur lewat jalan desa Pondoh dan Turi merupakan warisan budaya Mataram Kuno yang terkenal dengan bangunan Candi berbahan batu gunung (batu andesit). Sedangkan posisi di kaki Gunung Merapi yang merupakan ujung Utara dari poros imajiner makro-kosmologi Mataram Kini yang membentang hingga Laut Selatan di ujung Selatan. Selamat menikmati waktu Anda dalam menelusuri kisah peradaban Mataram yang  adiluhung ditengah balutan udara pegunungan yang sejuk Menapakkan kaki di kawasan Museum Ullen Sentalu terasa balutan hawa sejuk (15-25° Celcius) dan suasana hening yang menyatu dengan alam pegunungan disekitranya yang sekaligus memberikan rasa damai serta khidmat. Area seluas 1,2 hektar yang dikembangkan secara bertahap tersebut bernama nDalem Kaswargan atau Rumah Surga, dimana Museum Ullen Sentalu berada. Jalan masuk menuju ruang pamer museum maupun artshop dan restoran  berupa kelokan, undakan, serta labirin akan memberikan nuansa nostalgia, perenungan dan keindahan. Beberapa bagian bangunan dan unsur yang melengkapinya, seperti gapura, dinding tembok, taman, kolam, mencerminkan keagungan budaya leluhur yang sudah ada sejak masa silam. Berbagai jenis unsur bangunan Jawa terlihat pada layout dan struktur bangunan bergaya Indis dan post-mo yang bersatu-padu menciptakan harmoni secara menakjubkan. Koleksi berupa lukisan dan foto foto tokoh sejarah budaya Mataram Islam, kain batik vorstenlanden, karya sastra,  arca arca kebudayaan Hindu Buddha, dan koleksi etnografi era Mataram Islam. Itu membingkai kisah sosial ekonomi politik seni sejarah dan budaya Jawa, terutama kisah para putri di kraton Mataram yang tidak banyak dikisahkan kepada masyarakat awam.', 'uploads/67693028a975b.jpg', 'uploads/67693028de1c5.jpg', 'uploads/67693029148e6.jpeg', 'uploads/6769302934d7d.jpeg', 'uploads/6769302957465.jpeg', 'IDR 50.000', '2024-12-23 09:40:57', -7.596595, 110.433854, 'Selasa 08:30 - 17:00 | Rabu - Minggu 08:30 - 15:00', 'Jl. Boyong No.KM 25, Kaliurang, Hargobinangun, Kec. Pakem, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55582'),
(36, 'Sejarah', 'Candi Prambanan', 'Jl. Raya Solo - Yogyakarta No.16', 'Kompleks Candi Prambanan di Dusun Karangasem, Desa Bokoharjo, Kecamatan Prambanan, Kabupaten Sleman. Kompleks Candi Prambanan merupakan kompleks candi Hindhu terbesar di Jawa, yang mempunyai tiga bangnan candi utama dengan dikelilingi 244 buah candi perwara. Pada waktu ditemukan kembali pada tahun 1733 oleh C.A. Lons kompleks candi tersebut dalam keadaan runtuh. Upaya pemugaran untuk pertama kalinya terhadap kompleks candi dimulai pada tahun 1937. Menurut prasasti Siwagrha yang ditemukan di Kompleks Candi Prambanan dan dianggap meimiliki hubungan dengan Candi Prambanan, disebutkan bahwa kompleks candi tersebut didirikan pada tahun 778 Saka (856 Masehi ) di bawah pemerintahan Sri Maharaja Rakai Pikatan. Kompleks candi ini menempati area seluas 39,8 Hektar. Seluruh kompleks tersebut dibagi menjadi tiga halaman, masing-masing halaman dipisahkan oleh pagar keliling dengan pintu masuk terdapay di setiap penjuru mata angina. Halaman pertama merupakan halaman pusat dimana terdapat tiga candi utama, tiga candi wahana, dua candi kelir, dan delapan candi pathok. Halaman kedua berisi candi perwara yang berjumlah 224 candi. Halaman ketiga merupakan halaman paling luar tidak memiliki bangunan candi. Candi Prambanan merupakan kompleks candi Hindhu terbesar dan terindah di Pulau Jawa. Gaya arsitektur dan ragam hias di kompleks candi ini dibuat dengan sangat indah, sehingga dapat menarik minat wisatawan untuk berkunjung. Di samping itu, Kompleks Candi Prambanan juga bias dijadikan sumber bagi perkembangan ilmu pengetahuan.', 'uploads/6769336bdd84c.jpg', 'uploads/6769336c27179.jpg', 'uploads/6769336c572c5.jpg', 'uploads/6769336c93f70.jpg', 'uploads/6769336cd20c9.jpg', 'IDR 50.000', '2024-12-23 09:54:53', -7.752462, 110.492929, 'Setiap Hari - 06:30 - 17:00', 'Jl. Raya Solo - Yogyakarta No.16, Kranggan, Bokoharjo, Kec. Prambanan, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55571'),
(37, 'Sejarah', 'Museum Monjali', 'Jl. Ring Road Utara, Jongkang', 'Museum Monumen Yogya Kembali, atau yang dikenal sebagai Monumen Jogja Kembali (disingkat Monjali), merupakan museum sejarah perjuangan kemerdekaan Indonesia yang terletak di Daerah Istimewa Yogyakarta. Museum ini berada di bawah pengelolaan Kementerian Pariwisata dan Ekonomi Kreatif. Terletak di bagian utara kota Yogyakarta, Monjali menjadi destinasi populer, terutama bagi para pelajar yang mengunjunginya dalam rangka kegiatan darmawisata. Museum ini memiliki bentuk bangunan unik berupa kerucut dengan tiga lantai, dilengkapi perpustakaan dan ruang serbaguna. Di bagian rana pintu masuk museum, terdapat  ukiran 422 nama pahlawan yang gugur di daerah Wehrkreise III (RIS) selama periode 19 Desember 1948 hingga 29 Juni 1949. Di lantai pertama, museum ini memiliki empat ruang yang menyimpan berbagai koleksi bersejarah, seperti relief, replika, foto, dokumen, heraldika, senjata, serta representasi dapur umum yang menggambarkan suasana perang kemerdekaan 1945–1949. Salah satu koleksi yang menarik perhatian adalah tandu dan dokar (kereta kuda) yang pernah digunakan oleh Panglima Besar Jenderal Soedirman, yang ditempatkan di ruang museum nomor 2. Monumen Yogya Kembali berlokasi di Jalan Ring Road Utara, Kabupaten Sleman, Daerah Istimewa Yogyakarta, dan menjadi tempat yang memadukan unsur sejarah, edukasi, dan patriotisme.', 'uploads/6769358a44f03.jpg', 'uploads/6769358a613f5.jpeg', 'uploads/6769358a7266f.jpeg', 'uploads/6769358a83c16.jpeg', 'uploads/6769358a95bbe.jpeg', 'IDR 15.000', '2024-12-23 10:03:54', -7.756391, 110.368901, 'Selasa - Minggu 08:00 - 16:00', 'Jl. Ring Road Utara, Jongkang, Sariharjo, Kec. Ngaglik, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55581'),
(38, 'Makanan', 'Voucher Tempo Gelato', 'Kaliurang St No.KM.5 ', 'Tempo Gelato adalah salah satu kedai gelato paling terkenal dan populer di Yogyakarta, yang wajib masuk dalam daftar destinasi kuliner kamu saat berkunjung ke kota ini. Dengan berbagai cabang yang tersebar di lokasi strategis seperti Jalan Prawirotaman, Jalan Kaliurang, dan Tamansiswa, Tempo Gelato menawarkan pengalaman yang tak hanya memanjakan lidah tetapi juga mata. Setibanya di salah satu cabangnya, pengunjung akan disambut dengan suasana khas yang begitu autentik. Gaya interiornya mengusung konsep industrial dan vintage yang membuat setiap sudut ruangan terasa unik dan menarik. Dinding bata ekspos, lantai berpola klasik, serta penggunaan furnitur kayu dan besi menjadi daya tarik tersendiri, menghadirkan atmosfer \\\"tempo dulu\\\" yang begitu memikat. Tidak hanya itu, tempatnya dirancang dengan ruang yang luas dan ventilasi yang baik sehingga terasa sejuk dan nyaman untuk bersantai bersama teman, keluarga, atau bahkan pasangan. Berbagai sudutnya juga sangat Instagramable, menjadikannya tempat yang ideal untuk berfoto dan berbagi momen di media sosial. Salah satu alasan utama pengunjung jatuh hati pada Tempo Gelato adalah ragam rasa gelato dan sorbet yang ditawarkan. Dengan lebih dari 30 jenis rasa, kedai ini mampu memenuhi berbagai preferensi selera, baik untuk pecinta rasa klasik maupun mereka yang ingin mencoba rasa unik dan eksperimental. Pilihan rasa yang tersedia mencakup karamel, nutella, mint, matcha, jahe, stroberi, kopi, coconut choco, white peach, lollipop, hingga rasa khas Indonesia seperti kemangi. Selain itu, sorbet di Tempo Gelato juga menjadi favorit karena karakter rasanya yang lebih segar dan cocok dinikmati pada hari-hari panas di Yogyakarta. Keunikan lain dari Tempo Gelato adalah sistem penyajiannya yang memungkinkan pelanggan memilih rasa favorit mereka dan menikmatinya dalam cone atau cup. Dengan harga yang cukup terjangkau untuk kualitas premium, Tempo Gelato menawarkan pengalaman mencicipi gelato yang benar-benar memanjakan. Tidak heran jika kedai ini selalu ramai oleh pengunjung lokal maupun wisatawan, terutama pada akhir pekan atau musim liburan. Apabila kamu mencari tempat yang bisa memberikan pengalaman kuliner sekaligus suasana yang nyaman dan penuh estetika, Tempo Gelato adalah pilihan yang sangat tepat. Pastikan untuk datang lebih awal agar tidak perlu mengantri terlalu lama, dan jangan lupa eksplor setiap sudutnya untuk mendapatkan foto terbaik yang bisa kamu abadikan!', 'uploads/67693849dd506.jpg', 'uploads/6769384a0aec7.jpg', 'uploads/6769384a51242.jpg', 'uploads/6769384a715dc.jpg', 'uploads/6769384a966b9.jpg', 'IDR 35.000', '2024-12-23 10:15:38', -7.763131, 110.379250, 'Setiap Hari - 09:00 - 22:30', 'Kaliurang St No.KM.5 No.98, Kocoran, Sinduadi, Mlati, Sleman Regency, Special Region of Yogyakarta 55284'),
(39, 'Alam', 'Kali Kuning Park', 'Jl. Bebeng, Pangukrejo', 'Kali Kuning adalah sebuah sungai atau kali yang terletak di bagian timur Kota Yogyakarta.[1] Sungai ini memiliki panjang sekitar 40 km, serta berhulu di puncak Gunung Merapi. Sungai ini mengalir melalui 5 kapanewon di Kabupaten Sleman, antara lain, Pakem, Cangkringan, Ngemplak, Kalasan, dan Berbah; serta 2 kapanewon di Kabupaten Bantul, yaitu Banguntapan dan Pleret yang menjadi hilir Kali Kuning ini, di sini Kali Kuning menjadi satu dengan Kali Opak. Karena Kali Kuning berhulu langsung di kawah Gunung Merapi, secara otomatis akan menjadi lintasan lahar ketika Gunung Merapi bererupsi, sehingga berdampak langsung terhadap segala sesuatu berada di pinggir sungai, termasuk Candi Kadisoka dan Candi Sambisari yang terkubur beberapa meter oleh material lahar dingin.', 'uploads/67693a1b99a71.jpg', 'uploads/67693a1bb6a3f.jpg', 'uploads/67693a1bda83d.jpg', 'uploads/67693a1bec679.jpg', 'uploads/67693a1c089b8.jpg', 'IDR 5.000', '2024-12-23 10:23:24', -7.616264, 110.431021, 'Setiap Hari - 08:00 - 17:00', 'Jl. Bebeng, Pangukrejo, ngrangkah, RT.01/RW.04, Palemsari, Umbulharjo, Kec. Cangkringan, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55583'),
(40, 'Makanan', 'Kopi Klotok', ' Jalan Kaliurang No.KM.16', 'Warung Kopi Klotok Jogja menjadi salah satu destinasi wisata kuliner yang ramai pengunjung. Tak jarang sobat harus rela antre jika datang di akhir pekan, karena warung sederhana yang berada di daerah Kaliurang ini digemari hampir tiap kalangan buat tempat nongkrong. Saat datang ke Warung Kopi Klotok, sobat akan langsung disambut dengan bangunan tradisional khas Jawa. Sesuai namanya, tempat makan ini mengusung konsep warung sederhana dengan bangunan joglo tradisional, lengkap dengan furnitur antik tertata di dalamnya. Namun, di balik bangunan tradisional tersebut, tersimpan aneka menu makanan dan minuman lezat yang bikin sobat pengen nambah lagi dan lagi. Menyeruput kopi hangat sambil makan gorengan akan terasa lebih nikmat, karena didukung suasana asri dengan hamparan sawah di sekitar bangunan. Instagramable banget deh pokoknya! Inilah yang menjadi alasan mengapa Warung Kopi Klotok nyaris tidak pernah sepi pengunjung. Perjuangan sobat setelah antre panjang akan terbayarkan dengan lezatnya hidangan yang dipesan dan pemandangan alam yang sedap dipandang.', 'uploads/67693b93bc2be.jpg', 'uploads/67693b93deec8.jpg', 'uploads/67693b940c998.jpg', 'uploads/67693b942f041.jpg', 'uploads/67693b9446131.jpg', 'IDR 50.000', '2024-12-23 10:29:40', -7.662253, 110.397483, 'Setiap Hari - 07:00 - 22:00', ' Jalan Kaliurang No.KM.16, Area Sawah, Pakembinangun, Kec. Pakem, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55582'),
(41, 'Makanan', 'Kopi Merapi', 'Kepuharjo, Cangkringan', 'Kopi Merapi adalah satu peninggalan kolonial Belanda. Mungkin di sekitar tahun 1930-an ia mulai ditanam, tapi baru belakangan setelah erupsi gunung Merapi pada 2010 tempat ini menjadi omongan dan belakangan jadi tujuan wisata. Kopi yang ditanam di lereng Gunung Merapi, Sleman, Yogyakarta ini bukan cuma mengharumkan nama kopi Nusantara, namun juga menjadi catatan bangkitnya perekonomian penduduk lokal dari erupsi besar-besaran yang terjadi 10 tahun lalu. Kini saat liburan ke kawasan Kaliurang dan sekitarnya, ada satu warung kopi yang tak boleh dilewatkan. Kopi Merapi, begitu namanya, terletak di Dusun Petung, Kepuharjo, Cangkringan, Kabupaten Sleman. Di warung ini pengunjung dapat menikmati seduhan biji kopi yang ditanam langsung di tanah vulkanik lereng Merapi, baik jenis arabika maupun robusta.', 'uploads/676941838ffe2.jpg', 'uploads/67693cc83bfc6.jpg', 'uploads/67693cc85ea21.jpg', 'uploads/67693cc87dc2b.jpg', 'uploads/67693cc89b9b6.jpg', 'IDR 50.000', '2024-12-23 10:34:48', 0.000000, 0.000000, 'Setiap Hari - 08:00 - 00:00', 'Kepuharjo, Cangkringan, Petung, Kepuharjo, Kec. Cangkringan, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55583'),
(42, 'Alam', 'Gardu Pandang', 'Kaliurang, Hargobinangun', 'Gardu Pandang Kaliurang berada di kaki Gunung Merapi, tepatnya di ketinggian 900 mdpl, berdasarkan informasi dari situs Visiting Jogja. Oleh sebab itu, kawasan wisata ini memiliki udara sejuk khas dataran tinggi. Wisatawan akan menjumpai tiga gardu pandang yang berada di lokasi paling strategis untuk menyaksikan panorama Gunung Merapi. Dari puncak tiga gardu tersebut, pengunjung bisa menyaksikan kegagahan Gunung Merapi tanpa penghalangan apapun. Selain panorama Gunung Merapi, wisatawan juga bisa menyaksikan pemandangan Bukit Turgo dari menara pengamatan berlantai dua tersebut. Selain panorama yang indah, Gardu Pandang Kaliurang juga dilengkapi dengan area bermain untuk anak-anak. Ada sejumlah wahana permainan untuk anak-anak, seperti bianglala, jungkat-jungkit, perosotan, dan sebagainya yang dapat diakses secara gratis oleh pengunjung.', 'uploads/67693e6bbf781.jpg', 'uploads/67693e6bdea4b.jpg', 'uploads/67693e6c0ba8a.jpg', 'uploads/67693e6c2c6ed.jpg', 'uploads/67693e6c4d3d7.jpg', 'IDR 10.000', '2024-12-23 10:41:48', -7.604422, 110.432466, 'Setiap Hari - 05:00 - 22:00', 'Kaliurang, Hargobinangun, Pakem, Sleman Regency, Special Region of Yogyakarta 55582'),
(43, 'Alam', 'Ledok Sambi', 'Kaliurang St No.KM. 19,2', 'Salah satu daya tarik utama dari Ledok Sambi adalah menawarkan suasana alam yang hijau dan asri. Hal ini membuat sejumlah wisatawan yang datang ke Ledok Sambi hanya ingin bersantai sambil healing sejenak. Selain menikmati udara segar, kamu juga bisa bermain di pinggiran sungai. Tenang saja, air yang mengalir cukup tenang sehingga kamu bisa ke tengah-tengah. Namun tetap hati-hati karena terdapat batu kali yang licin.', 'uploads/6769403af2e67.jpg', 'uploads/6769403b4dfc4.jpg', 'uploads/6769403b91d30.jpg', 'uploads/6769403be0f04.jpg', 'uploads/6769403c2e701.jpg', 'IDR 50.000', '2024-12-23 10:49:32', -7.612793, 110.416337, 'Setiap Hari - 09:30 - 16:30', 'Kaliurang St No.KM. 19,2, Area Sawah, Pakembinangun, Pakem, Sleman Regency, Special Region of Yogyakarta 55582'),
(45, 'Hiburan', 'Plaza Ambarukmo', ' Jl. Laksda Adisucipto No.80', 'Plaza Ambarrukmo menjadi sebuah pusat perbelanjaan terbesar di Yogyakarta yang akan memberikan pengalaman berbelanja terbaik untuk semua orang. Lebih dari satu dekade berdiri, mall yang juga populer dengan sebutan Amplaz ini terus beradaptasi untuk mengikuti perkembangan tren yang ada. Salah satunya adalah menghadirkan beragam pilihan Plaza Ambarrukmo tenant yang terdiri dari kuliner, hiburan, fashion, hingga kebutuhan rumah tangga. Plaza Ambarrukmo tenant tersebar dalam tujuh lantai ditambah dengan berbagai kemudahan akses bagi para pengunjung untuk datang berbelanja.', 'uploads/676942fbb09d1.jpg', 'uploads/676942aeaf92c.jpg', 'uploads/676942aedbad8.jpeg', 'uploads/676942af0deb4.jpg', 'uploads/676942fc03244.jpg', 'IDR 50.000', '2024-12-23 10:59:59', -7.782869, 110.402207, 'Setiap Hari - 10:00 - 22:00', ' Jl. Laksda Adisucipto No.80, Ambarukmo, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281'),
(46, 'Hiburan', 'Pakuwon Mall, Kaliwaru', 'Jl. Ring Road Utara', 'Pakuwon Mall Jogja yang terletak di Sleman, Yogyakarta, adalah salah satu pusat perbelanjaan terbesar di Yogyakarta dengan total 279 tenant yang tersebar di 6 lantai. Pakuwon Mall Jogja menyasar pasar menengah dan menengah ke atas dan pertama kali beroperasi pada 20 November 2015 dengan banyak anchor tenant terkenal seperti Matahari Department Store, H&M, Uniqlo, ACE Hardware, Informa, Hypermart, CGV* Cinema yang tersebar di keseluruhan leaseable area seluas 77.266m2. Pakuwon Mall Jogja juga memiliki Area atrium di lantai dasar seluas 900m2 yang dapat dipergunakan untuk berbagai kegiatan seperti pameran dan meet and greet; dan food court di lantai 2 dengan 14 tenant yang akan memuaskan para pecinta kuliner', 'uploads/676943d414b06.jpg', 'uploads/676943d43d26a.jpeg', 'uploads/676943d473e2f.jpg', 'uploads/676943d4b5647.jpg', 'uploads/676943d4f32e9.jpg', 'IDR 50.000', '2024-12-23 11:04:53', -7.759151, 110.399161, 'Setiap Hari - 10:00 - 22:00', 'Jl. Ring Road Utara, Kaliwaru, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281');

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_destinasi` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id`, `username`, `nama_destinasi`, `created_at`) VALUES
(1, 'rain', 'Landmark Merapi Park', '2024-12-23 01:23:37'),
(2, 'rain', 'Landmark Merapi Park', '2024-12-23 01:23:50'),
(3, 'kelvin', 'Jipin', '2024-12-23 01:27:08'),
(4, 'kelvin', 'rumah jia', '2024-12-23 01:27:16'),
(5, 'kelvin', 'Heha forest', '2024-12-23 01:28:12'),
(6, 'dika', 'Landmark Merapi Park', '2024-12-23 01:28:54'),
(7, 'dika', 'Candi Prambanan', '2024-12-23 01:31:02'),
(8, 'kaffa', 'Plaza Ambarukmo', '2024-12-23 01:31:24'),
(9, 'kaffa', 'Taman Pintar', '2024-12-23 01:46:45'),
(10, 'kaffa', 'Acer nitro', '2024-12-23 02:14:46'),
(11, '123', 'rumah jia', '2024-12-23 03:59:54'),
(12, 'uii', 'Agrowisata Bhumi Merapi', '2024-12-23 05:11:17'),
(13, 'uii', 'Candi Prambanan', '2024-12-23 05:13:34'),
(14, 'uii', 'Landmark Merapi Park', '2024-12-23 05:59:50'),
(15, 'uii', 'Agrowisata Bhumi Merapi', '2024-12-23 06:20:20'),
(16, 'dika', 'Jia Kelpin', '2024-12-23 06:35:09'),
(17, 'cindi cantik', 'Agrowisata Bhumi Merapi', '2024-12-23 06:39:10'),
(18, 'jiaa', 'Agrowisata Bhumi Merapi', '2024-12-23 07:23:47'),
(19, 'Jiaa', 'Agrowisata Bhumi Merapi', '2024-12-23 07:32:04'),
(20, 'Jiaa', 'Jia Kelpin', '2024-12-23 07:32:10'),
(21, 'Jiaa', 'Agrowisata Bhumi Merapi', '2024-12-23 09:11:46'),
(22, 'Jiaa', 'Gardu Pandang', '2024-12-23 10:41:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_akun`
--
ALTER TABLE `data_akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destinasi_wisata`
--
ALTER TABLE `destinasi_wisata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_akun`
--
ALTER TABLE `data_akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `destinasi_wisata`
--
ALTER TABLE `destinasi_wisata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
