<?php
session_start();
include "LoginPage/koneksi.php";

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: LoginPage/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
    $photo_path = $_SESSION['user_photo'];

    // Handle profile photo upload
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'img/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '', basename($_FILES['foto']['name']));
        $uploadFilePath = $uploadDir . $fileName;

        $fileType = strtolower(pathinfo($uploadFilePath, PATHINFO_EXTENSION));
        $validTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($fileType, $validTypes)) {
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadFilePath)) {
                if (isset($_SESSION['user_photo']) && strpos($_SESSION['user_photo'], 'uploads/') !== false) {
                    if (file_exists($_SESSION['user_photo'])) {
                        unlink($_SESSION['user_photo']);
                    }
                }
                $photo_path = $uploadFilePath;
            }
        }
    }

    // Update Database
    $update_query = "UPDATE users SET name='$nama', address='$alamat', phone='$telepon', photo='$photo_path' WHERE id='$user_id'";
    if (mysqli_query($conn, $update_query)) {
        $_SESSION['user_name'] = $nama;
        $_SESSION['user_address'] = $alamat;
        $_SESSION['user_phone'] = $telepon;
        $_SESSION['user_photo'] = $photo_path;

        // Sync with customers.json for Admin Dashboard
        $customers_file = 'data/customers.json';
        if (file_exists($customers_file)) {
            $customers_data = json_decode(file_get_contents($customers_file), true);
            foreach ($customers_data as &$customer) {
                if ($customer['email'] === $_SESSION['user_email']) {
                    $customer['name'] = $nama;
                    $customer['phone'] = $telepon;
                    break;
                }
            }
            file_put_contents($customers_file, json_encode($customers_data, JSON_PRETTY_PRINT));
        }

        $success_msg = "Profil berhasil diperbarui!";
    } else {
        $error_msg = "Gagal memperbarui profil: " . mysqli_error($conn);
    }
}

$user_name = $_SESSION['user_name'] ?? "";
$user_address = $_SESSION['user_address'] ?? "";
$user_phone = $_SESSION['user_phone'] ?? "";
$user_photo = $_SESSION['user_photo'] ?? "img/testimonial-1.png"; // Fallback defaults
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Edit Profile - Putik Bouquet</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <!-- Fonts & Icons -->
    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;700&family=Work+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        body { 
            background-color: var(--soft-pink-bg); 
            font-family: 'Josefin Sans', sans-serif; 
            min-height: 100vh;
            color: var(--bs-dark);
        }
        
        .profile-container {
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 15px 35px rgba(233, 30, 99, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(233, 30, 99, 0.15);
        }

        .profile-header-bg {
            height: 120px;
            background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);
        }

        .foto-preview-container {
            width: 150px;
            height: 150px;
            margin-top: -75px;
            margin-left: auto;
            margin-right: auto;
            position: relative;
            border-radius: 50%;
            padding: 5px;
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .foto-preview-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .camera-icon-bg {
            background-color: #e91e63 !important;
            transition: all 0.3s ease;
        }

        .foto-preview-container:hover .camera-icon-bg { 
            transform: scale(1.1);
            background-color: #d81b60 !important; 
        }

        .form-control {
            border-radius: 12px;
            padding: 14px 22px;
            border: 2px solid #ffe5ec;
            background-color: #ffffff;
            color: #333;
            font-weight: 700;
            font-size: 1.05rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-control:focus {
            box-shadow: 0 0 15px rgba(233, 30, 99, 0.15);
            border-color: #ff7eb3;
            background-color: #fff;
        }

        .form-label {
            font-weight: 900;
            color: var(--deep-pink); /* Vibrant Deep Pink */
            margin-bottom: 12px;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            font-size: 1rem;
        }

        .btn-pink-gradient { 
            background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%); 
            color: white; 
            border: none; 
            transition: 0.3s; 
            font-weight: 800;
            font-size: 1.1rem;
            border-radius: 30px;
            letter-spacing: 0.5px;
        }

        .btn-pink-gradient:hover { 
            background: linear-gradient(135deg, #ff4b68 0%, #ff529a 100%); 
            color: white; 
            transform: translateY(-3px); 
            box-shadow: 0 8px 20px rgba(233, 30, 99, 0.3); 
        }

        .btn-outline-cancel { 
            border: 2px solid #ddd; 
            color: #555; 
            font-weight: 700; 
            background: white; 
            transition: 0.3s; 
            border-radius: 30px;
        }

        .btn-outline-cancel:hover { 
            background: #fdfdfd; 
            color: #333; 
            border-color: #aaa; 
            transform: translateY(-3px); 
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05); 
        }

        .nav-pills .nav-link {
            border-radius: 12px;
            color: #555;
            font-weight: 600;
            padding: 12px 20px;
            margin-bottom: 10px;
            transition: all 0.3s;
        }

        .nav-pills .nav-link:hover {
            background-color: #fff0f3;
            color: #e91e63;
        }

        .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(233, 30, 99, 0.3);
        }
    </style>
