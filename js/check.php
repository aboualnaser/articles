<?php
session_start();
class mysql
{
	     public $localhost="localhost";
         public $user="root";
         public $password="afpc1234";
         public $db="flip";
	
	function __construct()
	{
		
        mysql_connect($this->localhost,$this->user,$this->password);
        mysql_select_db($this->db);

	}
	function sql(){
		    $username=$_POST['username'];
        $password=$_POST['password'];
        $sql="SELECT * FROM users WHERE username='$username' AND password='$password'";
        $query=mysql_query($sql);
        $num=mysql_num_rows($query);
        if ($num==1) {
                      $_SESSION['username']="username";
                      $_SESSION['password']="password";
                      header("location:admin/admin.php");
        }
        else {
        	echo "username or password is wrong";
        }
	}


}
$use=new mysql;
$use->sql();


?>