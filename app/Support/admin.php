<?php

function admin_login(string $username, string $password): bool
{
    $expectedUser = $_ENV['ADMIN_USERNAME'] ?? 'admin';
    $hash = $_ENV['ADMIN_PASSWORD_HASH'] ?? '';
    return hash_equals($expectedUser, $username) && $hash !== '' && password_verify($password, $hash);
}
