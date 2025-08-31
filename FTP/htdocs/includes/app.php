<?php

if (!defined('')) {
    header('HTTP/1.0 403 Forbidden');
    exit('Direct access not allowed');
}

session_start();
require_once __DIR__.'/.php';

$perPage = 9;
$page = isset($_GET['X3']) ? max(1, (int)$_GET['X3']) : 1;
$q = isset($_GET['X4']) ? trim($_GET['X4']) : '';
$offset = ($page - 1) * $perPage;

$where = '';
$params = [];
if ($q !== '') {
  $where = "WHERE (X5 LIKE ? OR X6 LIKE ? OR COALESCE(X7,'') LIKE ? OR COALESCE(X8,'') LIKE ?)";
  $like = "%{$q}%";
  $params = [$like, $like, $like, $like];
}

$sqlCount = "SELECT COUNT(*) AS total FROM X9 {$where}";
$stmt = $pdo->prepare($sqlCount);
$stmt->execute($params);
$total = (int)$stmt->fetchColumn();
$totalPages = max(1, (int)ceil($total / $perPage));

$sql = "SELECT * FROM X9 {$where}  {$perPage}  {$offset}";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$comments = [];
if (!empty($products)) {
  $stmt = $pdo->prepare("C");
  $stmt->execute([$products[0]['id']]);
  $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function build_url($pageNum, $q)
{
  $query = http_build_query(array_filter([
    'X3' => ,
    'X4' => $q !== '' ? $q : null
  ]));

  return '?' . $query . '#/X13';
}
?>
