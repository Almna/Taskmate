<?php require 'header.php' ?>
    <body>
        <main>
            <?php
                $password_error = "";
                $email_error = "";
                $user_error = "";
                if (isset($_POST["signup"]))
                {
                    $sign_username = sanitize($_POST["username"]);
                    $sign_email = sanitize($_POST["email"]);
                    $sign_password = sanitize($_POST["passwd1"]);
                    $sign_confirm_password = sanitize($_POST["passwd2"]);

                    if(strlen($sign_username) < 3)
                    {
                        $user_error = "Username must be a combination of at least 3 characters!";
                    }

                    if(strlen($sign_password) < 8)
                    {
                        $password_error = "Password must be at least 8 characters!";
                        $Pass_error = true;
                    }

                    if($sign_password != $sign_confirm_password)
                    {
                       $password_error = " Passwords entered don't match!"; 
                       $Pass_error = true;          
                    }

                    if(!filter_var($sign_email, FILTER_VALIDATE_EMAIL))
                    {
                        $email_error = "Please enter email in a valid format!";
                        $Email_error = true;
                    }

                    if($Email_error == false && $Pass_error == false)
                    {
                        open_connection();
                        $sql = "select * from users where name='$sign_username'";
                        $user = $conn->query($sql);
                        if($user->num_rows > 0)
                        {
                            $user_error = "user already exists!";
                        }else{
                            $sql = "select * from users where email='$sign_email'";
                            $email = $conn->query($sql);
                            if($email->num_rows > 0)
                            {
                                $email_error = "sorry this email address is already linked to another account";
                                $Email_error = true;
                            }else{
                                $ti = time(); 
                                $sql = "insert into users (name, email, password, table_db)
                                values ('$sign_username', '$sign_email', '$sign_password', '$sign_username$ti')";
                                if($conn->query($sql))
                                {
                                    close_connection();
                                    open_connection();
                                    if($conn)
                                    {
                                        $sql = "create table $sign_username$ti (id int primary key auto_increment, task text not null, done boolean not null )";
                                        if($conn->query($sql))
                                        {
                                            echo "user & usertable created successfully!";
                                            setcookie("temp_user", $sign_username, time() + (30));
                                            header("Location: http://localhost/Taskmate/index.php");

                                        }else{
                                            echo "user & usertable was not created!";
                                            $conn->connect_error;
                                        }
                                    }
                                }else{
                                    echo "error in inserting user data to database";
                                }
                            }
                        }       
                    }
                    close_connection();
                }
            ?>
            <div class="row" style="position: fixed; height: 85%; width: 100%; bottom: 0%;">
                <div class="card col offset-s4 s4 z-depth-5" style="padding: 15px; border-radius: 20px;">
                    <center><h4 style="color: #0d4a6b; letter-spacing: .5px; transition: .2s ease-out;">Signup</h4></center>
                    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
                        <input class="col s12" type="text" name="username" placeholder="Username" value="<?php if($Pass_error == true || $Email_error == true){echo $sign_username;}?>"><?php echo "<p style='color: red;'>$user_error</p>";?>
                        <input type="text" class="col s12" name="email" placeholder="Email" value="<?php if($Pass_error == true || $Email_error == true) {echo $sign_email;}?>"> <?php if($Email_error == true){echo "<p style='color: red;'>$email_error</p>";}?>
                        <input class="col s12" type="password" name="passwd1" placeholder="Password">
                        <input class="col s12" type="password" name="passwd2" placeholder="Confirm Password"><?php echo "<p style='color: red;'>$password_error</p>";?>
                        <input class="btn col s12" style="background-color:  #0d4a6b;" type="submit" id="signup" name="signup" value="Signup">
                    </form>
                </div>
            </div>
        </main>
    </body>
<?php require 'footer.php' ?>