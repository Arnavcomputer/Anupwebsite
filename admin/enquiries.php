<?php $title="Enquiries"; require "_top.php";
if(isset($_POST['delete'])){$pdo->prepare("DELETE FROM enquiries WHERE id=?")->execute([(int)$_POST['delete']]);}
$rows=$pdo->query("SELECT * FROM enquiries ORDER BY created_at DESC")->fetchAll();
?>
<div class="table-wrap panel"><table><tr><th>Date</th><th>Name</th><th>Mobile</th><th>Type</th><th>Message</th><th>Action</th></tr><?php foreach($rows as $r): ?><tr><td><?=e($r['created_at'])?></td><td><?=e($r['name'])?></td><td><?=e($r['mobile'])?></td><td><?=e($r['type'])?></td><td><?=e($r['message'])?></td><td><form method="post"><button class="link danger" name="delete" value="<?=$r['id']?>">Delete</button></form></td></tr><?php endforeach;?></table></div>
<?php require "_bottom.php"; ?>
