<?php
if (session_status() === PHP_SESSION_NONE) session_start();
function CART_ADD($item, $qty = 1) {
    if (!isset($_SESSION['CART'])) $_SESSION['CART'] = [];
    if (isset($_SESSION['CART'][$item])) $_SESSION['CART'][$item] += $qty;
    else $_SESSION['CART'][$item] = $qty;
}
function CART_CLEAR() { unset($_SESSION['CART']); }
function CART_ITEMS() { if (session_status() === PHP_SESSION_NONE) session_start(); return $_SESSION['CART'] ?? []; }
?>
