<?php
require_once "config/database.php";
function e($v){return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8');}
function setting($key,$default=''){global $pdo;$st=$pdo->prepare("SELECT value FROM settings WHERE `key`=?");$st->execute([$key]);return $st->fetchColumn() ?: $default;}
$school=setting('school_name','Gyandayini Girls’ Academy');
$trust=setting('trust_name','Satya Bhama Educational Trust');
$record=null;$error='';
$ad=trim($_POST['admission_no']??$_GET['admission_no']??'');
if($ad!==''){$st=$pdo->prepare('SELECT * FROM tc_records WHERE admission_no=? LIMIT 1');$st->execute([$ad]);$record=$st->fetch();if(!$record)$error='No Transfer Certificate record found for this Admission Number.';}
?><!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>TC Verification | <?=e($school)?></title><link rel="stylesheet" href="<?=rtrim(dirname($_SERVER['SCRIPT_NAME']),'/')?>/css/style.css"><link rel="icon" type="image/png" href="assets/images/gga-logo.png"></head><body>
<?php include 'partials-header.php'; ?>
<section class="tc-hero"><div class="container tc-hero-inner"><div><span class="eyebrow">Student Service</span><h1>Transfer Certificate<br><span>Verification</span></h1><p>Enter the student Admission Number to verify and view the official Transfer Certificate uploaded by the school.</p></div><div class="tc-hero-seal"><img src="assets/images/gga-logo.png" alt="GGA"><b>Official TC Service</b><small><?=e($school)?></small></div></div></section>
<section class="section tc-section"><div class="container tc-page-grid"><aside class="tc-info"><div class="tc-info-icon">✓</div><h3>How to Verify</h3><p>Use the Admission Number exactly as recorded by the school.</p><ul><li>Search by Admission Number</li><li>View official uploaded TC</li><li>Download the certificate</li><li>PDF and image files supported</li></ul><div class="tc-trust-mini"><img src="assets/images/trust-logo.png" alt="Trust"><span><?=e($trust)?></span></div></aside>
<main class="tc-verify-card"><div class="tc-card-head"><div class="tc-big-icon">📜</div><div><span class="eyebrow">Online Verification</span><h2>Verify Your TC</h2><p>Enter Admission Number and click Verify.</p></div></div>
<form method="post" class="tc-search-form"><label for="admission_no">Admission Number</label><div class="tc-search-row"><input id="admission_no" name="admission_no" required value="<?=e($ad)?>" placeholder="Enter Admission Number"><button class="btn primary" type="submit">Verify TC</button></div></form>
<?php if($error): ?><div class="tc-alert error"><?=e($error)?></div><?php endif; ?>
<?php if($record): ?><div class="tc-success"><div class="verified-badge">✓ Verified Record</div><h3><?=e($record['student_name']?:'Student')?></h3><div class="tc-details"><div><small>Admission No.</small><strong><?=e($record['admission_no'])?></strong></div><div><small>Class</small><strong><?=e($record['class_name'])?></strong></div><div><small>Issue Date</small><strong><?=e($record['issue_date'])?></strong></div></div><div class="tc-result-actions"><a class="btn primary" href="tc-view.php?admission_no=<?=urlencode($record['admission_no'])?>">View TC</a><a class="btn ghost" href="tc-view.php?admission_no=<?=urlencode($record['admission_no'])?>&download=1">Download TC</a></div></div><?php endif; ?>
</main></div></section><?php include 'partials-footer.php'; ?><script src="js/site.js"></script></body></html>
