<?php
	include "init.php";
	if(isset($_SESSION['id'])){
		header("location:profile.php");
	}

    $email = $password = "";

	if (isset($_POST['login'])) {

        $validate->validate();

        $email = $validate->valid('email','Email','trim|required');
        $password = $validate->valid('password','Password','trim|required');
        
        if($validate->is_valid() === 1)
        {
            if($source->query("SELECT * FROM users WHERE email = ?", [$_POST['email']])){
                if($source->countRows() > 0){
                    $row = $source->single();
                    $id = $row->id;
                    $name = $row->name;
                    $dbPassword = $row->password;
                    if(password_verify($_POST['password'], $dbPassword)){
                        $_SESSION['loginSuccess'] = "Hi ".$name." You are successfully login";
                        $_SESSION['id'] = $id;
                        header('location:profile.php');
                    }else{
                        $validate->error["error_password"] = "Please enter correct password";
                    }
                }else{
                    $validate->error["error_email"]  = "Please enter correct email";
                }
            }
        }
	}
?>