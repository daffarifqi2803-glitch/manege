<?php
session_start();
// Menggunakan session untuk mengecek login
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true; 
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "Pelanggan";
$user_photo = $_SESSION['user_photo'] ?? "img/testimonial-1.png"; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Putik Bouquet - Rayakan Moment Bersama Orang Terdekat</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;700&family=Work+Sans:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Header Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-lg-5">
            <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
                <h2 class="mb-0 text-primary text-uppercase d-flex align-items-center">
                    <img src="img/logo.png" alt="logo.png" 
                    style="height:100px; width:auto; margin-right:1px;">
                    Putik Bouquet
                </h2>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto p-4 p-lg-0">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="about.php" class="nav-item nav-link">About</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Katalog</a>
                        <div class="dropdown-menu m-0">
                            <a href="team.php" class="dropdown-item">Our Product</a>
                            <a href="testimonial.php" class="dropdown-item active">Testimonial</a>
                            <a href="promotion.php" class="dropdown-item">Promotion</a>
                        </div>
                    </div>
                    <a href="contact.php" class="nav-item nav-link">Contact</a>
                </div>
                <div class="d-none d-lg-flex align-items-center gap-4">
                    <!-- Cart Icon -->
                    <a href="#" class="position-relative text-secondary fs-4" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cart-badge" style="font-size: 0.6rem;">
                            0
                        </span>
                    </a>

                    <?php if($is_logged_in): ?>
                        <!-- Profile Dropdown (Logged In) -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center gap-2 p-0" data-bs-toggle="dropdown" style="color: inherit;">
                                <img src="<?php echo $user_photo; ?>" alt="Profile" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; border: 2px solid var(--bs-secondary);">
                                <span class="fw-bold fs-6 text-secondary"><?php echo $user_name; ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end m-0 mt-3 border-0 shadow">
                                <a href="profile.php" class="dropdown-item py-2"><i class="fa fa-user me-2"></i>My Profile</a>
                                <a href="history.php" class="dropdown-item py-2"><i class="fa fa-history me-2"></i>My Orders</a>
                                <hr class="dropdown-divider">
                                <a href="LoginPage/logout.php" class="dropdown-item py-2 text-danger"><i class="fa fa-sign-out-alt me-2"></i>Logout</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Login Icon (Not Logged In) -->
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle text-secondary fs-3 p-0" data-bs-toggle="dropdown">
                                <i class="fa fa-user-circle"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end m-0 mt-3 border-0 shadow">
                                <a href="LoginPage/login.php" class="dropdown-item py-2"><i class="fa fa-sign-in-alt me-2"></i>Login</a>
                                <a href="LoginPage/register.php" class="dropdown-item py-2"><i class="fa fa-user-plus me-2"></i>Sign In</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <div class="page-header pb-5" style="background: linear-gradient(rgba(74, 74, 74, .6), rgba(74, 74, 74, .6)), url(img/product-1.jpg) center center no-repeat; background-size: cover;">
            <div class="container text-center py-5">
                <h1 class="display-4 text-uppercase mb-3 animated slideInDown">Testimonial</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                        <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                        <li class="breadcrumb-item text-primary active" aria-current="page">Testimonial</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Testimonial Start -->
    <div class="container-fluid py-5 bg-light">
        <div class="container py-5">

            <div class="text-center mb-5">
                <div class="title wow fadeInUp mb-4" data-wow-delay="0.1s">
                    <div class="title-center">
                        <h5>Testimonial & Statistik</h5>
                        <h1>Our Clients Say</h1>
                    </div>
                </div>
                
                <!-- Rating Banner -->
                <div class="bg-white rounded-pill d-inline-block py-2 px-4 shadow-sm mb-5 wow fadeInUp" data-wow-delay="0.2s">
                    <h5 class="m-0 text-dark">
                        <span class="text-warning"><i class="fa fa-star"></i> 4.8 / 5</span> dari 120 ulasan
                    </h5>
                </div>

                <!-- 4 Box Summary -->
                <div class="row g-4 mb-5 wow fadeInUp mx-auto" data-wow-delay="0.3s" style="max-width: 900px;">
                    <div class="col-md-3 col-6">
                        <div class="bg-white rounded p-4 shadow-sm h-100 border-bottom border-primary border-4 text-center">
                            <i class="fa fa-users text-primary fa-2x mb-3"></i>
                            <h2 class="fw-bold mb-1 text-dark">320</h2>
                            <p class="mb-0 text-dark small fw-bold" style="color: var(--bs-dark);">Total Pembeli</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="bg-white rounded p-4 shadow-sm h-100 border-bottom border-success border-4 text-center">
                            <i class="fa fa-comment-dots text-success fa-2x mb-3"></i>
                            <h2 class="fw-bold mb-1 text-dark">145</h2>
                            <p class="mb-0 text-dark small fw-bold">Total Testimoni</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="bg-white rounded p-4 shadow-sm h-100 border-bottom border-warning border-4 text-center">
                            <i class="fa fa-star text-warning fa-2x mb-3"></i>
                            <h2 class="fw-bold mb-1 text-dark">4.8<small class="fs-6 text-dark">/5</small></h2>
                            <p class="mb-0 text-dark small fw-bold">Rating Rata-rata</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="bg-white rounded p-4 shadow-sm h-100 border-bottom border-danger border-4 text-center">
                            <i class="fa fa-heart text-danger fa-2x mb-3"></i>
                            <h2 class="fw-bold mb-1 text-dark">92%</h2>
                            <p class="mb-0 text-dark small fw-bold">Pelanggan Puas</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.5s">

