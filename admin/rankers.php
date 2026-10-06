<?php $title="Result Rankers Banner"; require "_top.php";
function save_upload($field,$folder='rankers'){
 if(empty($_FILES[$field]['name']) || $_FILES[$field]['error']!==UPLOAD_ERR_OK) return '';
 $dir=dirname(__DIR__).'/uploads/'.$folder; if(!is_dir($dir)) mkdir($dir,0775,true);
 $ext=strtolower(pathinfo($_FILES[$field]['name'],PATHINFO_EXTENSION)); $allowed=['jpg','jpeg','png','webp']; if(!in_array($ext,$allowed,true)) return '';
 $name=uniqid('ranker_',true).'.'.$ext; if(move_uploaded_file($_FILES[$field]['tmp_name'],$dir.'/'.$name)) return 'uploads/'.$folder.'/'.$name; return '';
}
if(isset($_POST['delete'])){$pdo->prepare('DELETE FROM result_rankers WHERE id=?')->execute([(int)$_POST['delete']]);}
if(isset($_POST['save'])){
 $id=(int)($_POST['id']??0);$image=trim($_POST['old_image']??'');$up=save_upload('image');if($up)$image=$up;
 if($image===''){$image=trim($_POST['image_url']??'');}
 if($id){$pdo->prepare('UPDATE result_rankers SET class_name=?,title=?,session_name=?,image=?,sort_order=?,active=? WHERE id=?')->execute([$_POST['class_name'],$_POST['title'],$_POST['session_name'], $image,(int)$_POST['sort_order'],isset($_POST['active'])?1:0,$id]);}
 else{$pdo->prepare('INSERT INTO result_rankers(class_name,title,session_name,image,sort_order,active) VALUES(?,?,?,?,?,?)')->execute([$_POST['class_name'],$_POST['title'],$_POST['session_name'],$image,(int)$_POST['sort_order'],isset($_POST['active'])?1:0]);}
}
$edit=null;if(isset($_GET['edit'])){$st=$pdo->prepare('SELECT * FROM result_rankers WHERE id=?');$st->execute([(int)$_GET['edit']]);$edit=$st->fetch();}
$rows=$pdo->query('SELECT * FROM result_rankers ORDER BY sort_order,id')->fetchAll();
?>
<div class="panel"><h2><?= $edit?'Edit Ranker Banner':'Add Result Ranker Banner'?></h2><p class="muted">Upload a designed result-ranker banner for Nursery, LKG, UKG and Class 1–8. These banners will auto-scroll on the Home page.</p><form method="post" enctype="multipart/form-data" class="form-grid"><input type="hidden" name="id" value="<?=$edit['id']??0?>"><input type="hidden" name="old_image" value="<?=e($edit['image']??'')?>">
<label>Class<select name="class_name"><?php $classes=['Nursery','LKG','UKG']; for($i=1;$i<=8;$i++)$classes[]="Class $i"; foreach($classes as $c): ?><option value="<?=e($c)?>" <?=($edit['class_name']??'')===$c?'selected':''?>><?=e($c)?></option><?php endforeach;?></select></label>
<label>Banner Title<input name="title" required value="<?=e($edit['title']??'Class Result Rankers')?>"></label><label>Session<input name="session_name" value="<?=e($edit['session_name']??'2026-27')?>"></label><label>Display Order<input name="sort_order" type="number" value="<?=e($edit['sort_order']??1)?>"></label>
<label>Upload Banner (JPG/PNG/WebP)<input type="file" name="image" accept="image/*"></label><label>Or Image URL<input name="image_url" value="<?=e($edit['image']??'')?>"></label><label class="check"><input type="checkbox" name="active" <?=($edit['active']??1)?'checked':''?>> Show on Home</label><button class="primary" name="save">Save Banner</button></form></div>
<div class="admin-gallery ranker-admin-grid"><?php foreach($rows as $r): ?><div class="g-card"><img src="../<?=e($r['image'])?>" onerror="this.src='<?=e($r['image'])?>'"><b><?=e($r['class_name'])?> — <?=e($r['title'])?></b><small><?=e($r['session_name'])?> · <?= $r['active']?'Active':'Hidden' ?></small><div><a href="?edit=<?=$r['id']?>">Edit</a> <form method="post" style="display:inline"><button class="link danger" name="delete" value="<?=$r['id']?>">Delete</button></form></div></div><?php endforeach;?></div>
<?php require "_bottom.php"; ?>