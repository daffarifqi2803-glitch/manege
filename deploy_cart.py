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

for file_path in files:
    with open(file_path, "r", encoding="utf-8") as f:
        content = f.read()

    # Step 1: Remove the old mock items from Offcanvas
    content = re.sub(
        r'<div class="flex-grow-1 overflow-auto">.*?<!-- Checkout Section -->',
        r'<div class="flex-grow-1 overflow-auto">\n            </div>\n            <!-- Checkout Section -->',
        content,
        flags=re.DOTALL
    )

    # Step 2: Remove the old inline script we added previously
    content = re.sub(
        r'<script>\s*// Dinamis menambahkan item ke keranjang saat diklik.*?</script>',
        r'',
        content,
        flags=re.DOTALL
    )

    # Step 3: Inject <script src="js/cart.js"></script> before <!-- JavaScript Libraries -->
    if 'src="js/cart.js"' not in content:
        content = content.replace("<!-- JavaScript Libraries -->", '<script src="js/cart.js"></script>\n    <!-- JavaScript Libraries -->')

    with open(file_path, "w", encoding="utf-8") as f:
        f.write(content)

print("Deployed cart script and cleaned templates.")
