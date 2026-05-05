import os
import re
import glob

# All pages including index
files = glob.glob('*.php')

replacements = [
    # 1. Navbar background transparent (like homepage)
    (r'<nav class="navbar navbar-expand-lg bg-white navbar-light px-lg-5 shadow-sm">',
     r'<nav class="navbar navbar-expand-lg navbar-dark px-lg-5">'),
     
    # 2. Brand name to primary (pink)
    (r'<h2 class="mb-0 text-white text-uppercase d-flex align-items-center">',
     r'<h2 class="mb-0 text-primary text-uppercase d-flex align-items-center">'),
    
    # 3. Cart icon to primary (pink)
    (r'class="position-relative text-white fs-4"',
     r'class="position-relative text-primary fs-4"'),
     
    # 4. Profile picture border to primary (pink)
    (r'border: 2px solid var\(--bs-white\);',
     r'border: 2px solid var(--bs-primary);'),
     
    # 5. Profile name to primary (pink)
    (r'<span class="fw-bold fs-6 text-white">',
     r'<span class="fw-bold fs-6 text-primary">'),
     
    # 6. Login icon to primary (pink)
    (r'class="nav-link dropdown-toggle text-white fs-3 p-0"',
     r'class="nav-link dropdown-toggle text-primary fs-3 p-0"')
]

for filepath in files:
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
