<?php session_start(); require 'header.php'; ?>
<body>
    <main>
        <?php
            if(empty($_SESSION))
            {
                header("Location: http://localhost/Taskmate/index.php");
            }
            /*
                echo "<h3>session is live:-<br/> username: ".$_SESSION['username'];
                echo "<br/>email: ".$_SESSION['email']."</h3>";*/
        ?>
        <div class="row">
            <div class="card offset-s3 col s6 z-depth-5">
                <div class="row">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" class="col s12">
                    <div class="row">
                        <div class="input-field col offset-s2 s6" style="">
                            <input type="text" id="task" name="task" placeholder="a new task">
                        </div>
                            <button type="submit" class="btn-floating btn-large materialize-red" 
                            style="top: 15px; left: 30px;" name="add"><img src="img/plus.png" /></button>
                    </form>
                </div>
            </div>
        </div> 
        <form method="post">
            <div class="card col offset-s3 s6 z-depth-4" style="padding: 30px;">
                <div class="row">
                    <center>
                    <table class="centered highlight">
                        <label><h4>Tasks</h4></label>
                        <thead>
                        <tr>
                            <th>Task</th>
                            <th>Status</th>
                            <th>Set Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                            open_connection();
                            if($conn)
                            {
                                $db = $_SESSION['db'];
                                $sql = "select * from $db;";                
                                if($result = $conn->query($sql))
                                {
                                    if($result->num_rows > 0)
                                    {
                                        $tasks = array();
                                        while ($task = $result->fetch_assoc())
                                        {
                                            $id = $task['id'];
                                            $t = $task['task'];
                                            $done = $task['done'];
                                            if($done)
                                            {
                                                $tasks_data = "<tr style='background-color: #dff0d8; boarder-color: #d0e9c6;'>
                                                <td>$t</td>
                                                <td>Completed</td>
                                                <td><input class='waves-effect waves-light SET' type='submit' name='SET' id='$id' style='background-color: orange;' value='Set As Not'></td>
                                                <td><input class='waves-effect waves-light EDIT' type='submit' name='EDIT' id='$id' style='background-color: #ffc107;' value='Edit'></td>
                                                <td><input class='waves-effect waves-light DEL' type='submit' name='DEL' id='$id' style='background-color: red;' value='Delete'></td>
                                                </tr>";
                                            }else{
                                                $tasks_data = "<tr style='background-color: #f2dede; boarder-color: #ebcccc;'>
                                                <td>$t</td> 
                                                <td>not Completed</td>
                                                <td><input class='waves-effect waves-light SET' type='submit' name='SET' id='$id' style='background-color: green;' value='Set As Completed'></td>
                                                <td><input class='waves-effect waves-light EDIT' type='submit' name='EDIT' id='$id' style='background-color: #ffc107;' value='Edit'></td>
                                                <td><input class='waves-effect waves-light DEL' type='submit' name='DEL' id='$id' style='background-color: red;' value='Delete'></td>
                                                </tr>";
                                            }
                                            echo '<center>'.$tasks_data.'</center>';
                                        }
                                    }else{
                                        echo $conn->connect_error;
                                    }
                                }else{
                                    echo "cannot connect to database ", $conn->connect_error;
                                }
                            }
                            close_connection();
                        ?>
                        </tbody>
                    </table>
                    </center>
                </div>        
            <div>
        </form>
    </main> 
</body>
<?php require 'footer.php' ?>