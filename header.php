<?php require 'globals.php';?>
<head>
  <title>Taskmate</title>
  <link rel="stylesheet" href="css/materialize.css">
  <link rel="icon" href="img/ico.ico">
  <nav>
    <div class="row nav-wrapper">
      <a href="index.php" class="brand-logo center"><img src="img/logo.png" alt="logo" height="60px" width="60px"></a>
      <!-- <ul id="nav" class="left hide-on-med-and-down">
        <li><a href="index.php"><b>Home</b></a></li>
      </ul> -->
        <text class="right" style="margin-right : 20px;">
        <?php
          if(!strpos($_SERVER["PHP_SELF"], "index.php"))
          {
            if(empty($_SESSION))
            {
              echo '<a href="index.php"><b>Login</b></a></text>';
            }else{
              echo '<a href="logout.php"><b>Logout</b></a></text>';
            }
          }
        ?>
        </text>
        <text class="left" style="margin-left : 20px;">
        <?php
          if(!strpos($_SERVER["PHP_SELF"], "index.php"))
          {
            if(empty(!$_SESSION))
            {
              echo '<b>'.$_SESSION['username'].'</b></text>';
            }
          }
        ?>
    </div>
  </nav>
</head>