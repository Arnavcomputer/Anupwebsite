<?php
session_start();
require_once __DIR__ . "/database.php";
if (empty($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
function e($v){ return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

// Auto-convert Google Drive links to direct image links
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach (['image', 'image_url', 'file_url'] as $key) {
        if (!empty($_POST[$key]) && is_string($_POST[$key])) {
            if (strpos($_POST[$key], 'drive.google.com/file/d/') !== false && preg_match('#/d/([a-zA-Z0-9_-]+)#', $_POST[$key], $m)) {
                // Use Google's dedicated image CDN which bypasses the recent 3rd-party cookie blocks
                $_POST[$key] = 'https://lh3.googleusercontent.com/d/' . $m[1];
            }
        }
    }
}
?>