<!-- Testimoni 1 -->
<div class="testimonial-item">

    <div class="row align-items-center">

        <!-- Foto Testimoni -->
        <div class="col-md-6 text-center">
            <img src="img/testimonial-1.png" 
                 class="img-fluid testimonial-img mb-2" 
                 alt=""
                 style="max-width: 100%; height: auto; object-fit: contain; border-radius: 15px;">
        </div>

        <!-- Isi Testimoni -->
        <div class="col-md-6">

            <!-- Nama -->
            <h5 class="text-uppercase mb-1 fs-4">
                Siti Rahma
            </h5>

            <!-- Jenis Pembelian -->
            <span class="text-primary d-block mb-2 fs-5">
                Pembelian: Buket Wisuda
            </span>

            <!-- Ulasan -->
            <p class="mb-2 fs-5">
                Suka banget sama hasilnya! Cantik, rapi, dan terlihat eksklusif. 
                Recommended untuk yang cari buket berkualitas
            </p>

            <!-- Bintang 5 di bawah pesan -->
            <div class="text-warning fs-5">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>

        </div>

    </div>

</div>

<!-- Testimoni 2 -->
<div class="testimonial-item">

    <div class="row align-items-center">

        <!-- Foto Testimoni -->
        <div class="col-md-6 text-center">
            <img src="img/testimonial-2.png"
                 class="img-fluid testimonial-img mb-2" 
                 alt=""
                 style="max-width: 100%; height: auto; object-fit: contain; border-radius: 15px;">
        </div>

        <!-- Isi Testimoni -->
        <div class="col-md-6">

            <!-- Nama -->
            <h5 class="text-uppercase mb-1 fs-4">
                Andi Pratama
            </h5>

            <!-- Jenis Pembelian -->
            <span class="text-primary d-block mb-2 fs-5">
                Pembelian: Buket Ulang Tahun
            </span>

            <!-- Ulasan -->
            <p class="mb-2 fs-5">
                Buketnya sangat elegan, istri tercinta sangat senang saat menerimanya. 
                Pengerjaan cepat dan pesanan selamat sampai tujuan!
            </p>

            <!-- Bintang 5 di bawah pesan -->
            <div class="text-warning fs-5">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>

        </div>

    </div>

</div>

<!-- Testimoni 3 -->
<div class="testimonial-item">

    <div class="row align-items-center">

        <!-- Foto Testimoni -->
        <div class="col-md-6 text-center">
            <img src="img/testimonial-3.png" 
                 class="img-fluid testimonial-img mb-2" 
                 alt=""
                 style="max-width: 100%; height: auto; object-fit: contain; border-radius: 15px;">
        </div>

        <!-- Isi Testimoni -->
        <div class="col-md-6">

            <!-- Nama -->
            <h5 class="text-uppercase mb-1 fs-4">
                Dina Savitri
            </h5>

            <!-- Jenis Pembelian -->
            <span class="text-primary d-block mb-2 fs-5">
                Pembelian: Buket Uang
            </span>

            <!-- Ulasan -->
            <p class="mb-2 fs-5">
                Desain buket uangnya kreatif dan uangnya sama sekali tidak lecek! 
                Sangat profesional dan sesuai dengan request. Bintang lima.
            </p>

            <!-- Bintang 5 di bawah pesan -->
            <div class="text-warning fs-5">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>

        </div>

    </div>

