import os

login_path = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\LoginPage\login.php"
register_path = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\LoginPage\register.php"

css_styles = """
<style>
/* ========================================================
   LUXURY GLOWING ORB BOKEH BACKGROUND
======================================================== */
body {
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #fce8eb; /* Soft pastel pink base */
    overflow: hidden; 
    position: relative;
    z-index: 0;
}

/* Animated Floating Orbs */
.light-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(50px);
    z-index: -1;
    opacity: 0.8;
}

.orb-1 {
    width: 400px; height: 400px;
    background: #ff9a9e; /* Pink */
    top: -10%; left: -10%;
    animation: float1 10s infinite ease-in-out alternate;
}

.orb-2 {
    width: 500px; height: 500px;
    background: #fecfef; /* Light petal pink */
    bottom: -15%; right: -10%;
    animation: float2 14s infinite ease-in-out alternate;
}

.orb-3 {
    width: 350px; height: 350px;
    background: #ffc3a0; /* Peach */
    top: 50%; left: 40%;
    animation: float3 12s infinite ease-in-out alternate;
}

.orb-4 {
    width: 250px; height: 250px;
    background: #e25c3b; /* Brand Orange-Red */
    top: 10%; right: 20%;
    animation: float4 8s infinite ease-in-out alternate;
}

/* Obvious Movement Animations */
@keyframes float1 {
    0% { transform: translate(0, 0) scale(1); }
    100% { transform: translate(150px, 100px) scale(1.3); }
}
@keyframes float2 {
    0% { transform: translate(0, 0) scale(1); }
    100% { transform: translate(-200px, -150px) scale(1.2); }
}
@keyframes float3 {
    0% { transform: translate(0, 0) scale(1); }
    100% { transform: translate(100px, -200px) scale(1.5); }
}
@keyframes float4 {
    0% { transform: translate(0, 0) scale(1); }
    100% { transform: translate(-100px, 100px) scale(0.8); }
}

/* Authentic Frosted Glass Panel */
.auth-box {
    width: 440px;
    padding: 50px 40px;
    background: rgba(255, 255, 255, 0.45); 
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.8);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08); 
    z-index: 10; 
    
    /* Elegant emergence */
    opacity: 0;
    transform: translateY(40px);
    animation: fadeUpElevate 1.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
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
}

.auth-box label {
    color: #555;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.form-control {
    background: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.9);
    border-radius: 12px;
    padding: 14px 15px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    background: #fff;
    border-color: #ff9a9e;
    box-shadow: 0 0 15px rgba(255, 154, 158, 0.4);
    outline: none;
}

.btn-orange {
    background: linear-gradient(135deg, #e25c3b, #ff7a59);
    color: white;
    font-weight: 700;
    border-radius: 12px;
    padding: 14px;
    border: none;
    transition: all 0.3s ease;
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

<!-- Animated Orbs Background -->
<div class="light-orb orb-1"></div>
<div class="light-orb orb-2"></div>
<div class="light-orb orb-3"></div>
<div class="light-orb orb-4"></div>

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

<!-- Animated Orbs Background -->
<div class="light-orb orb-1"></div>
<div class="light-orb orb-2"></div>
<div class="light-orb orb-3"></div>
<div class="light-orb orb-4"></div>

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

print("Orbs Bokeh successfully deployed!")
