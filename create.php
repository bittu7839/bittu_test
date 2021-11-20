<?php
	include "init.php";
	$name = $email = $password = $confirmPassword = "";
	if (isset($_POST['register'])) {

		$validate->validate();

        $name = $validate->valid('name','Name','trim|required');
        $email = $validate->valid('email','Email','trim|required');
        $password = $validate->valid('password','Password','trim|required|max_length[5]');
		$confirmPassword = $validate->valid('confirmPassword','Confirm Password','trim|required|equalTo[password]','','Password');

		if($validate->is_valid() === 1)
        {
			if($source->query("SELECT * FROM users WHERE email = ?", [$_POST['email']])){
				if($source->countRows() > 0){
					$validate->error["error_email"] = "Sorry email is already exits";
				}else {
					$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
					if($source->query("INSERT INTO users (name,email,password) VALUES (?,?,?)",[$data['name'], $data['email'], $password])){
						$_SESSION['success'] = "Your account is created successfully";
						header("location:index.php");
					}
				}
			}	
		}
	}
?>