<?php

$conn = mysqli_connect("localhost", "root", "", "shopping");

if(isset($_POST['submit'])){
$uid = mysqli_real_escape_string($conn, $_POST['uid']);
$psw = mysqli_real_escape_string($conn, $_POST['psw']);

if($uid == "meroRules789" && $psw == "pricey31$"){
	$_SESSION['user'] = $uid;
	echo "<h1>Welcome ".$_SESSION['user']."</h1>";
	$query = "SELECT * FROM comp ORDER BY id DESC" ;  
                $result = mysqli_query($conn, $query);
                $number = mysqli_num_rows($result);

	echo "<strong>You have ".$number." new flags</strong>";
	  
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
                ?>
					<div class = 'row'>
						<div class="well">
					<h4><?php echo $row['company'];?></h4>
					<strong><?php echo $row['name']; ?></strong>
					<strong><?php echo $row['complain']; ?></strong>
					</div>
					</div>
				</br>
				<?php	
				}
}
}
}
?>

<html>
<head>
	<style type="text/css">
		.well{
			background-color: 
		}
	</style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<title></title>
</head>
<body>
<div class="container">
	<?php if(!isset($_SESSION['user'])){?>
	<div class="well">
	<form action="" method="POST">
		<input type="name" name="uid">
		<input type="password" name="psw">
		<button type="submit" class="btn btn-success" name="submit">Submit</button>
	</form>
</div>
<?php 
}
if(isset($_SESSION['user'])){
	?>
	<form action="logout.php" method="POST">
		<button class="btn btn-danger" name="submit" type="submit">Logout</button>
	</form> 
<?php
}

?>
</div>
</body>
</html>