import os
import glob
import re

# Read index.php to get the footer
with open('c:\\xampp\\htdocs\\Poseify\\Poseify-1.0.0\\index.php', 'r', encoding='utf-8') as f:
    index_content = f.read()

# Extract the footer from index.php
footer_match = re.search(r'<!-- Footer Start -->(.*?)<!-- Footer End -->', index_content, re.DOTALL)
if not footer_match:
    print("Could not find footer in index.php")
    exit(1)

footer_html = footer_match.group(1)
# Fix the broken i tag
footer_html = footer_html.replace('<i class=></i>', '<i class="fa-regular fa-face-smile me-1"></i>')

full_footer = f"<!-- Footer Start -->{footer_html}<!-- Footer End -->"

files = glob.glob('c:\\xampp\\htdocs\\Poseify\\Poseify-1.0.0\\*.php')

for file in files:
    filename = os.path.basename(file)
    if filename in ['admin_dashboard.php', 'admin_manage_products.php', 'api_chat.php', 'chat_widget.php', 'admin_realtime_api.php']:
        continue
        
    with open(file, 'r', encoding='utf-8') as f:
        content = f.read()
    
    modified = False
    
    # Try to replace <!-- Footer Start --> to <!-- Footer End -->
    if '<!-- Footer Start -->' in content and '<!-- Footer End -->' in content:
        content = re.sub(r'<!-- Footer Start -->.*?<!-- Footer End -->', full_footer, content, flags=re.DOTALL)
        modified = True
    elif '<!-- Footer Standard -->' in content:
        # Some files use <!-- Footer Standard --> and the div ends before another comment
        # We need to find <!-- Footer Standard --> and the next comment
        parts = re.split(r'(<!-- Footer Standard -->.*?)(?=<!--)', content, maxsplit=1, flags=re.DOTALL)
        if len(parts) >= 2:
            content = parts[0] + full_footer + '\n    ' + parts[2]
            modified = True
            
    if modified:
        with open(file, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f"Updated footer in {filename}")