</head>
<body>

    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-lg-5" style="background: rgba(0,0,0,0.9);">
            <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
                <h2 class="mb-0 text-primary text-uppercase d-flex align-items-center">
                    <img src="img/logo.png" alt="logo.png" style="height:80px; width:auto; margin-right:5px;">
                    Putik Bouquet
                </h2>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto p-4 p-lg-0">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="about.php" class="nav-item nav-link">About</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Katalog</a>
                        <div class="dropdown-menu m-0">
                            <a href="team.php" class="dropdown-item">Our Product</a>
                            <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                            <a href="promotion.php" class="dropdown-item">Promotion</a>
                        </div>
                    </div>

                    <a href="contact.php" class="nav-item nav-link">Contact</a>
                </div>
                <div class="d-none d-lg-flex align-items-center gap-4">
                    <a href="#" class="position-relative text-secondary fs-4" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">3</span>
                    </a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle d-flex align-items-center gap-2 p-0" data-bs-toggle="dropdown">
                            <img src="<?php echo htmlspecialchars($user_photo); ?>" alt="Profile" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; border: 2px solid var(--bs-secondary);">
                            <span class="fw-bold fs-6 text-secondary"><?php echo htmlspecialchars($user_name); ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end m-0 mt-3 border-0 shadow">
                            <a href="profile.php" class="dropdown-item py-2 active"><i class="fa fa-user me-2"></i>My Profile</a>
                            <a href="history.php" class="dropdown-item py-2"><i class="fa fa-history me-2"></i>My Orders</a>
                            <hr class="dropdown-divider">
                            <a href="LoginPage/logout.php" class="dropdown-item py-2 text-danger"><i class="fa fa-sign-out-alt me-2"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        
        <div class="page-header pb-5">
            <div class="container text-center py-5">
                <h1 class="display-4 text-uppercase mb-3 animated slideInDown">My Profile</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                        <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="#">User</a></li>
                        <li class="breadcrumb-item text-primary active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

<!-- Profile Content Start -->
        <div class="container profile-container mb-5">
            <form method="POST" enctype="multipart/form-data" id="profileForm">

                <div class="row g-4 align-items-start">

                    <!-- ================= LEFT SIDEBAR ================= -->
                    <div class="col-md-4">

                        <div class="glass-card mb-4 text-center">

                            <div class="profile-header-bg"></div>

                            <div>

    <div class="foto-preview-container">

<img src="<?php echo htmlspecialchars($user_photo); ?>" 
alt="Profile" 
id="profileImagePreview">

<div class="camera-icon-bg position-absolute bottom-0 end-0 text-white rounded-circle d-flex justify-content-center align-items-center shadow"
style="width: 40px; height: 40px; cursor: pointer; z-index: 5;">

<i class="fa fa-camera"></i>

</div>

<input type="file"
name="foto"
class="position-absolute top-0 start-0 w-100 h-100 opacity-0"
style="cursor:pointer; z-index: 10;"
accept="image/*"
onchange="previewImage(event)">

</div>

</div>

<div class="p-4 pt-3">

<h4 class="fw-bold text-dark mb-1">
<?php echo htmlspecialchars($user_name); ?>
</h4>

<p class="mb-3" style="color: #ff4d6d; font-weight: 600;">
<i class="fa fa-map-marker-alt me-1"></i>
<?php echo !empty($user_address) ? 'Alamat Tersimpan' : 'Belum diatur'; ?>
</p>

<hr class="my-4">

<div class="nav flex-column nav-pills text-start">

<a class="nav-link active" href="profile.php">
<i class="fa fa-user me-3"></i>
Edit Profile
</a>

<a class="nav-link" href="history.php">
<i class="fa fa-shopping-bag me-3"></i>
Riwayat Pemesanan
</a>

<a class="nav-link text-danger mt-3"
href="LoginPage/logout.php">
<i class="fa fa-sign-out-alt me-3"></i>
Keluar
</a>

</div>

</div>

</div>

</div>

<!-- ================= RIGHT CONTENT ================= -->

<div class="col-md-8">

<div class="glass-card p-4 p-md-5 h-100">

