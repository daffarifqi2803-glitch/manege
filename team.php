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
                            <a href="team.php" class="dropdown-item active">Our Product</a>
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

        <div class="page-header pb-5">
            <div class="container text-center py-5">
                <h1 class="display-4 text-uppercase mb-3 animated slideInDown">Our Product</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                        <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                        <li class="breadcrumb-item text-primary active" aria-current="page">Our Product</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Team Start -->
    <div class="container-fluid py-5 bg-light">
        <div class="container py-5">
            <div class="text-center">
                <div class="title wow fadeInUp" data-wow-delay="0.1s">
                    <div class="title-center">
                        <h5 style="color: var(--bs-primary);">Produk</h5>
                        <h1 style="color: var(--deep-pink);">Katalog Produk</h1>
                    </div>
                </div>
                <!-- Intro text & Features -->
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-10 wow fadeInUp" data-wow-delay="0.2s">
                        <p class="fs-5 text-center mb-4" style="color: var(--bs-dark); line-height: 1.8;">
                            Koleksi eksklusif <strong>Putik Bouquet</strong> dirangkai secara profesional untuk menyempurnakan setiap momen bahagia Anda. Kami sangat mengerti bahwa setiap kuntum bunga selalu membawa cerita dan makna yang mendalam. Oleh karena itu, dari rona haru di hari kelulusan, kemeriahan tiup lilin ulang tahun, hingga detik-detik romantis bertukar janji di hari jadi—semuanya kami visualisasikan ke dalam mahakarya buket yang begitu memikat hati, mewah, dan tentu saja tak terlupakan!
                        </p>
                        
                        <div class="row g-4 text-center mt-3 mb-4">
                            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="p-4 bg-white rounded shadow-sm h-100" style="border-top: 4px solid var(--deep-pink);">
                                    <i class="fa fa-spa fa-3x mb-3" style="color: var(--bs-primary);"></i>
                                    <h5 class="fw-bold" style="color: #333;">Bunga Fresh Premium</h5>
                                    <p class="small text-muted mb-0">Kami hanya menyortir dan memakai bunga segar kualitas terbaik sehingga warna cerahnya bertahan lama dan aroma khasnya selalu semerbak murni di setiap pesanan.</p>
                                </div>
                            </div>
                            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.4s">
                                <div class="p-4 bg-white rounded shadow-sm h-100" style="border-top: 4px solid var(--deep-pink);">
                                    <i class="fa fa-gem fa-3x mb-3" style="color: var(--bs-primary);"></i>
                                    <h5 class="fw-bold" style="color: #333;">Desain Eksklusif</h5>
                                    <p class="small text-muted mb-0">Seluruh rangkaian merupakan hasil tangan perangkai bunga (florist) ahlinya, dirancang dengan kehati-hatian tingkat tinggi untuk menghadirkan nuansa estetika yang modern dan elegan.</p>
                                </div>
                            </div>
                            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.5s">
                                <div class="p-4 bg-white rounded shadow-sm h-100" style="border-top: 4px solid var(--deep-pink);">
                                    <i class="fa fa-heart fa-3x mb-3" style="color: var(--bs-primary);"></i>
                                    <h5 class="fw-bold" style="color: #333;">Bisa Custom & Respon Cepat</h5>
                                    <p class="small text-muted mb-0">Anda diberikan kebebasan untuk menentukan warna kertas (wrapping), jenis pita, menyesuaikan isi kartu ucapan. Pengirimannya pun sangat cepat dan terproteksi aman.</p>
                                </div>
                            </div>
                        </div>

                        <p class="fs-5 text-center mt-4" style="color: var(--deep-pink); font-weight: 700; letter-spacing: 1px;">
                            ✨ Silakan eksplorasi ragam pilihan kami di bawah ini! ✨
                        </p>
                    </div>
                </div>
            </div>
            <?php
            $product_categories = [];
            $products_file = 'data/products.json';
            if(file_exists($products_file)) {
                $product_categories = json_decode(file_get_contents($products_file), true);
            }
            ?>
            <style>
            .category-tabs .nav-link {
                color: #555;
                font-weight: 600;
                border-radius: 30px;
                padding: 10px 25px;
                margin: 0 5px;
                transition: 0.3s;
                border: 2px solid transparent;
            }
            .category-tabs .nav-link:hover {
                color: var(--bs-primary);
            }
            .category-tabs .nav-link.active {
                background-color: var(--bs-primary);
                color: white !important;
                box-shadow: 0 4px 15px rgba(226, 92, 59, 0.3);
            }
            .product-card {
                background: #fff;
                border-radius: 15px;
                overflow: hidden;
                box-shadow: 0 5px 15px rgba(0,0,0,0.05);
                transition: 0.3s;
                height: 100%;
                border: 1px solid #f0f0f0;
            }
            .product-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            }
            .product-overlay {
                position: absolute;
                top: 0; left: 0; right: 0; bottom: 0;
                background: rgba(226, 92, 59, 0.4);
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: 0.3s;
                backdrop-filter: blur(2px);
            }
            .product-card:hover .product-overlay {
                opacity: 1;
            }
            .add-to-cart-btn {
                transform: translateY(20px);
                transition: 0.3s;
            }
            .product-card:hover .add-to-cart-btn {
                transform: translateY(0);
            }
            .tab-pane {
                transition: opacity 0.3s ease-in-out;
            }
            </style>
            
            <div class="row mb-5 justify-content-center wow fadeInUp" data-wow-delay="0.1s">
                <ul class="nav nav-pills category-tabs d-inline-flex justify-content-center">
                    <?php $i=0; foreach($product_categories as $cat => $items): ?>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-uppercase <?php echo ($i==0) ? 'active' : ''; ?>" data-bs-toggle="pill" href="#tab-<?php echo strtolower($cat); ?>">
                            <?php echo $cat; ?>
                        </a>
                    </li>
                    <?php $i++; endforeach; ?>
                </ul>
            </div>

            <div class="tab-content">
                <?php $i=0; foreach($product_categories as $cat => $items): ?>
                <div id="tab-<?php echo strtolower($cat); ?>" class="tab-pane fade show <?php echo ($i==0) ? 'active' : ''; ?> p-0">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 g-4 justify-content-center">
                        <?php foreach($items as $idx => $item): ?>
                        <div class="col wow fadeInUp" data-wow-delay="<?php echo 0.1 * ($idx + 1); ?>s">
                            <div class="product-card text-center pb-3">
                                <div class="position-relative overflow-hidden mb-3">
                                    <img class="img-fluid w-100" src="<?php echo $item['img']; ?>" alt="<?php echo $item['name']; ?>" style="height:220px; object-fit:cover;">
                                    <div class="product-overlay">
                                        <a href="#" class="btn btn-light rounded-pill py-2 px-4 shadow font-weight-bold add-to-cart-btn" data-bs-target="#cartOffcanvas" onclick="event.preventDefault();">
                                            <i class="fa fa-cart-plus me-2 text-primary"></i>Add to Cart
                                        </a>
                                    </div>
                                </div>
                                <h6 class="text-uppercase px-2 mb-1" style="font-size:1rem; font-family:'Josefin Sans', sans-serif; color: var(--deep-pink); font-weight: 700;"><?php echo $item['name']; ?></h6>
                                <p class="text-muted px-3 mb-2" style="font-size:0.8rem; line-height:1.4; height: 50px; overflow: hidden;"><?php echo $item['desc']; ?></p>
                                <span class="text-primary fw-bold fs-5">Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php $i++; endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Team End -->


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
</body>
</html>