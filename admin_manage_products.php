<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Content-Type: application/json");
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$products_file = 'data/products.json';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? 'update'; // add, update, delete
    $category = $_POST['category'] ?? '';
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? 0;
    $desc = $_POST['desc'] ?? '';
    $img = $_POST['img'] ?? '';

    if (!file_exists($products_file)) {
        header("Location: admin_dashboard.php");
        exit;
    }

    $data = json_decode(file_get_contents($products_file), true);

    // Image Upload Handling
    if (($action == 'add' || $action == 'update') && isset($_FILES['uploaded_image']) && $_FILES['uploaded_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['uploaded_image']['tmp_name'];
        $fileName = strtolower($_FILES['uploaded_image']['name']);
        $newFileName = time() . '_' . preg_replace('/[^a-z0-9.\-_]/', '', $fileName);
        $destPath = 'img/' . $newFileName;
        
        if (!is_dir('img')) mkdir('img', 0755, true);
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $img = $destPath;
        }
    }

    if ($action == 'add') {
        if (!isset($data[$category])) $data[$category] = [];
        $new_id = strtolower($category) . '_' . time();
        $data[$category][] = [
            'id' => $new_id,
            'img' => $img,
            'name' => $name,
            'price' => (int)$price,
            'desc' => $desc
        ];
        $_SESSION['success_msg'] = "Produk '$name' berhasil ditambahkan!";

    } elseif ($action == 'update') {
        if (isset($data[$category])) {
            foreach ($data[$category] as &$item) {
                if ($item['id'] === $id) {
                    $item['name'] = $name;
                    $item['price'] = (int)$price;
                    $item['img'] = $img;
                    $item['desc'] = $desc;
                    break;
                }
            }
        }
        $_SESSION['success_msg'] = "Produk '$name' berhasil diperbarui!";

    } elseif ($action == 'delete') {
        $id_to_delete = $_POST['id'] ?? '';
        $found = false;
        foreach ($data as $cat => &$items) {
            foreach ($items as $index => $item) {
                if ($item['id'] === $id_to_delete) {
                    unset($data[$cat][$index]);
                    $data[$cat] = array_values($data[$cat]); // re-index
                    $found = true;
                    break 2;
                }
            }
        }
        if ($found) {
            $_SESSION['success_msg'] = "Produk berhasil dihapus!";
        } else {
            $_SESSION['error_msg'] = "Produk tidak ditemukan!";
        }
        if ($found) {
            $_SESSION['success_msg'] = "Produk berhasil dihapus!";
        } else {
            $_SESSION['error_msg'] = "Produk tidak ditemukan!";
        }
    }

    file_put_contents($products_file, json_encode($data, JSON_PRETTY_PRINT));

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
