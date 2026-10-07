<?php require_once "../config/auth.php"; ?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?=e($title ?? 'Admin')?> | GGA</title><link rel="stylesheet" href="<?=rtrim(dirname($_SERVER['SCRIPT_NAME']),'/')?>/../css/admin.css"><link rel="icon" type="image/png" href="../assets/images/gga-logo.png"></head><body>
<div class="admin-layout"><aside class="sidebar"><div class="brand"><img src="../assets/images/gga-logo.png"><div><b>GGA</b><small>Admin Panel</small></div></div>
<nav>
<a href="dashboard.php">📊 Dashboard</a><a href="site.php">⚙️ Site Settings</a><a href="pages.php">📄 Pages & Messages</a><a href="facilities.php">🏫 Facilities</a><a href="rankers.php">🏆 Result Rankers</a><a href="events.php">📅 Events</a><a href="news.php">📰 News</a><a href="gallery.php">🖼️ Gallery</a><a href="downloads.php">⬇️ Downloads</a><a href="cbse-links.php">🔗 CBSE Links</a><a href="tc.php">📜 TC Verification</a><a href="disclosures.php">📑 CBSE Documents</a><a href="enquiries.php">✉️ Enquiries</a>
</nav><div class="side-bottom"><span><?=e($_SESSION['admin_name']??'Admin')?></span><a href="profile.php">Profile</a> &nbsp;|&nbsp; <a href="logout.php">Logout</a></div></aside><main class="admin-main"><header class="admin-head"><button class="mobile-toggle" onclick="document.querySelector('.sidebar').classList.toggle('open')">☰</button><div><span class="eyebrow">Control Center</span><h1><?=e($title ?? 'Dashboard')?></h1></div><a class="view-site" href="../index.php" target="_blank">View Website ↗</a></header>

