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

//------------------------------


$page = 1;
if(!empty($_GET['page'])) {
    $page = $_GET['page'];
    if(false === $page) {
       // $page = 1;
    }
}








// echo "Connected successfully";

if (isset($_GET['search'])) {
  $searchq=$_GET['search'] ;
  
  //$page =1;
  $count_per_page = 20;
  $items_per_page=20;
  $offset = ($page - 1) * $items_per_page;
  
$query_phrase =  "SELECT* FROM table1 WHERE titre LIKE '%$searchq%' OR publisher LIKE '%$searchq%' LIMIT " .$offset. " ," .$items_per_page;
$query_phrase1 =  "SELECT* FROM table1 WHERE titre LIKE '%$searchq%' OR publisher LIKE '%$searchq%'  " ;
$query1=mysqli_query( $conn,$query_phrase1) or die("Can't execute Query") ;
$query =mysqli_query( $conn,$query_phrase) or die("Can't execute Query") ;
  //~ $query_phrase  ="SELECT * FROM table1  WHERE MATCH (titre, publisher) AGAINST ('.$searchq.' IN NATURAL LANGUAGE MODE) LIMIT 0 , 50 ;";
  //~ $query =mysqli_query( $conn, $query_phrase) or die("Can't execute Query") ;
  $count2=mysqli_num_rows($query1);
   $count=mysqli_num_rows($query);
   $total_page = intval($count2/$items_per_page) ;
  // echo $total_page;
  // echo $page;
  

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
                  <h5 id="card" class="hidden">ISSN : '.$ISSN.'</h5>
                  <h5 id="card" class="hidden">ESSN : '.$ESSN.'</h5>       
                  <h5>CLASS :'.$CLASSE.'</h5>
                  <h5 id="card" class="hidden">Folder Name : '.$FolderN.'</h5>
                  <h5 id="card" class="hidden">URL :<a href="'.$URL.'">About</a></h5>

                  
                  
   </div>
    </div>              
 ';
    

}




$var = "SELECT titre FROM table2 WHERE titre = '$searchq'" ;
$query2 =mysqli_query($conn,$var);
$resul = mysqli_num_rows($query2);
if (!$query2) {
  printf("Error: %s\n", mysqli_error($conn));
  exit();
}
 

if (mysqli_num_rows($query2)>0) {
  $in = "SELECT `searchnum` FROM `table2` WHERE titre= '$searchq'";
  $query3=mysqli_query($conn,$in);
  $resul = mysqli_num_rows($query3);
  while ($row=mysqli_fetch_array($query3)){
      $inc = $row['searchnum']+1 ;}

$updat= " UPDATE table2 SET searchnum = '$inc' WHERE titre = '$searchq' " ;
 $query4 =mysqli_query($conn,$updat);
}else {
  $insert ="INSERT INTO table2(`titre`, `searchnum`) VALUES('$searchq',1 ) ";
  $query3 =mysqli_query($conn,$insert);
 

}
  






















//mysqli_close($conn) ;



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
    <title>journals for dz phd</title>

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
      <h3>total search : <?php echo $count2?>  </h3>
      
        <?php print('<div>'.$output.'</div>') ; ?>
      



  
 

      <?php 
      
        $query5= "SELECT titre FROM table2 GROUP BY searchnum ORDER BY searchnum DESC LIMIT 0, 3 ";
        $r=mysqli_query($conn,$query5);
        
        if (!$query5) {
          printf("Error: %s\n", mysqli_error($conn));
          exit();
        }
       
                echo '   <footer id="sticky-footer" class="py-4 bg-dark text-white-50">
                         <div class="container text-center">
                       
                        <h3> most searched words </h3>' ;

        while ($row = mysqli_fetch_array($r)) {
        $titreA= $row['titre'];
          if (true) {
            $p   = str_replace(" ","+",$titreA);
            $purl = "http://127.0.0.1/dashboard/journals-for-dz-phd.-master%20(1)/journals-for-dz-phd.-master/index.php?search=".$p;
          }

   
                   echo   '  <h5 class=""><a href="'.$purl.'">'.$titreA.'</a></h5>
                             <br>' ;



        } // while 
                 
      
      
mysqli_close($conn);
      
      
      ?>
    
    </div>
  </footer>

      <?php 
      
      for ($i=1; $i < $total_page ; $i++) { 
       $pageurl ="http://127.0.0.1/dashboard/journals-for-dz-phd.-master%20(1)/journals-for-dz-phd.-master/index.php?search=$searchq&page=$i";
       echo ' <a href="'.$pageurl.'">'.$i.'</a>' ;

      }
     


      
      
      ?>



 


<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript" src="jquery-3.4.1.min.js"></script>
<script language="JavaScript" type="text/javascript" src="m.js"></script>

 <script src="jquery-3.4.1.min.js"></script>



</body>
</html>
