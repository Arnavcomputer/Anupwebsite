<?php $title="Facilities"; require "_top.php";
if(isset($_POST['delete'])){$pdo->prepare("DELETE FROM facilities WHERE id=?")->execute([(int)$_POST['delete']]);}
if(isset($_POST['save'])){$id=(int)$_POST['id']; if($id){$pdo->prepare("UPDATE facilities SET title=?,description=?,icon=?,image=? WHERE id=?")->execute([$_POST['title'],$_POST['description'],$_POST['icon'],$_POST['image'],$id]);}else{$pdo->prepare("INSERT INTO facilities(title,description,icon,image) VALUES(?,?,?,?)")->execute([$_POST['title'],$_POST['description'],$_POST['icon'],$_POST['image']]);}}
$edit=null;if(isset($_GET['edit'])){$st=$pdo->prepare("SELECT * FROM facilities WHERE id=?");$st->execute([(int)$_GET['edit']]);$edit=$st->fetch();}
$rows=$pdo->query("SELECT * FROM facilities ORDER BY sort_order,id")->fetchAll();
?>
<div class="panel"><h2><?= $edit?'Edit Facility':'Add Facility'?></h2><form method="post" class="form-grid"><input type="hidden" name="id" value="<?=$edit['id']??0?>">
<label>Title<input name="title" required value="<?=e($edit['title']??'')?>"></label><label>Icon / Emoji<input name="icon" value="<?=e($edit['icon']??'🏫')?>"></label>
<label>Photo URL<input name="image" value="<?=e($edit['image']??'')?>"></label><label class="full">Description<textarea name="description"><?=e($edit['description']??'')?></textarea></label><button class="primary" name="save">Save Facility</button></form></div>
<div class="table-wrap panel"><table><tr><th>Photo</th><th>Facility</th><th>Actions</th></tr><?php foreach($rows as $r): ?><tr><td><img class="thumb" src="<?=e($r['image'])?>"></td><td><b><?=e($r['icon'])?> <?=e($r['title'])?></b><div><?=e($r['description'])?></div></td><td><a href="?edit=<?=$r['id']?>">Edit</a> <form style="display:inline" method="post"><button class="link danger" name="delete" value="<?=$r['id']?>">Delete</button></form></td></tr><?php endforeach;?></table></div>
<?php require "_bottom.php"; ?>

