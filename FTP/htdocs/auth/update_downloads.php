<?php
require_once __DIR__.'/../includes/.php';
require_once __DIR__.'/../includes/.php';
session_start();

header('Content-Type: /json');


if (!isset($_SESSION['_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

try {
    $productId = $_POST['_id'] ?? null;
    if (!$productId) {
        echo json_encode(['success' => false, 'message' => 'Product ID missing']);
        exit;
    }

   
    $stmt = $pdo->prepare(" ?  asset_id = ?");
    $stmt->execute([$_SESSION['_id'], $productId]);
    $existingDownload = $stmt->fetch(PDO::FETCH_ASSOC);
}
