 <?php 
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post about Lost</title>
    <link rel="stylesheet" href="CSS/createPost.css">
    <link rel="stylesheet" href="CSS/indexStyle.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

</head>

<body>
    
<div class="nav">
        <div class="logo">
            <i class="fa-regular fa-handshake" style="color: #ffffff;"></i>
        </div>

        <div class = "websiteName">
            <h1>SeekTogether</h1>
        </div>
        
        <div class="container1">
            <ul class="navbar">
                <li class = "bar"><a href="index.php">Home</a></li>
                <!-- <li class = "bar"><span><input type="text" placeholder="Search" name="search"></span><a href="search.php?page=1">%</a> -->
                </li>
                <?php if (isset($_SESSION["user_id"])) { ?>
                    <li class = "bar"><a href="create-post.php">Create Post</a></li>
                    <li class = "bar"><a href="logout.php" id="logout">Logout</a></li>
                <?php } else { ?>
                    <li class = "bar"><a href="login.php">Creat Post</a></li>
                    <li class = "bar"><a href="login.php">Log in</a></li>
                    <li class = "bar"><a href="signup.php" id="singup">Sign up</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
      
    <div class="welcome">
        <?php if (isset($_SESSION["name"]))
             echo "<h2>Hello " . $_SESSION["name"] . "</h2>"; ?>
        <h2 style = "text-align: left; font-family: times new roman;" id = "welcomeMsg">Here <br> You Can Create <br> A Lost Post</h2>
        <p>Fill The Form Below</p>
    </div>

   
    <form action="post-config.php" method="post" enctype="multipart/form-data">
            <h2 class = "add">Add Lost Item</h2>
            <input type="hidden" name="user_id" value= "<?php echo $_SESSION["user_id"]?> "> 
            <label for="title">Item Title:</label>
            <input type="text" id="title" name="title"class="a" required>

            <label for="description" >Description:</label>
            <textarea id="description" name="description" rows="3" class="a" required></textarea>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="Electronics">Electronics</option>
                <option value="Books">Books</option>
                <option value="Clothing">Clothing</option>
                <option value="Accessories">Accessories</option>
                <option value="Others">Others</option>
            </select>
            
            <label for="location">location:</label>
            <input type="text" id="location" name="location" class="a" required >
<!--  -->   
            <input type="hidden" id="date_lost" name="date_lost" value="<?php echo date("Y-m-d H:i:s");?>" required>
<!--  -->   
            <label for="contact_info"> enter your contact information:</label>
            <input type="text" id="contact_info" name="contact_info" class="a" required>

            <label for="item_image" id="fileStyle"> Upload Image</label>
            <input type="file" id="item_image" name="item_image" accept="image/*" required>

            <input type="submit" name="post" value="submit">       
    </form>

</body>
</html>