</div>

<!-- Testimoni 4 -->
<div class="testimonial-item">

    <div class="row align-items-center">

        <!-- Foto Testimoni -->
        <div class="col-md-6 text-center">
            <img src="img/testimonial-4.png"
                 class="img-fluid testimonial-img mb-2" 
                 alt=""
                 style="max-width: 100%; height: auto; object-fit: contain; border-radius: 15px;">
        </div>

        <!-- Isi Testimoni -->
        <div class="col-md-6">

            <!-- Nama -->
            <h5 class="text-uppercase mb-1 fs-4">
                Budi Santoso
            </h5>

            <!-- Jenis Pembelian -->
            <span class="text-primary d-block mb-2 fs-5">
                Pembelian: Buket Anniversary
            </span>

            <!-- Ulasan -->
            <p class="mb-2 fs-5">
                Pesan mendadak untuk anniversary, untung bisa dibantu oleh admin yang ramah. 
                Hasilnya tetap memukau dan bunga fresh banget.
            </p>

            <!-- Bintang 5 di bawah pesan -->
            <div class="text-warning fs-5">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>

        </div>

    </div>

</div>

<!-- Testimoni 5 -->
<div class="testimonial-item">

    <div class="row align-items-center">

        <!-- Foto Testimoni -->
        <div class="col-md-6 text-center">
            <img src="img/testimonial-5.png"
                 class="img-fluid testimonial-img mb-2" 
                 alt=""
                 style="max-width: 100%; height: auto; object-fit: contain; border-radius: 15px;">
        </div>

        <!-- Isi Testimoni -->
        <div class="col-md-6">

            <!-- Nama -->
            <h5 class="text-uppercase mb-1 fs-4">
                Maya Wulandari
            </h5>

            <!-- Jenis Pembelian -->
            <span class="text-primary d-block mb-2 fs-5">
                Pembelian: Buket Snack
            </span>

            <!-- Ulasan -->
            <p class="mb-2 fs-5">
                Anak saya seneng banget dapet buket snack ini pas lulus SD. 
                Isiannya komplit dan bisa request snack kesukaannya. Terbaik!
            </p>

            <!-- Bintang 5 di bawah pesan -->
            <div class="text-warning fs-5">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>

        </div>

    </div>

</div>

        </div>
    </div>

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

    <!-- Back to Top -->
    <a href="#" class="btn btn-outline-primary border-2 btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    
    
    <!-- Cart Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
        <div class="offcanvas-header bg-primary text-white">
            <h5 class="offcanvas-title text-white" id="cartOffcanvasLabel"><i class="fa fa-shopping-cart me-2"></i>Keranjang Anda</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <!-- Mock Cart Items -->
            <div class="flex-grow-1 overflow-auto">
            </div>
            <!-- Checkout Section -->
            <div class="border-top pt-4 mt-auto">
                <!-- Notes Field -->
                <div class="mb-3">
                    <label for="cartNotes" class="form-label text-dark fw-bold small"><i class="fa fa-pen me-2 text-primary"></i>Catatan Tambahan (Bila ada request):</label>
                    <textarea class="form-control bg-light rounded" id="cartNotes" rows="2" placeholder="Contoh: Kartu ucapan 'Happy Birthday', warna pita..."></textarea>
                </div>
                <!-- End Notes Field -->
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="mb-0 text-dark">Total:</h5>
                    <h5 class="mb-0 text-primary fw-bold">Rp 0</h5>
                </div>
                <a href="checkout.php" class="btn btn-primary w-100 py-3 fw-bold fs-5 rounded-pill shadow-sm">Checkout</a>
            </div>
        </div>
    </div>

    <script src="js/cart.js"></script>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>


<?php include 'chat_widget.php'; ?>
<!-- ============================== -->
</body>

</html>