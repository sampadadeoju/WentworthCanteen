<?php
function require_admin() {
    session_start();
    if (!isset($_SESSION['admin_id'])) {
        header('Location: ../admin/auth/admin_login.php');
        exit();
    }
}

function require_customer() {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: ../authentication/cust_login.php');
        exit();
    }
}

function sanitize_input($data) {
    if (is_array($data)) {
        return array_map('sanitize_input', $data);
    }
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
?>