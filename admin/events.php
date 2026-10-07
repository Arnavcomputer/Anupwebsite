<?php $title="Events"; require "_top.php";
if(isset($_POST['delete'])){$pdo->prepare("DELETE FROM events WHERE id=?")->execute([(int)$_POST['delete']]);}
if(isset($_POST['save'])){$id=(int)$_POST['id']; if($id)$pdo->prepare("UPDATE events SET title,event_date,location,description,image=? WHERE id=?")->execute([$_POST['title'],$_POST['event_date'],$_POST['location'],$_POST['description'],$_POST['image'],$id]);}
$rows=$pdo->query("SELECT * FROM events ORDER BY event_date DESC")->fetchAll();
?>
<div class="panel"><h2>Add Event</h2><form method="post" class="form-grid"><input type="hidden" name="id" value="0"><label>Title<input name="title" required></label><label>Date<input name="event_date" type="date"></label><label>Location<input name="location"></label><label>Photo URL<input name="image"></label><label class="full">Description<textarea name="description"></textarea></label><button class="primary" name="save">Save Event</button></form></div>
<div class="table-wrap panel"><table><tr><th>Date</th><th>Event</th><th>Location</th><th>Action</th></tr><?php foreach($rows as $r): ?><tr><td><?=e($r['event_date'])?></td><td><b><?=e($r['title'])?></b><br><?=e($r['description'])?></td><td><?=e($r['location'])?></td><td><form method="post"><button class="link danger" name="delete" value="<?=$r['id']?>">Delete</button></form></td></tr><?php endforeach;?></table></div>
<?php require "_bottom.php"; ?>

