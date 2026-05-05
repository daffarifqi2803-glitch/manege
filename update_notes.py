import os
import re

files = [
    r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\about.php",
    r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\contact.php",
    r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\promotion.php",
    r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\team.php",
    r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\testimonial.php",
    r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\index.php"
]

target_text = """            <!-- Checkout Section -->
            <div class="border-top pt-4 mt-auto">
                <div class="d-flex justify-content-between mb-3">"""

replacement_text = """            <!-- Checkout Section -->
            <div class="border-top pt-4 mt-auto">
                <!-- Notes Field -->
                <div class="mb-3">
                    <label for="cartNotes" class="form-label text-dark fw-bold small"><i class="fa fa-pen me-2 text-primary"></i>Catatan Tambahan (Bila ada request):</label>
                    <textarea class="form-control bg-light rounded" id="cartNotes" rows="2" placeholder="Contoh: Kartu ucapan 'Happy Birthday', warna pita..."></textarea>
                </div>
                <!-- End Notes Field -->
                <div class="d-flex justify-content-between mb-3">"""

script_target = """    <!-- JavaScript Libraries -->"""
script_replacement = """    <script>
    // Dinamis menambahkan item ke keranjang saat diklik
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('a[data-bs-target="#cartOffcanvas"]').forEach(button => {
            button.addEventListener('click', function(e) {
                // Pastikan yang diklik adalah tombol produk
                if(this.closest('.team-item')) {
                    const productContainer = this.closest('.team-item');
                    const productName = productContainer.querySelector('h5').innerText;
                    const productPrice = productContainer.querySelector('.text-primary.fw-bold').innerText;
                    const productImgSrc = productContainer.querySelector('img').src;
                    
                    const cartItemsContainer = document.querySelector('#cartOffcanvas .overflow-auto');
                    
                    // Hilangkan kata "Mulai" pada harga jika ada
                    const cleanPrice = productPrice.replace('Mulai ', '');
                    
                    // Buat elemen baru
                    const newItem = document.createElement('div');
                    newItem.className = 'd-flex align-items-center mb-4 pb-3 border-bottom';
                    newItem.style.animation = "fadeIn 0.5s";
                    newItem.innerHTML = `
                        <img src="${productImgSrc}" alt="${productName}" class="img-fluid rounded" style="width: 70px; height: 70px; object-fit: cover;">
                        <div class="ms-3 flex-grow-1">
                            <h6 class="mb-1 text-dark">${productName}</h6>
                            <small class="text-muted d-block">1 x ${cleanPrice}</small>
                        </div>
                        <button class="btn btn-sm btn-outline-danger" title="Hapus Item" onclick="this.parentElement.remove()"><i class="fa fa-trash"></i></button>
                    `;
                    // Masukkan di paling atas
                    cartItemsContainer.prepend(newItem);
                }
            });
        });
    });
    </script>
    <!-- JavaScript Libraries -->"""

for file_path in files:
    with open(file_path, "r", encoding="utf-8") as f:
        content = f.read()

    changed = False
    
    if "cartNotes" not in content:
        content = content.replace(target_text, replacement_text)
        changed = True

    if "// Dinamis menambahkan item ke keranjang saat diklik" not in content:
        content = content.replace(script_target, script_replacement)
        changed = True

    if changed:
        with open(file_path, "w", encoding="utf-8") as f:
            f.write(content)

print("Done injecting notes and dynamic cart script to templates")
