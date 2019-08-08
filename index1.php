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
if (isset($_GET['search'])) {
  $searchq=$_GET['search'] ;
  
  //$page =1;
  $count_per_page = 20;
  $items_per_page=20;
  $offset = ($page - 1) * $items_per_page;
  $query_phrase1 =  "SELECT* FROM table1 WHERE titre LIKE '%$searchq%' OR publisher LIKE '%$searchq%'  " ;
$query_phrase =  "SELECT* FROM table1 WHERE titre LIKE '%$searchq%' OR publisher LIKE '%$searchq%' LIMIT " .$offset. " ," .$items_per_page;

$query1=mysqli_query( $conn,$query_phrase1) or die("Can't execute Query") ;
$query =mysqli_query( $conn,$query_phrase) or die("Can't execute Query") ;
  //~ $query_phrase  ="SELECT * FROM table1  WHERE MATCH (titre, publisher) AGAINST ('.$searchq.' IN NATURAL LANGUAGE MODE) LIMIT 0 , 50 ;";
  //~ $query =mysqli_query( $conn, $query_phrase) or die("Can't execute Query") ;
  $count2=mysqli_num_rows($query1);
   $count=mysqli_num_rows($query);
   $total_page = intval($count2/$items_per_page) +2;
  // echo $total_page;
  // echo $page;
  

if ($count==0) {
  $output="there is no search result
  <h2>Suggestions</h2>

<h6> Check your spelling </h6>
<h6>Try more general search query </h6>
<h6>Try different keywords </h6>
<h6>Browse Journal Rankings </h6>" ;
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

    <div  class="card bg-light mb-3">
<div class="card-body">
            <h5  class="titre" style="float:left;margin-right:100px" ><a href="'.$URL.'">' .$title. ' </a>    </h5> 
           
            <h5 class="class" style="float:left;margin-right:160px""  >CLASS :('.$CLASSE.') </h5>
    
            <h5 class="pub" style="float:left;margin-right:60px">Publisher:'.$publisher.', ISSN : '.$ISSN.', ESSN : '.$ESSN.'</h5>  
            <h5 class="foldername"style="float:left"> Folder Name : '.$FolderN.'</h5>

            
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
    

  
  
  mysqli_close($conn) ;
  
  
  
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

  <div class="cover-container1 d-flex h-100 p-3 mx-auto flex-column">
    <header style=""  class="masthead mb-auto">
      <div class="inner">
        <h3 class="masthead-brand">journals4dzphd</h3>
        <nav class="nav nav-masthead justify-content-center">
          <a class="nav-link " href="home.php">Home</a>
          <a class="nav-link active" href="index.php">Search</a>
        </nav>
      </div>
      <div class="forme">
      <form action="index1.php" method="get">
        <div class="input-group">

          <input type="search" class="form-control" name="search" id="search" placeholder="TITLE, PUBLISHER  ">
          <div class="input-group-append">
            <button type="submit" class="btn btn-secondary" value="search"> <span
                class="glyphicon glyphicon-search"></span>Search</button>



          </div>
</form>
</div>
    </header>


          <p class="lead"> </p>
        <?php  echo $output;?>



 
  

<footer class="mastfoot mt-auto">
    <?php 
    
    for ($i=1; $i < $total_page ; $i++) { 
     $pageurl ="http://127.0.0.1/dashboard/journals-for-dz-phd.-master%20(1)%20-%20Copie/journals-for-dz-phd.-master/index1.php?search=$searchq&page=$i";
    if ($page == $i) {
      echo ' <a style="color: rgb(255, 255, 255);"href="'.$pageurl.'">'.$i.'</a>' ;
    }else {
      echo ' <a style="color: rgba(255, 255, 255, 0.418);" href="'.$pageurl.'">'.$i.'</a>' ;
    }

    }
    

    
    ?>
 
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