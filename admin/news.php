<?php $title="Latest News"; require "_top.php";
if(isset($_POST['delete'])){$pdo->prepare("DELETE FROM news WHERE id=?")->execute([(int)$_POST['delete']]);}
if(isset($_POST['save'])){$pdo->prepare("INSERT INTO news(title,excerpt,image,published_on) VALUES(?,?,?,?)")->execute([$_POST['title'],$_POST['excerpt'],$_POST['image'],$_POST['published_on']]);}
$rows=$pdo->query("SELECT * FROM news ORDER BY published_on DESC,id DESC")->fetchAll();
?>
<div class="panel"><h2>Add News</h2><form method="post" class="form-grid"><label>Title<input name="title" required></label><label>Date<input name="published_on" type="date" value="<?=date('Y-m-d')?>"></label><label>Photo URL<input name="image"></label><label class="full">Excerpt<textarea name="excerpt"></textarea></label><button class="primary" name="save">Publish</button></form></div>
<div class="table-wrap panel"><table><tr><th>Date</th><th>News</th><th>Action</th></tr><?php foreach($rows as $r): ?><tr><td><?=e($r['published_on'])?></td><td><b><?=e($r['title'])?></b><br><?=e($r['excerpt'])?></td><td><form method="post"><button class="link danger" name="delete" value="<?=$r['id']?>">Delete</button></form></td></tr><?php endforeach;?></table></div>
<?php require "_bottom.php"; ?>
