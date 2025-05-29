<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="CSS/style3.css">
    <link rel="stylesheet" href="CSS/indexStyle.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        #closeButton{
            background-color: #85A98F;
            border-radius: 150px;
            border: none;
            position: absolute;  
            top: 10px;           
            right: 10px;      
            padding: 10px;       
            cursor: pointer;    
            z-index: 1000;  
            width: 40px;
            height: 40px;     
        }

        #closeButton:hover{
            background-color: lightgray;
        }
    </style>
    

</head>

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
        <h2 id = "welcomeMsg">Here <br> with <br> SeekTogther</h2>
        <p>With the help of your fellows you will find your missing items!</p>
    </div>
    

<body>
    <div class="modal" id="modal">
        <div class="modal-content">
        <button id = "closeButton" type = "submit"><a href="index.php"><i class="fa-solid fa-xmark" style="font-size: 20px; color: #ffffff;"></i></a></button>
            <h2>Log in</h2>
            <form action="login-conf.php" method="post" id="form">
                <label for="email">E-mail:</label><br>
                <?php if(isset($_GET["email"])){?>
                    <input class="inpbox" type="email" id="email" name="email" placeholder="Enter your E-mail*" value="<?php echo $_GET["email"];?>"><br><br>
                <?php }else{?>
                    <input class="inpbox" type="email" id="email" name="email" placeholder="Enter your E-mail*"><br><br>
                <?php }?>
                <label for="password">Password:</label><br>
                <input class="inpbox" type="password" id="password" name="password"
                    placeholder="Enter your password*"><br><br>

                <label style = "position: static;" for="remember">Remember me</label>
                <input style = " cursor: pointer;" type="checkbox" name = "remember" value = "yes" id = "remember"> 
                
                <p style ="margin; 10px; color: black; font-size: 17px;">Haven't signed up yet? <a style = "font-weight: bold;" href="signup.php">Create account</a></p>

                <button class="inpbox" type="submit" id="subForm">Log in</button>
                <div style = "color: #900C3F; font-weight: bold;" class="error">
                    <?php if (isset($_GET["error"])) {
                        echo $_GET["error"];
                    } ?>
                </div>
            </form>
        </div>
    </div>

   
</body>

</html>