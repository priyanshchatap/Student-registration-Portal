 <?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
?> 


<!doctype html>
<html lang="ar" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">

    <title>Get And Post! <?php $_SESSION['username']?></title>
  </head>
  <body>
    <?php require 'partials/_nav.php'?>
    <?php
    //  echo $_SESSION['username']
     ?>
     <!-- <div class="container my-4">
     <div class="alert alert-success" role="alert">
     <h4 class="alert-heading">Welcome!- <?php echo $_SESSION['username']?></h4>
     <p>Welcome to Student Registration Portal. You are logged in as </p>
   <hr>
  <p class="mb-0">Whenever you need to, be sure to logout by <a href="/pcphp/logout.php">clicking here</p>
</div> -->

     
     </div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 80px;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Enter Registration details</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

  </div>
</nav>

<?php
    $first_error = "";
    $last_error = "";
    $email_error = "";
    $phno_error = "";
    $gender_error = "";
    $dob_error = "";
    $add_error="";
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $first= $_POST['first'];
    $last= $_POST['last'];
    $email= $_POST['email'];
    $phno= $_POST['phno'];
    $gender= $_POST['gen'];
    $dob = $_POST['dob'];
    $add= $_POST['add'];


    if (empty($first)) {
      $first_error = "Please enter the First name";
    }
    if (empty($last)) {
      $last_error = "Please enter the Last name";
    }
    if (empty($email)) {
      $email_error = "Please enter the E-mail";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $email_error= "Invalid Email address";
    }
    if (empty($phno)) {
      $phno_error = "Please enter the Phone Number";
    }
    if (empty($gender)) {
      $gender_error = "Please enter the gender";
    }
    if (empty($dob)) {
      $dob_error = "Please enter the Date of Birth";
    }
    if (empty($add)) {
      $add_error = "Please enter the Address";
    }

    //submitting these to database

    //connecting to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database="student_reg";

    $conn = mysqli_connect($servername, $username, $password, $database);
    if (empty($first_error) && empty($last_error) && empty($email_error) && empty($phno_error) && empty($gender_error) && empty($dob_error) && empty($add_error)) {
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    else{
        // echo "connection was successful<br>";

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
}
?>
<div class="container mt-3 mb-5" >
<form action="/pcphp/get_post.php" method="post">
  <div class="mb-3">
    <h1>Please enter the details</h1>
    <label for="first" class="form-label">First Name</label>
    <input type="text" name="first" class="form-control" id="first">
    <span style="color: red;"><?php  echo $first_error ?></span>
  </div>
  <div class="mb-3">
    <label for="last" class="form-label">Last Name</label>
    <input type="text" name="last" class="form-control" id="last">
    <span style="color: red;"><?php  echo $last_error ?></span>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
    <span style="color: red;"><?php  echo $email_error ?></span>
  </div>
  <div class="mb-3">
    <label for="phno" class="form-label">Phone Number</label>
    <input type="number" name="phno" class="form-control" id="phno" >
    <span style="color: red;"><?php  echo $phno_error ?></span>
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
    <span style="color: red;"><?php  echo $gender_error ?></span>
  </div>
  <div class="mb-3">
    <label for="dob" class="form-label">Date of Birth</label>
    <input type="date" name="dob" class="form-control" id="dob" onblur="getAge()" >
    <span style="color: red;"><?php  echo $dob_error ?></span>
  </div>
  <div class="mb-3">
    <label for="add" class="form-label">Address</label>
    <input type="text" name="add" class="form-control" id="add" >
    <span style="color: red;"><?php  echo $add_error ?></span>
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<script>
function getAge() {
var dateString = document.getElementById("dob").value;
if(dateString !="")
{
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    var da = today.getDate() - birthDate.getDate();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    if(m<0){
        m +=12;
    }
    if(da<0){
        da +=30;
    }

  if(age < 14 || age > 100)
{
alert("Age "+age+" is restrict");

 } 
 //else {

// alert("Age "+age+" is allowed");
// }
} else {
alert("please provide your date of birth");
}
}

</script>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>