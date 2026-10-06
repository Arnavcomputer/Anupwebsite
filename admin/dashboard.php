<?php $title="Dashboard"; require "_top.php";
$counts=[]; foreach(["facilities","events","news","gallery","downloads","documents","enquiries"] as $t){$counts[$t]=(int)$pdo->query("SELECT COUNT(*) FROM $t")->fetchColumn();}
?>
<div class="stats-grid">
<?php foreach($counts as $k=>$v): ?><div class="stat"><span><?=ucfirst($k)?></span><strong><?=$v?></strong></div><?php endforeach; ?>
</div>
<div class="panel"><h2>Website Control</h2><p>All major homepage content, About messages, facilities, events, news, gallery, downloads and CBSE documents can be managed from this panel.</p>
<div class="quick"><a href="site.php">Edit Site Settings</a><a href="pages.php">Edit Messages</a><a href="facilities.php">Manage Facilities</a><a href="gallery.php">Manage Photos</a><a href="enquiries.php">View Enquiries</a></div></div>
<div class="panel"><h2>Admin URL</h2><code>http://localhost/Gyandayini_Girls_Academy_Dynamic/admin/login.php</code></div>
<?php require "_bottom.php"; ?>
