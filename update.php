<?php session_start(); require 'header.php'; ?>
<body>
    <main>
        <?php
            if(empty($_SESSION['TASK_ID']))
            {
                header("Location: http://localhost/Taskmate/dashboard.php");
            }
        ?>
        
        <div class="card offset-s3 col s6 z-depth-3" style="margin-left: 300px; margin-right: 300px; margin-top: 200px;">
                <div class="row">
                    <form method="POST" class="col s12" style="padding: 10px;">
                        <div class="input-field col offset-s2 s6" style="">
                        Task:
                        <input type="text" id="task" name="task" placeholder="update task..">
                        </div>
                        <div>
                            <input class="col s2 btn" type="submit" style="margin-top: 40px;margin-left: 10px; background-color: #ffc107;" 
                            name="update" value='Update'>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </main>
</body>
<?php require 'footer.php'; ?>