<?php
session_start(); 
include "config.php";

   if(isset($_POST["post"])){ 
    $title = $_POST["title"];
    $user_id = (int)$_POST["user_id"];
    $description = $_POST["description"];
    $category = $_POST["category"];
    $location = $_POST["location"];
    $date_lost = $_POST["date_lost"];
    $image_temp = $_FILES["item_image"]["tmp_name"];
    $image_name = $_FILES["item_image"]["name"];

    $image_path = "C:/wamp/www/Project/Images/" . $image_name;


    move_uploaded_file($image_temp,$image_path);


    if (empty($title)) {
		header("Location: create-post.php?error=title is required&$title");
	    exit();
	}else if(empty($location)){
        header("Location: create-post.php?error=location is required&$title");
	    exit();
	}

	else if(empty($image_path)){
        header("Location: create-post.php?error=image is required&$title");
	    exit();
	}
    
    else{


    $sql = "INSERT INTO item(user_id,title,description,category,location,date,image_url) VALUES('$user_id','$title','$description','$category','$location','$date_lost','$image_path')";

    $res = mysqli_query($connection,$sql);
    
    if ($res) {
        header("Location: index.php?success=Your post has been created successfully");
        exit();
    }else {
           header("Location: create-post.php?error=unknown error occurred&$");
        exit();
        }

    }



}

?>