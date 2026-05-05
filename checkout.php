<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: LoginPage/login.php");
    exit;
}
$user_name = $_SESSION['user_name'] ?? "Pelanggan";
$user_address = $_SESSION['user_address'] ?? "Alamat belum diatur.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Checkout / Pembayaran - Putik Bouquet</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap');
        body { 
            background-color: var(--soft-pink-bg); 
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            color: var(--bs-dark);
        }
        .checkout-card {
            border-radius: 20px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.6);
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
        }
        .checkout-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(233, 30, 99, 0.1) !important;
        }
        .form-check {
            transition: all 0.2s ease;
            cursor: pointer;
            border: 2px solid transparent !important;
        }
        .form-check:hover {
            background-color: #fff !important;
            border-color: #ff9a9e !important;
            transform: scale(1.02);
            box-shadow: 0 8px 15px rgba(255, 154, 158, 0.15);
        }
        .form-check input:checked + label {
            color: #d81b60 !important;
        }
        .text-pink-custom { color: var(--deep-pink) !important; }
        .bg-pink-custom { background-color: #e91e63 !important; color: white; }
        .btn-pink-gradient { background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%); color: white; border: none; transition: 0.3s; }
        .btn-pink-gradient:hover { background: linear-gradient(135deg, #ff4b68 0%, #ff529a 100%); color: white; transform: translateY(-3px); box-shadow: 0 8px 20px rgba(233, 30, 99, 0.3); }
        .btn-outline-cancel { border: 2px solid #ddd; color: #555; font-weight: 700; background: white; transition: 0.3s; }
        .btn-outline-cancel:hover { background: #fdfdfd; color: #333; border-color: #aaa; transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05); }
        .section-title { font-weight: 800; letter-spacing: -0.5px; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold section-title text-pink-custom" style="font-size: 2.5rem;">
            <i class="fa fa-shopping-bag me-3"></i>Pembayaran (Checkout)
        </h1>
        <p class="text-muted fs-5">Selesaikan pembayaran Anda untuk memproses pesanan bervibrasi cinta</p>
    </div>

    <div class="row g-4">
        <!-- Rincian Pemesan -->
        <div class="col-lg-7">
            <div class="card checkout-card shadow-sm mb-4">
                <div class="card-body p-4">
                    <h4 class="mb-3 section-title text-pink-custom"><i class="fa fa-map-marker-alt me-2"></i>Informasi Pengiriman</h4>
                    <div class="p-3 bg-white rounded-3 border">
                        <p class="mb-1 fw-bold fs-5 text-dark"><?php echo htmlspecialchars($user_name); ?></p>
                        <p class="mb-3 text-muted"><?php echo htmlspecialchars($user_address); ?></p>
                        <a href="profile.php" class="btn btn-sm btn-outline-secondary rounded-pill px-4">Ubah Alamat</a>
                    </div>
                </div>
            </div>
            
            <div class="card checkout-card shadow-sm mb-4">
                <div class="card-body p-4">
                    <h4 class="mb-4 section-title text-pink-custom"><i class="fa fa-truck me-2"></i>Layanan Pengiriman</h4>
                    <div class="form-check mb-3 p-3 rounded-3 bg-light" id="box-gojek">
                        <input class="form-check-input ms-1" type="radio" name="shippingMethod" id="gojek" value="15000" checked onchange="updateCheckoutTotal()">
                        <label class="form-check-label ms-3 fw-bold text-dark w-100" for="gojek">
                            <i class="fa fa-motorcycle text-pink-custom me-2"></i>Gojek Instant <span class="float-end fw-normal text-muted">Rp 15.000</span>
                        </label>
                    </div>
                    <div class="form-check mb-3 p-3 rounded-3 bg-light" id="box-grab">
                        <input class="form-check-input ms-1" type="radio" name="shippingMethod" id="grab" value="20000" onchange="updateCheckoutTotal()">
                        <label class="form-check-label ms-3 fw-bold text-dark w-100" for="grab">
                            <i class="fa fa-motorcycle text-pink-custom me-2"></i>Grab Express <span class="float-end fw-normal text-muted">Rp 20.000</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="card checkout-card shadow-sm">
                <div class="card-body p-4">
                    <h4 class="mb-4 section-title text-pink-custom"><i class="fa fa-wallet me-2"></i>Metode Pembayaran</h4>
                    <div class="form-check mb-3 p-3 border rounded-3 bg-white" style="border-color: #ff9a9e !important; box-shadow: 0 4px 10px rgba(255, 154, 158, 0.1);">
                        <input class="form-check-input ms-1" type="radio" name="paymentMethod" id="qris" checked>
                        <label class="form-check-label ms-3 fw-bold text-pink-custom fs-5" for="qris">
                            <i class="fa fa-qrcode me-2"></i>QRIS Auto-Scan 
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ringkasan Pesanan -->
        <div class="col-lg-5">
            <div class="card checkout-card shadow-lg border-0" style="background: white;">
                <div class="card-body p-4">
                    <h4 class="mb-4 section-title text-pink-custom"><i class="fa fa-receipt me-2"></i>Ringkasan Pesanan</h4>
                    <div id="checkout-items-container" class="mb-4">
                        <!-- Item di-generate JS -->
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label text-dark fw-bold small"><i class="fa fa-ticket-alt me-2 text-pink-custom"></i>Kode Promo (Opsional)</label>
                        <div class="input-group">
                            <input type="text" id="promo-code-input" class="form-control" placeholder="Masukkan kode promo..." oninput="applyPromo()">
                            <button class="btn btn-dark fw-bold px-4" type="button" onclick="applyPromo()">Gunakan</button>
                        </div>
                        <small id="promo-msg" class="text-success mt-1 d-none fw-bold"></small>
                    </div>



                    <div class="p-3 bg-light rounded-3 mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted fw-bold">Subtotal</span>
                            <span id="checkout-subtotal" class="fw-bold text-dark">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 d-none" id="discount-row">
                            <span class="text-success fw-bold">Potongan Promo</span>
                            <span id="checkout-discount" class="fw-bold text-success">- Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted fw-bold">Ongkos Kirim</span>
                            <span id="checkout-shipping" class="fw-bold text-dark">Rp 15.000</span>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-4 pb-2 border-bottom">
                        <h3 class="fw-bold section-title text-dark">Total</h3>
                        <h3 class="fw-bold text-pink-custom" id="checkout-total">Rp 0</h3>
                    </div>
                    
                    <div class="d-flex gap-3 mt-4">
                        <a href="index.php" class="btn btn-outline-cancel w-50 py-3 rounded-pill text-center text-uppercase fs-6">Batal</a>
                        <button class="btn btn-pink-gradient w-50 py-3 fw-bold rounded-pill shadow-sm text-uppercase fs-6" id="bayar-btn" onclick="processCheckout()">Bayar Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- QRIS Modal -->
<div class="modal fade" id="qrisModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4 border-0 shadow">
      <div class="modal-header border-0 pb-0 justify-content-end">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4 class="fw-bold mb-1 border-bottom d-inline-block pb-2 border-3 text-primary">QRIS PUTIK BOUQUET</h4>
        <p class="text-muted mt-2 mx-auto" style="font-size: 0.9rem;">Pindai kode QR di bawah ini menggunakan M-Banking atau E-Wallet Anda (Gopay, OVO, Dana).</p>
        
        <div class="p-3 bg-white rounded shadow-sm d-inline-block position-relative border my-3">
            <img id="qris-qr-image" src="img/qris-bunga.jpeg" alt="QRIS Code - Rizki P.E.P" class="img-fluid" style="width:230px; border-radius: 8px;">
        </div>

        <h3 class="fw-bold text-dark mt-2" id="qris-total-amount">Rp 0</h3>
        <div class="small text-muted mb-4 lh-sm">
            <span class="fw-bold text-dark d-block mb-1">RIZKI P. E. P., TOKO BUNGA & TANAMAN HIAS</span>
            <span>NMID: ID1026507098410</span>
        </div>
        
        <a href="index.php" id="btn-success-pay" class="btn btn-success rounded-pill px-5 py-3 fw-bold w-100">Saya Sudah Bayar</a>
      </div>
    </div>
  </div>
</div>

<script>
function formatRupiah(number) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
}

let currentDiscount = 0; 
let currentDiscountType = 'none';

// Load promos from JSON for dynamic sync
const availablePromos = <?php 
    $promos_file = 'data/promos.json';
    echo file_exists($promos_file) ? file_get_contents($promos_file) : '[]';
?>;

function applyPromo() {
    const codeInput = document.getElementById('promo-code-input').value.trim().toUpperCase();
    const msg = document.getElementById('promo-msg');
    const row = document.getElementById('discount-row');
    
    // Find matching promo in the synced data
    const promo = availablePromos.find(p => p.code.toUpperCase() === codeInput);
    
    if (promo) {
        currentDiscountType = promo.type;
        currentDiscount = promo.value;
        
        let displayVal = (promo.type === 'percent') ? promo.value + '%' : formatRupiah(promo.value);
        msg.innerHTML = `<i class='fa fa-check-circle me-1'></i> Promo ${displayVal} (${promo.code}) diterapkan!`;
        msg.className = "text-success mt-1 d-block fw-bold";
        row.classList.remove('d-none');
    } else if (codeInput !== '') {
        currentDiscountType = 'none';
        currentDiscount = 0;
        msg.innerHTML = "<i class='fa fa-times-circle me-1'></i> Kode Promo tidak valid.";
        msg.className = "text-danger mt-1 d-block fw-bold";
        row.classList.add('d-none');
    } else {
        currentDiscountType = 'none';
        currentDiscount = 0;
        msg.innerHTML = "";
        msg.className = "d-none";
        row.classList.add('d-none');
    }
    updateCheckoutTotal();
}

function getUserKey() {
    const sessionName = "<?php echo addslashes($user_name); ?>";
    if(sessionName && sessionName !== "Putik Bouquet" && sessionName !== "") {
        return sessionName.trim().replace(/\s+/g, "_").toLowerCase();
    }
    return 'guest';
}

function getCartKey() {
    return 'poseify_cart_' + getUserKey();
}

function updateCheckoutTotal() {
    const cartKey = getCartKey();
    let cart = localStorage.getItem(cartKey);
    cart = cart ? JSON.parse(cart) : [];
    
    let subtotal = 0;
    const container = document.getElementById('checkout-items-container');
    container.innerHTML = "";
    
    if(cart.length === 0) {
        container.innerHTML = "<p class='text-danger small fw-bold mb-3'>Keranjang kosong. Mohon pilih buket di menu Katalog.</p>";
        document.getElementById('bayar-btn').disabled = true;
        
        // Auto redirect to shopping
        Swal.fire({
            icon: 'warning',
            title: 'Keranjang Kosong',
            text: 'Anda belum memilih produk. Mari berbelanja terlebih dahulu!',
            confirmButtonText: 'Ke Katalog',
            confirmButtonColor: '#e91e63',
            allowOutsideClick: false
        }).then(() => {
            window.location.href = 'index.php#katalog';
        });
        
        return; // stop execution
    }
    
    cart.forEach(item => {
        subtotal += (item.price * item.qty);
        container.innerHTML += `
            <div class="d-flex justify-content-between mb-3" style="font-size:0.9rem;">
                <span class="text-dark">${item.name} <span class="fw-bold text-primary">x ${item.qty}</span></span>
                <span class="fw-bold">${formatRupiah(item.price * item.qty)}</span>
            </div>
        `;
    });
    
    // Check which shipping is selected
    let shippingRadios = document.getElementsByName('shippingMethod');
    let shippingCost = 15000;
    for(let i=0; i<shippingRadios.length; i++){
        if(shippingRadios[i].checked) {
            shippingCost = parseInt(shippingRadios[i].value);
            // Highlight selected option
            shippingRadios[i].closest('.form-check')?.classList.add('border', 'border-success', 'border-2', 'bg-light');
        } else {
            shippingRadios[i].closest('.form-check')?.classList.remove('border', 'border-success', 'border-2', 'bg-light');
        }
    }
    
    let discountAmount = 0;
    if (currentDiscountType === 'percent') {
        discountAmount = subtotal * (currentDiscount / 100);
    } else if (currentDiscountType === 'flat') {
        discountAmount = currentDiscount;
    }
    
    // Ensure discount doesn't exceed subtotal
    if (discountAmount > subtotal) discountAmount = subtotal;

    document.getElementById('checkout-subtotal').innerText = formatRupiah(subtotal);
    document.getElementById('checkout-discount').innerText = "- " + formatRupiah(discountAmount);
    document.getElementById('checkout-shipping').innerText = formatRupiah(shippingCost);
    
    let total = (subtotal > 0) ? (subtotal - discountAmount + shippingCost) : 0;
    
    document.getElementById('checkout-total').innerText = formatRupiah(total);
    // Sync the QRIS modal
    document.getElementById('qris-total-amount').innerText = formatRupiah(total);
}

function processCheckout() {
    const cartKey = getCartKey();
    let cart = localStorage.getItem(cartKey);
    cart = cart ? JSON.parse(cart) : [];
    
    if(cart.length === 0) {
        window.location.href = 'index.php#katalog';
    } else {
        var myModal = new bootstrap.Modal(document.getElementById('qrisModal'));
        myModal.show();
    }
}

document.addEventListener("DOMContentLoaded", function() {
    updateCheckoutTotal();
    
    // Clear cart memory when user confirms payment
    document.getElementById('btn-success-pay').addEventListener("click", function() {
        const cartKey = getCartKey();
        localStorage.removeItem(cartKey);
        localStorage.removeItem("cartNotes_" + getUserKey());
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
