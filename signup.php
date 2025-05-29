<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
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

<body>

    <?php
    session_start();
    include('config.php');
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
        <h2 id = "welcomeMsg">Here <br> with <br> SeekTogther</h2>
        <p>With the help of your fellows you will find your missing items!</p>
    </div>
    

    <div class="modal">
        <div style = "height: 90%;" class="modal-content">
        <button id = "closeButton" type = "submit"><a href="index.php"><i class="fa-solid fa-xmark" style="font-size: 20px; color: #ffffff;"></i></a></button>
        <h2 style = "margin: 15px; margin-top: 0px">Sign up</h2>
            <form method="post" action="configration-sign-up.php" id="form">
                <label for="name">Name:</label><br>
                <?php if (isset($_GET['name'])) { ?>
                    <input class="inpbox" type="text" id="name" name="name" required value="<?php echo $_GET['name']; ?>">
                <?php } else { ?>
                    <input class="inpbox" type="text" id="name" name="name" required placeholder = "Enter your Name*"><br><br>
                <?php } ?>

              
                <label for="email">Email:</label><br>
                <?php if (isset($_GET['email'])) { ?>
                    <input class="inpbox" type="email" id="email" name="email" required value="<?php echo $_GET['email']; ?>">
                <?php } else { ?>
                    <input class="inpbox" type="email" id="email" name="email" required placeholder = "Enter your Email*"><br><br>
                <?php } ?>
                

                <label for="password">Password:</label><br>
                <input class="inpbox" type="password" id="password" name="password" required placeholder = "Enter your Password*"><br><br>

                <label for="phone">Phone number:</label><br>
                <input class="inpbox" type="tel" id="phone" name="phone" required placeholder = "Enter your Phone Number*"><br><br>


                <input class="inpbox2" style = "margin-bottom: 0px;" type="submit" value="Sign up" name="signup"><br><br>
                <p style = " margin-bottom: 0px; margin-top: 0px; color: black; font-size: 17px;">Already have an account?  <a style = "font-weight: bold;"" href="login.php" class="ca">Log in</a></p>
                <br>

                <div class = "errorMsg" id="error-msg">
                    <?php if (isset($_GET['error'])) { ?>
                        <p  class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                </div>
                
            </form>
        </div>
    </div>
<script src="JS/script1"></script>

</body>

</html>