<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Lost</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/style2.css">
    <link rel="stylesheet" href="CSS/indexStyle.css">
    <link rel="stylesheet" href="CSS/optionStyle.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    

    
</head>

<body>
    <?php
    session_start();
    include("config.php");
    ?>

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
        <h2 id = "welcomeMsg">Here <br> You Can <br> Filter Out Posts</h2>
        <p>Pick A Category And Set Published Time Below!</p>
    </div>
    

    <?php if (isset($_GET["error"])) { ?>
        <script src="JS/script2.js"></script>
    <?php } else { ?>
        <script src="JS/script1.js"></script>
    <?php

    } ?>
    <div class="specify">
        <form method="GET" action="" class="edit">
        <!--    <label for="category">Category:</label> -->
        <div class=select-container>
            <select name="category" id="category" class="option-container" >
                <option value="all" <?php if (isset($_GET['category']) && $_GET['category'] == 'all') echo 'selected'; ?>>All category</option>
                <option value="electronics" <?php if (isset($_GET['category']) && $_GET['category'] == 'electronics') echo 'selected'; ?>>Electronics</option>
                <option value="clothing" <?php if (isset($_GET['category']) && $_GET['category'] == 'clothing') echo 'selected'; ?>>Clothing</option>
                <option value="Books"<?php if (isset($_GET['category']) && $_GET['category'] == 'Books') echo 'selected'; ?>>Books</option>
                <option value="Accessories" <?php if (isset($_GET['category']) && $_GET['category'] == 'Accessories') echo 'selected'; ?>>Accessories</option>
                <option value="Others" <?php if (isset($_GET['category']) && $_GET['category'] == 'Others') echo 'selected';?>>Others</option>
            </select>
            <div class="icon-container">
                <i class="fa-solid fa-caret-down"></i>
            </div>
            
            

            
            
        
           
            <!-- <label for="order">Order:</label> -->

            <select name="order" id="order" class="option-container" >
            <option value="DESC" <?php if (isset($_GET['order']) && $_GET['order'] == 'DESC') echo 'selected'; ?>>Newest</option>
            <option value="ASC" <?php if (isset($_GET['order']) && $_GET['order'] == 'ASC') echo 'selected'; ?>>Oldest</option>
            </select>
            <div class="icon-container">
                <i class="fa-solid fa-caret-down"></i>
            </div>

        </div >  
            <button type="submit" class="submit-button">Apply</button>

            
        </form>

    </div>

    <div class="querys">
        <?php
        $items_per_page = 10;

        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($current_page - 1) * $items_per_page;



        $category = isset($_GET['category']) ? $_GET['category'] : 'all';
        $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';
        
        // Start building the SQL query
        $sql = "
            SELECT item.item_id, item.title, item.description, item.category, item.location, item.date, item.image_url, user.phone, user.email, user.name AS user_name 
            FROM item 
            INNER JOIN user ON item.user_id = user.user_id
        ";
        
        // Add category filter if selected
        if ($category !== 'all') {
            $sql .= " WHERE item.category = '" . mysqli_real_escape_string($connection, $category) . "'";
        }
        
        // Add sorting order
        $sql .= " ORDER BY item.date " . ($order === 'ASC' ? 'ASC' : 'DESC');
        
        // Add pagination
        $sql .= " LIMIT $items_per_page OFFSET $offset";
        
        // Execute the query
        $result = mysqli_query($connection, $sql);


        $count_query = "SELECT COUNT(*) AS total_items FROM item";
        if ($category !== 'all') {
            $count_query .= " WHERE category = '" . mysqli_real_escape_string($connection, $category) . "'";
        }
        $count_result = mysqli_query($connection, $count_query);
        $count_row = mysqli_fetch_assoc($count_result);
        $total_items = $count_row['total_items'];

        $total_pages = ceil($total_items / $items_per_page);

        // $sql = "SELECT item.item_id, item.title, item.description, item.category, item.location, item.date, item.image_url, user.phone, user.email, user.name AS user_name FROM item INNER JOIN user ON item.user_id = user.user_id ORDER BY item.date DESC LIMIT $items_per_page OFFSET $offset;";
        // $result = mysqli_query($connection, $sql);



        if ($total_items > 0) {
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="lost-item-post">
                    <div class="post-header">
                        <h2 class="post-title"><?php echo $row["title"]; ?></h2>
                        <h3 class="post-sender"><?php $row["user_name"] ?></h3>
                        <p class="post-date">Date Lost: <span><?php echo $row["date"]; ?></span></p>
                    </div>
                    <div class="post-content">
                        <div class="post-image">
                            <img src="<?php echo substr($row["image_url"], 20); ?>" alt="Image of lost <?php echo $row["category"]; ?>">
                        </div>
                        <div class="post-details">
                            <p><b>Category:</b> <?php echo $row["category"]; ?></p>
                            <p><b>Location:</b> <?php echo $row["location"]; ?></p>
                            <p><b>Description:</b> <?php echo $row["description"]; ?></p>
                            <p><b>Contact Info:</b> <?php echo $row["email"] . " | " . $row["phone"]; ?></p>
                        </div>
                    </div>
                </div>
        <?php }
        } else {
            echo "no items found";
        }
        if ($total_pages > 1) {
            echo "<div class='pagination'>";
            if ($current_page > 1) {
                echo "<a href='?page=" . ($current_page - 1). "&category=$category&order=$order'>Previous</a>";
            }
            if ($current_page < $total_pages) {
                echo "<a href='?page=" . ($current_page + 1) ."&category=$category&order=$order'>Next</a>";
            }
            echo "</div>";
        }
        ?>

    </div>

</body>

</html>