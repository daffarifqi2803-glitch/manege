import os

login_path = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\LoginPage\login.php"
register_path = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\LoginPage\register.php"

premium_css = """
<style>
/* ========================================================
   ULTRA-PREMIUM LIQUID BLOSSOM AESTHETIC
======================================================== */
body {
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f7f9fc; /* Clean ash-white canvas */
    overflow: hidden; /* Hide the light bleed */
    position: relative;
}

/* Primary Liquid Blossom Glow - A giant glowing flower essence */
body::before {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    width: 70vmin;
    height: 70vmin;
    /* Vibrant Rose, Salmon, Peach melting */
    background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 50%, #e25c3b 100%);
    border-radius: 40% 60% 60% 40% / 40% 50% 60% 60%;
    transform: translate(-50%, -50%);
    filter: blur(70px);
    opacity: 0.6;
    z-index: 1; /* Below the glass, above the canvas */
    animation: liquidBloom 25s ease-in-out infinite alternate;
}

/* Secondary Core White Glow - Creates a luminous center */
body::after {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    width: 50vmin;
    height: 50vmin;
    background: linear-gradient(-135deg, rgba(255,255,255,0.8) 0%, rgba(253, 160, 133, 0.4) 100%);
    border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
    transform: translate(-30%, -40%) rotate(45deg);
    filter: blur(50px);
    opacity: 0.7;
    z-index: 2;
    animation: liquidBloomReverse 20s ease-in-out infinite alternate;
}

@keyframes liquidBloom {
    0% {
        border-radius: 40% 60% 60% 40% / 40% 50% 60% 60%;
        transform: translate(-50%, -50%) rotate(0deg) scale(0.9);
    }
    100% {
        border-radius: 60% 40% 40% 60% / 60% 50% 40% 40%;
        transform: translate(-50%, -50%) rotate(360deg) scale(1.15);
    }
}

@keyframes liquidBloomReverse {
    0% {
        transform: translate(-30%, -40%) rotate(45deg) scale(1);
    }
    100% {
        transform: translate(-70%, -60%) rotate(-45deg) scale(1.3);
    }
}

/* Authentic Frosted Glass Panel */
.auth-box {
    width: 440px;
    padding: 50px 40px;
    background: rgba(255, 255, 255, 0.35); /* Transparency */
    backdrop-filter: blur(25px); /* Heavy blur for expensive feel */
    -webkit-backdrop-filter: blur(25px);
    border-radius: 24px;
    border: 1px solid rgba(255, 255, 255, 0.6);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05); /* Very soft dark shadow */
    position: relative;
    z-index: 10; /* Bring above the light globs */
    
    /* Elegant emergence */
    opacity: 0;
    transform: translateY(40px);
    animation: fadeUpElevate 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@keyframes fadeUpElevate {
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
    color: #555;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.form-control {
    background: rgba(255, 255, 255, 0.7);
    border: 1px solid rgba(255, 255, 255, 0.8);
    border-radius: 12px;
    padding: 14px 15px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    color: #333;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.01);
}

.form-control:focus {
    background: #fff;
    border-color: #ff9a9e;
    box-shadow: 0 0 15px rgba(255, 154, 158, 0.3);
    outline: none;
}

::placeholder {
    color: #aaa !important;
}

.btn-orange {
    background: linear-gradient(135deg, #e25c3b, #ff7a59);
    color: white;
    font-weight: 700;
    border-radius: 12px;
    padding: 14px;
    border: none;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    letter-spacing: 1px;
    margin-top: 15px;
}

.btn-orange:hover {
    background: linear-gradient(135deg, #c94a2e, #e25c3b);
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(226, 92, 59, 0.4);
    color: white;
}

.text-bottom {
    color: #666;
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
{premium_css}
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
{premium_css}
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

print("Ultra-Premium Liquid Blossom Glassmorphism deployed completely!")
