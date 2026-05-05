import os
import re

login_path = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\LoginPage\login.php"
register_path = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0\LoginPage\register.php"

def apply_floral_theme(filepath):
    with open(filepath, "r", encoding="utf-8") as f:
        content = f.read()

    # The old CSS block we want to replace
    old_body_css = """body {
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
}"""

    new_body_css = """body {
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    position: relative;
    overflow: hidden; /* Hide falling petals overflow */
}

/* Floral Breathing Image */
body::before {
    content: "";
    position: fixed;
    top: -5%; left: -5%;
    width: 110%; height: 110%;
    background: url('../img/carousel-1.jpg') no-repeat center center;
    background-size: cover;
    z-index: -2;
    animation: breatheFlower 25s infinite alternate ease-in-out;
}

/* Dark Overlay for readability */
body::after {
    content: "";
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0, 0, 0, 0.45);
    z-index: -2;
}

@keyframes breatheFlower {
    0% { transform: scale(1); }
    100% { transform: scale(1.15); }
}

/* Falling Petal CSS */
.petal {
    position: absolute;
    background: #ffb6c1; /* Soft pink */
    border-radius: 15px 0 15px 0;
    opacity: 0.6;
    z-index: -1;
    pointer-events: none;
    box-shadow: 0 0 10px rgba(255, 182, 193, 0.5);
    animation: fall linear forwards infinite;
}

@keyframes fall {
    0% {
        transform: translateY(-50px) rotate(0deg) scale(0.8);
        opacity: 0;
    }
    10% { opacity: 0.8; }
    90% { opacity: 0.8; }
    100% {
        transform: translateY(110vh) rotate(360deg) scale(1.2);
        opacity: 0;
    }
}"""

    content = content.replace(old_body_css, new_body_css)

    # Adding the JS script right before </body>
    petal_js = """
<script>
    // Animasi Kelopak Bunga Berjatuhan
    document.addEventListener("DOMContentLoaded", function() {
        const petalsCount = 40;
        for(let i=0; i<petalsCount; i++) {
            let petal = document.createElement('div');
            petal.className = 'petal';
            // Random sizes slightly
            let size = Math.random() * 10 + 10;
            petal.style.width = size + 'px';
            petal.style.height = size + 'px';
            // Random position across viewport width
            petal.style.left = Math.random() * 100 + 'vw';
            // Random fall duration and delay
            petal.style.animationDelay = Math.random() * 10 + 's';
            petal.style.animationDuration = Math.random() * 15 + 8 + 's';
            document.body.appendChild(petal);
        }
    });
</script>
</body>"""

    if "Animasi Kelopak Bunga" not in content:
        content = content.replace("</body>", petal_js)

    with open(filepath, "w", encoding="utf-8") as f:
        f.write(content)

apply_floral_theme(login_path)
apply_floral_theme(register_path)
print("Floral Animation injected into both pages successfully!")
