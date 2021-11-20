<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header("location:index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
	<div class="profile-container" id="container">
		
		<div class="form-container sign-in-container">
			<?php
				if(isset($_SESSION['loginSuccess'])){
					echo "<div class='bg-success'>".$_SESSION['loginSuccess']."</div>";
					unset($_SESSION['loginSuccess']);
				}
			?>
			<h1>Welcome To Dashboard</h1>
			<hr>
			<a href="logout.php" style="text-align: center;">Logout</a>
			
		</div>
		
	</div>

</body>

</html>