<h3 class="fw-bold mb-4" style="color: #d81b60;">
Informasi Pribadi
</h3>

<p class="text-muted mb-4">
Perbarui informasi profil Anda di bawah ini agar kami dapat memproses pesanan Anda dengan lancar.
</p>

<?php if(isset($success_msg)): ?>

<div class="alert alert-success alert-dismissible fade show rounded-pill px-4" role="alert">

<i class="fa fa-check-circle me-2"></i>
<?php echo $success_msg; ?>

<button type="button"
class="btn-close"
data-bs-dismiss="alert">
</button>

</div>

<?php endif; ?>

<div class="row g-4">

<!-- Nama -->

<div class="col-12">

<div class="row align-items-center">

<div class="col-sm-4">

<label class="form-label mb-0">
Nama Lengkap
<span class="text-danger">*</span>
</label>

</div>

<div class="col-sm-8">

<div class="input-group">

<span class="input-group-text bg-white border-end-0"
style="border-radius: 12px 0 0 12px; border-color: #ffe5ec; border-width: 2px;">

<i class="fa fa-user fs-5" style="color: #ff7eb3;"></i>

</span>

<input type="text"
class="form-control border-start-0 ps-0"
style="border-width: 2px; border-color: #ffe5ec;"
name="nama"
value="<?php echo htmlspecialchars($user_name); ?>"
required
placeholder="Masukkan nama lengkap Anda">

</div>

</div>

</div>

</div>

<!-- Telepon -->

<div class="col-12">

<div class="row align-items-center">

<div class="col-sm-4">

<label class="form-label mb-0">
Nomor Telepon
<span class="text-danger">*</span>
</label>

</div>

<div class="col-sm-8">

<div class="input-group">

<span class="input-group-text bg-white border-end-0"
style="border-radius: 12px 0 0 12px; border-color: #ffe5ec; border-width: 2px;">

<i class="fa fa-phone fs-5" style="color: #ff7eb3;"></i>

</span>

<input type="text"
class="form-control border-start-0 ps-0"
style="border-width: 2px; border-color: #ffe5ec;"
name="telepon"
value="<?php echo htmlspecialchars($user_phone); ?>"
required
placeholder="Contoh: 08123456789">

</div>

</div>

</div>

</div>

<!-- Alamat -->

<div class="col-12">

<div class="row">

<div class="col-sm-4 pt-2">

<label class="form-label mb-0">
Alamat Pengiriman
<span class="text-danger">*</span>
</label>

</div>

<div class="col-sm-8">

<textarea class="form-control"
style="border-width: 2px; border-color: #ffe5ec;"
name="alamat"
rows="4"
required
placeholder="Masukkan alamat lengkap...">

<?php echo htmlspecialchars($user_address); ?>

</textarea>

</div>

</div>

</div>

</div>

<!-- BUTTON -->

<div class="d-flex justify-content-end gap-3 mt-5 pt-3 border-top">

<button type="button"
class="btn btn-outline-cancel px-5 py-2"
onclick="window.location.href='index.php'">

Batal

</button>

<button type="submit"
class="btn btn-pink-gradient px-5 py-2">

<i class="fa fa-save me-2"></i>
Simpan Perubahan

</button>

</div>

</div>

</div>

</div>

</form>
</div>
<!-- Profile Content End -->
                                
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <a href="index.php">
                <h1 class="display-4 mb-3 text-white text-uppercase"><i class="fa-regular fa-face-smile me-1"></i>Putik
                    Bouquet</h1>
            </a>
            <div class="d-flex justify-content-center mb-4">
                <a class="btn btn-lg-square btn-outline-primary border-2 m-1" href="https://instagram.com/username_kamu"
                    Target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="btn btn-lg-square btn-outline-primary border-2 m-1"
                    href="https://maps.app.goo.gl/Wpin1kf8h8wLZNSDA" Target="_blank">
                    <i class="fa fa-map-marker-alt"></i>
                </a>
                <a class="btn btn-lg-square btn-outline-primary border-2 m-1"
                    href="https://wa.me/6289506079211?text=Halo%20saya%20ingin%20memesan%20buket" Target="_blank">
                    <i class="fab fa-whatsapp"></i></a>
            </div>
            <p class="tw-leading-loose"> © 2026 Putik Bouquet All Right Reserved.</p>

        </div>
    </div>
    <!-- Footer End -->
    <!-- Script for Image Preview -->
    <script>
    function previewImage(event) {
        if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("profileImagePreview");
            preview.src = src;
        }
    }
    </script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <?php include 'chat_widget.php'; ?>
</body>
</html>