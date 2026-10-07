<?php
session_start();
require_once "../config/database.php";
if (!empty($_SESSION['admin_id'])) { header("Location: dashboard.php"); exit; }
$error="";
if($_SERVER['REQUEST_METHOD']==='POST'){
  $email=trim($_POST['email']??'');
  $password=$_POST['password']??'';
  $st=$pdo->prepare("SELECT * FROM admins WHERE email=? LIMIT 1");
  $st->execute([$email]); $admin=$st->fetch();
  if($admin && password_verify($password,$admin['password'])){
    $_SESSION['admin_id']=$admin['id']; $_SESSION['admin_name']=$admin['name'];
    header("Location: dashboard.php"); exit;
  }
  $error="Invalid email or password.";
}
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin Login | GGA</title><link rel="stylesheet" href="<?=rtrim(dirname($_SERVER['SCRIPT_NAME']),'/')?>/../css/admin.css"></head>
<body class="login-page"><div class="login-card">
<img src="../assets/images/gga-logo.png" class="login-logo"><h1>GGA Admin Panel</h1><p>Gyandayini Girls’ Academy</p>
<?php if($error): ?><div class="alert danger"><?=htmlspecialchars($error)?></div><?php endif; ?>
<form method="post"><label>Email</label><input name="email" type="email" required><label>Password</label><input name="password" type="password" required><button>Login to Dashboard</button></form>
</div></body></html>
