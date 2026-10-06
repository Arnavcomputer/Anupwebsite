<?php $title="Site Settings"; require "_top.php";
if($_SERVER['REQUEST_METHOD']==='POST'){
 foreach($_POST as $k=>$v){ if($k==='save') continue; $st=$pdo->prepare("INSERT INTO settings(`key`,`value`) VALUES(?,?) ON DUPLICATE KEY UPDATE value=VALUES(value)"); $st->execute([$k,trim($v)]); }
 $ok="Settings saved.";
}
$settings=[]; foreach($pdo->query("SELECT `key`,`value` FROM settings") as $r) $settings[$r['key']]=$r['value'];
?>
<?php if(!empty($ok)): ?><div class="alert success"><?=$ok?></div><?php endif; ?>
<form method="post" class="panel form-grid">
<label>School Name<input name="school_name" value="<?=e($settings['school_name']??"Gyandayini Girls’ Academy")?>"></label>
<label>Trust Name<input name="trust_name" value="<?=e($settings['trust_name']??"Satya Bhama Educational Trust")?>"></label>
<label>Address<input name="address" value="<?=e($settings['address']??"Paramapur, Akelwa, Varanasi – 221302")?>"></label>
<label>Affiliation<input name="affiliation" value="<?=e($settings['affiliation']??"A Co-Educational English Medium School, Affiliated to U.P. Government")?>"></label>
<label>Email<input name="email" value="<?=e($settings['email']??"gyandayinigirlsacademy@gmail.com")?>"></label>
<label>Phone<input name="phone" value="<?=e($settings['phone']??"9473528689")?>"></label>
<label>Facebook URL<input name="facebook" value="<?=e($settings['facebook']??"https://www.facebook.com/gyandayiniacademy")?>"></label>
<label>Instagram URL<input name="instagram" value="<?=e($settings['instagram']??"https://www.instagram.com/gyandayiniacademyakelwan/")?>"></label>
<label class="full">Announcement Text<textarea name="announcement"><?=e($settings['announcement']??"Admissions & school updates — visit the academy office for current information.")?></textarea></label>
<button name="save" class="primary">Save All Settings</button></form>
<?php require "_bottom.php"; ?>
