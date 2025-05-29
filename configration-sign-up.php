<?php 
session_start(); 
include "config.php";

if (isset($_POST['email']) && isset($_POST['password'])
    && isset($_POST['name']) && isset($_POST['phone'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$email = validate($_POST['email']);
	$pass = validate($_POST['password']);

	$phone = validate($_POST['phone']);
	$name = validate($_POST['name']);

	$user_data = 'email='. $email. '&name='. $name;


	if (empty($email)) {
		header("Location: signup.php?error=Email is required&$user_data");
	    exit();
	}else if(empty($pass)){
        header("Location: signup.php?error=Password is required&$user_data");
	    exit();
	}
	else if(empty($phone)){
        header("Location: signup.php?error=Re Password is required&$user_data");
	    exit();
	}

	else if(empty($name)){
        header("Location: signup.php?error=Name is required&$user_data");
	    exit();
	}


	else{

		// hashing the password

	    $sql = "SELECT * FROM user WHERE email='$email' ";
		$result = mysqli_query($connection, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: signup.php?error=The email is taken try another&$user_data");
	        exit();
		}else {
           $sql2 = "INSERT INTO user(email, password, name, phone) VALUES('$email', '$pass', '$name','$phone')";
           $result2 = mysqli_query($connection, $sql2);
           if ($result2) {
           	 header("Location: index.php?success=Your account has been created successfully");
	         exit();
           }else {
	           	header("Location: signup.php?error=unknown error occurred&$user_data");
		        exit();
           }
		}
	}

	
}else{
    


	header("Location: signup.php");
	exit();
}