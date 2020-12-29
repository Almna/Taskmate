<?php session_start(); require 'header.php'; if(empty($_SESSION)){header("Location: http://localhost/Taskmate/index.php");}?>
<body>
    <main>
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
      <div class="row"> 
          <div class="card col offset-s3 s6 z-depth-4" style="padding: 10px;">
            <table class="centered highlight">
                <center><label><h4>Tasks</h4></label></center>
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
                    foreach ($Tasks as $task => $t)
                    {
                        if($t[1] == true)
                        {
                            $tasks_data = "<tr style='background-color: #dff0d8; boarder-color: #d0e9c6;'>
                            <td>$t[0]</td>
                            <td>Completed</td>
                            <td><a class='waves-effect waves-light btn z-depth-1' style='background-color: orange;' href='#'>Set As Not Yet</a>
                            </a></td>
                            <td><a class='waves-effect waves-light btn' style='background-color: #ffc107;' href='#'>Edit</a>
                            </a></td>
                            <td><a class='waves-effect waves-light btn' style='background-color: red;' href='#'>Delete
                            </a></td>
                            </tr>";
                        }else{
                            $tasks_data = "<tr style='background-color: #f2dede; boarder-color: #ebcccc;'>
                            <td>$t[0]</td>
                            <td>not yet</td>
                            <td><a class='waves-effect waves-light btn' style='background-color: green;' 
                            href='#'>Set As Completed</a>
                            </a></td>
                            <td><a class='waves-effect waves-light btn' style='background-color: #ffc107;' href='#'>Edit</a>
                            </a></td>
                            <td><a class='waves-effect waves-light btn' style='background-color: red;' href='#'>Delete
                            </a></td>
                            </tr>";
                        }
                        
                        
                        echo $tasks_data;
                    }
                ?>
                </tbody>
            </table>
          </div> 
      <div>
    </main>
</body>
<?php require 'footer.php' ?>