import os

css_path = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\css\style.css"
login_path = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\LoginPage\login.php"
register_path = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\LoginPage\register.php"

cursor_css = """
/* ========================================================
   GLOBAL CUSTOM FLOWER CURSORS
======================================================== */
body, html, *, p, h1, h2, h3, h4, h5, h6, span, div {
    cursor: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32' width='32' height='32'><path fill='%23ffb6c1' stroke='%23fff' stroke-width='2' d='M16 4C14 0 8 0 8 5C8 9 13 14 16 16C19 14 24 9 24 5C24 0 18 0 16 4ZM4 16C0 14 0 8 5 8C9 8 14 13 16 16C14 19 9 24 5 24C0 24 0 18 4 16ZM16 28C14 32 8 32 8 27C8 23 13 18 16 16C19 18 24 23 24 27C24 32 18 32 16 28ZM28 16C32 14 32 8 27 8C23 8 18 13 16 16C18 19 23 24 27 24C32 24 32 18 28 16Z'/><circle cx='16' cy='16' r='4' fill='%23ffefa6'/></svg>") 16 16, auto !important;
}

a, button, input[type='submit'], input[type='button'], .btn, .nav-link, select, .cursor-pointer {
    cursor: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32' width='32' height='32'><path fill='%23e25c3b' stroke='%23ffffff' stroke-width='2' d='M16 4C14 0 8 0 8 5C8 9 13 14 16 16C19 14 24 9 24 5C24 0 18 0 16 4ZM4 16C0 14 0 8 5 8C9 8 14 13 16 16C14 19 9 24 5 24C0 24 0 18 4 16ZM16 28C14 32 8 32 8 27C8 23 13 18 16 16C19 18 24 23 24 27C24 32 18 32 16 28ZM28 16C32 14 32 8 27 8C23 8 18 13 16 16C18 19 23 24 27 24C32 24 32 18 28 16Z'/><circle cx='16' cy='16' r='4' fill='%23ffefa6'/></svg>") 16 16, pointer !important;
}
"""

def inject_cursor_css(filepath, is_html_file=False):
    if not os.path.exists(filepath):
        print(f"Skipping {filepath}, does not exist.")
        return
        
    with open(filepath, "r", encoding="utf-8") as f:
        content = f.read()
        
    if "GLOBAL CUSTOM FLOWER CURSORS" in content:
        print(f"Cursor already injected in {filepath}")
        return

    if is_html_file:
        # Menambahkan ke dalam blok <style>
        content = content.replace("</style>", cursor_css + "\n    </style>")
    else:
        # Menambahkan di akhir file CSS
        content += "\n" + cursor_css

    with open(filepath, "w", encoding="utf-8") as f:
        f.write(content)
    print(f"Injected into {filepath}")

inject_cursor_css(css_path, False)
inject_cursor_css(login_path, True)
inject_cursor_css(register_path, True)

print("Flower cursors installed globally!")
