import os
import re
import glob

# All pages
files = glob.glob('*.php')

replacements = [
    # Brand name to primary (pink)
    (r'<h2 class="mb-0 text-secondary text-uppercase d-flex align-items-center">',
     r'<h2 class="mb-0 text-primary text-uppercase d-flex align-items-center">')
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
