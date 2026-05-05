<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Content-Type: application/json");
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$customers_file = 'data/customers.json';
$customers_data = [];
if (file_exists($customers_file)) {
    $customers_data = json_decode(file_get_contents($customers_file), true);
}

$total_users = count($customers_data);
$online_users = 0;
foreach ($customers_data as $c) {
    if (isset($c['status']) && $c['status'] == 'online') {
        $online_users++;
    }
}

// Get latest 100 registrations
usort($customers_data, function($a, $b) {
    return strtotime($b['joined']) - strtotime($a['joined']);
});
$latest_users = array_slice($customers_data, 0, 100);

header("Content-Type: application/json");
echo json_encode([
    'time' => date("H:i:s"),
    'date' => date("d M Y"),
    'stats' => [
        'total' => $total_users,
        'online' => $online_users,
        'offline' => $total_users - $online_users
    ],
    'latest_users' => $latest_users
]);
?>
