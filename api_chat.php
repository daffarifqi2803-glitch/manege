<?php
session_start();
header("Content-Type: application/json");

$chats_file = 'data/chats.json';

function getChats() {
    global $chats_file;
    if (!file_exists($chats_file)) return [];
    return json_decode(file_get_contents($chats_file), true) ?: [];
}

function saveChats($chats) {
    global $chats_file;
    file_put_contents($chats_file, json_encode($chats, JSON_PRETTY_PRINT));
}

$action = $_GET['action'] ?? $_POST['action'] ?? '';

// Ensure we have a session ID for tracking anonymous users
if (!isset($_SESSION['chat_session_id'])) {
    $_SESSION['chat_session_id'] = bin2hex(random_bytes(8));
}

$user_id = $_SESSION['user_id'] ?? $_SESSION['chat_session_id'];
$user_name = $_SESSION['user_name'] ?? 'Guest ' . substr($_SESSION['chat_session_id'], 0, 4);
$is_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

if ($action === 'send') {
    $message = $_POST['message'] ?? '';
    if (empty($message)) {
        echo json_encode(['error' => 'Empty message']);
        exit;
    }

    $target_user_id = $_POST['target_user_id'] ?? $user_id; // If admin, they specify who they reply to
    $sender = $is_admin ? 'admin' : 'user';

    $chats = getChats();
    
    // Find or create conversation
    $found = false;
    foreach ($chats as &$chat) {
        if ($chat['session_id'] === $target_user_id) {
            $chat['messages'][] = [
                'sender' => $sender,
                'message' => $message,
                'timestamp' => date('Y-m-d H:i:s')
            ];
            $chat['last_activity'] = date('Y-m-d H:i:s');
            $chat['unread_admin'] = $is_admin ? 0 : ($chat['unread_admin'] ?? 0) + 1;
            $chat['unread_user'] = $is_admin ? ($chat['unread_user'] ?? 0) + 1 : 0;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $chats[] = [
            'session_id' => $target_user_id,
            'user_name' => $user_name,
            'last_activity' => date('Y-m-d H:i:s'),
            'unread_admin' => $is_admin ? 0 : 1,
            'unread_user' => $is_admin ? 1 : 0,
            'messages' => [
                [
                    'sender' => $sender,
                    'message' => $message,
                    'timestamp' => date('Y-m-d H:i:s')
                ]
            ]
        ];
    }

    saveChats($chats);
    echo json_encode(['status' => 'success']);
} 
elseif ($action === 'fetch') {
    $target_user_id = $_GET['session_id'] ?? $user_id;
    $chats = getChats();
    $messages = [];

    foreach ($chats as &$chat) {
        if ($chat['session_id'] === $target_user_id) {
            $messages = $chat['messages'];
            // Reset unread count
            if ($is_admin) {
                $chat['unread_admin'] = 0;
            } else {
                $chat['unread_user'] = 0;
            }
            saveChats($chats);
            break;
        }
    }

    echo json_encode(['messages' => $messages]);
}
elseif ($action === 'list') {
    if (!$is_admin) {
        echo json_encode(['error' => 'Unauthorized']);
        exit;
    }

    $chats = getChats();
    // Sort by last activity
    usort($chats, function($a, $b) {
        return strtotime($b['last_activity']) - strtotime($a['last_activity']);
    });

    echo json_encode($chats);
}
?>
