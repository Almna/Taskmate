<?php
    $database_name = "";
    $User_error = false;
    $user_error = "";
    $Email_error = false;
    $Pass_error = false;
    $pass_error = "";
    $conn = "";
    $account_info = '<a href="#" class="col right"><?php echo $UserName ?><img src="img/logout.png" alt="Logout"></a>';
    $tasks_data = "";

    /*****Singup Variables*****/
    $sign_username =  "";
    $sign_email = "";
    $sign_password = $sign_confirm_password = "";
    $temp_username = "";
    /*************************/

    /***********Dashboard Variables**********/
    $dash_username = "";
    /***************************************/
    if(isset($_POST['add']))
    {
        if(!empty($_POST['task']))
        {
            $task = $_POST['task'];
            $task = sanitize($task);
            insert_task($task);
        }
    }

    if(isset($_POST['SET']))
    {
        if($_POST['SET'] == "Set As Not")
        {
            if(!empty($_COOKIE['tmpSet']))
            {
                update_task_state($_COOKIE['tmpSet'], 0);
            }
        }
        if($_POST['SET'] == "Set As Completed")
        {
            if(!empty($_COOKIE['tmpSet']))
            {
                update_task_state($_COOKIE['tmpSet'], 1);
            }
        }
    }

    if(isset($_POST['update']))
    {
        if(!empty($_SESSION['TASK_ID']))
        {
            $new_task = sanitize($_POST['task']);
            update_task($_SESSION['TASK_ID'], $new_task);
        }
        header("Location: http://localhost/Taskmate/dashboard.php");
    }

    if(isset($_POST['EDIT']))
    {
        if(!empty($_COOKIE['tmpEdit']))
        {
            $_SESSION['TASK_ID'] = $_COOKIE['tmpEdit'];
            header("Location: http://localhost/Taskmate/update.php");
        }
    }

    if(isset($_POST['DEL']))
    {
        if(!empty($_COOKIE['tmpDel']))
        {
            $task_id = $_COOKIE['tmpDel'];
            delete_task($task_id);
        }
    }


    function insert_task($task_name)
    {
        global $conn;
        open_connection();
        if($conn)
        {
            $db = $_SESSION['db'];
            $sql = "insert into $db (task, done) values ('$task_name', 'false')";
            if($conn->query($sql))
            {
                setcookie("taskInsert", "$task_name is added successfully!", time() + 2);
            }else{
                setcookie("taskInsert", "Error in adding task $task_name!", time() + 2);
            }
        }else{
            echo "connection is not up!";
        }
        close_connection();
    }

    function delete_task($task_id)
    {
        global $conn;
        open_connection();
        if($conn)
        {
            $db = $_SESSION['db'];
            $sql = "delete from $db where id='$task_id'";
            if($conn->query($sql))
            {
                setcookie("taskDeleted", "task is deleted successfully!", time() + 2);
            }else{
                setcookie("taskDeleted", "Error in deleting task!", time() + 2);
            }
        }
        close_connection();
    }

    function update_task($task_id, $new_task)
    {
        global $conn;
        open_connection();
        if($conn)
        {
            $db = $_SESSION['db'];
            $sql = "update $db set task='$new_task' where id='$task_id'";
            if($conn->query($sql))
            {
                setcookie("taskUpdated", "$new_task is updated successfully!", time() + 3);
            }else{
                setcookie("taskUpdated", "Error in updating task $new_task!", time() + 3);
            }
        }
        close_connection();
    }
          
    
    
    function update_task_state($task_id, $state)
    {
        global $conn;
        open_connection();
        if($conn)
        {
            $db = $_SESSION['db'];
            $sql = "update $db 
            set done='$state' 
            where id='$task_id'
            ";

            if($conn->query($sql))
            {
                setcookie("taskStated", "task status changed successfully!", time() + 2);
            }
        }
        close_connection();
    }

    function open_connection()
    {
        global $conn;
        $conn = new mysqli("localhost", "root", "", "taskmateusers");
        if($conn->connect_error)
        {
            echo $conn->connect_error;
            die();
        }
    }

    function close_connection()
    {
        global $conn;
        if($conn)
        {
            $conn->close();
        }
    }


    function sanitize($var)
    {
        $var = trim($var);
        $var = htmlspecialchars($var);
        $var = stripslashes($var);
        return $var;
    }
?>