<!DOCTYPE html>
<?php
session_start();
include("includes/connection.php");
if(isset($_SESSION['user_email'])){
    header("location: signin.php");
}
?>
<html>
    <head>
        <title>Chat Home</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
    <div class="container main-section">
<div class="row">
    <div class="col-md-3 col-sm-3 col-xs-12 left sidebar">
        <div class="input-group searchbox">
            <div class="input-group-btn">
                <center><a href="include/findfriends.php"><button class="btn btn-default search-icon" name="searchuser" type="submit">Add new 
                    user</a></button></center> 
            </div>
        </div>
      <div class="left-chat">
          <ul>
              <?php include("include/getusersdata.php"); ?>
    </div>
</div>
    <div class="col-md col-sm-9 col-xs-12 right-sidebar">
        <div class="row">
            <!-- daxil olan user'in melumatlarini alir -->
            <?php
                $user = $_SESSION['user_email'];
                $get_user = "select * from users where user_email='$user'";
                $run_user = mysqli_query($con, $get_user);
                $row = mysqli_fetch_array($run_user);

                $user_id = $row['user_id'];
                $user_name = $row['user_name'];
            
            ?>
             <!-- user click etdiyi diger userin melumatlarini gorur -->
            <?php
            if(isset($GET['user_name'])){
               global $con;

               $get_username=$_GET['user_name'];
               $get_user = "select * from users where user_name='$get_username'";
               $run_user = mysqli_query($con, $get_user);
               $run_user = mysqli_fetch_array($run_user);
               $user_name = $row_user['user_name'];
               $user_profile_image = $row_user['user_profile'];
            }

            $total_messages = "select * from users_chat where (sender_username='$user_name' AND receive_username='$username') OR 
            (receiver_username='$user_name' AND sender_username='$username')";
            $run_messages = mysqli_query($con, $total_messages);
            $total = mysqli_num_rows($run_messages);          
            ?>

            <div class="col-md-12 right-header">
            <div class="right-header-img">
                <img src="<?php echo"$user_profile_image";  ?>">
            </div>
            <div class="right-header-detail">
                <form method="post">
                    <p><?php echo"$username";  ?></p>
                    <span><?php echo $total; ?> messages</span>
                    <button name="logout" class="btn btn-danger">Logout</button>
        </form>
        <?php
            if(isset($_POST['logout'])){
                $update_message = mysqli_query($con, "UPDATE users SET log_in='offline' WHERE user_name='$user_name'");
                header("Location:logout.php");
                exit();
            }
        ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="scrolling_to_bottom" class="col-md-12 right-header-contentChat">
            <?php
                 $update_message = mysqli_query($con, "UPDATE users_chat SET message_status='read' WHERE sender_username='$user_name'");
                 $sel_message = " select * from users_chat where (sender_username='$user_name' AND receiver_username='$username') OR (
                receiver_username='$user_name' AND sender_username='$username') ORDER by  ASC";
                $run_message = mysqli_query($con, $sel_message);
                
                while ($row = mysqli_fetch_array($run_message)){

                    $sender_username = $row['sender_username'];
                    $receiver_username = $row['receiver_username'];
                    $message_content = ['message_content'];
                    $message_date = $row['message_date'];
               
            ?>
            <ul>
                <?php
                if($user_name == $sender_username AND $username == $receiver_username){
                    echo"
                        <li>
                           <div class='rightside-chat'>
                                <span> $username <small>$message_date</small></span>
                                <p>$message_content</p>
                            </div>
                        </li>
                    ";
                }
                else if($user_name == $receiver_username AND $username == $sender_username){
                    echo"
                        <li>
                           <div class='rightside-chat'>
                                <span> $username <small>$message_date</small></span>
                                <p>$message_content</p>
                            </div>
                        </li>
                    ";
                }
            ?>
        </ul>
        <?php
                }
        
        ?>
             </div>
        </div>
        <div class="row">
            <div>
                <div class="col-md-12 right-chat-textbox">
                    <form method="post">
                        <input type="text" name="message_content" placeholder="write a message">
                        <button class="btn" name="submit"><i class="fa fa-telegram" aria-hidden="true"></i></button>
                    </form>

                </div>
            </div> 
        </div>
    </div>
</div>
 
    <?php
        if(isset($_POST['submit'])){

            $message = htmlentities($_POST['message_content']);

            if(strlen($message) >100 ){
                echo"
                <div class='alert alert-danger'>
                     <strong><center>This message is too long</center></strong>
                </div>
                ";
            }

            else{
                $insert = "insert into users_chat(sender_username, receiver_username, message_content, message_status, message_date) values
                ('$user_name', '$username', '$message', 'unread', NOW())";
                $run_insert = mysqli_query($con, $insert);
            }
        }
    ?>


</body>
</html>



