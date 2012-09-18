<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PDO Test</title>
</head>

<body>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
<fieldset style="width: 500px; text-align: center;">
<label>Name</label>
<input type="text" name="name" /><br /><br />
<label>City</label>
<input type="text" name="city" /><br /><br />
<input type="submit" name="submit" value="Submit" />

</fieldset>
</fieldset>




<?php 

if(isset($_REQUEST['submit'])){
	
	$name = $_REQUEST['name'];
	$city = $_REQUEST['city'];
	}

require_once('db_connection.php');

$dbh = db_connection();

try{
	//$dbh->exec("insert into pdotest(name,city) values(?,?)");
	
	$prepareStatement = $dbh->prepare("insert into pdotest(name,city) values(?,?)");
	
	$prepareStatement->bindValue(1,$name,PDO::PARAM_STR);
	$prepareStatement->bindValue(2,$city,PDO::PARAM_STR);
	$prepareStatement->execute();

	
}catch(PDOException $e){
	
	$e->getMessage();
	}




$result = $dbh->query("select *from pdotest");

printf("<br />Number of Column in result set = %d",$result->columnCount());

printf("<br /> Number of Rows in result set = %d",$result->rowCount());

echo "<br/ ><br /><br />";

$c = 0;


/*
while($row = $result->fetch()){
	echo "<br />".$row[0]."  ".$row[1];
	$c++;
	}

echo "<br />Number of Rows in Result Set: ". $c;
*/

while($obj = $result->fetch(PDO::FETCH_OBJ)){
//$obj = $result->fetch(PDO::FETCH_OBJ);
echo "<br />".$obj->id;
echo "<br />".$obj->name;
echo "<br />".$obj->city;
echo"<br />-----------------------------------";
}



?>


</body>
</html>