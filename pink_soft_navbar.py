import os
import re
import glob

files = glob.glob('*.php')

replacements = [
    # 1. Brand name to secondary (pink soft)
    (r'<h2 class="mb-0 text-primary text-uppercase d-flex align-items-center">',
     r'<h2 class="mb-0 text-secondary text-uppercase d-flex align-items-center">'),
    
    # 2. Cart icon to secondary
    (r'class="position-relative text-primary fs-4"',
     r'class="position-relative text-secondary fs-4"'),
     
    # 3. Profile picture border to secondary
    (r'border: 2px solid var\(--bs-primary\);',
     r'border: 2px solid var(--bs-secondary);'),
     
    # 4. Profile name to secondary
    (r'<span class="fw-bold fs-6 text-primary">',
     r'<span class="fw-bold fs-6 text-secondary">'),
     
    # 5. Login icon to secondary
    (r'class="nav-link dropdown-toggle text-primary fs-3 p-0"',
     r'class="nav-link dropdown-toggle text-secondary fs-3 p-0"')
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
