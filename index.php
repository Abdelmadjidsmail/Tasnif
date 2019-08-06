<?php
error_reporting(-1);
ini_set('display_errors', 'On');
include('conf/config.php');
$output="";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 





// echo "Connected successfully";

if (isset($_GET['search'])) {
   $searchq=$_GET['search'] ;




   //~ $query =mysqli_query( $conn," SELECT* FROM table1 WHERE titre LIKE '%$searchq%' OR publisher LIKE '%$searchq%' LIMIT 0 , 50  ") or die("Can't execute Query") ;
   $query_phrase  ="SELECT * FROM table1  WHERE MATCH (titre, publisher) AGAINST ('$searchq' IN NATURAL LANGUAGE MODE) LIMIT 0 , 50 ;";
   $query =mysqli_query( $conn, $query_phrase) or die("Can't execute Query") ;
   $count=mysqli_num_rows($query);

if ($count==0) {
  $output="there is no search result" ;
}else {
    
}
while ($row=mysqli_fetch_array($query)) {
    # code...

    $title = $row['titre'] ;
    $ID=$row['id'] ;
    $publisher = $row['publisher'] ;
    $ISSN=$row['issn'] ;
    $ESSN=$row['essn'] ;
    $FolderN=$row['foldername'] ;
    $CLASSE=$row['category'];
    $URL=$row['url'];
    if(true)
    {
        $q   = str_replace(" ","+",$title);
        $URL = "https://www.scimagojr.com/journalsearch.php?q=". $q;
        //~ echo $URL;
    }





    $output .= '

    <div class="card bg-light mb-3">
     <div class="card-body">
                  <h5>ID :'.$ID.' </h5>
                  <h5>TITLE  :' .$title. ' </h5>
                  <h5>Publisher :'.$publisher.'</h5>   
                  <h5 class="hidden">ISSN : '.$ISSN.'</h5>
                  <h5 class="hidden">ESSN : '.$ESSN.'</h5>       
                  <h5>CLASS :'.$CLASSE.'</h5>
                  <h5 class="hidden">Folder Name : '.$FolderN.'</h5>
                  <h5 class="hidden">URL :<a href="'.$URL.'">About</a></h5>

                  
                  
   </div>
    </div>              
 ';
    

}


mysqli_close($conn) ;


}




?>






<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>journals-for-dz-phd</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/cover/">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">


    <!-- Bootstrap core CSS -->
<link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="cover.css" rel="stylesheet">
  </head>
  <body class="text-center">
 <form action="index.php" method="get">
  <div class="jumbotron">
  <main role="main" class="inner cover">
    <h1 class="cover-heading">journals for dz phd.</h1>
    <p class="lead">A site that allows you to search for scientific journals of both A and B in addition to the lists of opportunistic journals and editors (Predators)</p>
      <div class="input-group">
          
    <input type="search" class="form-control" name="search" id="search" placeholder="TITLE, PUBLISHER  ">
    <div class="input-group-append">    
    <button type="submit" class="btn btn-secondary" value="search"> <span class="glyphicon glyphicon-search"></span>Search</button>






    </div>
  </div>

   
  </main>
  </div>
  


      <H3>Search result  : <?php echo $count?> </H3>

      
        <?php print('<div>'.$output.'</div>') ; ?>




  
  <footer class="mastfoot mt-auto">
    <div class="inner">

    </div>
  </footer>
</div>

 






<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<script src="jquery-3.4.1.min.js"></script>
<script src="jq.js"></script>
</body>
</html>
