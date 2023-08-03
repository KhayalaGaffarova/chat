<?php
include("includes/connection.php");

if(isset($_POST['sign_up'])){

    $name = htmlentities(mysqli_real_escape_string($con, $_POST['username']));
    $password = htmlentities(mysqli_real_escape_string($con, $_POST['user_password']));
    $email = htmlentities(mysqli_real_escape_string($con, $_POST['user_email']));
    $country = htmlentities(mysqli_real_escape_string($con, $_POST['user_country']));
    $gender = htmlentities(mysqli_real_escape_string($con, $_POST['user_gender']));
    $rand = rand(1, 2);

    if($name == ''){
        echo"<script>alert('Please write your name')</script>";
    }
    if(strlen($password)<8){
        echo"<script>alert('Password should be minimum 8 charecters')</script>";
        exit();
    }

    $check_email = "select * from users where user_email='$email'";
    $run_email = mysqli_query($con, $check_email);

    $check = mysqli_num_rows($run_email);

    if($check==1){
        echo"<script>alert('Email already exist, please try again')</script>";
        echo"<script>window.open('signup.php', '_self')</script>";
        exit();
    }
    if($rand == 1)
        $profile_pic = "images/user1.jpg";
    else if($rand == 2)
            $profile_pic = "images/user2.jpg";
        
    $insert = "insert into users (user_name, user_password, user_email, user_profile, user_country, user_gender) 
    values('$name','$password', '$email','$profile_pic', '$country','$gender')";

    $query = mysqli_query($con, $insert);

    if($query){
        echo"<script>alert('Congratulations $name, your account has been created successfully')</script>";

        echo"<script>window.open('signin.php', '_self')</script>";
    }
    else{
        echo"<script>alert('Registration failed, try again')</script>";

        echo"<script>window.open('signup.php', '_self')</script>";
    }
    }

?>
