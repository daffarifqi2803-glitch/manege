<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Content-Type: application/json");
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$promos_file = 'data/promos.json';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? 'update'; // add, update, delete
    $id = $_POST['id'] ?? '';
    $code = $_POST['code'] ?? '';
    $type = $_POST['type'] ?? 'percent';
    $value = $_POST['value'] ?? 0;
    $title = $_POST['title'] ?? '';
    $desc = $_POST['desc'] ?? '';
    $badge = $_POST['badge'] ?? '';
    $img = $_POST['img'] ?? '';

    if (!file_exists($promos_file)) {
        file_put_contents($promos_file, json_encode([], JSON_PRETTY_PRINT));
    }

    $data = json_decode(file_get_contents($promos_file), true);

    // Image Upload Handling
    if (($action == 'add' || $action == 'update') && isset($_FILES['uploaded_image']) && $_FILES['uploaded_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['uploaded_image']['tmp_name'];
        $fileName = strtolower($_FILES['uploaded_image']['name']);
        $newFileName = 'promo_' . time() . '_' . preg_replace('/[^a-z0-9.\-_]/', '', $fileName);
        $destPath = 'img/' . $newFileName;
        
        if (!is_dir('img')) mkdir('img', 0755, true);
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $img = $destPath;
        }
    }

    if ($action == 'add') {
        $new_id = 'promo_' . time();
        $data[] = [
            'id' => $new_id,
            'code' => strtoupper($code),
            'type' => $type,
            'value' => (int)$value,
            'title' => $title,
            'desc' => $desc,
            'badge' => $badge,
            'img' => $img
        ];
        $_SESSION['success_msg'] = "Promo '$code' berhasil ditambahkan!";

    } elseif ($action == 'update') {
        foreach ($data as &$item) {
            if ($item['id'] === $id) {
                $item['code'] = strtoupper($code);
                $item['type'] = $type;
                $item['value'] = (int)$value;
                $item['title'] = $title;
                $item['desc'] = $desc;
                $item['badge'] = $badge;
                $item['img'] = $img;
                break;
            }
        }
        $_SESSION['success_msg'] = "Promo '$code' berhasil diperbarui!";

    } elseif ($action == 'delete') {
        $id_to_delete = $_POST['id'] ?? '';
        $found = false;
        foreach ($data as $index => $item) {
            if ($item['id'] === $id_to_delete) {
                unset($data[$index]);
                $data = array_values($data); // re-index
                $found = true;
                break;
            }
        }
        if ($found) {
            $_SESSION['success_msg'] = "Promo berhasil dihapus!";
        } else {
            $_SESSION['error_msg'] = "Promo tidak ditemukan!";
        }
        if ($found) {
            $_SESSION['success_msg'] = "Promo berhasil dihapus!";
        } else {
            $_SESSION['error_msg'] = "Promo tidak ditemukan!";
        }
    }

    file_put_contents($promos_file, json_encode($data, JSON_PRETTY_PRINT));

    if(isset($_POST['ajax'])) {
        header("Content-Type: application/json");
        $success = isset($_SESSION['success_msg']);
        $msg = $success ? $_SESSION['success_msg'] : ($_SESSION['error_msg'] ?? 'Aksi gagal');
        unset($_SESSION['success_msg']);
        unset($_SESSION['error_msg']);
        echo json_encode(['success' => $success, 'message' => $msg]);
        exit;
    }
}

header("Location: admin_dashboard.php");
exit;
?>
