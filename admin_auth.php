<?php

require_once __DIR__ . '/app/bootstrap.php';

if (empty($_SESSION['admin'])) {
    $path = $_SERVER['REQUEST_URI'] ?? '/admin/index.php';
    $_SESSION['redirect_after_login'] = $path;
    header('Location: ' . app_url('/admin/login.php')) ;
    exit;
}
