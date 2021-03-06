<?php session_start(); require 'header.php'; if(!empty($_SESSION)){header("Location: http://localhost/Taskmate/dashboard.php");} ?>

<?php 
    if(isset($_POST["login"]))
    {
        $sign_username = sanitize($_POST["username"]);
        $sign_password = sanitize($_POST["passwd"]);

        open_connection();
        if($conn)
        {
            $sql = "select name from users where name='$sign_username'";
            if($res = $conn->query($sql))
            {
                if($res->num_rows > 0)
                {
                    $sql = "select password from users where name='$sign_username'";
                    if($result = $conn->query($sql))
                    {
                        if($result->num_rows > 0)
                        {
                            $tmp = $result->fetch_assoc();
                            if($tmp["password"] == $sign_password)
                            {
                                $sql = "select * from users where name='$sign_username'";
                                if($result = $conn->query($sql))
                                {
                                    if($result->num_rows > 0)
                                    {
                                        $tmp = $result->fetch_assoc();
                                        
                                        //start a session
                                        //assign user info to the session variables
                                        setcookie("logged_user", $sign_username, time() + (6));
                                        $_SESSION["username"] =  $tmp["name"];
                                        $_SESSION["email"] =  $tmp["email"];
                                        $_SESSION["db"] = $tmp["table_db"];
                                        //set session timeout (60min) disconnect the session and rest the vars
                                        //set logout button to disconnect the session and rest the vars
                                        //send to dashboard
                                        header("Location: http://localhost/Taskmate/dashboard.php");
                                    }
                                }else{
                                    $Pass_error = true;
                                    $pass_error = "<b>Error while trying to login please try again!</b>";    
                                }
                            }else{
                                //wrong password!
                                $Pass_error = true;
                                $pass_error = "<b>incorrect username <-> password combination</b>";
                            }
                        }else{
                            echo $conn->connect_error;
                        }
                    }
                }else{
                    $Pass_error = true;
                    $pass_error = "<b>incorrect username <-> password combination</b>";
                }
            }else{
                $User_error = true;
                $user_error = "<b>Username is incorrect!</b>";
                echo $conn->connect_error;
            }

            close_connection();
        }
        

    }
?>
<body>
    <main>
        <div class="row" style="position: fixed; height: 75%; width: 100%; bottom: 0%;">
            <div class="card col offset-s4 s4 z-depth-5" style="padding: 20px; border-radius: 20px;">
                <center><h4 style="color: #0d4a6b; letter-spacing: .5px; transition: .2s ease-out;">LOGIN</h4></center>
                <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
                    <input class="col s12" type="text" name="username" placeholder="Username"><?php if($User_error == true){echo "<p style='color: red;'>$user_error</p>";}?>
                    <input class="col s12" type="password" name="passwd" placeholder="Password"><?php if($Pass_error == true){echo "<p style='color: red;'>$pass_error</p>";}?>
                    <input class="btn col s12" style="background-color:  #0d4a6b;" type="submit" name="login" value="Login">
                    <text class="left" style="margin-top: 15px; letter-spacing: .5px; transition: .2s ease-out;">Don't have an account? <a href="signup.php">Sign Up</a></text>
                </form>
            </div>
        </div>
    </main>
</body>
<?php require 'footer.php' ?>