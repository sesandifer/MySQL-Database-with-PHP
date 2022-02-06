
<?php

    require("config.php");
    include("header.php");
    session_start();
    
    $failmessage="";

    if(count($_POST)>0) {

        $result = mysqli_query($mysqli,"SELECT * FROM users WHERE username='" . $_POST["username"] . "' and password = '". md5($_POST["password"])."'");
        $row  = mysqli_fetch_array($result);
            if(is_array($row)) {
                $_SESSION["id"] = $row['id'];
                $_SESSION["username"] = $row['username'];
            } else {
                $failmessage = "Invalid Username or Password!";
            }
    }
    
    if(isset($_SESSION["id"])) {
        header("Location:index.php");
    }   
?>

<html>
<head>
    <title>User Account Login</title>
</head>
<body>
    <div class="form">
        <h2></h2>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 well">
                <form name="userlogin" method="post" action="">
                    <fieldset>
                        <legend><h2>Please Login</h2></legend>
                        <div class="form-group">

                            <input type="text" name="username" placeholder="Username" required class="form-control" />
                        </div>
                        <div class="form-group">

                            <input type="password" name="password" placeholder="Password" required class="form-control" />
                        </div><br>
                        <input type="submit" class="btn btn-primary btn-lg" name="submit" value="Log In">

                        <div class="btn">
                            <a class="btn btn-light" href="register.php" role="button">Register</a>
                        </div>	

                    </fieldset>
                    <div class="failmessage">
                        <?php if($failmessage!="") { echo $failmessage; } ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>






