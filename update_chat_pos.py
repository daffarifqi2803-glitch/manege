import os
import glob
import re

base_dir = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0"

def update_wa_pos():
    files = glob.glob(os.path.join(base_dir, "*.php"))
    files.extend(glob.glob(os.path.join(base_dir, "LoginPage", "*.php")))
    
    count = 0
    
    # CSS Changes replacements
    old_css_rule = r"""\.chat-toggle-btn \{
    position: fixed;
    top: 50%;
    left: 0;
    transform: translateY\(-50%\) translateX\(-45px\) rotate\(-90deg\);
    transform-origin: center right;"""
    
    new_css_rule = """\.chat-toggle-btn {
    position: fixed;
    bottom: 30px;
    right: 30px;
    /* transform removed untuk di pojok kanan bawah */"""

    old_hover_rule = r"""\.chat-toggle-btn:hover \{
    padding-bottom: 20px;
    color: #fff;
    box-shadow: -2px 10px 25px rgba\(226, 92, 59, 0\.6\);
\}"""

    new_hover_rule = """.chat-toggle-btn:hover {
    transform: translateY(-5px) scale(1.05); /* Muncul efek lompat ke atas */
    color: #fff;
    box-shadow: 0 10px 25px rgba(226, 92, 59, 0.6);
}"""

    old_border_rule = "border-radius: 15px 15px 0 0;"
    new_border_rule = "border-radius: 30px;"
    
    old_shadow_rule = "box-shadow: -2px 5px 15px rgba(226, 92, 59, 0.4);"
    new_shadow_rule = "box-shadow: 0 5px 15px rgba(226, 92, 59, 0.4);"

    old_html_class = 'class="offcanvas offcanvas-start offcanvas-chat"'
    new_html_class = 'class="offcanvas offcanvas-end offcanvas-chat"'

    for f in files:
        fname = os.path.basename(f)
        if fname in ["logout.php", "cart.php"] or fname.startswith("proses_"):
            continue
            
        with open(f, 'r', encoding='utf-8') as file:
            content = file.read()
            
        if "PREMIUM LEFT OFFCANVAS CHAT" in content or "PREMIUM OFFCANVAS CHAT" in content:
            # Ganti teks agar akurat
            content = content.replace("PREMIUM LEFT OFFCANVAS CHAT", "PREMIUM RIGHT OFFCANVAS CHAT")
            
            # Subtitusi Regex karena spasi kadang tidak akurat lewat string biasa
            content = re.sub(old_css_rule, new_css_rule[1:], content, flags=re.MULTILINE)
            content = re.sub(old_hover_rule, new_hover_rule, content, flags=re.MULTILINE)
            
            # Text based replace
            content = content.replace(old_border_rule, new_border_rule)
            content = content.replace(old_shadow_rule, new_shadow_rule)
            content = content.replace(old_html_class, new_html_class)
            
            with open(f, 'w', encoding='utf-8') as file:
                file.write(content)
            count += 1
            print(f"Moved chat to bottom-right on {fname}")
            
    print(f"Update completed in {count} files.")

if __name__ == "__main__":
    update_wa_pos()
