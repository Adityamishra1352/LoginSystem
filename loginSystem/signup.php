<?php
    $showAlert = true;
    $showError=false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "partials/_dbconnect.php";
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["confirmpassword"];
    // $exists = false;
    $existingUser="SELECT * FROM `users` Where `username`='$username'";
    $resultUserCheck=mysqli_query($conn,$existingUser);
    $numRows=mysqli_num_rows($resultUserCheck);
    if($numRows>0){
        $showError="Username already exists";
    }
    else{
    if (($password == $cpassword)) {
        $sql = "INSERT INTO `users`(`username`,`password`,`date`) VALUES ('$username','$password',current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if($result){
            $showAlert=false;
        }
    }
    else{
        $showError="Passwords donot match";
    }
}
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <?php
    require 'partials/_nav.php';
    ?>
    <?php 
    if(!$showAlert){
        echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You have successfully signed up the website.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if($showError){
        echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed! </strong>' .$showError.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <div class="container my-3">
        <h1 class="text-center">Signup to our website</h1>
    </div>
    <div class="container">
        <form action="/loginSystem/signup.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="confirmpassword" class="form-label"> Confirm Password</label>
                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
            </div>
            <button type="submit" class="btn btn-primary">Signup</button>
        </form>
    </div>
    <?php

    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>