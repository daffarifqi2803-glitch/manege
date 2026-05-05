import os

login_path = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\LoginPage\login.php"
register_path = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\LoginPage\register.php"

css_styles = """
<style>
/* ========================================================
   ULTRA-PREMIUM AUTENTIKASI: TEMA TANGAN PETAL & SPARKLE
======================================================== */

/* ✨ 1. Gradient Background Bergerak (Soft Luxury Feel) */
body {
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    /* Soft rose to peach transition */
    background: linear-gradient(-45deg, #ffdde1, #ff9a9e, #fad0c4, #fecfef);
    background-size: 400% 400%;
    animation: gradientMove 15s ease infinite;
    overflow: hidden; 
    position: relative;
    perspective: 1000px;
}

@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* 🎀 4. Animasi Masuk (Fade + Float) untuk Login Box */
.auth-box {
    width: 440px;
    padding: 40px;
    background: rgba(255, 255, 255, 0.35); 
    backdrop-filter: blur(25px);
    -webkit-backdrop-filter: blur(25px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.8);
    box-shadow: 0 15px 35px rgba(226, 92, 59, 0.08); 
    z-index: 10; 
    position: relative;
    
    /* Fade + Float in */
    opacity: 0;
    transform: translateY(50px) scale(0.95);
    animation: fadeAndFloat 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    transition: all 0.4s ease;
}

@keyframes fadeAndFloat {
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* 💡 3. Glow saat hover pada form */
.auth-box:hover {
    box-shadow: 0 10px 40px rgba(255, 154, 158, 0.5), 0 0 20px rgba(255, 255, 255, 0.8);
    transform: translateY(-5px);
}

.auth-box h4 { color: #333; font-weight: 800; margin-bottom: 30px; letter-spacing: 1px; }
.auth-box label { color: #555; font-weight: 600; font-size: 0.9rem; margin-bottom: 8px; display: block; }

.form-control {
    background: rgba(255, 255, 255, 0.6);
    border: 1px solid rgba(255, 255, 255, 0.8);
    border-radius: 12px;
    padding: 14px 15px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
}

.form-control:focus { 
    outline: none; 
    background: #fff;
    border-color: #ff9a9e; 
    box-shadow: 0 0 15px rgba(255, 154, 158, 0.4); 
}

.btn-orange {
    background: linear-gradient(135deg, #e25c3b, #ff7a59);
    color: white; font-weight: bold; border-radius: 12px; padding: 14px;
    border: none; margin-top: 15px; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.btn-orange:hover {
    background: linear-gradient(135deg, #c94a2e, #e25c3b);
    transform: translateY(-3px); 
    box-shadow: 0 10px 25px rgba(226, 92, 59, 0.4); 
    color: white;
}

.text-bottom { color: #666; font-size: 0.9rem; font-weight: 500;}
.text-bottom a { color: #e25c3b; font-weight: 800; text-decoration: none; transition: 0.3s; }
.text-bottom a:hover { color: #c94a2e; text-decoration: underline; }

/* 🌸 2. Petal dengan Blur Depth (Bokeh) */
.css-petal {
    position: fixed;
    border-radius: 150% 0 150% 40%; /* Organic petal shape */
    z-index: 5;
    pointer-events: none;
    will-change: transform, opacity;
}

@keyframes fallAndSway {
    0% {
        transform: translateY(-10vh) rotate(0deg) scale(var(--s));
        opacity: 0;
    }
    15% { opacity: var(--max-op); }
    85% { opacity: var(--max-op); }
    100% {
        transform: translateY(110vh) rotate(var(--r)) scale(var(--s));
        opacity: 0;
    }
}

/* 🌙 5. Efek Sparkle (Bintang Kejora Berkeredap) */
.sparkle {
    position: absolute;
    width: 3px;
    height: 3px;
    background: white;
    border-radius: 50%;
    z-index: 4;
    box-shadow: 0 0 8px 2px rgba(255,255,255,0.8);
    pointer-events: none;
    animation: twinkle linear infinite;
}

@keyframes twinkle {
    0% { opacity: 0; transform: translateY(0) scale(0.5); }
    50% { opacity: 1; transform: translateY(-20px) scale(1.5); }
    100% { opacity: 0; transform: translateY(-40px) scale(0.5); }
}

/* Ambient glow spheres for extra luxury */
.ambient-glow {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    z-index: 1;
    opacity: 0.5;
    pointer-events: none;
}
.glow-1 { width: 500px; height: 500px; background: #ff9a9e; top: -10%; left: -10%; animation: pulse 10s infinite alternate; }
.glow-2 { width: 400px; height: 400px; background: #fecfef; bottom: -10%; right: -10%; animation: pulse 12s infinite alternate; }
@keyframes pulse { 0% { transform: scale(1); } 100% { transform: scale(1.2); } }
</style>
"""

