<?php

    $login = false;
    $loginError = false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        include "partials/_dbconnect.php";
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // $sql = "select * from user where username='$username' and password='$password';";
        $sql = "select * from user where username='$username';";
        
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)){
            while($row = mysqli_fetch_assoc($result)){
              if(password_verify($password, $row['password'])){
                $login = true;     
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("location: welcome.php");      
              }
              else{
                $loginError = true;
              }
            }
        }
        else{
          $loginError = true;
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <?php include "partials/_nav.php"?>

    <?php
        if($login){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> You are Loged In to our Website.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
        if($loginError){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Sorry! Can\'t Login <strong> Incorrect Credentials</strong>.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    ?>

    <h1 class="text-center">Login to our Website</h1>

    <?php include "partials/_login_form.php"?>


    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>