import os

login_path = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\LoginPage\login.php"
register_path = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\LoginPage\register.php"

css_styles = """
<style>
/* Floral Theme Animated Background */
body {
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    /* Soft pinks, peach, warm yellows */
    background: linear-gradient(-45deg, #ff9a9e, #fecfef, #ffe2e2, #fda085);
    background-size: 400% 400%;
    animation: gradientBG 12s ease infinite;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Glassmorphism Box */
.auth-box {
    width: 420px;
    padding: 40px 30px;
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.6);
    box-shadow: 0 8px 32px 0 rgba(226, 92, 59, 0.15);
    /* Fade Up Animation */
    opacity: 0;
    transform: translateY(30px);
    animation: fadeUp 0.8s forwards ease-out;
}

@keyframes fadeUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.auth-box h4 {
    color: #333;
    font-weight: 800;
    margin-bottom: 30px;
    letter-spacing: 0.5px;
}

.auth-box label {
    color: #444;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.form-control {
    background: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.9);
    border-radius: 12px;
    padding: 12px 15px;
    font-size: 0.95rem;
    transition: all 0.3s;
}

.form-control:focus {
    background: #fff;
    border-color: #fda085;
    box-shadow: 0 0 10px rgba(253, 160, 133, 0.3);
    outline: none;
}

.btn-orange {
    background: linear-gradient(135deg, #e25c3b, #ff7a59);
    color: white;
    font-weight: 700;
    border-radius: 12px;
    padding: 12px;
    border: none;
    transition: all 0.3s ease;
    letter-spacing: 1px;
    margin-top: 10px;
}

.btn-orange:hover {
    background: linear-gradient(135deg, #c94a2e, #e25c3b);
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(226, 92, 59, 0.4);
    color: white;
}

.text-bottom {
    color: #555;
    font-weight: 500;
    font-size: 0.9rem;
}

.text-bottom a {
    color: #e25c3b;
    font-weight: 800;
    text-decoration: none;
    transition: all 0.3s ease;
}

.text-bottom a:hover {
    color: #c94a2e;
    text-decoration: underline;
}
</style>
"""

login_html = f"""<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Login - Putik Bouquet</title>
<link href="../css/bootstrap.min.css" rel="stylesheet">
{css_styles}
</head>
<body>

<div class="auth-box">
    <h4 class="text-center text-uppercase">Welcome Back 🌸</h4>
    <form action="proses_login.php" method="POST">
        <div class="mb-3">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
        </div>
        <div class="mb-4">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
        </div>
        <button type="submit" class="btn btn-orange w-100">LOGIN</button>
        <div class="text-center mt-4 text-bottom">
            Don't have an account? <a href="register.php">Sign up</a>
        </div>
    </form>
</div>

</body>
</html>
"""

register_html = f"""<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Sign Up - Putik Bouquet</title>
<link href="../css/bootstrap.min.css" rel="stylesheet">
{css_styles}
</head>
<body>

<div class="auth-box" style="margin: 40px auto; width: 450px;">
    <h4 class="text-center text-uppercase">Create Account 🌺</h4>
    <form action="proses_register.php" method="POST">
        <div class="mb-3">
            <label>Full Name</label>
            <input type="text" name="name" class="form-control" placeholder="Jane Doe" required>
        </div>
        <div class="mb-3">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Create a password" required>
        </div>
        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" placeholder="Repeat password" required>
        </div>
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" required>
            <label class="form-check-label text-dark small fw-bold">
                I agree to the terms and privacy
            </label>
        </div>
        <button type="submit" class="btn btn-orange w-100">SIGN UP</button>
        <div class="text-center mt-4 text-bottom">
            Already have an account? <a href="login.php">Sign in</a>
        </div>
    </form>
</div>

</body>
</html>
"""

with open(login_path, "w", encoding="utf-8") as f:
    f.write(login_html)

with open(register_path, "w", encoding="utf-8") as f:
    f.write(register_html)

print("Auth pages redesigned with Floral Glassmorphism!")
