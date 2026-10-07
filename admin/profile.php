<?php $title="Admin Profile"; require "_top.php";
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $newpass = $_POST['new_password'] ?? '';
    
    if($email) {
        $st = $pdo->prepare("UPDATE admins SET email = ? WHERE id = ?");
        $st->execute([$email, $_SESSION['admin_id']]);
        $ok = "Profile updated.";
    }
    
    if($newpass) {
        $hash = password_hash($newpass, PASSWORD_DEFAULT);
        $st = $pdo->prepare("UPDATE admins SET password = ? WHERE id = ?");
        $st->execute([$hash, $_SESSION['admin_id']]);
        $ok = "Password updated successfully.";
    }
}
$admin = $pdo->prepare("SELECT email FROM admins WHERE id = ?");
$admin->execute([$_SESSION['admin_id']]);
$admin = $admin->fetch();
?>
<?php if(!empty($ok)): ?><div class="alert success"><?=$ok?></div><?php endif; ?>
<form method="post" class="panel form-grid" style="max-width: 600px;">
    <label class="full">Admin Email Address<input type="email" name="email" value="<?=e($admin['email'] ?? '')?>" required></label>
    <label class="full">New Password (leave blank to keep current)<input type="password" name="new_password" placeholder="Enter a new password here"></label>
    <button name="save" class="primary">Update Profile</button>
</form>
<?php require "_bottom.php"; ?>
