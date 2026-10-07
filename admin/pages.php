<?php $title="Pages & Messages"; require "_top.php";
if($_SERVER['REQUEST_METHOD']==='POST'){
 $id=(int)($_POST['id']??0); $st=$pdo->prepare("UPDATE pages SET title=?,content=?,image=? WHERE id=?"); $st->execute([$_POST['title'],$_POST['content'],$_POST['image'],$id]); $ok="Page updated.";
}
$rows=$pdo->query("SELECT * FROM pages ORDER BY id")->fetchAll();
?>
<?php if(!empty($ok)): ?><div class="alert success"><?=$ok?></div><?php endif; ?>
<?php foreach($rows as $r): ?><form method="post" enctype="multipart/form-data" class="panel"><input type="hidden" name="id" value="<?=$r['id']?>"><div class="form-grid">
<label>Section<input name="title" value="<?=e($r['title'])?>"></label>
<div style="display:flex; gap:10px; flex-direction:column;">
    <label>Image URL<input name="image" value="<?=e($r['image'])?>"></label>
    <label>Or Upload Image<input type="file" name="image_upload" accept="image/*"></label>
</div>
<label class="full">Message / Content<textarea name="content" rows="8"><?=e($r['content'])?></textarea></label></div><button class="primary">Save <?=e($r['slug'])?></button></form><?php endforeach; ?>
<?php require "_bottom.php"; ?>

