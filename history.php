<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: LoginPage/login.php");
    exit;
}

$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$user_email = $_SESSION['user_email'] ?? "name@example.com";
$user_name = $_SESSION['user_name'] ?? "Pelanggan";
$user_photo = $_SESSION['user_photo'] ?? "img/testimonial-1.png";

$orders_file = 'data/orders.json';
$user_orders = [];

if (file_exists($orders_file)) {
    $all_orders = json_decode(file_get_contents($orders_file), true);
    foreach ($all_orders as $order) {
        if ($order['user_email'] === $user_email) {
            $user_orders[] = $order;
        }
    }
}

// Sort orders by date descending
usort($user_orders, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Riwayat Pemesanan - Putik Bouquet</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        body { background-color: var(--soft-pink-bg); font-family: 'Josefin Sans', sans-serif; color: var(--bs-dark); }
        .history-card { border-radius: 15px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: 0.3s; margin-bottom: 25px; background: #fff;}
        .history-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
        .status-badge { padding: 5px 15px; border-radius: 20px; font-weight: 700; font-size: 0.8rem; }
        .status-selesai { background-color: #e8f5e9; color: #2e7d32; }
        .status-dikirim { background-color: #e3f2fd; color: #1565c0; }
        .status-diproses { background-color: #fff3e0; color: #ef6c00; }
        .product-img { width: 80px; height: 80px; object-fit: cover; border-radius: 10px; }
        .order-id { font-weight: 700; color: #e91e63; }
        
        /* Tracking Stepper */
        .stepper { display: flex; justify-content: space-between; position: relative; margin-bottom: 30px; }
        .stepper::before { content: ""; position: absolute; top: 15px; left: 0; width: 100%; height: 2px; background: #eee; z-index: 1; }
        .step { position: relative; z-index: 2; background: #fff; width: 30px; height: 30px; border-radius: 50%; border: 2px solid #eee; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; color: #ccc; }
        .step.active { border-color: #e91e63; color: #e91e63; font-weight: bold; }
        .step.completed { background: #e91e63; border-color: #e91e63; color: #fff; }
        .step-label { position: absolute; top: 35px; left: 50%; transform: translateX(-50%); font-size: 0.65rem; white-space: nowrap; color: #777; }
        .step.active .step-label { color: #e91e63; font-weight: bold; }

        /* Invoice Modal */
        .invoice-box { padding: 20px; border: 1px solid #eee; background: #f9f9f9; border-radius: 10px; font-family: 'Courier New', Courier, monospace; }
        .invoice-header { border-bottom: 2px dashed #ccc; padding-bottom: 10px; margin-bottom: 15px; text-align: center; }
    </style>
</head>
<body>
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
                                <a href="history.php" class="dropdown-item py-2 active"><i class="fa fa-history me-2"></i>My Orders</a>
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
                <h1 class="display-4 text-uppercase mb-3 animated slideInDown">Riwayat Pemesanan</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center text-uppercase mb-0">
                        <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="#">User</a></li>
                        <li class="breadcrumb-item text-primary active" aria-current="page">Riwayat Pemesanan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <div class="container pb-5 mt-5">
        <div class="text-center mb-5">
            <div class="title wow fadeInUp" data-wow-delay="0.1s">
                <div class="title-center">
                    <h5 style="color: var(--bs-primary);">Transaksi</h5>
                    <h1 style="color: var(--deep-pink);">Riwayat Belanja</h1>
                </div>
            </div>
        </div>
        <?php if (empty($user_orders)): ?>
            <div class="text-center py-5">
                <i class="fa fa-shopping-bag fa-5x text-muted mb-4 opacity-25"></i>
                <h3>Belum ada pesanan nih...</h3>
                <a href="team.php" class="btn btn-primary rounded-pill px-5 py-3 mt-3">Belanja Sekarang</a>
            </div>
        <?php else: ?>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <?php foreach ($user_orders as $order): ?>
                        <?php 
                            $status_class = 'status-' . strtolower($order['status']); 
                            $date_formatted = date("d M Y, H:i", strtotime($order['date']));
                        ?>
                        <div class="card history-card">
                            <div class="card-body p-4">
                                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 border-bottom pb-3">
                                    <div>
                                        <span class="text-muted small">ID Pesanan: <span class="order-id"><?php echo $order['order_id']; ?></span></span>
                                        <div class="small text-muted mt-1">Pembayaran: <span class="badge bg-success small"><?php echo $order['payment_status']; ?></span> (<?php echo $order['payment_method']; ?>)</div>
                                    </div>
                                    <div class="text-md-end mt-3 mt-md-0">
                                        <span class="status-badge <?php echo $status_class; ?>">
                                            <i class="fa fa-circle me-1" style="font-size:0.5rem;"></i> <?php echo $order['status']; ?>
                                        </span>
                                    </div>
                                </div>

                                <!-- Compact Item Preview -->
                                <div class="d-flex align-items-center gap-3 mb-4">
                                    <img src="<?php echo $order['items'][0]['img']; ?>" class="product-img">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 fw-bold"><?php echo $order['items'][0]['name']; ?></h6>
                                        <?php if(count($order['items']) > 1): ?>
                                            <small class="text-muted">+ <?php echo count($order['items']) - 1; ?> item lainnya</small>
                                        <?php endif; ?>
                                        <div class="text-primary fw-bold mt-1">Rp <?php echo number_format($order['total'], 0, ',', '.'); ?></div>
                                    </div>
                                    <div class="text-end">
                                        <button class="btn btn-sm btn-outline-primary rounded-pill px-3 mb-2 w-100" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $order['order_id']; ?>">Lihat Paket</button>
                                        <button class="btn btn-sm btn-primary rounded-pill px-3 w-100 btn-reorder" data-items='<?php echo json_encode($order['items']); ?>'><i class="fa fa-undo me-1"></i>Pesan Lagi</button>
                                    </div>
                                </div>

                                <!-- Action bar -->
                                <div class="d-flex justify-content-between border-top pt-3">
                                    <button class="btn btn-link text-decoration-none text-muted p-0 small" data-bs-toggle="modal" data-bs-target="#nota-<?php echo $order['order_id']; ?>"><i class="fa fa-file-invoice me-1"></i>Lihat Nota</button>
                                    <button class="btn btn-link text-decoration-none text-muted p-0 small" data-bs-toggle="modal" data-bs-target="#track-<?php echo $order['order_id']; ?>"><i class="fa fa-truck me-1"></i>Lacak Pengiriman</button>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL DETAIL -->
                        <div class="modal fade" id="modal-<?php echo $order['order_id']; ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content shadow border-0" style="border-radius: 20px;">
                                    <div class="modal-header border-0 pb-0">
                                        <h5 class="modal-title fw-bold">Detail Pesanan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="mb-3 small text-muted">ID: <?php echo $order['order_id']; ?> | <?php echo $date_formatted; ?></div>
                                        <?php foreach ($order['items'] as $item): ?>
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="<?php echo $item['img']; ?>" class="rounded me-3" style="width:50px; height:50px; object-fit:cover;">
                                                <div class="flex-grow-1">
                                                    <div class="fw-bold"><?php echo $item['name']; ?></div>
                                                    <small class="text-muted"><?php echo $item['qty']; ?> x Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></small>
                                                </div>
                                                <div class="fw-bold">Rp <?php echo number_format($item['price'] * $item['qty'], 0, ',', '.'); ?></div>
                                            </div>
                                        <?php endforeach; ?>
                                        <hr>
                                        <div class="d-flex justify-content-between fw-bold mb-1">
                                            <span>Subtotal</span>
                                            <span>Rp <?php echo number_format($order['total'] - 15000, 0, ',', '.'); ?></span>
                                        </div>
                                        <div class="d-flex justify-content-between text-muted small mb-1">
                                            <span>Ongkir</span>
                                            <span>Rp 15.000</span>
                                        </div>
                                        <div class="d-flex justify-content-between fw-bold h5 text-primary mt-3">
                                            <span>TOTAL</span>
                                            <span>Rp <?php echo number_format($order['total'], 0, ',', '.'); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL NOTA -->
                        <div class="modal fade" id="nota-<?php echo $order['order_id']; ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content border-0">
                                    <div class="modal-body p-0">
                                        <div class="invoice-box shadow">
                                            <div class="invoice-header">
                                                <div class="fw-bold fs-5">PUTIK BOUQUET</div>
                                                <small>Resi Pembelian Sah</small>
                                            </div>
                                            <div class="small mb-3">
                                                <div>ID: <?php echo $order['order_id']; ?></div>
                                                <div>Tgl: <?php echo $date_formatted; ?></div>
                                                <div>User: <?php echo $user_name; ?></div>
                                            </div>
                                            <div class="border-bottom border-secondary mb-2" style="border-style: dashed !important;"></div>
                                            <?php foreach ($order['items'] as $item): ?>
                                                <div class="d-flex justify-content-between small">
                                                    <span><?php echo $item['name']; ?> x<?php echo $item['qty']; ?></span>
                                                    <span><?php echo number_format($item['price'] * $item['qty'], 0, ',', '.'); ?></span>
                                                </div>
                                            <?php endforeach; ?>
                                            <div class="border-bottom border-secondary my-2" style="border-style: dashed !important;"></div>
                                            <div class="d-flex justify-content-between fw-bold">
                                                <span>TOTAL</span>
                                                <span>Rp <?php echo number_format($order['total'], 0, ',', '.'); ?></span>
                                            </div>
                                            <div class="text-center mt-4 small">
                                                * LUNAS (<?php echo $order['payment_method']; ?>) *<br>Terima kasih telah memesan!
                                            </div>
                                        </div>
                                        <button class="btn btn-dark w-100 mt-2 rounded-pill" onclick="window.print()">Cetak Nota</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL TRACKING -->
                        <div class="modal fade" id="track-<?php echo $order['order_id']; ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content shadow-lg border-0" style="border-radius:20px;">
                                    <div class="modal-body p-4 pt-5">
                                        <h5 class="text-center fw-bold mb-4">Lacak Pesanan</h5>
                                        <div class="stepper">
                                            <div class="step completed">1 <span class="step-label">Dipesan</span></div>
                                            <div class="step <?php echo ($order['status'] != 'Diproses') ? 'completed' : 'active'; ?>">2 <span class="step-label">Diproses</span></div>
                                            <div class="step <?php echo ($order['status'] == 'Selesai' || $order['status'] == 'Dikirim') ? 'completed' : (($order['status'] == 'Dikirim') ? 'active' : ''); ?>">3 <span class="step-label">Dikirim</span></div>
                                            <div class="step <?php echo ($order['status'] == 'Selesai') ? 'completed' : ''; ?>">4 <span class="step-label">Selesai</span></div>
                                        </div>
                                        <div class="mt-5 p-3 bg-light rounded text-center">
                                            <div class="small text-muted">Nomor Pelacakan:</div>
                                            <div class="fw-bold text-dark fs-5"><?php echo $order['tracking_no']; ?></div>
                                            <small class="text-primary mt-2 d-block">Metode: Kurir Internal Putik</small>
                                        </div>
                                        <button class="btn btn-primary w-100 mt-4 rounded-pill py-2" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
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
    <!-- Cart Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas">
        <div class="offcanvas-header bg-primary text-white">
            <h5 class="offcanvas-title text-white">Keranjang Anda</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
             <div id="cart-history-items" class="flex-grow-1 overflow-auto">
                 <p class="text-center text-muted py-5">Pilih item untuk pesan lagi.</p>
             </div>
             <div class="border-top pt-3">
                 <a href="checkout.php" class="btn btn-primary w-100 rounded-pill py-3 fw-bold">Lanjut Checkout</a>
             </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.btn-reorder').click(function() {
                const items = $(this).data('items');
                const userKey = "<?php echo strtolower(str_replace(' ', '_', $user_name)); ?>";
                const cartKey = 'poseify_cart_' + userKey;
                
                // Add items to localStorage cart
                let cart = JSON.parse(localStorage.getItem(cartKey)) || [];
                items.forEach(newItem => {
                    const existing = cart.find(i => i.name === newItem.name);
                    if(existing) {
                        existing.qty += newItem.qty;
                    } else {
                        cart.push(newItem);
                    }
                });
                localStorage.setItem(cartKey, JSON.stringify(cart));
                
                alert('Item telah ditambahkan kembali ke keranjang! Silakan cek menu Keranjang.');
                window.location.href = 'index.php'; // Or show cart offcanvas
            });
        });
    </script>
    <?php include 'chat_widget.php'; ?>
</body>
</html>
