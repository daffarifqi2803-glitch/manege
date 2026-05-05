import os
import re
import glob

# All subpages
files = [
    "about.php",
    "contact.php",
    "history.php",
    "profile.php",
    "promotion.php",
    "team.php",
    "testimonial.php",
    "checkout.php"
]

replacements = [
    # 1. Navbar background to white with shadow
    (r'<nav class="navbar navbar-expand-lg navbar-dark px-lg-5">',
     r'<nav class="navbar navbar-expand-lg bg-white navbar-light px-lg-5 shadow-sm">'),
     
    # 2. Brand name back to primary
    (r'<h2 class="mb-0 text-white text-uppercase d-flex align-items-center">',
     r'<h2 class="mb-0 text-primary text-uppercase d-flex align-items-center">'),
    
    # 3. Cart icon back to primary
    (r'class="position-relative text-white fs-4"',
     r'class="position-relative text-primary fs-4"'),
     
    # 4. Profile picture border back to primary
    (r'border: 2px solid var\(--bs-white\);',
     r'border: 2px solid var(--bs-primary);'),
     
    # 5. Profile name back to primary
    (r'<span class="fw-bold fs-6 text-white">',
     r'<span class="fw-bold fs-6 text-primary">'),
     
    # 6. Login icon back to primary
    (r'class="nav-link dropdown-toggle text-white fs-3 p-0"',
     r'class="nav-link dropdown-toggle text-primary fs-3 p-0"')
]

for filepath in files:
    if not os.path.exists(filepath):
        continue
        
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
        
    original_content = content
    for old, new in replacements:
        content = re.sub(old, new, content)
        
    if content != original_content:
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f"Updated {filepath}")
        
print("Done.")
