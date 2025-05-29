<?php
session_start(); 
include "config.php";
if(isset($_POST["password"]) && isset($_POST["email"])){


    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $password = validate($_POST["password"]);
    $email = validate($_POST["email"]);
    $remember = $_POST["remember"];

    if(empty($email)){
        header("Location: login.php?error=The email is required");
	    exit();
    }elseif(empty($password)){
        header("Location: login.php?error=Password is required&email=$email");
	    exit();
    }else{
        $sql = "SELECT * FROM user WHERE email ='$email' AND password='$password'";

		$result = mysqli_query($connection, $sql);


        if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['email'] === $email && $row['password'] === $password) {
            	$_SESSION['email'] = $row['email'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['user_id'] = $row['user_id'];
                if($remember == "yes"){

                    setcookie("email",$email,time() + 60*60*24*30);
                    setcookie("user_id",$row["user_id"],time() + 60*60*24*30);
                    setcookie("name",$row["name"],time() + 60*60*24*30);
                }
                
            	header("Location: index.php?sucess=You logged in successfully");
		        exit();
            }else{
				header("Location: login.php?error=Incorect User name or password&email=$email");
		        exit();
			}
		}else{
			header("Location: login.php?error=Incorect User name or password&email=$email");
	        exit();
        }
    }
}else{
    header("Location: login.php?error=Please fill the form");
    exit();
}
?>