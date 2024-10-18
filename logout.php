<?php
session_start();

// Unset all of the session variables
session_unset();

// Destroy the session
session_destroy();

// Optional: Destroy the session cookie if it exists
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Redirect to index.php
header("Location: login-page.php");
exit();
