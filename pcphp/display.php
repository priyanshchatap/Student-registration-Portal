<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
  integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" class="script"> -->

    <title>Student Registration Information</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="editModal">
  Edit Modal
</button> -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Edit the details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"> 
      <form action="/pcphp/display.php" method="post">
        <input type="hidden" name="Snoedit" id="Snoedit">
  <div class="mb-3">
    <label for="firstedit" class="form-label">First Name</label>
    <input type="text" name="firstedit" class="form-control" id="firstedit">
  </div>
  <div class="mb-3">
    <label for="lastedit" class="form-label">Last Name</label>
    <input type="text" name="lastedit" class="form-control" id="lastedit">
  </div>
  <div class="mb-3">
    <label for="emailedit" class="form-label">Email address</label>
    <input type="email" name="emailedit" class="form-control" id="emailedit" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="phnoedit" class="form-label">Phone Number</label>
    <input type="number" name="phnoedit" class="form-control" id="phnoedit" >
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
    <label for="genedit" class="form-label">Gender</label>
    <input type="text" name="genedit" class="form-control" id="genedit" >
  </div>
  <div class="mb-3">
    <label for="dobedit" class="form-label">Date of Birth</label>
    <input type="date" name="dobedit" class="form-control" id="dobedit" >
  </div>
  <div class="mb-3">
    <label for="addedit" class="form-label">Address</label>
    <input type="text" name="addedit" class="form-control" id="addedit" >
  </div>


  <button type="submit" class="btn btn-primary">Update Info</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Student Registration portal</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/pcphp/get_post.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/pcphp/logout.php">Logout</a>
        </li>  
      </ul>
      
    </div>
  </div>
</nav>

    
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database="student_reg";
$insert=false;
$update=false;
$delete=false;
// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if(isset($_GET['delete'])){
  $Sno = $_GET['delete'];
  echo "Deleting row with Sno: " . $Sno; // Add this line for debugging
  $delete = true;
  $sql = "DELETE FROM `student_reg3` WHERE `student_reg3`.`Sno` = '$Sno'";
  $result = mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD']=='POST'){
if(isset( $_POST['Snoedit'])){
    //update the record
    $Sno=$_POST['Snoedit'];
    $first= $_POST['firstedit'];
    $last= $_POST['lastedit'];
    $email= $_POST['emailedit'];
    $phno= $_POST['phnoedit'];
    $gender= $_POST['genedit'];
    $dob = $_POST['dobedit'];
    $add= $_POST['addedit'];
    $sql = "UPDATE `student_reg3` SET `first` = '$first',`last` = '$last',`email` = '$email',`phno` = '$phno',`gen` = '$gender',`dob` = '$dob',`add` = '$add' WHERE `student_reg3`.`Sno` = '$Sno'";
    $result= mysqli_query($conn,$sql);
    if ($result) {
       $insert=true;
    }
}
else{
    $first= $_POST['first'];
    $last= $_POST['last'];
    $email= $_POST['email'];
    $phno= $_POST['phno'];
    $gender= $_POST['gen'];
    $dob = $_POST['dob'];
    $add= $_POST['add'];
    
    $sql = "INSERT INTO `student_reg3` (`first`, `last`, `email`, `phno`, `gen`, `dob`, `add`) 
        VALUES ('$first', '$last', '$email', '$phno', '$gender', '$dob', '$add');";

    $result= mysqli_query($conn,$sql);
    if ($result) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Information Updated Successfully!</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    
      </div>';
       $insert=true;
    } else {
        echo "Error creating database: " . $conn->error;
    }

}
//}
// else{
//     echo "connection was successful<br>";
}

$sql= "SELECT * from student_reg3";
$result= mysqli_query($conn,$sql);

$num= mysqli_num_rows($result);
echo "<br>Records Registered: ";
echo $num;

// if ($num > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//       echo $row['Sno']."  ". $row["first"]. "  " . $row["last"]. "  ".$row["email"].  "  ".$row["phno"]. "  ".$row["gen"]. "  ".$row["dob"]. "  " .$row["add"]. "<br>";
//     }
//   } else {
//     echo "0 results";
//   }
  $conn->close();
//}
?>

    <table class="table" id="myTable">
    <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">E-mail</th>
          <th scope="col">Phone No.</th>
          <th scope="col">Gender</th>
          <th scope="col">Date of Birth</th>
          <th scope="col">Address</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php
        //$result = mysqli_query($conn, $sql);
$Sno = 0;
while ($row = $result->fetch_assoc()) {
    $Sno = $Sno + 1;
    echo "<tr>
            <th scope='row'>". $Sno . "</th>
            <td>". $row['first'] . "</td>
            <td>". $row['last'] . "</td>
            <td>". $row['email'] . "</td>
            <td>". $row['phno'] . "</td>
            <td>". $row['gen'] . "</td>
            <td>". $row['dob'] . "</td>
            <td>". $row['add'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=".$row['Sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['Sno'].">Delete</button>  </td>
          </tr>";
        }
      ?>
      </tbody>
    </table>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <!-- //  $(document).ready(function(){
        //     $('#myTable').DataTable();
        //  });
        //$(document).ready(function(){
        //let table = new DataTable('#myTable');
//});
// $(document).ready(function() {
//     var table = $('#myTable').DataTable({
//         "columns": [
//             null,
//             null,
//             null,
//             null,
//             null,
//             null,
//             null,
//             null,
//             { "orderable": false } // Disable sorting for the last column (Actions)
//         ],
//         "fixedHeader": {
//             header: true,
//             footer: true
//         }
//         "header": false
//     });
// }); -->

<script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>

    </script>  
        <script>
        edits= document.getElementsByClassName('edit');
        Array.from(edits).forEach((element)=>{
            element.addEventListener("click", (e)=>{
                console.log("edit",);
                tr= e.target.parentNode.parentNode;
                first= tr.getElementsByTagName("td")[0].innerText;
                last= tr.getElementsByTagName("td")[1].innerText;
                email= tr.getElementsByTagName("td")[2].innerText;
                phno= tr.getElementsByTagName("td")[3].innerText;
                gen= tr.getElementsByTagName("td")[4].innerText;
                dob= tr.getElementsByTagName("td")[5].innerText;
                add= tr.getElementsByTagName("td")[6].innerText;
                console.log(first,last,email,phno,gen,dob,add);
                firstedit.value=first;
                lastedit.value=last;
                emailedit.value=email;
                phnoedit.value=phno;
                genedit.value=gen;
                dobedit.value=dob;
                addedit.value=add;
                Snoedit.value=e.target.id;
                console.log(e.target.id);
                $('#editModal').modal('toggle');

            })
        })

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
        console.log("edit", );
        //let Sno = e.target.stu_reg3.Sno;
        Sno=  e.target.id.substr(1,);

        if (confirm("Press a button!")) {
            console.log("Yes");
            window.location = `/pcphp/display.php?delete=${Sno}`;
        } else {
            console.log("No");
        }
    })
})
    </script>
</body>
</html>
