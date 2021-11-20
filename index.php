<?php
	include "login.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
	<div class="container" id="container">
		
		<div class="form-container sign-in-container">
			<h1>Student Sign in</h1>
			<?php
				if(isset($_SESSION['success'])){
					echo "<div class='bg-success'>".$_SESSION['success']."</div>";
					unset($_SESSION['success']);
				}
			?>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<input type="email" name="email" placeholder="Email" value="<?php echo $email?>" />
				<div class="error">
					<?php echo $validate->error('error_email');?>
				</div>
				<input type="password" name="password" placeholder="Password" value="<?php echo $password?>" />
				<div class="error">
					<?php echo $validate->error('error_password');?>
				</div>
				<button type="submit" name="login" value="Sign In">Sign In</button>
				<p>Don't have an account?<a href="register.php">Register</a></p>
			</form>
		</div>
		
	</div>

</body>

</html>