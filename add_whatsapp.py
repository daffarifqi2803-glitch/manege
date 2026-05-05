import os
import glob

base_dir = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0"

wa_snippet = """
<!-- ==============================
     WhatsApp Live Chat Floating
=============================== -->
<style>
.whatsapp-float {
    position: fixed;
    width: 60px;
    height: 60px;
    bottom: 30px;
    left: 30px;
    background-color: #25d366;
    color: #FFF;
    border-radius: 50px;
    box-shadow: 2px 2px 10px rgba(0,0,0,0.15);
    z-index: 10000;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.whatsapp-float svg {
    width: 35px;
    height: 35px;
    fill: #ffffff;
    padding-top: 2px;
}

.whatsapp-float:hover {
    transform: scale(1.15) rotate(-5deg);
    box-shadow: 2px 2px 15px rgba(37, 211, 102, 0.6);
    color: #FFF;
}

/* Pulsing effect */
.whatsapp-float::before {
    content: '';
    position: absolute;
    width: 60px;
    height: 60px;
    background-color: #25d366;
    border-radius: 50%;
    z-index: -1;
    opacity: 0.6;
    animation: waPulse 2s infinite;
}

@keyframes waPulse {
    0% { transform: scale(1); opacity: 0.6; }
    100% { transform: scale(1.6); opacity: 0; }
}

@media screen and (max-width: 767px){
    .whatsapp-float {
        width: 50px;
        height: 50px;
        bottom: 20px;
        left: 20px;
    }
    .whatsapp-float svg { width: 30px; height: 30px; }
    .whatsapp-float::before { width: 50px; height: 50px; }
}
</style>
<a href="https://wa.me/6289506079211?text=Halo%20Admin%20Putik%20Bouquet,%20saya%20ingin%20bertanya..." class="whatsapp-float" target="_blank" rel="noopener noreferrer" title="Chat dengan Kami via WhatsApp">
    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
      <path d="M16.03 0a15.93 15.93 0 0 0-14.07 23.36L.23 31.77l8.6-2.22A15.97 15.97 0 1 0 16.03 0zm0 29.28c-2.48 0-4.9-0.64-7.05-1.85l-.5-.29-5.11 1.32 1.35-4.97-.33-.52a13.3 13.3 0 1 1 11.64 6.31zm7.32-9.98c-1.3-.64-1.28-0.96-2.4-.64-.53.16-1.12.96-1.54 1.5l-.26.33c-.27.16-.7.42-1.82-.48l-1.07-.84-1.05-.88c-1.16-.97-1.3-1.07-1.14-1.36.14-.26.68-1.02.8-1.33.1-.28.02-.6-.2-.84-.33-.35-1.37-3.07-1.57-3.66l-.37-.8c-.3-.21-.61-.3-.98-.3l-1.33.02c-.93.07-1.54 1.1-1.74 1.6-.26.63-.58 1.95 0 3.73.44 1.34 1.16 2.66 2.07 3.55 1.55 1.53 3.96 3.1 8 4.23.86.24 1.83.47 2.76.54 1.25.1 2.58-.2 3.65-1.02 1.1-.84 1.25-1.73 1.14-2.24l-.16-.3c-.27-.14-1-.53-1.48-.77z"/>
    </svg>
</a>
<!-- ============================== -->
</body>"""

def inject():
    # Gather all PHP files in root and LoginPage
    files = glob.glob(os.path.join(base_dir, "*.php"))
    files.extend(glob.glob(os.path.join(base_dir, "LoginPage", "*.php")))
    
    count = 0
    for f in files:
        # Pengecualian logout dan file koneksi logik (proses_*.php, etc)
        fname = os.path.basename(f)
        if fname in ["logout.php", "cart.php"] or fname.startswith("proses_"):
            continue
            
        with open(f, 'r', encoding='utf-8') as file:
            content = file.read()
            
        if "WhatsApp Live Chat Floating" in content:
            continue
            
        if "</body>" in content:
            # Mengganti </body> dengan snippet + </body>
            content = content.replace("</body>", wa_snippet)
            
            with open(f, 'w', encoding='utf-8') as file:
                file.write(content)
            count += 1
            print(f"Injected WA into {fname}")
            
    print(f"Injection completed in {count} files.")

if __name__ == "__main__":
    inject()
