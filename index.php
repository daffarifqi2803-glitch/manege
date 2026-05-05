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
    <title>Putik Bouquet</title>
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
                    <a href="index.php" class="nav-item nav-link active">Home</a>
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
                
                <!-- Cart Icon -->
                <a href="#" class="position-relative text-secondary fs-4" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                        3
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
        </nav>

        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/carousel-1.jpg" class="img-fluid w-100">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="title mx-5 px-5 animated slideInDown">
                            <div class="title-center">
                                <h5 style="color: var(--bs-primary) !important;">Welcome</h5>
                                <h1 class="display-1" style="color: var(--bs-primary) !important;">Momen Spesial</h1>
                            </div>
                        </div>
                        <p class="fs-5 mb-5 animated slideInDown" style="color: var(--bs-primary) !important;">Hadiahkan momen terbaik dengan buket dan hampers
                            cantik dari Putik Bouquet.<br> Desain elegan, kualitas terbaik, dan dibuat dengan penuh
                            perhatian untuk setiap momen spesial Anda.</p>
                        <a href="team.php" class="btn btn-outline-primary border-2 py-3 px-5 animated slideInDown">Shop
                            Now</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-2.jpg" class="img-fluid w-100">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="title mx-5 px-5 animated slideInDown">
                            <div class="title-center">
                                <h5 style="color: var(--bs-primary) !important;">Welcome</h5>
                                <h1 class="display-1" style="color: var(--bs-primary) !important;">Pilihan Terbaik</h1>
                            </div>
                        </div>
                        <p class="fs-5 mb-5 animated slideInDown" style="color: var(--bs-primary) !important;">Temukan berbagai pilihan buket dan hampers
                            terbaik.<br>Dengan desain elegan, kualitas premium, dan cocok untuk berbagai momen spesial
                            Anda.</p>
                        <a href="team.php" class="btn btn-outline-primary border-2 py-3 px-5 animated slideInDown">Shop
                            Now</a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Header End -->



    <!-- About Start -->
    <div class="container-fluid py-5 position-relative theme-pink-maroon" style="overflow: hidden;">
        <!-- Decorative blobs -->
        <div class="position-absolute top-0 end-0 translate-middle" style="width: 400px; height: 400px; background: rgba(233, 30, 99, 0.05); border-radius: 50%; filter: blur(60px);"></div>
        <div class="position-absolute bottom-0 start-0 translate-middle" style="width: 300px; height: 300px; background: rgba(255, 117, 140, 0.05); border-radius: 50%; filter: blur(50px);"></div>

        <div class="container py-5 position-relative" style="z-index: 1;">
            <!-- Section Title -->
            <div class="text-center mb-5">
                <div class="title wow fadeInUp" data-wow-delay="0.1s">
                    <div class="title-center">
                        <h5>About</h5>
                        <h1>Our Bouquet</h1>
                    </div>
                </div>
            </div>

            <div class="row g-5 align-items-center">
                <!-- LEFT: Text Content -->
                <div class="col-lg-7 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="p-4 rounded-4 shadow-sm mb-4 border-start border-5 position-relative overflow-hidden" style="background: rgba(255,255,255,0.5); border-color: var(--bs-primary) !important;">
                        <div class="position-absolute top-0 end-0 p-3 opacity-10">
                            <i class="fa fa-quote-right fa-4x text-primary"></i>
                        </div>
                        <p class="mb-0" style="font-size: 1.1rem; line-height: 1.8;">
                            Didirikan pada tahun 2024 sebagai usaha rumahan, Putik Bouquet lahir dari kecintaan mendalam pada seni merangkai bunga. Keinginan utama kami adalah menghadirkan buket yang tidak sekadar indah, namun juga <span class="fw-bold">bermakna untuk setiap momen spesial</span>.
                        </p>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start p-3 rounded-4 shadow-sm h-100 border border-light transition-hover" style="background: rgba(255,255,255,0.5);">
                                <div class="bg-primary rounded-circle d-flex flex-shrink-0 align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                                    <i class="fa fa-seedling text-white fs-5"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="fw-bold mb-1">Langkah Awal</h5>
                                    <p class="small mb-0">Melayani kerabat terdekat &amp; lingkungan sekitar.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start p-3 rounded-4 shadow-sm h-100 border border-light transition-hover" style="background: rgba(255,255,255,0.5);">
                                <div class="bg-primary rounded-circle d-flex flex-shrink-0 align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                                    <i class="fa fa-chart-line text-white fs-5"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="fw-bold mb-1">Berkembang</h5>
                                    <p class="small mb-0">Menjadi pilihan utama untuk berbagai momen spesial.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="mb-4">
                        Hingga saat ini, kami terus berinovasi dalam menciptakan rangkaian yang modern dan estetik untuk kebahagiaan pelanggan kami.
                    </p>

                    <a href="about.php" class="btn btn-primary rounded-pill px-5 py-3 shadow-lg">
                        Pelajari Selengkapnya <i class="fa fa-arrow-right ms-2"></i>
                    </a>
                </div>

                <!-- RIGHT: Image -->
                <div class="col-lg-5 wow fadeInRight" data-wow-delay="0.3s">
                    <div class="position-relative p-4">
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary rounded-4 opacity-10" style="transform: rotate(3deg);"></div>
                        <img class="img-fluid rounded-4 shadow-lg w-100 position-relative" src="img/about.png" alt="Putik Bouquet History" style="z-index: 2;">
                        <div class="position-absolute rounded-circle d-flex align-items-center justify-content-center shadow-lg"
                             style="width: 100px; height: 100px; bottom: -10px; right: -10px; z-index: 3; border: 4px solid var(--bs-primary); background: rgba(255, 240, 243, 0.95);">
                            <div class="text-center">
                                <h3 class="text-primary mb-0 fw-bold">2024</h3>
                                <small class="fw-bold" style="font-size: 0.7rem;">ESTABLISHED</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->




    <!-- Service Start -->
    <div class="container-fluid py-5 theme-pink-maroon">
        <!-- Title inside container (centered) -->
        <div class="container">
            <div class="text-center">
                <div class="title wow fadeInUp" data-wow-delay="0.1s">
                    <div class="title-center">
                        <h5>Product</h5>
                        <h1>How We Help You</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service items full-width -->
        <div class="service-item service-item-left">
            <div class="row g-0 align-items-center">
                <div class="col-md-4">
                    <div class="service-img p-3 wow fadeInRight" data-wow-delay="0.2s">
                        <img class="img-fluid rounded-circle" src="img/service-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="service-text px-4 py-3 wow fadeInRight" data-wow-delay="0.5s">
                        <h3 class="text-uppercase">Wisuda</h3>
                        <p class="mb-2">Buket bunga untuk wisuda biasanya diberikan sebagai bentuk ucapan selamat
                            dan apresiasi atas keberhasilan seseorang dalam menyelesaikan pendidikan. Buket wisuda
                            menjadi simbol kebanggaan, dukungan, dan harapan untuk kesuksesan di masa depan.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="service-item service-item-right">
            <div class="row g-0 align-items-center">
                <div class="col-md-5 order-md-1 text-md-end">
                    <div class="service-img p-3 wow fadeInLeft" data-wow-delay="0.2s">
                        <img class="img-fluid rounded-circle" src="img/service-2.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="service-text px-4 py-3 text-md-end wow fadeInLeft" data-wow-delay="0.5s">
                        <h3 class="text-uppercase">Hari Spesial / Perayaan</h3>
                        <p class="mb-2">Buket bunga sering digunakan untuk merayakan hari-hari spesial, seperti
                            ulang tahun, anniversary, atau perayaan lainnya. Memberikan buket pada momen ini
                            bertujuan untuk menambah kebahagiaan dan menciptakan kenangan indah bersama orang
                            terdekat.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="service-item service-item-left">
            <div class="row g-0 align-items-center">
                <div class="col-md-5">
                    <div class="service-img p-3 wow fadeInRight" data-wow-delay="0.2s">
                        <img class="img-fluid rounded-circle" src="img/service-3.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="service-text px-4 py-3 wow fadeInRight" data-wow-delay="0.5s">
                        <h3 class="text-uppercase">Pernikahan</h3>
                        <p class="mb-2">Dalam acara pernikahan, buket bunga memiliki makna cinta, kesetiaan, dan
                            kebahagiaan. Buket biasanya digunakan sebagai hadiah untuk pasangan pengantin atau
                            sebagai bagian dari dekorasi dan simbol kebahagiaan dalam memulai kehidupan baru
                            bersama.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="service-item service-item-right">
            <div class="row g-0 align-items-center">
                <div class="col-md-5 order-md-1 text-md-end">
                    <div class="service-img p-3 wow fadeInLeft" data-wow-delay="0.2s">
                        <img class="img-fluid rounded-circle" src="img/service-4.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="service-text px-4 py-3 text-md-end wow fadeInLeft" data-wow-delay="0.5s">
                        <h3 class="text-uppercase">Ucapan Terima Kasih</h3>
                        <p class="mb-2">Buket bunga juga dapat diberikan sebagai bentuk rasa terima kasih dan
                            penghargaan kepada seseorang yang telah membantu atau berjasa. Memberikan buket bunga
                            menunjukkan perhatian, ketulusan, dan penghormatan kepada penerimanya.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-5"></div>
    </div>
    <!-- Service End -->



    <!-- Banner Start -->
    <div class="container-fluid py-5 theme-pink-maroon">
        <div class="container py-5">
            <div class="row g-0 justify-content-center">
                <div class="col-lg-7 text-center">
                    <div class="title mx-5 px-5 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="title-center">
                            <h5>Order</h5>
                            <h1>want to buy our products?</h1>
                        </div>
                    </div>
                    <p class="fs-5 mb-5 wow fadeInUp" data-wow-delay="0.2s">Masih bingung memilih buket yang sesuai?
                        Jangan khawatir! Anda bisa langsung menghubungi kami melalui WhatsApp untuk mendapatkan
                        konsultasi gratis. Tim kami siap membantu Anda menentukan pilihan buket terbaik agar momen
                        spesial Anda menjadi lebih berkesan.</p>
                    <div class="position-relative wow fadeInUp" data-wow-delay="0.3s">
                        <input class="form-control border-2 rounded-pill w-100 py-4 ps-4 pe-5" 
                            style="background: rgba(255,255,255,0.7); border-color: var(--bs-primary) !important; color: var(--maroon);"
                            type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-3 px-4 position-absolute top-0 end-0 me-2"
                            style="margin-top: 7px;">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->


    <!-- Product Start -->
    <div class="container-fluid py-5 theme-pink-maroon">
        <div class="container py-5">

            <div class="text-center">
                <div class="title wow fadeInUp" data-wow-delay="0.1s">
                    <div class="title-center">
                        <h5 style="color: var(--bs-primary);">Produk Terlaris</h5>
                        <h1 style="color: var(--deep-pink);">Best Product</h1>
                    </div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 g-4 justify-content-center">
                <?php
                $products_file = 'data/products.json';
                $best_products = [];
                if(file_exists($products_file)) {
                    $json_data = json_decode(file_get_contents($products_file), true);
                    // Ambil 1 produk pertama dari setiap kategori (maksimal 5)
                    $count = 0;
                    foreach($json_data as $cat => $items) {
                        if(isset($items[0])) {
                            $best_products[] = $items[0];
                            $count++;
                        }
                        if($count >= 5) break;
                    }
                }
                ?>
                <?php foreach($best_products as $idx => $item): ?>
                <div class="col wow fadeInUp" data-wow-delay="<?php echo 0.1 * ($idx + 1); ?>s">
                    <div class="team-item h-100 d-flex flex-column">
                        <div class="team-body position-relative overflow-hidden mb-3">
                            <img class="img-fluid w-100" src="<?php echo htmlspecialchars($item['img']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" style="height:220px; object-fit:cover;">
                        </div>
                        <div class="text-center p-3 d-flex flex-column flex-grow-1">
                            <h5 class="text-uppercase mb-2" style="font-size:1rem; font-family:'Josefin Sans', sans-serif; color: var(--deep-pink); font-weight: 700;">
                                <?php echo htmlspecialchars($item['name']); ?>
                            </h5>
                            <p class="text-primary fw-bold fs-6">Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></p>
                            <p class="small text-muted flex-grow-1" style="line-height:1.4; height: 65px; overflow: hidden;">
                                <?php echo htmlspecialchars($item['desc']); ?>
                            </p>
                            <a href="#" class="btn btn-primary w-100 fw-bold rounded-pill shadow-sm mt-auto" data-bs-target="#cartOffcanvas" onclick="event.preventDefault();">
                                <i class="fa fa-cart-plus me-1"></i>Keranjang
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>

        </div>
    </div>
    <!-- Product End -->


    <!-- Testimonial Start -->
    <div class="container-fluid py-5 theme-pink-maroon">
        <div class="container py-5">
            <div class="text-center">
                <div class="title wow fadeInUp">
                    <div class="title-center">
                        <h5>Testimonial</h5>
                        <h1>Our Clients Say</h1>
                    </div>
                </div>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp">
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
                            <h5 class="text-uppercase mb-1 fs-4">Siti Rahma</h5>
                            <span class="text-primary d-block mb-2 fs-5">Pembelian: Buket Wisuda</span>
                            <p class="mb-2 fs-5">Suka banget sama hasilnya! Cantik, rapi, dan terlihat eksklusif. Recommended untuk yang cari buket berkualitas</p>
                            <div class="text-warning fs-5">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimoni 2 -->
                <div class="testimonial-item">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center">
                            <img src="img/testimonial-2.png"
                                 class="img-fluid testimonial-img mb-2" 
                                 alt=""
                                 style="max-width: 100%; height: auto; object-fit: contain; border-radius: 15px;">
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-uppercase mb-1 fs-4">Andi Pratama</h5>
                            <span class="text-primary d-block mb-2 fs-5">Pembelian: Buket Ulang Tahun</span>
                            <p class="mb-2 fs-5">Buketnya sangat elegan, istri tercinta sangat senang saat menerimanya. Pengerjaan cepat dan pesanan selamat sampai tujuan!</p>
                            <div class="text-warning fs-5">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimoni 3 -->
                <div class="testimonial-item">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center">
                            <img src="img/testimonial-3.png" 
                                 class="img-fluid testimonial-img mb-2" 
                                 alt=""
                                 style="max-width: 100%; height: auto; object-fit: contain; border-radius: 15px;">
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-uppercase mb-1 fs-4">Dina Savitri</h5>
                            <span class="text-primary d-block mb-2 fs-5">Pembelian: Buket Uang</span>
                            <p class="mb-2 fs-5">Desain buket uangnya kreatif dan uangnya sama sekali tidak lecek! Sangat profesional dan sesuai dengan request. Bintang lima.</p>
                            <div class="text-warning fs-5">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimoni 4 -->
                <div class="testimonial-item">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center">
                            <img src="img/testimonial-4.png"
                                 class="img-fluid testimonial-img mb-2" 
                                 alt=""
                                 style="max-width: 100%; height: auto; object-fit: contain; border-radius: 15px;">
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-uppercase mb-1 fs-4">Budi Santoso</h5>
                            <span class="text-primary d-block mb-2 fs-5">Pembelian: Buket Anniversary</span>
                            <p class="mb-2 fs-5">Pesan mendadak untuk anniversary, untung bisa dibantu oleh admin yang ramah. Hasilnya tetap memukau dan bunga fresh banget.</p>
                            <div class="text-warning fs-5">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimoni 5 -->
                <div class="testimonial-item">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center">
                            <img src="img/testimonial-5.png"
                                 class="img-fluid testimonial-img mb-2" 
                                 alt=""
                                 style="max-width: 100%; height: auto; object-fit: contain; border-radius: 15px;">
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-uppercase mb-1 fs-4">Maya Wulandari</h5>
                            <span class="text-primary d-block mb-2 fs-5">Pembelian: Buket Snack</span>
                            <p class="mb-2 fs-5">Anak saya seneng banget dapet buket snack ini pas lulus SD. Isiannya komplit dan bisa request snack kesukaannya. Terbaik!</p>
                            <div class="text-warning fs-5">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
    <!-- Testimonial End -->


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
                    <h5 class="mb-0 text-primary fw-bold">Rp 450.000</h5>
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