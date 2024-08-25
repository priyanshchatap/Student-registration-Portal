<?php

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    $loggedin=true;
}
else{
  $loggedin=false;
}

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/pcphp">Student Registration Portal</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>';

    if($loggedin){
    echo '<div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/pcphp/login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/pcphp/signup.php">Signup</a>
        </li>
      </ul>';
    }
    if(!$loggedin){
    echo '    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/pcphp/get_post.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/pcphp/display.php">View</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/pcphp/logout.php">Logout</a>
      </li>  
    </ul>
    
  </div>';
    }
    echo '</div>
  </div>
</nav>';
?> 