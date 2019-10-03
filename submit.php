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

function test_input($str){
	$str=trim($str);
	$str=stripslashes($str);
	$str=htmlspecialchars($str);
	return $str;
}
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	
	
	$mode1 = $_POST["hello"];
	
	$mode=test_input($mode1);
	
}


// $qry1=mysqli_query($con,"create procedure upfac(out ans VARCHAR(800)) UPDATE student SET ans='$ans',pic='$pic' WHERE ques='$key' ");
// mysqli_query($con,$qry1);

if($mode==="insert")
{

	$que=$_POST["ques"];
	$and=$_POST["and"];
	$key=test_input($que);
	$ans=test_input($and);

$sql="INSERT INTO testdatatable VALUES('$key','$ans')";
$check=mysqli_query($con,$sql);
//if($check)
{
//		echo "<script>";
//		 echo "alert('INSERTION SUCCESSFULL');";
//		 echo "window.location.href = 'admin.html'";
//		 echo "</script>";
}
$qry="CREATE TABLE `$key` (name VARCHAR(20), min INT ,max INT, actual INT)";
$nice=mysqli_query($con,$qry);
if($nice)
{
	echo "<script>";
		 echo "alert('INSERTION SUCCESSFULL');";
		 echo "window.location.href = 'admin.php'";
		 echo "</script>";
}
}



if($mode==="delete")
{
	$que=$_POST["sub1"];
	$key=test_input($que);
	$qry="DELETE FROM testdatatable WHERE ques='$key'";
	
	
	$check=mysqli_query($con,$qry);
	if($check)
	{
		$poi = "DROP TABLE `$key`";
		mysqli_query($con,$poi);
		echo "<script>";
		 echo "alert('DELETION SUCCESSFULL');";
		 echo "window.location.href = 'admin.php'";
		 echo "</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}

if($mode==="database")
{
	$result = mysqli_query($con,"SELECT * FROM testdatatable");
	echo "<table border='1'>
<tr>
<th>Questions</th>
<th>Answer</th>
</tr>";

while($row = mysqli_fetch_array($result))
{

echo "<tr>";
echo "<td>" . $row['ques'] . "</td>";
echo "<td>" . $row['ans'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($con);
}

if($mode==="addpara")
{
	$que=$_POST["sub1"];
	$and=$_POST["and"];
	
	$mini = $_POST["min"];
	$maxi = $_POST["max"];
	$key=test_input($que);
	$ans=test_input($and);
	
	$maximum = test_input($maxi);
	$minimum = test_input($mini);
	$result = mysqli_query($con,"INSERT INTO `$key` VALUES('$ans','$minimum','$maximum','')" );
	if($result)
	{
		 echo "<script>";
		 echo "alert('PARAMETER ADDED SUCCESSFULLY');";
		 echo "window.location.href = 'admin.php'";
		 echo "</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}

if($mode ==="deletepara")
{
	$que=$_POST["sub1"];
	$and=$_POST["and"];
	
	
	$key=test_input($que);
	$ans=test_input($and);
	
	
	$result = mysqli_query($con,"DELETE FROM `$key` WHERE name ='$ans'" );	
	if($result)
	{
		 echo "<script>";
		 echo "alert('PARAMETER DELETED SUCCESSFULLY');";
		 echo "window.location.href = 'admin.php'";
		 echo "</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}

if($mode === "showtest")
{
	$que=$_POST["sub1"];
	
	$key=test_input($que);
	
	$result = mysqli_query($con,"SELECT * FROM `$key`" );
	echo "<table border='1'>
<tr>
<th>NAME</th>
<th>MINIMUM</th>
<th>MAXIMUM</th>
</tr>";

while($row = mysqli_fetch_array($result))
{

echo "<tr>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['min'] . "</td>";
echo "<td>" . $row['max'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($con);
}

if ($mode === "patienttest")
{
	$que=$_POST["sub1"];
	$and = $_POST["and"];
	$ans=test_input($and);
	$key=test_input($que);
	$result = mysqli_query($con,"SELECT * FROM `$key`" );
	echo "<body style = 'background-color : #ffffcc'></style></body>";
	
	echo "<h1 align = center> DIAGONSTIC REPORT </h1>";
	echo "<h3 align = center>$key report </h3>";
	echo "<br>";
	echo "<br>";
	echo "<table border='1' align = 'center'>
<tr>
<th>**...NAME...**</th>
<th>**..MINIMUM..**</th>
<th>**..MAXIMUM..**</th>
<th>**..ACTUAL..**</th> 
</tr>";
while($row = mysqli_fetch_array($result))
{

echo "<tr>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['min'] . "</td>";
echo "<td>" . $row['max'] . "</td>";
echo "<td>";
?>
	<input type="text" class="form-control" name="dekhtehai" value="">

<?php
echo "</td>";
}

echo "</table>";?>
<br>
<br>
<div align="center">
<button onclick="myFunction()">Print</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<button>Mail</button>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<input type="submit" name="back" value="Back" onclick="window.location.href='admin.php'"  >
</div>
<script>
function myFunction() {
  window.print();
}

</script>
<?php
mysqli_close($con);
}

?>