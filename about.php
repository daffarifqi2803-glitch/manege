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
    <title>Putik - Bouquet</title>
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

<body class="page-about">
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
                    <a href="about.php" class="nav-item nav-link active">About</a>
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

        <div class="page-header pb-5" style="background: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, .5)), url(img/about-2.png) center center no-repeat; background-size: cover;">
            <div class="container text-center py-5">
                <h1 class="display-4 text-uppercase mb-3 animated slideInDown">About</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                        <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                        <li class="breadcrumb-item text-primary active" aria-current="page">About</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- History Start -->
    <div class="container-fluid py-5 position-relative" style="background: linear-gradient(135deg, var(--soft-pink-bg) 0%, var(--bs-light) 100%); overflow: hidden;">
        <!-- Decorative blobs -->
        <div class="position-absolute top-0 start-0 translate-middle" style="width: 300px; height: 300px; background: rgba(233, 30, 99, 0.1); border-radius: 50%; filter: blur(50px);"></div>
        <div class="position-absolute bottom-0 end-0 translate-middle" style="width: 400px; height: 400px; background: rgba(255, 117, 140, 0.1); border-radius: 50%; filter: blur(60px);"></div>
        
        <div class="container py-5 position-relative z-index-1">
            <div class="row g-5 align-items-center">
                
                <div class="col-lg-5 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="position-relative">
                        <img class="img-fluid rounded-4 shadow-lg w-100 position-relative" src="img/about.png" alt="History Putik Bouquet" style="z-index: 2; border: 5px solid white;">
                        <div class="position-absolute rounded-4" style="background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-secondary) 100%); width: 100%; height: 100%; top: 20px; left: -20px; z-index: 1;"></div>
                        
                        <div class="position-absolute bg-white rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 100px; height: 100px; bottom: -30px; right: -20px; z-index: 3; border: 3px dashed var(--bs-primary);">
                            <div class="text-center">
                                <h3 class="text-primary mb-0 fw-bold">2024</h3>
                                <small class="text-muted fw-bold">Didirikan</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-7 wow fadeInRight" data-wow-delay="0.3s">
                    <div class="mb-4">
                        <h1 class="display-5 mb-4 fw-bold" style="color: var(--deep-pink);">Berawal dari Hobi Menjadi Dedikasi Hati</h1>
                    </div>
                    
                    <div class="bg-white p-4 rounded-4 shadow-sm mb-4 border-start border-primary border-5 position-relative">
                        <i class="fa fa-quote-left fa-3x text-primary opacity-25 position-absolute top-0 end-0 mt-3 me-3"></i>
                        <p class="mb-0 text-dark" style="font-size: 1.1rem; line-height: 1.8;">
                            Didirikan pada tahun 2024 sebagai usaha rumahan, Putik Bouquet lahir dari kecintaan mendalam pada seni merangkai bunga. Keinginan utama kami adalah menghadirkan buket yang tidak sekadar indah, namun juga <span class="fw-bold text-primary">bermakna untuk setiap momen spesial</span>.
                        </p>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary rounded-circle d-flex flex-shrink-0 align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                                    <i class="fa fa-seedling text-white fs-5"></i>
                                </div>
                                <div class="ms-3 pt-1">
                                    <h5 class="fw-bold text-dark mb-1">Langkah Awal</h5>
                                    <p class="text-muted small">Melayani kerabat terdekat & lingkungan sekitar.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary rounded-circle d-flex flex-shrink-0 align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                                    <i class="fa fa-chart-line text-white fs-5"></i>
                                </div>
                                <div class="ms-3 pt-1">
                                    <h5 class="fw-bold text-dark mb-1">Berkembang Pesat</h5>
                                    <p class="text-muted small">Menjadi pilihan utama untuk ulang tahun, wisuda, dan momen spesial lainnya.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="text-muted mb-0">
                        Hingga saat ini, kami terus berinovasi dalam menciptakan rangkaian yang modern dan estetik. Kami percaya bahwa kualitas, desain kreatif, dan pelayanan ramah adalah kunci untuk terus menyebarkan kebahagiaan.
                    </p>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- History End -->

    <!-- Visi Misi / Slogan Start -->
    <div class="container-fluid bg-light py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <img class="img-fluid rounded shadow-lg w-100 border border-secondary" src="img/service-4.jpg" alt="Visi Misi">
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="title-left mb-4">
                        <h5 class="text-maroon text-uppercase">Visi & Misi</h5>
                        <h1 class="display-5 mb-0 text-maroon">Keindahan dalam Setiap Rangkaian</h1>
                    </div>
                    <p class="mb-4 text-maroon">
                        "Keindahan dalam Setiap Rangkaian" mencerminkan komitmen Putik Buket dalam menghadirkan buket yang dirancang dengan penuh ketelitian dan kreativitas. Setiap rangkaian dibuat untuk menyampaikan perasaan, memperindah momen spesial, serta memberikan kesan hangat dan berkesan.
                    </p>
                    
                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-primary rounded-circle d-flex flex-shrink-0 align-items-center justify-content-center shadow" style="width: 60px; height: 60px;">
                            <i class="fa fa-eye text-white fs-4"></i>
                        </div>
                        <div class="ms-4">
                            <h4 class="mb-2 text-maroon">Visi Kami</h4>
                            <p class="mb-0 text-maroon">Menjadi pilihan utama dalam memberikan hadiah manis yang menghubungkan perasaan melalui rangkaian bunga terbaik di setiap momen berharga Anda.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-primary rounded-circle d-flex flex-shrink-0 align-items-center justify-content-center shadow" style="width: 60px; height: 60px;">
                            <i class="fa fa-bullseye text-white fs-4"></i>
                        </div>
                        <div class="ms-4">
                            <h4 class="mb-2 text-maroon">Misi Kami</h4>
                            <p class="mb-0 text-maroon">Memberikan inovasi desain yang terus mengikuti tren, memberikan pelayanan sepenuh hati, menjaga kualitas tinggi, serta penawaran harga yang inklusif untuk semua kalangan.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Visi Misi / Slogan End -->

    <!-- Logo & Filosofi Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 700px;">
                <div class="title-left d-inline-block text-center border-0 border-bottom border-primary mb-3 pb-2">
                    <h5 class="text-primary text-uppercase m-0">Identitas Visual</h5>
                </div>
                <h1 class="display-5 mb-0">Filosofi Putik Bouquet</h1>
                <p class="mt-3 text-muted">
                    Logo Putik Bouquet menggambarkan keindahan, ketulusan, dan makna mendalam. Setiap elemen dirancang secara spesifik sebagai wujud nyata dedikasi dan profesionalisme kami dalam menghadirkan karya pelengkap hari bahagia.
                </p>
            </div>
            
            <div class="row g-5 align-items-center mb-4">
                <div class="col-lg-4 text-end wow fadeInLeft" data-wow-delay="0.3s">
                    <div class="d-flex flex-column align-items-end mb-5">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm border" style="width: 80px; height: 80px;">
                            <i class="fa fa-shield-alt fa-2x text-primary"></i>
                        </div>
                        <h4>Bingkai Melengkung</h4>
                        <p class="text-muted mb-0">Melambangkan perlindungan dan komitmen kokoh kami untuk terus menjaga kualitas dan kepuasan pelanggan secara maksimal dari awal hingga akhir.</p>
                    </div>
                    <div class="d-flex flex-column align-items-end mb-4">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm border" style="width: 80px; height: 80px;">
                            <i class="fa fa-gift fa-2x text-primary"></i>
                        </div>
                        <h4>Ikon Pita Hadiah</h4>
                        <p class="text-muted mb-0">Menjadi lambang dari hadiah dan kejutan. Menegaskan bahwa setiap buket disusun penuh cinta untuk menebarkan kebahagiaan kepada orang terkasih.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 text-center wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative d-inline-block px-4 py-5 bg-white rounded-circle shadow" style="border: 2px dashed rgba(226, 92, 59, 0.4);">
                        <img class="img-fluid" src="img/logo.png" style="max-height: 250px; object-fit: contain;" alt="Logo Filosofi">
                    </div>
                </div>
                
                <div class="col-lg-4 text-start wow fadeInRight" data-wow-delay="0.3s">
                    <div class="d-flex flex-column align-items-start mb-5">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm border" style="width: 80px; height: 80px;">
                            <i class="fa fa-shopping-basket fa-2x text-primary"></i>
                        </div>
                        <h4>Keranjang Bunga</h4>
                        <p class="text-muted mb-0">Lambang kelimpahan dan sumber keindahan. Mewakili proses usaha rintisan yang terangkai menjadi harmoni penuh kreativitas tak terbatas.</p>
                    </div>
                    <div class="d-flex flex-column align-items-start mb-4">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm border" style="width: 80px; height: 80px;">
                            <i class="fa fa-palette fa-2x text-primary"></i>
                        </div>
                        <h4>Harmoni Warna</h4>
                        <p class="text-muted mb-0">Gradasi memukau dari cokelat ke merah muda menyimbolkan kehangatan mendalam, kelembutan elegan, serta harapan indah.</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!-- Logo & Filosofi End -->

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