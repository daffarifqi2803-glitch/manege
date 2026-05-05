import os

css_path = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\css\style.css"
login_path = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\LoginPage\login.php"
register_path = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\LoginPage\register.php"

# The old block
old_cursor_css_1 = """/* ========================================================
   GLOBAL CUSTOM FLOWER CURSORS
======================================================== */
body, html, *, p, h1, h2, h3, h4, h5, h6, span, div {
    cursor: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32' width='32' height='32'><path fill='%23ffb6c1' stroke='%23fff' stroke-width='2' d='M16 4C14 0 8 0 8 5C8 9 13 14 16 16C19 14 24 9 24 5C24 0 18 0 16 4ZM4 16C0 14 0 8 5 8C9 8 14 13 16 16C14 19 9 24 5 24C0 24 0 18 4 16ZM16 28C14 32 8 32 8 27C8 23 13 18 16 16C19 18 24 23 24 27C24 32 18 32 16 28ZM28 16C32 14 32 8 27 8C23 8 18 13 16 16C18 19 23 24 27 24C32 24 32 18 28 16Z'/><circle cx='16' cy='16' r='4' fill='%23ffefa6'/></svg>") 16 16, auto !important;
}

a, button, input[type='submit'], input[type='button'], .btn, .nav-link, select, .cursor-pointer {
    cursor: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32' width='32' height='32'><path fill='%23e25c3b' stroke='%23ffffff' stroke-width='2' d='M16 4C14 0 8 0 8 5C8 9 13 14 16 16C19 14 24 9 24 5C24 0 18 0 16 4ZM4 16C0 14 0 8 5 8C9 8 14 13 16 16C14 19 9 24 5 24C0 24 0 18 4 16ZM16 28C14 32 8 32 8 27C8 23 13 18 16 16C19 18 24 23 24 27C24 32 18 32 16 28ZM28 16C32 14 32 8 27 8C23 8 18 13 16 16C18 19 23 24 27 24C32 24 32 18 28 16Z'/><circle cx='16' cy='16' r='4' fill='%23ffefa6'/></svg>") 16 16, pointer !important;
}"""

old_cursor_css_2 = """/* ========================================================
   GLOBAL CUSTOM FLOWER CURSORS
======================================================== */
body, html, *, p, h1, h2, h3, h4, h5, h6, span, div {
    cursor: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32' width='32' height='32'><path fill='%23ffb6c1' stroke='%23fff' stroke-width='2' d='M16 4C14 0 8 0 8 5C8 9 13 14 16 16C19 14 24 9 24 5C24 0 18 0 16 4ZM4 16C0 14 0 8 5 8C9 8 14 13 16 16C14 19 9 24 5 24C0 24 0 18 4 16ZM16 28C14 32 8 32 8 27C8 23 13 18 16 16C19 18 24 23 24 27C24 32 18 32 16 28ZM28 16C32 14 32 8 27 8C23 8 18 13 16 16C18 19 23 24 27 24C32 24 32 18 28 16Z'/><circle cx='16' cy='16' r='4' fill='%23ffefa6'/></svg>") 16 16, auto !important;
}

a, button, input[type='submit'], input[type='button'], .btn, .nav-link, select, .cursor-pointer {
    cursor: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32' width='32' height='32'><path fill='%23e25c3b' stroke='%23ffffff' stroke-width='2' d='M16 4C14 0 8 0 8 5C8 9 13 14 16 16C19 14 24 9 24 5C24 0 18 0 16 4ZM4 16C0 14 0 8 5 8C9 8 14 13 16 16C14 19 9 24 5 24C0 24 0 18 4 16ZM16 28C14 32 8 32 8 27C8 23 13 18 16 16C19 18 24 23 24 27C24 32 18 32 16 28ZM28 16C32 14 32 8 27 8C23 8 18 13 16 16C18 19 23 24 27 24C32 24 32 18 28 16Z'/><circle cx='16' cy='16' r='4' fill='%23ffefa6'/></svg>") 16 16, pointer !important;
}"""

