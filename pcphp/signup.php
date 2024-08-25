<?php
include 'partials/_dbconnect.php';
$showalert=false;
$showError=false;
$username_error = "";
$password_error = "";
$cpassword_error = "";
if ($_SERVER['REQUEST_METHOD']=='POST'){
    
    $username= $_POST['username'];
    $password= $_POST['password'];
    $cpassword= $_POST['cpassword'];
    $exists=false;
    if (empty($username)) {
      $username_error = "Please enter the username";
  }
  if (empty($password)) {
      $password_error = "Please enter the password";
  }
  else{
    if(strlen($password)<=5){
      $password_error="<br />Atleast 5 characters";
    }
    elseif(!preg_match("#[0-9]+#", $password)){
      $password_error="<br />Atleast one digit is required";
    }
    elseif(!preg_match("#[a-z]+#", $password)){
      $password_error="<br />Atleast one lower case character is required";
    }
    elseif(!preg_match("#[A-Z]+#", $password)){
      $password_error="<br />Atleast one Upper case character is required";
    }
  }
  if (empty($cpassword)) {
    $cpassword_error = "Please enter the confirmed password";
}

  if (empty($username_error) && empty($password_error) && empty($cpassword_error)) {
    if(($password == $cpassword) && $exists==false){
        $sql="INSERT INTO `users` ( `username`, `password`, `dt`) VALUES ( '$username', '$password', current_timestamp());";

        $result= mysqli_query($conn,$sql);
        if ($result) {
            $showalert=true;
        } else {
            $showError="Password do not match";
        }

    }
  }

}
?>

<!doctype html>
<html lang="ar" dir="ltr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">

    <title>Signup</title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if($showalert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Account Registered Successfully!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        
      </div>';
    }
    if($showError){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>ERROR!</strong> '.$showError.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        
      </div>';
    }
    ?>

    <div class="container my-4">
        <h1 class="text-center">Sign-Up to Student Registration Portal</h1>

    <form action ="/pcphp/signup.php" method="post">
  <div class="mb-3 " >
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
    <span style="color: red;"><?php  echo $username_error ?></span>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
    <span style="color: red;"><?php echo $password_error ?></span>
  </div>
  <div class="mb-3">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="cPassword" name="cpassword">
    <div id="emailHelp" class="form-text">Make sure to type the same password!</div>
    <span style="color: red;"><?php echo $cpassword_error ?></span>
  </div>
  <button type="submit" class="btn btn-primary">Sign-up</button>
</form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    -->
  </body>
</html>