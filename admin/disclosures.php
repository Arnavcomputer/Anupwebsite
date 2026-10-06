<?php $title="CBSE / School Documents"; require "_top.php";
if(isset($_POST['delete'])){$pdo->prepare("DELETE FROM documents WHERE id=?")->execute([(int)$_POST['delete']]);}
if(isset($_POST['save'])){$pdo->prepare("INSERT INTO documents(title,description,file_url) VALUES(?,?,?)")->execute([$_POST['title'],$_POST['description'],$_POST['file_url']]);}
$rows=$pdo->query("SELECT * FROM documents ORDER BY id")->fetchAll();
?>
<div class="panel"><h2>Add Document</h2><form method="post" class="form-grid"><label>Document Title<input name="title" required></label><label>File URL<input name="file_url"></label><label class="full">Description<textarea name="description"></textarea></label><button class="primary" name="save">Add Document</button></form></div>
<div class="table-wrap panel"><table><tr><th>Document</th><th>Description</th><th>File</th><th>Action</th></tr><?php foreach($rows as $r): ?><tr><td><?=e($r['title'])?></td><td><?=e($r['description'])?></td><td><?=e($r['file_url'])?></td><td><form method="post"><button class="link danger" name="delete" value="<?=$r['id']?>">Delete</button></form></td></tr><?php endforeach;?></table></div>
<?php require "_bottom.php"; ?>