# New tangkai bunga block
new_cursor_css = """/* ========================================================
   GLOBAL CURSOR: TANGKAI BUNGA (FLOWER WITH STEM)
======================================================== */
body, html, *, p, h1, h2, h3, h4, h5, h6, span, div {
    cursor: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32' width='36' height='36'><path d='M10 10 Q 15 20 28 28' fill='none' stroke='%23388e3c' stroke-width='2.5' stroke-linecap='round'/><path d='M14 18 Q 23 15 22 23 Q 18 22 14 18' fill='%234caf50'/><path d='M10 2 C 7 2 7 8 10 10 C 13 8 13 2 10 2 Z' fill='%23ffa6b6'/><path d='M10 18 C 7 18 7 12 10 10 C 13 12 13 18 10 18 Z' fill='%23ffa6b6'/><path d='M2 10 C 2 7 8 7 10 10 C 8 13 2 13 2 10 Z' fill='%23ffa6b6'/><path d='M18 10 C 18 7 12 7 10 10 C 12 13 18 13 18 10 Z' fill='%23ffa6b6'/><path d='M4.3 4.3 C 2 6.5 6.5 11 10 10 C 11 6.5 6.5 2 4.3 4.3 Z' fill='%23ffc0cb'/><path d='M15.7 15.7 C 18 13.5 13.5 9 10 10 C 9 13.5 13.5 18 15.7 15.7 Z' fill='%23ffc0cb'/><path d='M4.3 15.7 C 2 13.5 6.5 9 10 10 C 11 13.5 6.5 18 4.3 15.7 Z' fill='%23ffc0cb'/><path d='M15.7 4.3 C 18 6.5 13.5 11 10 10 C 9 6.5 13.5 2 15.7 4.3 Z' fill='%23ffc0cb'/><circle cx='10' cy='10' r='3' fill='%23ffefa6' stroke='%23f57c00' stroke-width='1'/></svg>") 10 10, auto !important;
}

a, button, input[type='submit'], input[type='button'], .btn, .nav-link, select, .cursor-pointer {
    cursor: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32' width='36' height='36'><path d='M10 10 Q 15 20 28 28' fill='none' stroke='%23388e3c' stroke-width='2.5' stroke-linecap='round'/><path d='M14 18 Q 23 15 22 23 Q 18 22 14 18' fill='%234caf50'/><path d='M10 2 C 7 2 7 8 10 10 C 13 8 13 2 10 2 Z' fill='%23e25c3b'/><path d='M10 18 C 7 18 7 12 10 10 C 13 12 13 18 10 18 Z' fill='%23e25c3b'/><path d='M2 10 C 2 7 8 7 10 10 C 8 13 2 13 2 10 Z' fill='%23e25c3b'/><path d='M18 10 C 18 7 12 7 10 10 C 12 13 18 13 18 10 Z' fill='%23e25c3b'/><path d='M4.3 4.3 C 2 6.5 6.5 11 10 10 C 11 6.5 6.5 2 4.3 4.3 Z' fill='%23ff7a59'/><path d='M15.7 15.7 C 18 13.5 13.5 9 10 10 C 9 13.5 13.5 18 15.7 15.7 Z' fill='%23ff7a59'/><path d='M4.3 15.7 C 2 13.5 6.5 9 10 10 C 11 13.5 6.5 18 4.3 15.7 Z' fill='%23ff7a59'/><path d='M15.7 4.3 C 18 6.5 13.5 11 10 10 C 9 6.5 13.5 2 15.7 4.3 Z' fill='%23ff7a59'/><circle cx='10' cy='10' r='3' fill='%23ffefa6' stroke='%23f57c00' stroke-width='1'/></svg>") 10 10, pointer !important;
}"""

def replace_cursor(filepath):
    if not os.path.exists(filepath):
        return
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    # The old css has an \r on windows, but it's fine, we can replace block.
    # Alternatively, just identify the beginning of the block to the end of the block.
    start_str = "/* ========================================================\n   GLOBAL CUSTOM"
    end_str = "} !important;\n}"
    
    if "GLOBAL CUSTOM FLOWER CURSORS" in content:
        content = content.replace(old_cursor_css_1, new_cursor_css)
        content = content.replace(old_cursor_css_2, new_cursor_css)

    # Overwrite
    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(content)

replace_cursor(css_path)
replace_cursor(login_path)
replace_cursor(register_path)
print("Updated to tangkai bunga!")
