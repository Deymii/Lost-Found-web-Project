<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SeekTogether</title>

    <link rel="stylesheet" href="CSS/style2.css">
    <link rel="stylesheet" href="CSS/indexStyle.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    include("config.php");
    if (isset($_COOKIE["user_id"])) {
        $_SESSION["name"] = $_COOKIE["name"];
        $_SESSION["email"] = $_COOKIE["email"];
        $_SESSION["user_id"] = $_COOKIE["user_id"];
    }
    ?>


    <div class="nav">
        <a id = "cursor" href="index.php">
          <div class="logo">
                <i class="fa-regular fa-handshake" style="color: #ffffff;"></i>
            </div>
        </a>
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
        <h2 id = "welcomeMsg">Here <br> with <br> SeekTogther</h2>
        <p>With the help of your fellows you will find your missing items!</p>
        <p class = "viewMsg">To view all posts and filter out posts click this: <a id = "viewPost" href="search.php">View Posts</a></p>
    </div>
    

    <?php if (isset($_GET["error"])) { ?>
        <script src="JS/script2.js"></script>
    <?php } else { ?>
        <script src="JS/script1.js"></script>
    <?php

    } ?>


<div class="querys">
    <?php 
        $items_per_page = 10;

        
        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        
        
        $offset = ($current_page - 1) * $items_per_page;
        
       
        $count_query = "SELECT COUNT(*) AS total_items FROM item";
        $count_result = mysqli_query($connection, $count_query);
        $count_row = mysqli_fetch_assoc($count_result);
        $total_items = $count_row['total_items'];
 
        
        $total_pages = ceil($total_items / $items_per_page);
 
    
    $sql = "SELECT item.item_id, item.title, item.description, item.category, item.location, item.date, item.image_url, user.phone, user.email, user.name AS user_name FROM item INNER JOIN user ON item.user_id = user.user_id ORDER BY item.date DESC LIMIT $items_per_page OFFSET $offset;";
    $result = mysqli_query($connection,$sql);

    

    if($total_items > 0){
        while($row =mysqli_fetch_assoc($result)){?>
        <div class="lost-item-post">
            <div class="post-header">
                <h2 class="post-title"><?php echo $row["title"];?></h2>
                <h3 class="post-sender"><?php $row["user_name"]?></h3>
                <p class="post-date">Date Lost: <span><?php echo $row["date"];?></span></p>
            </div>
            <div class="post-content">
                <div class="post-image">
                    <img src="<?php echo substr($row["image_url"],20);?>" alt="Image of lost <?php echo $row["category"];?>">
                </div>
                <div class="post-details">
                    <p><b>Category:</b> <?php echo $row["category"];?></p>
                    <p><b>Location:</b> <?php echo $row["location"];?></p>
                    <p><b>Description:</b> <?php echo $row["description"];?></p>
                    <p><b>Contact Info:</b> <?php echo $row["email"]." | ". $row["phone"]; ?></p>
                </div>
            </div>
        </div>
        <?php }
    }else{
        echo "no items found";
    }
    ?>
    <div class="show-more">
    <?php if($current_page < $total_pages){?>
        <a href="search.php?page=2" id="show-more">Show more</a>
        <?php }?>
    </div>
    <div class="footer">

    </div>
</body>

</html>