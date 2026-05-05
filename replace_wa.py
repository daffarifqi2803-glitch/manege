import os
import glob
import re

base_dir = r"c:\xampp\htdocs\Poseify\Poseify-1.0.0"

new_snippet = """
<!-- ==============================
     PREMIUM LEFT OFFCANVAS CHAT
=============================== -->
<style>
/* Chat Toggle Button */
.chat-toggle-btn {
    position: fixed;
    top: 50%;
    left: 0;
    transform: translateY(-50%) translateX(-45px) rotate(-90deg);
    transform-origin: center right;
    background: linear-gradient(135deg, #ff9a9e, #e25c3b);
    color: #fff;
    padding: 12px 28px;
    font-family: 'Josefin Sans', sans-serif;
    font-size: 1.25rem;
    font-weight: 700;
    letter-spacing: 2px;
    border-radius: 15px 15px 0 0;
    cursor: pointer;
    box-shadow: -2px 5px 15px rgba(226, 92, 59, 0.4);
    z-index: 1040;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 1px solid rgba(255,255,255,0.4);
    border-bottom: none;
    display: flex;
    align-items: center;
    gap: 8px;
}

.chat-toggle-btn:hover {
    padding-bottom: 20px;
    color: #fff;
    box-shadow: -2px 10px 25px rgba(226, 92, 59, 0.6);
}

/* Offcanvas custom look */
.offcanvas-chat {
    width: 380px !important;
    border-right: none;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(25px);
    -webkit-backdrop-filter: blur(25px);
    box-shadow: 5px 0 35px rgba(0,0,0,0.1);
}

.offcanvas-chat .offcanvas-header {
    background: linear-gradient(135deg, #e25c3b, #ff7a59);
    color: white;
    padding: 20px 25px;
    border-bottom-right-radius: 20px;
}

.offcanvas-chat .btn-close {
    filter: invert(1) grayscale(100%) brightness(200%);
    opacity: 0.8;
}

.chat-body-area {
    height: 100%;
    overflow-y: auto;
    padding: 20px;
    background: #fdfdfd;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.msg-bubble {
    font-size: 0.95rem;
    padding: 12px 18px;
    border-radius: 20px;
    max-width: 82%;
    line-height: 1.5;
    word-wrap: break-word;
    box-shadow: 0 2px 5px rgba(0,0,0,0.03);
    animation: fadeInMsg 0.3s ease-out;
}

@keyframes fadeInMsg {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.msg-admin {
    background: #fff;
    color: #444;
    align-self: flex-start;
    border-bottom-left-radius: 4px;
    border: 1px solid #ebebeb;
}

.msg-user {
    background: #e25c3b;
    color: #fff;
    align-self: flex-end;
    border-bottom-right-radius: 4px;
}

.chat-footer {
    padding: 15px 20px;
    background: #fff;
    border-top: 1px solid #f0f0f0;
    display: flex;
    gap: 10px;
    align-items: center;
}

.chat-input {
    flex: 1;
    border: 1px solid #ddd;
    border-radius: 20px;
    padding: 12px 18px;
    outline: none;
    font-size: 0.95rem;
    background: rgba(255,255,255,0.8);
    transition: all 0.3s;
}

.chat-input:focus {
    border-color: #ff9a9e;
    box-shadow: 0 0 10px rgba(255, 154, 158, 0.2);
    background: #fff;
}

.chat-send-btn {
    background: linear-gradient(135deg, #e25c3b, #ff7a59);
    color: #fff;
    border: none;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: 0.3s;
    box-shadow: 0 4px 10px rgba(226, 92, 59, 0.3);
}

.chat-send-btn:hover {
    transform: scale(1.08);
    box-shadow: 0 6px 15px rgba(226, 92, 59, 0.4);
}
.chat-send-btn i {
    margin-right: 2px;
}
</style>

<!-- Sidebar Trigger -->
<div class="chat-toggle-btn" data-bs-toggle="offcanvas" data-bs-target="#liveChatOffcanvas">
    ✨ LIVE CHAT
</div>

<!-- Offcanvas Sidebar -->
<div class="offcanvas offcanvas-start offcanvas-chat" tabindex="-1" id="liveChatOffcanvas" aria-labelledby="liveChatOffcanvasLabel">
    <div class="offcanvas-header">
        <div class="d-flex align-items-center gap-3">
            <div style="position:relative;">
                <img src="../img/logo.png" onerror="this.src='img/logo.png'" alt="Admin" style="width: 48px; height: 48px; border-radius: 50%; background: #fff; padding:3px; object-fit: contain; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <span class="pulse-indicator" style="position:absolute; bottom:2px; right:0; width:12px; height:12px; background:#00e676; border-radius:50%; border:2px solid #fff;"></span>
            </div>
            <div>
                <h5 class="offcanvas-title text-white mb-0" id="liveChatOffcanvasLabel" style="font-family:'Josefin Sans',sans-serif; letter-spacing:1px;">Customer Care</h5>
                <small style="opacity: 0.9; font-weight:600;"><i class="fa fa-circle text-success me-1" style="font-size:0.6rem;"></i>Online | Putik Bouquet</small>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    
    <div class="chat-body-area" id="chatArea">
        <div class="msg-bubble msg-admin">
            Halo! 🌸 Senang bertemu Anda. Ada yang bisa kami bantu seputar buket atau hampers kami hari ini?
        </div>
    </div>
    
    <div class="chat-footer">
        <input type="text" id="chatInputBar" class="chat-input" placeholder="Tulis pesan..." autocomplete="off">
        <button class="chat-send-btn" id="chatSendBtn">
            <i class="fa fa-paper-plane"></i>
        </button>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const chatInput = document.getElementById('chatInputBar');
    const sendBtn = document.getElementById('chatSendBtn');
    const chatArea = document.getElementById('chatArea');

    function sendMessage() {
        let text = chatInput.value.trim();
        if(text === "") return;

        // User Message
        let userMsg = document.createElement('div');
        userMsg.className = 'msg-bubble msg-user';
        userMsg.innerText = text;
        chatArea.appendChild(userMsg);
        
        chatInput.value = "";
        chatArea.scrollTop = chatArea.scrollHeight;

        // Auto Reply / Routing logic visual simulation
        setTimeout(() => {
            let adminMsg = document.createElement('div');
            adminMsg.className = 'msg-bubble msg-admin';
            adminMsg.innerHTML = "<em>(Pesan diteruskan ke WhatsApp Admin otomatis)</em>. <br><br>Terima kasih, mohon tunggu balasan tim kami segera! ✨";
            chatArea.appendChild(adminMsg);
            chatArea.scrollTop = chatArea.scrollHeight;
        }, 1200);
    }

    sendBtn.addEventListener('click', sendMessage);
    chatInput.addEventListener('keypress', function(e) {
        if(e.key === 'Enter') {
            sendMessage();
        }
    });
});
</script>
<!-- ============================== -->
</body>"""

def replace_wa():
    files = glob.glob(os.path.join(base_dir, "*.php"))
    files.extend(glob.glob(os.path.join(base_dir, "LoginPage", "*.php")))
    
    count = 0
    for f in files:
        fname = os.path.basename(f)
        if fname in ["logout.php", "cart.php"] or fname.startswith("proses_"):
            continue
            
        with open(f, 'r', encoding='utf-8') as file:
            content = file.read()
            
        # Gunakan regex untuk memotong blok lama dan meneteskan new_snippet
        pattern = r"<!-- ==============================\n     WhatsApp Live Chat Floating.*?\n<!-- ============================== -->\n</body>"
        match = re.search(pattern, content, flags=re.DOTALL)
        
        if match:
            new_content = content[:match.start()] + new_snippet + content[match.end():]
            with open(f, 'w', encoding='utf-8') as file:
                file.write(new_content)
            count += 1
            print(f"Replaced WA object on {fname}")
            
    print(f"Replacement completed in {count} files.")

if __name__ == "__main__":
    replace_wa()
