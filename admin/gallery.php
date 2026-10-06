<?php $title="Gallery"; require "_top.php";
if(isset($_POST['delete'])){$pdo->prepare("DELETE FROM gallery WHERE id=?")->execute([(int)$_POST['delete']]);}
if(isset($_POST['save'])){$pdo->prepare("INSERT INTO gallery(title,image,category) VALUES(?,?,?)")->execute([$_POST['title'],$_POST['image'],$_POST['category']]);}
$rows=$pdo->query("SELECT * FROM gallery ORDER BY id DESC")->fetchAll();
?>
<div class="panel"><h2>Add Photo</h2><form method="post" class="form-grid"><label>Title<input name="title"></label><label>Category<input name="category" value="School Life"></label><label class="full">Image URL<input name="image" required placeholder="Upload to assets/uploads or use an image URL"></label><button class="primary" name="save">Add Photo</button></form></div>
<div class="admin-gallery"><?php foreach($rows as $r): ?><div class="g-card"><img src="<?=e($r['image'])?>"><b><?=e($r['title'])?></b><small><?=e($r['category'])?></small><form method="post"><button class="link danger" name="delete" value="<?=$r['id']?>">Delete</button></form></div><?php endforeach;?></div>
<?php require "_bottom.php"; ?>
