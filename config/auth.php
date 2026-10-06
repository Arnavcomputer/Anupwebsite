<?php
session_start();
require_once __DIR__ . "/database.php";
if (empty($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
function e($v){ return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
?>
