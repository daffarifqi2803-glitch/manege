import os

cart_js_path = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\js\cart.js"

new_cart_js = """
// Menambahkan style animasi ke dalam head secara dinamis
const cartStyles = document.createElement('style');
cartStyles.innerHTML = `
/* Animasi Goyang Keranjang (Bounce) */
@keyframes cartWiggle {
    0%, 100% { transform: scale(1) rotate(0deg); }
    25% { transform: scale(1.4) rotate(-15deg); }
    50% { transform: scale(1.4) rotate(15deg); }
    75% { transform: scale(1.4) rotate(-15deg); }
}
.cart-bounce {
    animation: cartWiggle 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    color: #e25c3b !important;
    display: inline-block;
}

/* Animasi Toast / Snackbar Terbang */
.cart-toast {
    position: fixed;
    bottom: -100px; /* Hidden initially */
    left: 50%;
    transform: translateX(-50%);
    background: rgba(30, 30, 30, 0.95);
    color: white;
    padding: 12px 25px;
    border-radius: 50px;
    font-size: 0.95rem;
    font-weight: 600;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    z-index: 11000;
    transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    display: flex;
    align-items: center;
    gap: 12px;
}
.cart-toast.show {
    bottom: 40px; /* Muncul ke atas */
}
.cart-toast img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #e25c3b;
}
`;
document.head.appendChild(cartStyles);

document.addEventListener("DOMContentLoaded", function() {
    initCart();
    
    // Pendaftaran Event klik pada setiap produk (Add to Cart logic)
    document.querySelectorAll('a[data-bs-target="#cartOffcanvas"]').forEach(button => {
        button.addEventListener('click', function(e) {
            // Hanya berlaku jika klik pada tombol di dalam daftar produk (.team-item / .product-item)
            if(this.closest('.team-item')) {
                const productContainer = this.closest('.team-item');
                const productName = productContainer.querySelector('h5').innerText;
                let productPriceText = productContainer.querySelector('.text-primary.fw-bold').innerText;
                
                // Hilangkan "Rp", dst
                const cleanPriceStr = productPriceText.replace(/[^0-9]/g, '');
                const price = parseInt(cleanPriceStr);
                const productImgSrc = productContainer.querySelector('img').src;
                
                addToCart({
                    name: productName,
                    price: price,
                    img: productImgSrc,
                    qty: 1
                });
            }
        });
    });

    // Simpan otomatis isi text notes apabila pengguna mengetik
    const notesField = document.getElementById("cartNotes");
    if(notesField) {
        notesField.value = localStorage.getItem("cartNotes_" + getUserKey()) || "";
        notesField.addEventListener("input", function() {
            localStorage.setItem("cartNotes_" + getUserKey(), this.value);
        });
    }
});

// Identifier Sinkronisasi Keranjang berdasar User Account Profile
function getUserKey() {
    let nameElem = document.querySelector('.fw-bold.fs-6.text-primary'); 
    if(nameElem && nameElem.innerText.trim() !== "Putik Bouquet" && nameElem.innerText.trim() !== "") {
        return nameElem.innerText.trim().replace(/\s+/g, "_").toLowerCase();
    }
    return 'guest';
}

function getCartKey() {
    return 'poseify_cart_' + getUserKey();
}

function getCart() {
    let cart = localStorage.getItem(getCartKey());
    return cart ? JSON.parse(cart) : [];
}

function saveCart(cart) {
    localStorage.setItem(getCartKey(), JSON.stringify(cart));
}

function addToCart(product) {
    let cart = getCart();
    let existing = cart.find(item => item.name === product.name);
    if(existing) {
        existing.qty += 1; // + kuantitas jika sama
    } else {
        cart.push(product); // item baru
    }
    saveCart(cart);
    renderCart();

    // == ANIMASI IKON KERANJANG GOYANG ==
    let cartIconLinks = document.querySelectorAll('a[data-bs-target="#cartOffcanvas"] i.fa-shopping-cart');
    cartIconLinks.forEach(icon => {
        icon.classList.remove('cart-bounce');
        void icon.offsetWidth; // trigger dom reflow untuk mereset animasi css
        icon.classList.add('cart-bounce');
    });

    // == ANIMASI TOAST BAR ==
    showToast(product.img, product.name);
}

function showToast(imgSrc, name) {
    // Hindari duplikasi toast berlebihan
    document.querySelectorAll('.cart-toast').forEach(t => t.remove());

    let toast = document.createElement('div');
    toast.className = 'cart-toast';
    toast.innerHTML = `<img src="${imgSrc}" alt="${name}"> <span><b>${name}</b> dimasukkan ke keranjang! 🎉</span>`;
    document.body.appendChild(toast);
    
    // Transisi masuk
    setTimeout(() => {
        toast.classList.add('show');
    }, 50);

    // Transisi memudar setelah 3 detik
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 500);
    }, 3000);
}

// Terkspose global agar bisa dipanggil element innerHTML (onclick) pada keranjang laci
window.updateQty = function(name, delta) {
    let cart = getCart();
    let existing = cart.find(item => item.name === name);
    if(existing) {
        existing.qty += delta;
        if(existing.qty <= 0) {
            cart = cart.filter(item => item.name !== name); // hapus item apabila qty habis
        }
        saveCart(cart);
        renderCart();
    }
}

function formatRupiah(number) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
}

function renderCart() {
    let cart = getCart();
    const container = document.querySelector('#cartOffcanvas .overflow-auto');
    const totalEl = document.querySelector('#cartOffcanvas .mb-0.text-primary.fw-bold');
    
    // Perbarui semua badge (jumlah) yang ada di ikon keranjang header
    const cartBadges = document.querySelectorAll('.badge.rounded-pill.bg-danger');

    if(!container) return; // Skip di page yang tak punya canvas keranjang

    container.innerHTML = "";
    let total = 0;
    let totalItems = 0;

    if(cart.length === 0) {
        container.innerHTML = '<div class="text-center text-muted mt-5"><i class="fa fa-shopping-basket fa-3x mb-3 text-light"></i><p>Keranjang Anda masih kosong</p></div>';
    } else {
        cart.forEach(item => {
            total += (item.price * item.qty);
            totalItems += item.qty;
            
            const div = document.createElement('div');
            div.className = 'd-flex align-items-center justify-content-between mb-4 pb-3 border-bottom';
            // Desain item keranjang
            div.innerHTML = `
                <div class="d-flex align-items-center">
                    <img src="${item.img}" alt="${item.name}" class="img-fluid rounded" style="width: 55px; height: 55px; object-fit: cover;">
                    <div class="ms-3">
                        <h6 class="mb-1 text-dark" style="font-size:0.95rem;">${item.name}</h6>
                        <small class="text-primary fw-bold d-block">${formatRupiah(item.price)}</small>
                    </div>
                </div>
                <div class="d-flex align-items-center rounded border bg-light" style="height:32px;">
                    <button class="btn btn-sm btn-light px-2 py-0 border-0 fw-bold" onclick="updateQty('${item.name}', -1)">-</button>
                    <span class="px-2 fw-bold text-dark" style="font-size:0.85rem;">${item.qty}</span>
                    <button class="btn btn-sm btn-light px-2 py-0 border-0 fw-bold" onclick="updateQty('${item.name}', 1)">+</button>
                </div>
            `;
            container.appendChild(div);
        });
    }

    if(totalEl) totalEl.innerText = formatRupiah(total);
    // Terapkan jumlah notifikasi keranjang kepada semua badge di seluruh layar
    cartBadges.forEach(badge => {
        badge.innerText = totalItems;
        if(totalItems > 0) {
            badge.style.display = "inline-block";
        } else {
            badge.style.display = "none";
        }
    });
}

function initCart() {
    renderCart(); 
}
"""

with open(cart_js_path, "w", encoding="utf-8") as f:
    f.write(new_cart_js)
    
print("cart.js updated with user-specific keys and animations!")
