<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "shopping");



if(isset($_POST['Badthing1'])){
	$stmt=$conn->prepare("INSERT INTO comp(name, company, complain) VALUES(?,?,?) ");
	$stmt->bind_param("sss", $name, $postName, $bad1);
	$bad1 = "Badthing1";
	$postName = $_POST['postName'];
	$name = $_POST['pers'];

	$stmt->execute();
	header("Location: flagSuccess.php?success=true");


}
if(isset($_POST['Badthing2'])){
	$stmt=$conn->prepare("INSERT INTO comp (name, company, complain) VALUES(?,?,?)");
	$stmt->bind_param("sss", $name, $postName, $bad2);
	$bad2 = "Badthing2";
	$postName = $_POST['postName'];
	$name = $_POST['pers'];

	$stmt->execute();
	header("Location: flagSuccess.php?success=true");
}
if(isset($_POST['Badthing3'])){
	
	$stmt=$conn->prepare("INSERT INTO comp (name, company, complain) VALUES(?,?,?)");
	$stmt->bind_param("sss", $name, $postName, $bad3);
	$bad3 = "Badthing3";
	$postName = $_POST['postName'];
	$name = $_POST['pers'];
	$stmt->execute();
	header("Location: flagSuccess.php?success=true");
}
if(isset($_POST['Badthing4'])){
	
	$stmt=$conn->prepare("INSERT INTO comp (name, company, complain) VALUES(?,?,?)");
	$stmt->bind_param("sss", $name, $postName, $bad4);
	$bad4 = "Badthing4";
	$postName = $_POST['postName'];
	$name = $_POST['pers'];
	$stmt->execute();
	header("Location: flagSuccess.php?success=true");
}
if(isset($_POST['other'])){
	$stmt=$conn->prepare("INSERT INTO comp (name, company, complain VALUES(?,?,?)");
	$stmt->bind_param("sss", $name, $postName, $badT);	
	$badT = $_POST['desc'];
	$name = $_POST['pers'];
	$postName = $_POST['postName'];
	$stmt->execute();
	header("Location: flagSuccess.php?success=true");
}

				
?>

<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		.complain{
			
		}
	</style>
	<title></title>
</head>
<body>
<form action="" method="POST">
	<input type="name" name="uid">
	<input type="password" name="psw">
	<input type="submit" name="sub">
</form>
<?php

	?>
</body>
</html>