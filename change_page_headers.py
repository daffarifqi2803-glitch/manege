import os
import re

base_dir = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0"

# Map of files to their new background image
bg_images = {
    'about.php': 'img/carousel-2.jpg',
    'product.php': 'img/service-1.jpg',
    'testimonial.php': 'img/service-2.jpg',
    'contact.php': 'img/service-3.jpg',
    'promotion.php': 'img/valen-1.jpg'
}

for filename, img_path in bg_images.items():
    filepath = os.path.join(base_dir, filename)
    if os.path.exists(filepath):
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
        
        # We look for <div class="page-header pb-5"> or similar
        # and add an inline style
        
        # Remove any existing inline background for this so it doesn't stack if run multiple times
        content = re.sub(r'(<div\s+class="page-header[^"]*?")\s+style="background:[^"]+?"', r'\1', content)
        
        # Add the new inline style
        # It's usually <div class="page-header pb-5">
        pattern = r'(<div\s+class="page-header\s+[^"]*?")'
        # linear gradient overlay + image
        style_str = f' style="background: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, .5)), url({img_path}) center center no-repeat; background-size: cover;"'
        
        new_content = re.sub(pattern, r'\1' + style_str, content)
        
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(new_content)
        print(f"Updated {filename}")
    else:
        print(f"File not found: {filename}")
