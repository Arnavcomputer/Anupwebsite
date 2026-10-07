<?php
session_start();
require_once __DIR__ . "/database.php";
if (empty($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
function e($v){ return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

// Auto-handle image uploads globally
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES)) {
    foreach (['image_upload' => 'image', 'file_upload' => 'file_url'] as $fileField => $postField) {
        if (!empty($_FILES[$fileField]['name']) && $_FILES[$fileField]['error'] === UPLOAD_ERR_OK) {
            $dir = dirname(__DIR__) . '/uploads/misc';
            if (!is_dir($dir)) mkdir($dir, 0775, true);
            $ext = strtolower(pathinfo($_FILES[$fileField]['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg','jpeg','png','webp','gif','pdf'])) {
                $name = uniqid('up_', true) . '.' . $ext;
                if (move_uploaded_file($_FILES[$fileField]['tmp_name'], $dir . '/' . $name)) {
                    $_POST[$postField] = 'uploads/misc/' . $name;
                }
            }
        }
    }
}

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
