import os
import glob

base_dir = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0"

cart_offcanvas_snippet = """
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
"""

def distribute_cart():
    files = glob.glob(os.path.join(base_dir, "*.php"))
    count = 0
    
    for f in files:
        fname = os.path.basename(f)
        if fname in ["logout.php", "cart.php", "index.php"] or fname.startswith("proses_"):
            continue
            
        with open(f, 'r', encoding='utf-8') as file:
            content = file.read()
            
        if 'id="cartOffcanvas"' in content:
            continue
            
        # Cari titik injeksi terbaik (sebelum cart.js atau sebelum script JS)
        target = '<script src="js/cart.js"></script>'
        if target not in content:
            target = '<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>'
            
        if target in content:
            content = content.replace(target, cart_offcanvas_snippet + "\n    " + target)
            with open(f, 'w', encoding='utf-8') as file:
                file.write(content)
            count += 1
            print(f"Injected Cart Offcanvas to {fname}")
        else:
            print(f"Could not find injection point in {fname}")
            
    print(f"Successfully fixed cart canvas in {count} files.")

if __name__ == "__main__":
    distribute_cart()
