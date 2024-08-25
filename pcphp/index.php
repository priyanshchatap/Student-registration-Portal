<!doctype html>
<html lang="ar" dir="ltr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">

    <title>Get And Post!</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 80px;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Student Registration portal</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/pcphp/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/pcphp/display.php">View</a>
        </li>
      </ul>
      
    </div>
  </div>
</nav>

<?php
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $first= $_POST['first'];
    $last= $_POST['last'];
    $email= $_POST['email'];
    $phno= $_POST['phno'];
    $gender= $_POST['gen'];
    $dob = $_POST['dob'];
    $add= $_POST['add'];

        
    
    //submitting these to database

    //connecting to database
    $servername = "sql309.infinityfree.com";
    $username = "if0_35552334";
    $password ="NM5me45dgbc";
    $database="if0_35552334_student_reg";
// Create a connection
    $conn = mysqli_connect($servername, $username, $password, $database);

// Check the connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    else{
         echo "connection was successful<br>";

        $sql = "INSERT INTO `student_reg3` (`first`, `last`, `email`, `phno`, `gen`, `dob`, `add`) 
        VALUES ('$first', '$last', '$email', '$phno', '$gender', '$dob', '$add');";

        $result= mysqli_query($conn,$sql);
        if ($result) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Information Registered Successfully!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        
      </div>';
        } else {
            echo "Error creating database: " . $conn->error;
        }

        $conn->close();
    }

    // if (isset($_POST['gender'])) {
    //     $gender = $_POST['gender'];
    //     echo "connected gender<br>";
    // } else {
    //     echo "not gender";
    // }
}

?>
<div class="container mt-3 mb-5" >
<form action="/pcphp/index.php" method="post">
  <div class="mb-3">
    <h1>Please enter the details</h1>
    <label for="first" class="form-label">First Name</label>
    <input type="text" name="first" class="form-control" id="first">
  </div>
  <div class="mb-3">
    <label for="last" class="form-label">Last Name</label>
    <input type="text" name="last" class="form-control" id="last">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="phno" class="form-label">Phone Number</label>
    <input type="number" name="phno" class="form-control" id="phno" >
  </div>
  <!-- <div class="mb-3">
        <label for="gender">Gender</label>
                <div>
                  <label for="male" class="radio-inline"><input type="radio" name="gender" value="m" id="male">Male</label>
                  <label for="female" class="radio-inline"><input type="radio" name="gender" value="f" id="female">Female</label>
                  <label for="others" class="radio-inline"><input type="radio" name="gender" value="o" id="others" >Others</label>                
                </div>
    </div>
   -->
  <div class="mb-3">
    <label for="gen" class="form-label">Gender</label>
    <input type="text" name="gen" class="form-control" id="gen" >
  </div>
  <div class="mb-3">
    <label for="dob" class="form-label">Date of Birth</label>
    <input type="date" name="dob" class="form-control" id="dob" >
  </div>
  <div class="mb-3">
    <label for="add" class="form-label">Address</label>
    <input type="text" name="add" class="form-control" id="add" >
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>