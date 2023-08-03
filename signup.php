<!DOCTYPE html>
<html>
<head>
    <title>Create an account</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=KoHo:wght@500;700&family=Pattaya&display=swap"
    rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/signup.css">	
</head>
<body>
    <div class="signup-form">
        <form action="" method="post">
            <div class="form-header">
                <h2>Sign up</h2>
                <p>Start chating</p>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="user_name" placeholder="Example: nigar" autocomplete="off"
                required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Example:1234578" autocomplete="off"
                required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="user_email" placeholder="someone@site.com" autocomplete="off"
                required>
            </div>
            <div class="form-group">
                <label>Country</label>
                <select class="form-control" name="user_country" required>
                <option disabled="">Select a country
                <option>Azerbaijan</option>
                <option>Greece</option>
                <option>Italy</option>
                </select>
            </div>
            <div class="form-group">
                <label>Gender</label>
                <select class="form-control" name="user_gender" required>
                <option disabled="">Select your gender
                <option>male</option>
                <option>female</option>
                <option>others</option>
                </select>
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-lg" name="sign_up">Sign Up</button> 
            <?php include("signup_user.php");?> 
        </form>
        <div class="text-center small" style="color: #674288;">Already have an account? <a href="signin.php">Signin</a></div>

    </div>


    


