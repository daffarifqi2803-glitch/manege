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
                            <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                            <a href="promotion.php" class="dropdown-item active">Promotion</a>
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

        <div class="page-header pb-5" style="background: linear-gradient(rgba(74, 74, 74, .6), rgba(74, 74, 74, .6)), url(img/promotion.jpg) center center no-repeat; background-size: cover;">
            <div class="container text-center py-5">
                <h1 class="display-4 text-uppercase mb-3 animated slideInDown">Promotion</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                        <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="#">Katalog</a></li>
                        <li class="breadcrumb-item text-primary active" aria-current="page">Promotion</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Promotion Start -->
    <div class="container-fluid py-5 bg-light" style="position: relative; overflow: hidden;">
        <!-- Latar belakang abstrak -->
        <div class="position-absolute rounded-circle" style="width: 300px; height: 300px; background: rgba(233, 30, 99, 0.1); filter: blur(50px); top: -100px; left: -100px;"></div>
        <div class="position-absolute rounded-circle" style="width: 400px; height: 400px; background: rgba(255, 122, 89, 0.1); filter: blur(60px); bottom: -150px; right: -150px;"></div>
        
        <div class="container py-5">
            <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="text-uppercase" style="color: var(--bs-primary); font-weight: 700; font-family:'Josefin Sans', sans-serif; letter-spacing: 2px;">Exclusive Offers</h5>
                <h1 class="display-4 fw-bold text-dark">Promo Spesial Bulan Ini</h1>
                <p class="fs-5 text-muted mx-auto mt-3" style="max-width: 600px;">Nikmati berbagai penawaran eksklusif dan diskon heboh untuk merayakan momen spesialmu bersama Putik Bouquet.</p>
            </div>

            <div class="row g-4 mb-5">
                <?php
                $promos_file = 'data/promos.json';
                $promos = [];
                if (file_exists($promos_file)) {
                    $promos = json_decode(file_get_contents($promos_file), true);
                }

                $gradients = [
                    'linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%)',
                    'linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%)',
                    'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)',
                    'linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%)'
                ];

                $i = 0;
                foreach ($promos as $promo):
                    $grad = $gradients[$i % count($gradients)];
                    $delay = 0.2 + ($i * 0.1);
                ?>
                <!-- Promo Card -->
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="<?php echo $delay; ?>s">
                    <div class="card border-0 shadow h-100" style="border-radius: 20px; overflow: hidden; background: <?php echo $grad; ?>;">
                        <div class="row g-0 align-items-center h-100">
                            <div class="col-md-5" style="height: 300px;">
                                <img src="<?php echo htmlspecialchars($promo['img']); ?>" class="img-fluid" style="height: 100%; width: 100%; object-fit: cover;" alt="<?php echo htmlspecialchars($promo['title']); ?>">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body p-4 p-lg-4">
                                    <div class="badge bg-danger rounded-pill px-3 py-2 mb-3 shadow-sm"><?php echo htmlspecialchars($promo['badge']); ?></div>
                                    <h3 class="card-title fw-bold text-dark mb-2" style="font-family:'Josefin Sans', sans-serif;"><?php echo htmlspecialchars($promo['title']); ?></h3>
                                    <p class="card-text text-dark mb-4" style="opacity: 0.8; font-size: 0.95rem; line-height:1.4;"><?php echo htmlspecialchars($promo['desc']); ?></p>
                                    <div class="d-flex align-items-center bg-white rounded-pill p-1 justify-content-between shadow-sm" style="border: 2px dashed var(--bs-primary);">
                                        <span class="ps-3 fw-bold" style="color: var(--bs-primary); font-family: monospace; font-size: 1.2rem; letter-spacing: 1px;" id="promoCode<?php echo $i; ?>"><?php echo htmlspecialchars($promo['code']); ?></span>
                                        <button class="btn rounded-pill px-4 text-white hover-zoom fw-bold" style="background: var(--bs-primary);" onclick="copyPromo('promoCode<?php echo $i; ?>')"><i class="fa fa-copy me-2"></i>Salin</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                $i++;
                endforeach; 
                ?>
            </div>

            <!-- Program Loyalitas Banner -->
            <div class="rounded-3 shadow-lg p-5 text-center wow fadeInUp" data-wow-delay="0.4s" style="background: url('img/aniversry-3.jpg') center/cover no-repeat; position: relative; overflow: hidden;">
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark" style="opacity: 0.75;"></div>
                <div class="position-relative z-1 text-white py-4">
                    <div style="display:inline-block; padding: 15px; border-radius: 50%; background: rgba(255,193,7,0.2); margin-bottom: 20px;">
                        <i class="fa fa-gem fa-3x" style="color: #ffc107;"></i>
                    </div>
                    <h2 class="text-white fw-bold mb-3 display-6" style="font-family:'Josefin Sans', sans-serif;">Bergabung dengan VIP Putik</h2>
                    <p class="fs-5 mx-auto mb-4" style="max-width: 600px; line-height:1.6;">Jadilah member setia kami dan kumpulkan poin setiap kali berbelanja. Poin dapat ditukar dengan <strong>Buket Gratis</strong>, terutama di hari ulang tahunmu!</p>
                    <a href="LoginPage/register.php" class="btn btn-warning rounded-pill py-3 px-5 text-dark fw-bold fs-5 shadow" style="transition: 0.3s;"><i class="fa fa-star me-2"></i>Daftar / Buat Akun Berbayar Sekarang</a>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Script Salin Promo -->
    <script>
    function copyPromo(elementId) {
        var text = document.getElementById(elementId).innerText;
        navigator.clipboard.writeText(text).then(() => {
            alert("Kode Promo '" + text + "' berhasil disalin. Masukkan kode ini saat melakukan checkout nanti!");
        }).catch(err => {
            console.error("Gagal menyalin: ", err);
        });
    }
    </script>
    <style>
    .hover-zoom {
        transition: transform 0.2s ease-in-out;
    }
    .hover-zoom:hover {
        transform: scale(1.05);
    }
    </style>
    <!-- Promotion End -->


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
<!--
<style>
/* Chat Toggle Button */
.chat-toggle-btn {
    position: fixed;
    bottom: 30px;
    right: 30px;
    /* transform removed untuk di pojok kanan bawah */
    background: linear-gradient(135deg, #ff9a9e, #e25c3b);
    color: #fff;
    padding: 12px 28px;
    font-family: 'Josefin Sans', sans-serif;
    font-size: 1.25rem;
    font-weight: 700;
    letter-spacing: 2px;
    border-radius: 30px;
    cursor: pointer;
    box-shadow: 0 5px 15px rgba(226, 92, 59, 0.4);
    z-index: 1040;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 1px solid rgba(255,255,255,0.4);
    border-bottom: none;
    display: flex;
    align-items: center;
    gap: 8px;
}

.chat-toggle-btn:hover {
    transform: translateY(-5px) scale(1.05); /* Muncul efek lompat ke atas */
    color: #fff;
    box-shadow: 0 10px 25px rgba(226, 92, 59, 0.6);
}

/* Offcanvas custom look */
.offcanvas-chat {
    width: 380px !important;
    border-right: none;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(25px);
    -webkit-backdrop-filter: blur(25px);
    box-shadow: 5px 0 35px rgba(0,0,0,0.1);
}

.offcanvas-chat .offcanvas-header {
    background: linear-gradient(135deg, #e25c3b, #ff7a59);
    color: white;
    padding: 20px 25px;
    border-bottom-right-radius: 20px;
}

.offcanvas-chat .btn-close {
    filter: invert(1) grayscale(100%) brightness(200%);
    opacity: 0.8;
}

.chat-body-area {
    height: 100%;
    overflow-y: auto;
    padding: 20px;
    background: #fdfdfd;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.msg-bubble {
    font-size: 0.95rem;
    padding: 12px 18px;
    border-radius: 20px;
    max-width: 82%;
    line-height: 1.5;
    word-wrap: break-word;
    box-shadow: 0 2px 5px rgba(0,0,0,0.03);
    animation: fadeInMsg 0.3s ease-out;
}

@keyframes fadeInMsg {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.msg-admin {
    background: #fff;
    color: #444;
    align-self: flex-start;
    border-bottom-left-radius: 4px;
    border: 1px solid #ebebeb;
}

.msg-user {
    background: #e25c3b;
    color: #fff;
    align-self: flex-end;
    border-bottom-right-radius: 4px;
}

.chat-footer {
    padding: 15px 20px;
    background: #fff;
    border-top: 1px solid #f0f0f0;
    display: flex;
    gap: 10px;
    align-items: center;
}

.chat-input {
    flex: 1;
    border: 1px solid #ddd;
    border-radius: 20px;
    padding: 12px 18px;
    outline: none;
    font-size: 0.95rem;
    background: rgba(255,255,255,0.8);
    transition: all 0.3s;
}

.chat-input:focus {
    border-color: #ff9a9e;
    box-shadow: 0 0 10px rgba(255, 154, 158, 0.2);
    background: #fff;
}

.chat-send-btn {
    background: linear-gradient(135deg, #e25c3b, #ff7a59);
    color: #fff;
    border: none;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: 0.3s;
    box-shadow: 0 4px 10px rgba(226, 92, 59, 0.3);
}

.chat-send-btn:hover {
    transform: scale(1.08);
    box-shadow: 0 6px 15px rgba(226, 92, 59, 0.4);
}
.chat-send-btn i {
    margin-right: 2px;
}
</style>

<!-- Sidebar Trigger -->
<div class="chat-toggle-btn" data-bs-toggle="offcanvas" data-bs-target="#liveChatOffcanvas">
    ✨ LIVE CHAT
</div>

<!-- Offcanvas Sidebar -->
<div class="offcanvas offcanvas-end offcanvas-chat" tabindex="-1" id="liveChatOffcanvas" aria-labelledby="liveChatOffcanvasLabel">
    <div class="offcanvas-header">
        <div class="d-flex align-items-center gap-3">
            <div style="position:relative;">
                <img src="../img/logo.png" onerror="this.src='img/logo.png'" alt="Admin" style="width: 48px; height: 48px; border-radius: 50%; background: #fff; padding:3px; object-fit: contain; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <span class="pulse-indicator" style="position:absolute; bottom:2px; right:0; width:12px; height:12px; background:#00e676; border-radius:50%; border:2px solid #fff;"></span>
            </div>
            <div>
                <h5 class="offcanvas-title text-white mb-0" id="liveChatOffcanvasLabel" style="font-family:'Josefin Sans',sans-serif; letter-spacing:1px;">Customer Care</h5>
                <small style="opacity: 0.9; font-weight:600;"><i class="fa fa-circle text-success me-1" style="font-size:0.6rem;"></i>Online | Putik Bouquet</small>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    
    <div class="chat-body-area" id="chatArea">
        <div class="msg-bubble msg-admin">
            Halo! 🌸 Senang bertemu Anda. Ada yang bisa kami bantu seputar buket atau hampers kami hari ini?
        </div>
    </div>
    
    <div class="chat-footer">
        <input type="text" id="chatInputBar" class="chat-input" placeholder="Tulis pesan..." autocomplete="off">
        <button class="chat-send-btn" id="chatSendBtn">
            <i class="fa fa-paper-plane"></i>
        </button>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const chatInput = document.getElementById('chatInputBar');
    const sendBtn = document.getElementById('chatSendBtn');
    const chatArea = document.getElementById('chatArea');

    function sendMessage() {
        let text = chatInput.value.trim();
        if(text === "") return;

        // User Message
        let userMsg = document.createElement('div');
        userMsg.className = 'msg-bubble msg-user';
        userMsg.innerText = text;
        chatArea.appendChild(userMsg);
        
        chatInput.value = "";
        chatArea.scrollTop = chatArea.scrollHeight;

        // Auto Reply / Routing logic visual simulation
        setTimeout(() => {
            let adminMsg = document.createElement('div');
            adminMsg.className = 'msg-bubble msg-admin';
            adminMsg.innerHTML = "<em>(Pesan diteruskan ke WhatsApp Admin otomatis)</em>. <br><br>Terima kasih, mohon tunggu balasan tim kami segera! ✨";
            chatArea.appendChild(adminMsg);
            chatArea.scrollTop = chatArea.scrollHeight;
        }, 1200);
    }

    sendBtn.addEventListener('click', sendMessage);
    chatInput.addEventListener('keypress', function(e) {
        if(e.key === 'Enter') {
            sendMessage();
        }
    });
});
</script>
-->
</body>

</html>