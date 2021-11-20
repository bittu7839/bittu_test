<?php
	include "create.php";
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
	<div class="container" id="container">
		
		<div class="form-container sign-in-container">
			<h1>Student Sign in</h1>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<input type="text" name="name" placeholder="Name" value="<?php echo $name?>" />
				<div class="error">
					<?php echo $validate->error('error_name');?>
				</div>
				<input type="email" name="email" placeholder="Email" value="<?php echo $email?>" />
				<div class="error">
					<?php echo $validate->error('error_email');?>
				</div>
				<input type="password" name="password" placeholder="Password" value="<?php echo $password?>" />
				<div class="error">
					<?php echo $validate->error('error_password');?>
				</div>
				<input type="password" name="confirmPassword" placeholder="Confirm Password" value="<?php echo $confirmPassword?>" />
				<div class="error">
					<?php echo $validate->error('error_confirmPassword');?>
				</div>
				<button type="submit" name="register" value="Submit">Submit</button>
				<p>Already have an account?<a href="index.php">Login</a></p>
			</form>
		</div>
		
	</div>

</body>

</html>