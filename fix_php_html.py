import os

files = [
    r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\about.php",
    r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\contact.php",
    r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\promotion.php",
    r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\team.php",
    r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\testimonial.php",
    r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\index.php"
]

header = """<?php
session_start();
// Menggunakan session untuk mengecek login
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true; 
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "Pelanggan";
$user_photo = "img/testimonial-1.jpg"; 
?>
"""

for file_path in files:
    with open(file_path, "r", encoding="utf-8") as f:
        content = f.read()

    # Fix HTML tags mangled to PHP
    content = content.replace("<!DOCTYPE php>", "<!DOCTYPE html>")
    content = content.replace("<php lang=", "<html lang=")
    content = content.replace("</php>", "</html>")

    # If the file doesn't have <?php session_start (our block) at the top, add it
    if "session_start" not in content[:200]:
        content = header + content

    with open(file_path, "w", encoding="utf-8") as f:
        f.write(content)

print("Done fixing HTML tags and applying header block.")
