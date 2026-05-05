<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    // If not logged in as admin, redirect
    header("Location: LoginPage/login.php");
    exit;
}

$products_file = 'data/products.json';
$sales_file = 'data/sales.json';
$customers_file = 'data/customers.json';
$promos_file = 'data/promos.json';

$products_data = [];
$sales_data = [];
$customers_data = [];
$promos_data = [];

if (file_exists($products_file)) $products_data = json_decode(file_get_contents($products_file), true);
if (file_exists($sales_file)) $sales_data = json_decode(file_get_contents($sales_file), true);
if (file_exists($customers_file)) $customers_data = json_decode(file_get_contents($customers_file), true);
if (file_exists($promos_file)) $promos_data = json_decode(file_get_contents($promos_file), true);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard - Putik Bouquet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;700&family=Work+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { background: #fdfdfd; font-family: 'Josefin Sans', sans-serif; }
        .sidebar { min-height: 100vh; background: linear-gradient(135deg, #e91e63, #ff7a59); color: white; }
        .sidebar .nav-link { color: rgba(255,255,255,0.8); text-decoration: none; display: block; padding: 15px; font-weight: 500; transition: 0.3s; border-radius: 0; text-align: left; background: transparent; border: none; width: 100%; cursor: pointer;}
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(255,255,255,0.2); color: white; border-left: 4px solid white; }
        .card-custom { border-radius: 15px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .btn-pink { background-color: #e91e63; color: white; }
        .btn-pink:hover { background-color: #c2185b; color: white; }
        .btn-outline-pink { color: #e91e63; border-color: #e91e63; }
        .btn-outline-pink:hover, .btn-check:checked + .btn-outline-pink { background-color: #e91e63; color: white; }
        .stat-card { border-radius: 15px; border: none; color: white; padding: 20px;}
        .stat-chart { background: linear-gradient(135deg, #ff9a9e, #fecfef); }
        .stat-cust { background: linear-gradient(135deg, #a18cd1, #fbc2eb); }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .clock-container { background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 12px; padding: 10px 20px; color: white; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border: 1px solid rgba(255,255,255,0.2); }
        .live-indicator { width: 10px; height: 10px; background: #00ff00; border-radius: 50%; display: inline-block; margin-right: 8px; animation: pulse 2s infinite; }
        @keyframes pulse { 0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(0, 255, 0, 0.7); } 70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(0, 255, 0, 0); } 100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(0, 255, 0, 0); } }
        .status-badge { font-size: 0.75rem; padding: 4px 10px; border-radius: 20px; }
        .status-online { background: #e8f5e9; color: #2e7d32; }
        .status-offline { background: #ffebee; color: #c62828; }
        
        /* Chat Input Styles */
        .chat-input {
            flex: 1;
            border: 1px solid #ddd;
            border-radius: 20px;
            padding: 12px 18px;
            outline: none;
            font-size: 0.95rem;
            font-weight: 600; /* Font dipertebal */
            background: rgba(255,255,255,0.8);
            transition: all 0.3s;
            color: #444; /* Explicitly set text color so it's visible */
        }
        .chat-input:focus {
            border-color: #ff9a9e;
            box-shadow: 0 0 10px rgba(255, 154, 158, 0.2);
            background: #fff;
        }
        .chat-input:disabled {
            background: #eee;
            color: #999;
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
        .chat-send-btn:hover:not(:disabled) {
            transform: scale(1.08);
            box-shadow: 0 6px 15px rgba(226, 92, 59, 0.4);
        }
        .chat-send-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            box-shadow: none;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar as Nav Pills -->
        <div class="col-md-2 p-0 sidebar flex-column">
            <div class="p-4 text-center border-bottom border-light">
                <i class="fa fa-spa fa-3x mb-2"></i>
                <h5>Putik Admin</h5>
            </div>
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#v-pills-overview" type="button" role="tab">
                    <i class="fa fa-chart-line me-2"></i> Grafik Pembelian
                </button>
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#v-pills-products" type="button" role="tab">
                    <i class="fa fa-box me-2"></i> Kelola Produk
                </button>
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#v-pills-customers" type="button" role="tab">
                    <i class="fa fa-users me-2"></i> Data Pelanggan
                </button>
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#v-pills-finance" type="button" role="tab">
                    <i class="fa fa-wallet me-2"></i> Laporan Keuangan
                </button>
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#v-pills-promos" type="button" role="tab">
                    <i class="fa fa-tags me-2"></i> Kelola Promo
                </button>
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#v-pills-chat" type="button" role="tab" id="chat-tab-btn">
                    <i class="fa fa-comments me-2"></i> Live Chat <span class="badge bg-danger ms-2 d-none" id="admin-chat-badge">0</span>
                </button>
                <a href="index.php" target="_blank" class="nav-link"><i class="fa fa-globe me-2"></i> Kunjungi Web</a>
                <a href="LoginPage/logout.php" class="nav-link"><i class="fa fa-sign-out-alt me-2"></i> Logout</a>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-10 p-5 bg-light">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-dark mb-0">Enterprise Workspace</h2>
                    <p class="text-muted mb-0">Monitoring & Manajemen Sistem Real-time</p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="clock-container text-dark" style="background: white; border: 1px solid #eee;">
                        <div id="liveClock" class="fw-bold fs-5">00:00:00</div>
                        <div id="liveDate" class="small text-muted">Memuat tanggal...</div>
                    </div>
                    <span class="badge bg-primary p-2 fs-6"><i class="fa fa-user-circle me-2"></i>Administrator</span>
                </div>
            </div>

            <?php if(isset($_SESSION['success_msg'])): ?>
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fa fa-check-circle me-2"></i> <?php echo $_SESSION['success_msg']; unset($_SESSION['success_msg']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="tab-content" id="v-pills-tabContent">
                
                <!-- TAB 1: GRAFIK PEMBELIAN -->
                <div class="tab-pane fade show active" id="v-pills-overview" role="tabpanel">
                    <?php 
                        $current_month_sales = end($sales_data);
                        $current_revenue = $current_month_sales['revenue'] ?? 0;
                        $current_orders = $current_month_sales['orders'] ?? 0;
                    ?>
                    <div class="row mb-4 g-4">
                        <div class="col-md-3">
                            <div class="stat-card stat-chart shadow-sm">
                                <h6>Total Pendapatan</h6>
                                <h3>Rp <?php echo number_format($current_revenue, 0, ',', '.'); ?></h3>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card shadow-sm" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
                                <h6>Produk Terjual</h6>
                                <h3><?php echo number_format($current_orders, 0, ',', '.'); ?> Buket</h3>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card stat-cust shadow-sm">
                                <h6>User Online <span class="live-indicator ms-2"></span></h6>
                                <h3 id="stat_online">0</h3>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card shadow-sm" style="background: linear-gradient(135deg, #f093fb, #f5576c);">
                                <h6>Total Pelanggan</h6>
                                <h3 id="stat_total"><?php echo count($customers_data); ?></h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card card-custom">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="fw-bold text-dark mb-0">Grafik Tren Penjualan E-Commerce</h5>
                                <div class="btn-group shadow-sm" role="group">
                                    <input type="radio" class="btn-check" name="chartview" id="chartDaily" autocomplete="off" checked onchange="updateChart('daily')">
                                    <label class="btn btn-outline-pink fw-bold px-4" for="chartDaily">Harian</label>

                                    <input type="radio" class="btn-check" name="chartview" id="chartMonthly" autocomplete="off" onchange="updateChart('monthly')">
                                    <label class="btn btn-outline-pink fw-bold px-4" for="chartMonthly">Bulanan</label>
                                </div>
                            </div>
                            <canvas id="salesChart" height="100"></canvas>
                        </div>
                    </div>
                </div>

                <!-- TAB 2: KELOLA PRODUK -->
                <div class="tab-pane fade" id="v-pills-products" role="tabpanel">
                    <div class="card card-custom">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    <?php $i=0; foreach($products_data as $category => $items): ?>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link <?php echo ($i==0)?'active':''; ?> rounded-pill" data-bs-toggle="pill" data-bs-target="#tab-<?php echo strtolower($category); ?>" type="button" role="tab" style="color: #666;">
                                                <?php echo $category; ?>
                                            </button>
                                        </li>
                                    <?php $i++; endforeach; ?>
                                </ul>
                                <button class="btn btn-success rounded-pill px-4 shadow-sm" onclick="openAddModal()">
                                    <i class="fa fa-plus-circle me-2"></i>Tambah Produk
                                </button>
                            </div>
                            
                            <div class="tab-content" id="pills-tabContent">
                                <?php $i=0; foreach($products_data as $category => $items): ?>
                                    <div class="tab-pane fade <?php echo ($i==0)?'show active':''; ?>" id="tab-<?php echo strtolower($category); ?>" role="tabpanel">
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle border-top">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Gambar</th>
                                                        <th>Nama Produk</th>
                                                        <th>Harga (Rp)</th>
                                                        <th style="width: 35%;">Deskripsi</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($items as $item): ?>
                                                    <tr>
                                                        <td>
                                                            <img src="<?php echo htmlspecialchars($item['img']); ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                                        </td>
                                                        <td class="fw-bold"><?php echo htmlspecialchars($item['name']); ?></td>
                                                        <td class="text-primary fw-bold"><?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                                                        <td class="small text-muted"><?php echo htmlspecialchars($item['desc']); ?></td>
                                                        <td class="text-nowrap">
                                                            <button class="btn btn-sm btn-outline-primary rounded-pill px-3 shadow-sm me-1" 
                                                                onclick="openEditModal('<?php echo $category; ?>', '<?php echo $item['id']; ?>', '<?php echo addslashes($item['name']); ?>', '<?php echo $item['price']; ?>', '<?php echo addslashes(preg_replace('/\s+/', ' ', $item['desc'])); ?>', '<?php echo addslashes($item['img']); ?>')">
                                                                <i class="fa fa-edit me-1"></i> Edit
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-sm" 
                                                                onclick="deleteProduct('<?php echo $item['id']; ?>', '<?php echo addslashes($item['name']); ?>')">
                                                                <i class="fa fa-trash me-1"></i> Hapus
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <?php $i++; endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 3: DATA PELANGGAN -->
                <div class="tab-pane fade" id="v-pills-customers" role="tabpanel">
                    <div class="card card-custom">
                        <div class="card-body">
                            <h5 class="fw-bold text-dark mb-4">Basis Data Pelanggan Reguler</h5>
                            <div class="table-responsive">
                                <table class="table table-striped align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Email</th>
                                            <th>Total Orders</th>
                                            <th>Total Belanja</th>
                                            <th>Status</th>
                                            <th>Tgl Bergabung</th>
                                        </tr>
                                    </thead>
                                    <tbody id="customer_table_body">
                                        <?php foreach($customers_data as $cust): ?>
                                        <tr>
                                            <td class="fw-bold">USR-<?php echo str_pad($cust['id'], 4, '0', STR_PAD_LEFT); ?></td>
                                            <td><i class="fa fa-user-circle text-muted me-2"></i><?php echo $cust['name']; ?></td>
                                            <td><?php echo $cust['email']; ?></td>
                                            <td class="text-center"><span class="badge bg-info text-dark rounded-pill"><?php echo $cust['total_orders'] ?? 0; ?></span></td>
                                            <td class="fw-bold text-success">Rp <?php echo number_format($cust['total_spent'] ?? 0, 0, ',', '.'); ?></td>
                                            <td>
                                                <span class="status-badge <?php echo ($cust['status'] == 'online') ? 'status-online' : 'status-offline'; ?>">
                                                    <i class="fa fa-circle me-1" style="font-size: 8px;"></i>
                                                    <?php echo ucfirst($cust['status']); ?>
                                                </span>
                                            </td>
                                            <td><?php echo date("d M Y", strtotime($cust['joined'])); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination Container -->
                            <nav aria-label="Customer pagination">
                                <ul class="pagination pagination-sm justify-content-center mt-3" id="customer_pagination">
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- TAB 4: LAPORAN KEUANGAN -->
                <div class="tab-pane fade" id="v-pills-finance" role="tabpanel">
                    <div class="row g-4 mb-4">
                        <?php
                            $total_rev = array_sum(array_column($sales_data, 'revenue'));
                            $total_ord = array_sum(array_column($sales_data, 'orders'));
                            $avg_ticket = $total_ord > 0 ? $total_rev / $total_ord : 0;
                        ?>
                        <div class="col-md-4">
                            <div class="card card-custom p-4 bg-white border-start border-primary border-5">
                                <h6 class="text-muted small fw-bold">TOTAL PENDAPATAN (ALL TIME)</h6>
                                <h3 class="text-primary fw-bold">Rp <?php echo number_format($total_rev, 0, ',', '.'); ?></h3>
                                <div class="text-success small"><i class="fa fa-arrow-up"></i> 12% dari kuartal lalu</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-custom p-4 bg-white border-start border-success border-5">
                                <h6 class="text-muted small fw-bold">RATA-RATA ORDER VALUE</h6>
                                <h3 class="text-success fw-bold">Rp <?php echo number_format($avg_ticket, 0, ',', '.'); ?></h3>
                                <div class="text-muted small">Berdasarkan <?php echo $total_ord; ?> pesanan</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-custom p-4 bg-white border-start border-warning border-5">
                                <h6 class="text-muted small fw-bold">PROYEKSI BULAN DEPAN</h6>
                                <h3 class="text-warning fw-bold">Rp <?php echo number_format($total_rev / count($sales_data) * 1.1, 0, ',', '.'); ?></h3>
                                <div class="text-muted small">Estimasi pertumbuhan 10%</div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-custom shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-4">Rincian Keuangan Bulanan</h5>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Bulan</th>
                                            <th>Total Pesanan</th>
                                            <th>Pendapatan (Gross)</th>
                                            <th>Estimasi Profit (25%)</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach(array_reverse($sales_data) as $s): ?>
                                        <tr>
                                            <td class="fw-bold"><?php echo $s['month']; ?> 2026</td>
                                            <td><?php echo $s['orders']; ?> Order</td>
                                            <td class="fw-bold">Rp <?php echo number_format($s['revenue'], 0, ',', '.'); ?></td>
                                            <td class="text-success fw-bold">Rp <?php echo number_format($s['revenue'] * 0.25, 0, ',', '.'); ?></td>
                                            <td><span class="badge bg-success-soft text-success px-3 rounded-pill" style="background: #e8f5e9;">Completed</span></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 5: KELOLA PROMO -->
                <div class="tab-pane fade" id="v-pills-promos" role="tabpanel">
                    <div class="card card-custom">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="fw-bold text-dark mb-0">Daftar Promosi Aktif</h5>
                                <button class="btn btn-success rounded-pill px-4 shadow-sm" onclick="openAddPromoModal()">
                                    <i class="fa fa-plus-circle me-2"></i>Tambah Promo
                                </button>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-hover align-middle border-top">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Banner</th>
                                            <th>Kode</th>
                                            <th>Info Promo</th>
                                            <th>Diskon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($promos_data as $promo): ?>
                                        <tr>
                                            <td>
                                                <img src="<?php echo htmlspecialchars($promo['img']); ?>" style="width: 80px; height: 45px; object-fit: cover; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                            </td>
                                            <td><span class="badge bg-light text-primary border border-primary px-3 py-2"><?php echo htmlspecialchars($promo['code']); ?></span></td>
                                            <td>
                                                <div class="fw-bold"><?php echo htmlspecialchars($promo['title']); ?></div>
                                                <small class="text-muted"><?php echo htmlspecialchars($promo['badge']); ?></small>
                                            </td>
                                            <td class="fw-bold text-danger">
                                                <?php echo ($promo['type'] == 'percent') ? $promo['value'].'%' : 'Rp '.number_format($promo['value'], 0, ',', '.'); ?>
                                            </td>
                                            <td class="text-nowrap">
                                                <button class="btn btn-sm btn-outline-primary rounded-pill px-3 shadow-sm me-1" 
                                                    onclick="openEditPromoModal(<?php echo htmlspecialchars(json_encode($promo)); ?>)">
                                                    <i class="fa fa-edit me-1"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-sm" 
                                                    onclick="deletePromo('<?php echo $promo['id']; ?>', '<?php echo htmlspecialchars($promo['code']); ?>')">
                                                    <i class="fa fa-trash me-1"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 6: LIVE CHAT -->
                <div class="tab-pane fade" id="v-pills-chat" role="tabpanel">
                    <div class="card card-custom" style="height: 70vh;">
                        <div class="row g-0 h-100">
                            <!-- User List -->
                            <div class="col-md-4 border-end">
                                <div class="p-3 border-bottom bg-light">
                                    <h6 class="fw-bold mb-0">Active Conversations</h6>
                                </div>
                                <div class="list-group list-group-flush overflow-auto" id="admin-chat-user-list" style="max-height: calc(70vh - 50px);">
                                    <div class="p-4 text-center text-muted">Loading chats...</div>
                                </div>
                            </div>
                            <!-- Chat Area -->
                            <div class="col-md-8 d-flex flex-column h-100 bg-white">
                                <div class="p-3 border-bottom d-flex justify-content-between align-items-center" id="active-chat-header">
                                    <h6 class="fw-bold mb-0" id="current-chat-user">Select a conversation</h6>
                                    <span class="badge bg-success-soft text-success px-3 rounded-pill d-none" id="online-status">Online</span>
                                </div>
                                <div class="flex-grow-1 p-4 overflow-auto bg-light" id="admin-chat-area" style="display: flex; flex-direction: column; gap: 10px;">
                                    <div class="m-auto text-muted">Pilih pelanggan di samping untuk mulai membalas pesan.</div>
                                </div>
                                <div class="p-3 border-top d-flex gap-2 align-items-center">
                                    <input type="text" id="admin-chat-input" class="chat-input" placeholder="Tulis balasan..." disabled>
                                    <button class="chat-send-btn" id="admin-send-btn" disabled>
                                        <i class="fa fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Toast Container for Notifications -->
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
  <div id="regToast" class="toast hide shadow-lg border-0" role="alert" aria-live="assertive" aria-atomic="true" style="border-radius: 15px;">
    <div class="toast-header bg-success text-white" style="border-radius: 15px 15px 0 0;">
      <i class="fa fa-user-plus me-2"></i>
      <strong class="me-auto">Registrasi Baru!</strong>
      <small>Baru saja</small>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body bg-white py-3" style="border-radius: 0 0 15px 15px;">
      <div class="d-flex align-items-center">
        <div class="flex-shrink-0">
          <i class="fa fa-circle-check fa-2x text-success"></i>
        </div>
        <div class="flex-grow-1 ms-3">
          <p class="mb-0 fw-bold text-dark" id="toast_name">User Baru</p>
          <small class="text-muted">Telah bergabung di sistem.</small>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit/Tambah Produk -->
<div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="admin_manage_products.php" method="POST" enctype="multipart/form-data" onsubmit="confirmAction(event, 'produk', this)">
        <div class="modal-content border-0 shadow-lg">
        <div class="modal-header bg-light border-0">
            <h5 class="modal-title fw-bold text-dark" id="modalTitle"><i class="fa fa-edit text-primary me-2"></i>Edit Detail Produk</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
            <input type="hidden" name="action" id="modal_action" value="update">
            <input type="hidden" name="id" id="modal_id">
            
            <div class="text-center mb-4">
                <img id="preview_img" src="img/placeholder.jpg" style="width: 120px; height: 120px; object-fit: cover; border-radius: 10px; border: 3px solid #ff9a9e; padding: 2px;">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold small text-muted">Kategori</label>
                <select class="form-select" name="category" id="modal_category" required>
                    <?php foreach($products_data as $cat => $val): ?>
                    <option value="<?php echo $cat; ?>"><?php echo $cat; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold small text-muted">Nama Produk</label>
                <input type="text" class="form-control" name="name" id="modal_name" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold small text-muted">Harga (Rp)</label>
                <input type="number" class="form-control" name="price" id="modal_price" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold small text-muted">Foto Produk</label>
                <input type="file" class="form-control" name="uploaded_image" id="modal_file" accept="image/png, image/jpeg, image/jpg">
                <small class="text-muted d-block mt-1" id="fileHelp">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                <input type="hidden" name="img" id="modal_img_hidden">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold small text-muted">Deskripsi</label>
                <textarea class="form-control" name="desc" id="modal_desc" rows="3" required></textarea>
            </div>
        </div>
        <div class="modal-footer bg-light border-0">
            <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-pink rounded-pill px-4"><i class="fa fa-save me-2"></i>Simpan</button>
        </div>
        </div>
    </form>
  </div>
</div>

<!-- Modal Edit/Tambah Promo -->
<div class="modal fade" id="promoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="admin_manage_promos.php" method="POST" enctype="multipart/form-data" onsubmit="confirmAction(event, 'promo', this)">
        <div class="modal-content border-0 shadow-lg">
        <div class="modal-header bg-light border-0">
            <h5 class="modal-title fw-bold text-dark" id="promoModalTitle"><i class="fa fa-tag text-primary me-2"></i>Edit Detail Promo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
            <input type="hidden" name="action" id="promo_modal_action" value="update">
            <input type="hidden" name="id" id="promo_modal_id">
            
            <div class="text-center mb-4">
                <img id="promo_preview_img" src="img/placeholder.jpg" style="width: 100%; height: 150px; object-fit: cover; border-radius: 10px; border: 2px solid #eee;">
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold small text-muted">Kode Promo</label>
                    <input type="text" class="form-control" name="code" id="promo_modal_code" placeholder="CONTOH: HEMAT50" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold small text-muted">Badge / Label</label>
                    <input type="text" class="form-control" name="badge" id="promo_modal_badge" placeholder="Flash Sale / Promo" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold small text-muted">Judul Promo</label>
                <input type="text" class="form-control" name="title" id="promo_modal_title" required>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold small text-muted">Tipe Diskon</label>
                    <select class="form-select" name="type" id="promo_modal_type" required>
                        <option value="percent">Persentase (%)</option>
                        <option value="flat">Potongan Tetap (Rp)</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold small text-muted">Nilai</label>
                    <input type="number" class="form-control" name="value" id="promo_modal_value" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold small text-muted">Banner Promo</label>
                <input type="file" class="form-control" name="uploaded_image" id="promo_modal_file" accept="image/*">
                <small class="text-muted d-block mt-1" id="promoFileHelp">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                <input type="hidden" name="img" id="promo_modal_img_hidden">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold small text-muted">Deskripsi</label>
                <textarea class="form-control" name="desc" id="promo_modal_desc" rows="3" required></textarea>
            </div>
        </div>
        <div class="modal-footer bg-light border-0">
            <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-pink rounded-pill px-4"><i class="fa fa-save me-2"></i>Simpan Promo</button>
        </div>
        </div>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Menangani konfirmasi tambah/edit
function confirmAction(event, type, formElement) {
    event.preventDefault();
    
    let action = '';
    let actionWord = '';
    
    if (type === 'produk') {
        action = document.getElementById('modal_action').value;
    } else if (type === 'promo') {
        action = document.getElementById('promo_modal_action').value;
    }
    
    actionWord = action === 'add' ? 'menambahkan' : 'memperbarui';
    let typeName = type === 'promo' ? 'promosi' : 'produk';
    
    Swal.fire({
        title: 'Konfirmasi',
        text: `Apakah ingin ${actionWord} ${typeName}?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#e91e63',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Oke',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            let formData = new FormData(formElement);
            formData.append('ajax', 'true');
            
            fetch(formElement.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: data.message,
                        confirmButtonColor: '#e91e63'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Gagal!', data.message || 'Terjadi kesalahan.', 'error');
                }
            })
            .catch(error => {
                Swal.fire('Error!', 'Gagal menghubungi server.', 'error');
            });
        }
    });
}

// Menyimpan state tab yang aktif ke localStorage agar tidak kembali ke awal saat reload
$(document).ready(function() {
    $('a[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
        localStorage.setItem('activeAdminTab', $(e.target).attr('href'));
    });

    var activeTab = localStorage.getItem('activeAdminTab');
    if (activeTab) {
        var tabElement = document.querySelector('a[href="' + activeTab + '"]');
        if (tabElement) {
            var tab = new bootstrap.Tab(tabElement);
            tab.show();
        }
    }
});
</script>

<!-- Logika Chart.js untuk Grafik -->
<script>
    <?php
    $labels_monthly = [];
    $revenues_monthly = [];
    foreach($sales_data as $s) {
        $labels_monthly[] = $s['month'];
        $revenues_monthly[] = $s['revenue'];
    }
    
    // Generate daily mock data for the current month
    $days_in_month = date('t');
    $current_day = date('j');
    $labels_daily = range(1, $days_in_month);
    $revenues_daily = array_fill(0, $days_in_month, 0);
    
    $current_month_indo = [1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',7=>'Jul',8=>'Ags',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'][date('n')];
    $current_month_total = 0;
    foreach($sales_data as $s) {
        if ($s['month'] == $current_month_indo) {
            $current_month_total = $s['revenue'];
            break;
        }
    }
    
    if ($current_month_total > 0 && $current_day > 1) {
        $avg = $current_month_total / $current_day;
        for ($i=0; $i<$current_day; $i++) {
            $revenues_daily[$i] = rand($avg * 0.5, $avg * 1.5);
        }
    } else if ($current_month_total > 0 && $current_day == 1) {
        $revenues_daily[0] = $current_month_total;
    }
    ?>
    
    const monthlyData = {
        labels: <?php echo json_encode($labels_monthly); ?>,
        data: <?php echo json_encode($revenues_monthly); ?>,
        label: 'Pendapatan Bulanan (Rp)'
    };
    
    const dailyData = {
        labels: <?php echo json_encode($labels_daily); ?>.map(d => d + ' <?php echo $current_month_indo; ?>'),
        data: <?php echo json_encode($revenues_daily); ?>,
        label: 'Pendapatan Harian (Rp)'
    };

    const ctx = document.getElementById('salesChart').getContext('2d');
    let salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dailyData.labels,
            datasets: [{
                label: dailyData.label,
                data: dailyData.data,
                borderColor: '#e91e63',
                backgroundColor: 'rgba(233, 30, 99, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#ff7a59',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: true, position: 'top' } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            if (value >= 1000000) return 'Rp ' + (value/1000000) + ' Jt';
                            else if (value >= 1000) return 'Rp ' + (value/1000) + ' Rb';
                            return 'Rp ' + value;
                        }
                    }
                }
            }
        }
    });

    function updateChart(view) {
        if(view === 'monthly') {
            salesChart.data.labels = monthlyData.labels;
            salesChart.data.datasets[0].data = monthlyData.data;
            salesChart.data.datasets[0].label = monthlyData.label;
        } else {
            salesChart.data.labels = dailyData.labels;
            salesChart.data.datasets[0].data = dailyData.data;
            salesChart.data.datasets[0].label = dailyData.label;
        }
        salesChart.update();
    }

// Fungsi Real-time Clock
function updateClock() {
    const now = new Date();
    const timeStr = now.toLocaleTimeString('id-ID', { hour12: false });
    const dateStr = now.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
    document.getElementById('liveClock').textContent = timeStr;
    document.getElementById('liveDate').textContent = dateStr;
}
setInterval(updateClock, 1000);
updateClock();

let lastTotalUsers = <?php echo count($customers_data); ?>;

// Variables for pagination
let customerDataList = [];
let currentPage = 1;
const itemsPerPage = 10;

function renderCustomerTable() {
    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedItems = customerDataList.slice(start, end);
    
    let html = '';
    paginatedItems.forEach(cust => {
        const statusClass = (cust.status === 'online') ? 'status-online' : 'status-offline';
        const totalSpent = new Intl.NumberFormat('id-ID').format(cust.total_spent || 0);
        html += `<tr>
            <td class="fw-bold">USR-${String(cust.id).padStart(4, '0')}</td>
            <td><i class="fa fa-user-circle text-muted me-2"></i>${cust.name}</td>
            <td>${cust.email}</td>
            <td class="text-center"><span class="badge bg-info text-dark rounded-pill">${cust.total_orders || 0}</span></td>
            <td class="fw-bold text-success">Rp ${totalSpent}</td>
            <td>
                <span class="status-badge ${statusClass}">
                    <i class="fa fa-circle me-1" style="font-size: 8px;"></i>
                    ${cust.status.charAt(0).toUpperCase() + cust.status.slice(1)}
                </span>
            </td>
            <td>${new Date(cust.joined).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })}</td>
        </tr>`;
    });
    $('#customer_table_body').html(html); 
    
    // Render pagination
    const totalPages = Math.ceil(customerDataList.length / itemsPerPage);
    let pageHtml = '';
    for(let i=1; i<=totalPages; i++) {
        const active = i === currentPage ? 'active' : '';
        const bgColor = i === currentPage ? 'background-color: #e91e63; border-color: #e91e63; color: white;' : 'color: #e91e63;';
        pageHtml += `<li class="page-item ${active}"><a class="page-link shadow-sm" style="${bgColor} border-radius: 5px; margin: 0 3px;" href="#" onclick="changePage(${i}); return false;">${i}</a></li>`;
    }
    $('#customer_pagination').html(pageHtml);
}

function changePage(page) {
    currentPage = page;
    renderCustomerTable();
}

// Fungsi Polling Real-time Data
function fetchRealtimeData() {
    $.getJSON('admin_realtime_api.php', function(data) {
        if(data.stats) {
            // Check for new user notification
            if (data.stats.total > lastTotalUsers) {
                const newUser = data.latest_users[0];
                $('#toast_name').text(newUser.name);
                var toastEl = document.getElementById('regToast');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            }
            lastTotalUsers = data.stats.total;

            $('#stat_online').text(data.stats.online);
            $('#stat_total').text(data.stats.total);
            
            // Update customer data list for pagination
            customerDataList = data.latest_users;
            
            // Adjust current page if necessary
            const totalPages = Math.ceil(customerDataList.length / itemsPerPage);
            if (currentPage > totalPages && totalPages > 0) currentPage = totalPages;
            
            renderCustomerTable();
        }
    });
}
setInterval(fetchRealtimeData, 5000); // Poll every 5 seconds
fetchRealtimeData();

// Logika Modal Produk
function openAddModal() {
    document.getElementById('modalTitle').innerHTML = '<i class="fa fa-plus-circle text-success me-2"></i>Tambah Produk Baru';
    document.getElementById('modal_action').value = 'add';
    document.getElementById('modal_id').value = '';
    document.getElementById('modal_name').value = '';
    document.getElementById('modal_price').value = '';
    document.getElementById('modal_desc').value = '';
    document.getElementById('modal_img_hidden').value = '';
    document.getElementById('preview_img').src = 'img/placeholder.jpg';
    document.getElementById('fileHelp').innerText = 'Pilih foto untuk produk baru.';
    document.getElementById('modal_file').required = true;
    
    var myModal = new bootstrap.Modal(document.getElementById('productModal'));
    myModal.show();
}

function openEditModal(category, id, name, price, desc, img) {
    document.getElementById('modalTitle').innerHTML = '<i class="fa fa-edit text-primary me-2"></i>Edit Detail Produk';
    document.getElementById('modal_action').value = 'update';
    document.getElementById('modal_id').value = id;
    document.getElementById('modal_name').value = name;
    document.getElementById('modal_price').value = price;
    document.getElementById('modal_desc').value = desc;
    document.getElementById('modal_category').value = category;
    document.getElementById('modal_img_hidden').value = img;
    document.getElementById('preview_img').src = img;
    document.getElementById('fileHelp').innerText = 'Biarkan kosong jika tidak ingin mengganti gambar.';
    document.getElementById('modal_file').required = false;

    var myModal = new bootstrap.Modal(document.getElementById('productModal'));
    myModal.show();
}

// Logika Admin Live Chat
let currentChatSession = null;

function fetchChatList() {
    $.getJSON('api_chat.php?action=list', function(data) {
        if (data.error) return;
        
        let html = '';
        let totalUnread = 0;
        data.forEach(chat => {
            const isActive = (currentChatSession === chat.session_id) ? 'active' : '';
            const nameColor = (currentChatSession === chat.session_id) ? 'text-white' : 'text-pink';
            const unread = chat.unread_admin || 0;
            totalUnread += unread;
            const lastMsg = chat.messages[chat.messages.length - 1].message;
            const time = new Date(chat.last_activity).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
            
            html += `<button class="list-group-item list-group-item-action p-3 ${isActive}" onclick="selectChat('${chat.session_id}', '${chat.user_name}')">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h6 class="mb-0 fw-bold" style="${nameColor === 'text-pink' ? 'color: #e91e63;' : 'color: #fff;'}">${chat.user_name}</h6>
                    <small class="${isActive ? 'text-white-50' : 'text-muted'}">${time}</small>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0 text-muted text-truncate small" style="max-width: 150px;">${lastMsg}</p>
                    ${unread > 0 ? `<span class="badge bg-danger rounded-pill">${unread}</span>` : ''}
                </div>
            </button>`;
        });
        
        $('#admin-chat-user-list').html(html || '<div class="p-4 text-center text-muted">No messages yet.</div>');
        
        if (totalUnread > 0) {
            $('#admin-chat-badge').text(totalUnread).removeClass('d-none');
        } else {
            $('#admin-chat-badge').addClass('d-none');
        }
    });
}

function selectChat(sessionId, name) {
    currentChatSession = sessionId;
    $('#current-chat-user').text(name);
    $('#admin-chat-input, #admin-send-btn').prop('disabled', false);
    fetchMessages();
}

function fetchMessages() {
    if (!currentChatSession) return;
    $.getJSON('api_chat.php?action=fetch&session_id=' + currentChatSession, function(data) {
        let html = '';
        data.messages.forEach(msg => {
            const isMe = msg.sender === 'admin';
            const align = isMe ? 'flex-end' : 'flex-start';
            const bg = isMe ? 'linear-gradient(135deg, #e25c3b, #ff7a59)' : '#fff';
            const color = isMe ? '#fff' : '#444';
            const border = isMe ? 'none' : '1px solid #ebebeb';
            const radius = isMe ? '20px 20px 4px 20px' : '20px 20px 20px 4px';
            const senderLabel = isMe ? 'Admin' : $('#current-chat-user').text();
            const labelAlign = isMe ? 'right' : 'left';
            
            html += `<div style="align-self: ${align}; max-width: 82%; margin-bottom: 5px;">
                <small style="display: block; text-align: ${labelAlign}; color: #888; margin-bottom: 2px; font-weight: 600; font-size: 0.75rem;">${senderLabel}</small>
                <div style="background: ${bg}; color: ${color}; padding: 12px 18px; border-radius: ${radius}; box-shadow: 0 2px 5px rgba(0,0,0,0.03); border: ${border}; font-size: 0.95rem; line-height: 1.5; word-wrap: break-word;">
                    ${msg.message}
                </div>
            </div>`;
        });
        $('#admin-chat-area').html(html);
        $('#admin-chat-area').scrollTop($('#admin-chat-area')[0].scrollHeight);
    });
}

function sendReply() {
    const text = $('#admin-chat-input').val().trim();
    if (!text || !currentChatSession) return;
    
    $.post('api_chat.php', {
        action: 'send',
        message: text,
        target_user_id: currentChatSession
    }, function() {
        $('#admin-chat-input').val('');
        fetchMessages();
        fetchChatList();
    });
}

$('#admin-send-btn').click(sendReply);
$('#admin-chat-input').keypress(e => { if(e.key === 'Enter') sendReply(); });

setInterval(() => {
    fetchChatList();
    fetchMessages();
}, 4000);

fetchChatList();

function deleteProduct(id, name) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: `Apakah ingin menghapus produk "${name}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Oke',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post('admin_manage_products.php', { action: 'delete', id: id, ajax: true }, function(res) {
                if(res.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Terhapus!',
                        text: res.message || 'Produk berhasil dihapus.',
                        confirmButtonColor: '#e91e63'
                    }).then(() => {
                        location.reload();
                    });
                }
            });
        }
    });
}

// Logika Modal Promo
function openAddPromoModal() {
    document.getElementById('promoModalTitle').innerHTML = '<i class="fa fa-plus-circle text-success me-2"></i>Tambah Promo Baru';
    document.getElementById('promo_modal_action').value = 'add';
    document.getElementById('promo_modal_id').value = '';
    document.getElementById('promo_modal_code').value = '';
    document.getElementById('promo_modal_badge').value = '';
    document.getElementById('promo_modal_title').value = '';
    document.getElementById('promo_modal_type').value = 'percent';
    document.getElementById('promo_modal_value').value = '';
    document.getElementById('promo_modal_desc').value = '';
    document.getElementById('promo_modal_img_hidden').value = '';
    document.getElementById('promo_preview_img').src = 'img/placeholder.jpg';
    document.getElementById('promoFileHelp').innerText = 'Pilih foto banner promo.';
    document.getElementById('promo_modal_file').required = true;
    
    var myModal = new bootstrap.Modal(document.getElementById('promoModal'));
    myModal.show();
}

function openEditPromoModal(promo) {
    document.getElementById('promoModalTitle').innerHTML = '<i class="fa fa-edit text-primary me-2"></i>Edit Detail Promo';
    document.getElementById('promo_modal_action').value = 'update';
    document.getElementById('promo_modal_id').value = promo.id;
    document.getElementById('promo_modal_code').value = promo.code;
    document.getElementById('promo_modal_badge').value = promo.badge;
    document.getElementById('promo_modal_title').value = promo.title;
    document.getElementById('promo_modal_type').value = promo.type;
    document.getElementById('promo_modal_value').value = promo.value;
    document.getElementById('promo_modal_desc').value = promo.desc;
    document.getElementById('promo_modal_img_hidden').value = promo.img;
    document.getElementById('promo_preview_img').src = promo.img;
    document.getElementById('promoFileHelp').innerText = 'Biarkan kosong jika tidak ingin mengganti gambar.';
    document.getElementById('promo_modal_file').required = false;

    var myModal = new bootstrap.Modal(document.getElementById('promoModal'));
    myModal.show();
}

function deletePromo(id, code) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: `Apakah ingin menghapus promosi "${code}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Oke',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post('admin_manage_promos.php', { action: 'delete', id: id, ajax: true }, function(res) {
                if(res.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Terhapus!',
                        text: res.message || 'Promo berhasil dihapus.',
                        confirmButtonColor: '#e91e63'
                    }).then(() => {
                        location.reload();
                    });
                }
            });
        }
    });
}
</script>

<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
<script>
    // Auto Logout karena Inactivity (30 menit)
    let inactivityTime = function () {
        let time;
        const timeoutDuration = 30 * 60 * 1000; 

        window.onload = resetTimer;
        document.onmousemove = resetTimer;
        document.onkeypress = resetTimer;
        document.onscroll = resetTimer;
        document.onclick = resetTimer;
        document.ontouchstart = resetTimer;

        function logout() {
            window.location.href = 'LoginPage/logout.php?timeout=1';
        }

        function resetTimer() {
            clearTimeout(time);
            time = setTimeout(logout, timeoutDuration);
        }
    };
    
    inactivityTime();
</script>
<?php endif; ?>

</body>
</html>
