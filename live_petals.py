import os

login_path = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\LoginPage\login.php"
register_path = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\LoginPage\register.php"

css_styles = """
<style>
/* ========================================================
   LUXURY GLOWING ORB BOKEH + LIVE FALLING FLOWERS
======================================================== */
body {
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #fcf1f3; /* Pearl pink */
    overflow: hidden; 
    position: relative;
}

/* Ambient Lighting Orbs */
.light-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(60px);
    z-index: 1;
    opacity: 0.6;
}

.orb-1 { width: 400px; height: 400px; background: #ff9a9e; top: -10%; left: -10%; animation: float1 10s infinite ease-in-out alternate; }
.orb-2 { width: 500px; height: 500px; background: #fecfef; bottom: -15%; right: -10%; animation: float2 14s infinite ease-in-out alternate; }
.orb-3 { width: 350px; height: 350px; background: #ffc3a0; top: 50%; left: 40%; animation: float3 12s infinite ease-in-out alternate; }

@keyframes float1 { 0% { transform: translate(0, 0); } 100% { transform: translate(150px, 100px); } }
@keyframes float2 { 0% { transform: translate(0, 0); } 100% { transform: translate(-200px, -150px); } }
@keyframes float3 { 0% { transform: translate(0, 0); } 100% { transform: translate(100px, -200px); } }

/* Authentic Frosted Glass Panel */
.auth-box {
    width: 440px;
    padding: 40px;
    background: rgba(255, 255, 255, 0.5); 
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.9);
    box-shadow: 0 15px 35px rgba(226, 92, 59, 0.08); 
    z-index: 10; 
}

.auth-box h4 { color: #333; font-weight: 800; margin-bottom: 30px; }
.auth-box label { color: #555; font-weight: 600; font-size: 0.9rem; margin-bottom: 5px; }

.form-control {
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid rgba(255, 255, 255, 1);
    border-radius: 10px;
    padding: 12px 15px;
    font-size: 0.95rem;
    color: #444;
}

.form-control:focus { outline: none; border-color: #ff9a9e; box-shadow: 0 0 10px rgba(255, 154, 158, 0.5); }

.btn-orange {
    background: linear-gradient(135deg, #e25c3b, #ff7a59);
    color: white; font-weight: bold; border-radius: 10px; padding: 12px;
    border: none; margin-top: 10px; transition: all 0.3s;
}
.btn-orange:hover {
    background: linear-gradient(135deg, #c94a2e, #e25c3b);
    transform: translateY(-2px); box-shadow: 0 8px 20px rgba(226, 92, 59, 0.3); color: white;
}

.text-bottom { color: #666; font-size: 0.9rem; font-weight: 500;}
.text-bottom a { color: #e25c3b; font-weight: 800; text-decoration: none; }
.text-bottom a:hover { color: #c94a2e; text-decoration: underline; }

/* 
  LIVE FALLING FLOWERS (BUNGA BERTEBANGAN)
  We use Javascript to spawn these so they fall organically.
*/
.css-petal {
    position: fixed;
    /* Beautiful elegant petal shape using border-radius */
    border-radius: 60% 0 60% 30%;
    /* Gradient matching flower vibes */
    background: linear-gradient(120deg, #ffb6c1, #ffc0cb, #ffe4e1);
    box-shadow: 0 0 6px rgba(255, 182, 193, 0.6);
    z-index: 5; /* Flows over the background, under the glass box */
    pointer-events: none; /* User cant click on them */
    opactiy: 0.9;
    
    /* Animation base */
    animation-name: fallAndSway; 
    animation-timing-function: linear;
    animation-fill-mode: forwards;
}

@keyframes fallAndSway {
    0% {
        transform: translateY(-50px) rotate(0deg) scale(var(--s));
        opacity: 0;
    }
    10% { opacity: 0.9; }
    90% { opacity: 0.9; }
    100% {
        transform: translateY(115vh) rotate(var(--r)) scale(var(--s));
        opacity: 0;
    }
}
</style>
"""

js_scripts = """
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const petalCount = 35; // Jumlah bunga
        for(let i=0; i<petalCount; i++) {
            let p = document.createElement('div');
            p.className = 'css-petal';
            
            // Random sizes
            let w = Math.random() * 15 + 10;
            p.style.width = w + 'px';
            p.style.height = w + 'px';
            
            // Random horizontal start
            p.style.left = (Math.random() * 100) + 'vw';
            
            // Random fall duration and delay
            let dur = Math.random() * 8 + 6; // 6 to 14 seconds
            let del = Math.random() * 5;
            p.style.animationDuration = dur + 's';
            p.style.animationDelay = del + 's';
            
            // Random rotation end goal and scale for the CSS variable
            let rotations = Math.random() * 500 + 100; // 100 to 600 degrees
            let sign = Math.random() > 0.5 ? 1 : -1;
            let scaleFactor = Math.random() * 0.5 + 0.8;
            
            p.style.setProperty('--r', (rotations * sign) + 'deg');
            p.style.setProperty('--s', scaleFactor);
            
            document.body.appendChild(p);
            
            // loop falling effect beautifully
            setInterval(() => {
                let nP = p.cloneNode(true);
                document.body.removeChild(p);
                document.body.appendChild(nP);
                p = nP;
            }, (dur + del) * 1000);
        }
    });
</script>
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

<div class="light-orb orb-1"></div>
<div class="light-orb orb-2"></div>
<div class="light-orb orb-3"></div>

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

{js_scripts}
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

<div class="light-orb orb-1"></div>
<div class="light-orb orb-2"></div>
<div class="light-orb orb-3"></div>

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

{js_scripts}
</body>
</html>
"""

with open(login_path, "w", encoding="utf-8") as f:
    f.write(login_html)

with open(register_path, "w", encoding="utf-8") as f:
    f.write(register_html)

print("Live falling flowers deployed!")
