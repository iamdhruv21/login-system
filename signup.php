<?php

    $showAlert = false;
    $showError = false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        include "partials/_dbconnect.php";
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        $existSql = "select * from user where username='$username';";
        $result1 = mysqli_query($conn, $existSql);
        
        $err;
        $numExistRows = mysqli_num_rows($result1);

        if($numExistRows > 0){
          $showError = true;
          $err = "Username Already Exist";
        }
        else {
          if($password === $cpassword){

            $hash = password_hash($password, PASSWORD_DEFAULT);

              $sql = "insert into user(username, password, rdate) 
              values('$username', '$hash', now());";
              
              $result = mysqli_query($conn, $sql);
              if($result){
                  $showAlert = true;            
              }
          }
          else{
              $showError = true; 
              $err = "Password Does Not Match";
          }
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
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your Account is now Created.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
        if($showError){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Sorry!</strong> Your Account is Not Created.
                    <strong>'.$err.'</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    ?>

    <h1 class="text-center">Signup to our Website</h1>

    <?php include "partials/_signin_form.php"?>


    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>