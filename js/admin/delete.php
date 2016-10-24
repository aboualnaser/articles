<?php
if($connect=mysqli_connect('localhost','root','afpc1234','flip')){
	$sql="SELECT * FROM threads ORDER BY id DESC ";
	$query=mysqli_query($connect,$sql);
	$num=mysqli_num_rows($query);
}
?>


<form action="#" method="post">
	<table width="400" callspacing="0" callpadding="0">
<tr>
<td>#</td>
<td>id</td>
<td>article</td>
</tr>
<?php
while ($row=mysqli_fetch_array($query)) {
?>
<tr>
<td><input type="checkbox" name="checkbox[]" value="<?php echo $row['id']?>"></td>
<td><?php echo $row['id']?></td>
<td><?php echo $row['topic']?></td>
</tr>

<?php
}
?>
<input  type="submit" name="delete" value="delete"/>
<?php
if ($_POST['delete']) {
    foreach($_POST['checkbox'] as $selected){
    	$sql2="DELETE FROM threads WHERE id='$selected'";
    	$query2=mysqli_query($connect,$sql2);
    }

    if($query2){
    	
    	echo "<meta http-equiv='refresh' content='0;url=delete2.php?id=".$id."'>";
    }
  }
mysqli_close($connect);
?>


	</table>

</form>