<?php 
error_reporting(-1);
ini_set('display_errors', 'On');
include('conf/config.php');
$output="";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

  <title>journals for dz phd</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/cover/">

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


  <!-- Custom styles for this template -->
  <link href="style.css" rel="stylesheet">
</head>

<body class="text-center">

  <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto">
      <div class="inner">
        <h3 class="masthead-brand">journals4dzphd</h3>
        <nav class="nav nav-masthead justify-content-center">
          <a class="nav-link " href="./home.php">Home</a>
          <a class="nav-link active" href="index.php">Search</a>

        </nav>
      </div>
    </header>

    <main role="main" class="inner cover">
      <h1 class="cover-heading">journals for dz phd </h1>
      <p class="lead">You can  Search for a Scientific journal here  </p> 
      <p class="lead">يمكنك البحث عن المجلات العلمية هنا  </p> 

      <form action="index1.php" method="get">
        <div class="input-group">

          <input type="search" class="form-control" name="search" id="search" placeholder="TITLE, PUBLISHER  ">
          <div class="input-group-append">
            <button type="submit" class="btn btn-secondary" value="search"> <span
                class="glyphicon glyphicon-search"></span>Search</button>



          </div>



          <p class="lead"> </p>
</main>
<footer class="mastfoot mt-auto">
        <div class="inner">
            <?php 
                    $query5= "SELECT titre FROM table2 GROUP BY searchnum ORDER BY searchnum DESC LIMIT 0, 3 ";
                    $r=mysqli_query($conn,$query5);
                    if (!$query5) {
                      printf("Error: %s\n", mysqli_error($conn));
                      exit();
                    }
                   
                            echo '  <h3> most searched words </h3>' ;
            
                    while ($row = mysqli_fetch_array($r)) {
                    $titreA= $row['titre'];
                      if (true) {
                        $p   = str_replace(" ","+",$titreA);
                        $purl = "http://127.0.0.1/dashboard/journals-for-dz-phd.-master%20(1)/journals-for-dz-phd.-master/index1.php?search=".$p;
                      }
            
               
                               echo   '  <h5 class=""><a href="'.$purl.'">'.$titreA.'</a></h5>';
                                         
            
            
                    } // while 
            
            
            
            
            
            
            
            
            
            
            
            ?>
          
        </div>
      </footer>
        </div>



        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
          integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script>
          window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
        </script>

</body>

</html>