<?php
session_start();
if (!isset($_SESSION['username'])) {
	header("location:login.php");
}

?>


<!DOCTYPE html>
<html>
<head>
    
</head>
<body>



	<?php
    	

if ($_POST['submit'] && !empty($_FILES)) {
	$formok=true;
	//input vars
	
	$title=$_POST['title'];
	$thread=$_POST['elml'];
	//$date=date_default_timezone_set('France/Paris');
    //FILES VARS
    
	$img_tmp=$_FILES['upload']['tmp_name'];
	$img_name=$_FILES['upload']['name'];
	$target=dirname(__FILE__)."/uploaded/".$img_name;
	move_uploaded_file($img_tmp,$target);
	include("easyphpthumbnail.class.php");
	$thumb=new easyphpthumbnail;
	$thumb->Thumbsize=160;
	$thumb->Createthumb($target,'file');
	$thumb=dirname(__FILE__)."/".$img_name;
	if(copy($thumb,$target)){
		unlink($thumb);
		echo "string";
	}
	
	$size=$_FILES['upload']['size'];
	$type=$_FILES['upload']['type'];
	$error=$_FILES['upload']['error'];
	
	if (!in_array($type,array('image/png','image/jpg','image/jpeg','image/gif','image/NEF'))) {
		$formok=False;
		echo "the uploaded file is not image";
	}
	if (filesize($target)>800000) {
		$formok=False;
		echo "the size of file is big";
	}
}
if ($formok) {
	if ($connect=mysqli_connect('localhost','root','afpc1234','flip')) {
		$content=file_get_contents($target);
		$titlescape=mysqli_real_escape_string($connect,$title);
		$threadescape=mysqli_real_escape_string($connect,$thread);
		$imagescape=mysqli_real_escape_string($connect,$content);

		//$sqltitle="insert into threads(title) values ('$titlescape')";
		$sqlthread="insert into threads(title,topic) values ('$titlescape','$threadescape')";
		$sqlimage="insert into image(name,size,type,content) values ('$img_name','$size','$type','$imagescape')";
        
        //$quertitle=mysqli_query($connect,$sqltitle);
        $querythread=mysqli_query($connect,$sqlthread);
        $queryimage=mysqli_query($connect,$sqlimage);

      if ($querythread && $queryimage) {
	     $imageid=mysqli_insert_id($connect);
        }
         mysqli_close($connect);

	}
	else {
		echo "ther is wrong in connect with data base";
	}
	echo "success in insert data in database";
}
    	
if($connect=mysqli_connect('localhost','root','afpc1234','flip')){
	$sql="SELECT type,content FROM image WHERE id=$imageid";
	$sth = $connect->query($sql);
$result=mysqli_fetch_array($sth);
echo '<img src="data:image/jpeg;base64,'.base64_encode($result['content'] ).'"/>';

}
else {
	echo "there is not connection with database";
}
?>
    	<hr />
	
    	<script type="text/javascript" src="js/jquery.min.js"></script>
    	<script type="text/javascript" src="plugin/tinymce/tinymce.min.js"></script>
    	<script type="text/javascript" src="plugin/tinymce/init-tinymce.js"></script>
    	

	<form  action="<?php echo $PHP_SELF; ?>" method="post" enctype="multipart/form-data" >
		<p>title
<input type="text" name="title"/>
</p>
<div>
<textarea class="tinymce" id="elml" name="elml"></textarea>
</div>
<input type="hidden" name="MAX_FILE_SIZE" value="800000"/>
<input type="file" name="upload"/>
<p>
<input type="submit" name="submit" value="process"/>
</p>
	</form>
	
</body>
