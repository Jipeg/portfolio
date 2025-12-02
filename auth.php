<?php

require_once(__DIR__ . '/helpers.php');

function authenticate($username, $password)
{
    $config = config();
    if ($username === $config['auth']['username']) {
        return password_verify($password, $config['auth']['password']);
    }
    return false;
}

function requireAuth()
{
    if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
        header('Location: /admin/login');
        exit;
    }
}

function startSession()
{
    if (session_status() === PHP_SESSION_NONE) {
        $config = config();
        session_name($config['session_name']);
        session_start();
    }
}

