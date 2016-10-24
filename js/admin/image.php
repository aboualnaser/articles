<?php 
$imageid=$_GET['id'];
echo $imageid;
if($connect=mysqli_connect('localhost','root','afpc1234','flip')){
	$sql="SELECT type,content FROM image WHERE id=$imageid";
	$sth = $connect->query($sql);
$result=mysqli_fetch_array($sth);
echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['content'] ).'"/>';

}
else {
	echo "there is not connection with database";
}




?>