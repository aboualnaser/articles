<?php
if($connect=mysqli_connect('localhost','root','afpc1234','flip')){
	$id = intval($_GET['id']);
	echo $id;
	$sql="SELECT * FROM threads WHERE id='$id'";
	$query=mysqli_query($connect,$sql);
	
		while($row=mysqli_fetch_object($query)){
?>
<form action="#" method="post">
		<input type="hidden" name="id" value="<?php echo $row->id;?>">
	<input type="text" name="title" value="<?php echo $row->title;?>">
	<input type="submit" name="submit" value="edit">
    </form>

</form>
<?php
}
 
	$title=$_POST['title'];
$sql2="UPDATE threads SET title='$title' WHERE id='$id'";
$query2=mysqli_query($connect,$sql2);
if ($_POST['submit']){
	echo "edit done";
}
else {
	echo "edit does not";
}

}
else {
	echo "does not connect with database";
}

?>
