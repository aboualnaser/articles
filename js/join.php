<?php
if($connect=mysqli_connect('localhost','root','afpc1234','flip')){
	$sqlget="SELECT threads.title, image.content,image.id ".
 "FROM threads LEFT JOIN image ".
	"ON threads.id = image.id";
	if($getresult=mysqli_query($connect,$sqlget)){
	while($row=mysqli_fetch_array($getresult)) {
		echo $row['id'].$row['title'].'<img src="data:image/jpeg;base64,'.base64_encode( $row['content'] ).'"/>'."<br>";
	}
}
else{
	echo "string";
}
}
?>