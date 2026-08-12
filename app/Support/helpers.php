<?php

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function money(float|int|string $value): string
{
    return 'S/ ' . number_format((float) $value, 2, '.', ',');
}

function redirect(string $url): never
{
    if (str_starts_with($url, '/')) {
        $url = app_url($url);
    }
    header('Location: ' . $url);
    exit;
}

function flash(string $type, string $title, string $message): void
{
    $_SESSION['flash'] = compact('type', 'title', 'message');
}

function consume_flash(): ?array
{
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $flash;
}

function payment_status(float $price, float $paid): array
{
    if ($price <= 0) return ['key' => 'sin_precio', 'label' => 'Sin precio', 'class' => 'secondary'];
    if ($paid + 0.00001 >= $price) return ['key' => 'pagado', 'label' => 'Pagado', 'class' => 'success'];
    return ['key' => 'pendiente', 'label' => 'Pendiente', 'class' => 'warning text-dark'];
}

function app_url(string $path = ''): string
{
    $base = rtrim($_ENV['APP_URL'] ?? '', '/');
    if ($base === '') {
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $base = $scheme . '://' . $host;
    }
    return $base . '/' . ltrim($path, '/');
}
