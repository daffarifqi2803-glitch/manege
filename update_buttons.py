import os
import re

file_path = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\index.php"

with open(file_path, "r", encoding="utf-8") as f:
    content = f.read()

replacement = """<a href="#" class="btn btn-primary w-100 fw-bold rounded-pill shadow-sm" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas">
                                <i class="fa fa-cart-plus me-2"></i>Masukkan Keranjang
                            </a>"""

content_new = re.sub(
    r'<a href="https://wa\.me/[^"]+".*?class="btn btn-success w-100" target="_blank">\s*Pesan Sekarang\s*</a>',
    replacement,
    content,
    flags=re.DOTALL
)

if content_new != content:
    with open(file_path, "w", encoding="utf-8") as f:
        f.write(content_new)
    print("Successfully replaced Pesan Sekarang buttons with Masukkan Keranjang.")
else:
    print("No changes made. Regex might not have matched.")
