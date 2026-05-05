<!-- ==============================
     PREMIUM REAL-TIME LIVE CHAT
=============================== -->
<style>
/* Chat Toggle Button */
.chat-toggle-btn {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: linear-gradient(135deg, #ff9a9e, #e25c3b);
    color: #fff;
    padding: 12px 28px;
    font-family: 'Josefin Sans', sans-serif;
    font-size: 1.25rem;
    font-weight: 700;
    letter-spacing: 2px;
    border-radius: 30px;
    cursor: pointer;
    box-shadow: 0 5px 15px rgba(226, 92, 59, 0.4);
    z-index: 1040;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 1px solid rgba(255,255,255,0.4);
    display: flex;
    align-items: center;
    gap: 8px;
}

.chat-toggle-btn:hover {
    transform: translateY(-5px) scale(1.05);
    color: #fff;
    box-shadow: 0 10px 25px rgba(226, 92, 59, 0.6);
}

.chat-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #ff0000;
    color: #fff;
    font-size: 0.7rem;
    padding: 2px 6px;
    border-radius: 50%;
    border: 2px solid #fff;
    display: none;
}

/* Offcanvas custom look */
.offcanvas-chat {
    width: 380px !important;
    border-left: none;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(25px);
    -webkit-backdrop-filter: blur(25px);
    box-shadow: -5px 0 35px rgba(0,0,0,0.1);
}

.offcanvas-chat .offcanvas-header {
    background: linear-gradient(135deg, #e25c3b, #ff7a59);
    color: white;
    padding: 20px 25px;
    border-bottom-left-radius: 20px;
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
    position: relative;
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
    background: linear-gradient(135deg, #e25c3b, #ff7a59);
    color: #fff;
    align-self: flex-end;
    border-bottom-right-radius: 4px;
    border: none;
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
    font-weight: 600; /* Font dipertebal */
    color: #444;
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
</style>

<!-- Sidebar Trigger -->
<div class="chat-toggle-btn" data-bs-toggle="offcanvas" data-bs-target="#liveChatOffcanvas">
    ✨ LIVE CHAT
    <span id="chatNotifBadge" class="chat-badge">0</span>
</div>

<!-- Offcanvas Sidebar -->
<div class="offcanvas offcanvas-end offcanvas-chat" tabindex="-1" id="liveChatOffcanvas">
    <div class="offcanvas-header">
        <div class="d-flex align-items-center gap-3">
            <div style="position:relative;">
                <img src="img/logo.png" onerror="this.src='../img/logo.png'" alt="Admin" style="width: 48px; height: 48px; border-radius: 50%; background: #fff; padding:3px; object-fit: contain; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <span class="pulse-indicator" style="position:absolute; bottom:2px; right:0; width:12px; height:12px; background:#00e676; border-radius:50%; border:2px solid #fff;"></span>
            </div>
            <div>
                <h5 class="offcanvas-title text-white mb-0" style="font-family:'Josefin Sans',sans-serif; letter-spacing:1px;">Customer Care</h5>
                <small style="opacity: 0.9; font-weight:600;"><i class="fa fa-circle text-success me-1" style="font-size:0.6rem;"></i>Online | Putik Bouquet</small>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    
    <div class="chat-body-area" id="chatArea">
        <div class="msg-bubble msg-admin">
            Halo! 🌸 Ada yang bisa kami bantu seputar buket atau hampers kami hari ini?
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
    const badge = document.getElementById('chatNotifBadge');
    let lastMessageCount = 0;

    function fetchMessages() {
        fetch('api_chat.php?action=fetch')
            .then(response => response.json())
            .then(data => {
                if (data.messages) {
                    if (data.messages.length > lastMessageCount) {
                        renderMessages(data.messages);
                        if (lastMessageCount > 0 && !document.getElementById('liveChatOffcanvas').classList.contains('show')) {
                            // New message notification
                            badge.innerText = data.messages.length - lastMessageCount;
                            badge.style.display = 'block';
                        }
                        lastMessageCount = data.messages.length;
                    }
                }
            });
    }

    function renderMessages(messages) {
        chatArea.innerHTML = `
            <div style="color: #888; font-size: 0.75rem; font-weight: 600; margin-bottom: -2px; align-self: flex-start;">Admin</div>
            <div class="msg-bubble msg-admin">Halo! 🌸 Ada yang bisa kami bantu seputar buket atau hampers kami hari ini?</div>
        `;
        messages.forEach(msg => {
            const label = document.createElement('div');
            label.style.color = '#888';
            label.style.fontSize = '0.75rem';
            label.style.fontWeight = '600';
            label.style.marginBottom = '-2px';
            label.style.marginTop = '6px';
            label.style.alignSelf = msg.sender === 'user' ? 'flex-end' : 'flex-start';
            label.innerText = msg.sender === 'user' ? 'Anda' : 'Admin';
            
            const bubble = document.createElement('div');
            bubble.className = `msg-bubble msg-${msg.sender}`;
            bubble.innerText = msg.message;
            
            chatArea.appendChild(label);
            chatArea.appendChild(bubble);
        });
        chatArea.scrollTop = chatArea.scrollHeight;
    }

    function sendMessage() {
        const text = chatInput.value.trim();
        if (text === "") return;

        const formData = new FormData();
        formData.append('action', 'send');
        formData.append('message', text);

        fetch('api_chat.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                chatInput.value = "";
                fetchMessages();
            }
        });
    }

    sendBtn.addEventListener('click', sendMessage);
    chatInput.addEventListener('keypress', (e) => { if(e.key === 'Enter') sendMessage(); });

    // Reset badge when offcanvas is opened
    document.getElementById('liveChatOffcanvas').addEventListener('shown.bs.offcanvas', () => {
        badge.style.display = 'none';
        badge.innerText = '0';
    });

    setInterval(fetchMessages, 3000);
    fetchMessages();
});
</script>

<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
<script>
    // Auto Logout karena Inactivity (30 menit)
    let inactivityTime = function () {
        let time;
        // Waktu timeout dalam milidetik (misal 30 menit = 1800000)
        // Untuk testing bisa ubah jadi 5000 (5 detik)
        const timeoutDuration = 30 * 60 * 1000; 

        window.onload = resetTimer;
        document.onmousemove = resetTimer;
        document.onkeypress = resetTimer;
        document.onscroll = resetTimer;
        document.onclick = resetTimer;
        document.ontouchstart = resetTimer;

        function logout() {
            // Arahkan ke logout.php dengan parameter timeout
            window.location.href = 'LoginPage/logout.php?timeout=1';
        }

        function resetTimer() {
            clearTimeout(time);
            time = setTimeout(logout, timeoutDuration);
        }
    };
    
    // Inisialisasi
    inactivityTime();
</script>
<?php endif; ?>