js_scripts = """
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const petalCount = 40;
        const sparkleCount = 60;
        const body = document.body;

        // 🌸 2. Generate Petals with Blur Depth (Bokeh)
        for(let i=0; i<petalCount; i++) {
            let p = document.createElement('div');
            p.className = 'css-petal';
            
            let size = Math.random() * 15 + 10;
            let startX = Math.random() * 100; // viewport width
            let duration = Math.random() * 8 + 6; // fall speed
            let delay = Math.random() * -15; // start at different phases
            
            // Bokeh Blur Depth formula: 
            // Smaller petals should be blurrier (background), larger petals in focus (foreground)
            let depthBlur = Math.random() > 0.6 ? (Math.random() * 4 + 2) : 0; // chance to be blurred
            
            p.style.width = size + 'px';
            p.style.height = size + 'px';
            p.style.left = startX + 'vw';
            p.style.background = `linear-gradient(${Math.random() * 180}deg, #ffb6c1, #ffc0cb, #ffe4e1)`;
            p.style.filter = `blur(${depthBlur}px)`;
            
            p.style.animation = `fallAndSway ${duration}s linear infinite`;
            p.style.animationDelay = delay + 's';
            
            p.style.setProperty('--r', (Math.random() * 720 - 360) + 'deg');
            p.style.setProperty('--s', Math.random() * 0.7 + 0.6);
            p.style.setProperty('--max-op', Math.random() * 0.4 + 0.4);
            
            body.appendChild(p);
        }

        // 🌙 5. Generate Sparkles 
        for(let i=0; i<sparkleCount; i++) {
            let s = document.createElement('div');
            s.className = 'sparkle';
            s.style.left = (Math.random() * 100) + 'vw';
            s.style.top = (Math.random() * 100) + 'vh';
            
            let dur = Math.random() * 3 + 2; 
            let del = Math.random() * 4;
            s.style.animationDuration = dur + 's';
            s.style.animationDelay = del + 's';
            
            body.appendChild(s);
        }

    });
</script>
"""

login_html = f"""<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Putik Bouquet</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    {css_styles}
</head>
<body>

<div class="ambient-glow glow-1"></div>
<div class="ambient-glow glow-2"></div>

<div class="auth-box">
    <h4 class="text-center text-uppercase">Welcome Back 🌺</h4>
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

{js_scripts}

</body>
</html>
"""

register_html = f"""<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - Putik Bouquet</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    {css_styles}
</head>
<body>

<div class="ambient-glow glow-1"></div>
<div class="ambient-glow glow-2"></div>

<div class="auth-box" style="margin: 40px auto; width: 450px;">
    <h4 class="text-center text-uppercase">Create Account 🌸</h4>
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

{js_scripts}

</body>
</html>
"""

with open(login_path, "w", encoding="utf-8") as f:
    f.write(login_html)

with open(register_path, "w", encoding="utf-8") as f:
    f.write(register_html)

print("Super premium aesthetic applied successfully!")
