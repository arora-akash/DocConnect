<?php

$server="localhost";
$user="root";
$pass="";
$con=mysqli_connect($server,$user,$pass);
if($con){
	
}

$check=mysqli_select_db($con,"testdata");
if($check){
	
}
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$mode=$_POST["login"];
	$name=$_POST["username"];
	$passw=$_POST["password"];
	$mode=test_input($mode);
	$name=test_input($name);
	$passw=test_input($passw);
}

function test_input($str){
	$str=trim($str);
	$str=stripslashes($str);
	$str=htmlspecialchars($str);
	return $str;
}

if($mode=="STUDENT")
{
	$count=0;
	$q="SELECT * from pass where pass='$passw' AND user='$name'";
	$w=mysqli_query($con,$q);

	while($row=mysqli_fetch_row($w))
{
	$count++;
  header('Location: admin.php');
}
	if($count==0)
	{
		 echo "<script>";
		 echo "alert('INVALID CREDENTIALS');";
		 echo "window.location.href = 'login.html'";
		 echo "</script>";
		 
		/*header('Location: login.html'); */
		 
	}
}


if($mode=="ADMIN")
{	
	$count=0;
	$q="SELECT * from pass where pass='$passw'";
	$w=mysqli_query($con,$q);
	while($row=mysqli_fetch_row($w))
{
	$count++;
  header('Location: admin.php');
}
if($count==0)
	{
		echo "<script>";
		 echo "alert('INVALID CREDENTIALS');";
		 echo "window.location.href = 'login.html'";
		 echo "</script>";
		 
	}
}
?>