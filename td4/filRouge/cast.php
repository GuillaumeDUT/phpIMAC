<head>
  <link rel="stylesheet"  href="stylemoche.css" type="text/css">
</head>
<body>

  <h1>CAST LIST</h1>

  <?php
  require_once('MyPDO.imac-movie.include.php');
  require_once('Cast.class.php');
  require_once('Movie.class.php');
  header('Content-Type: text/html; charset=utf-8');

  if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id']>0){
    try{
      if($request = Cast::createFromId($_GET['id']) ){
          
        
        echo "<div class='castWrapper'><h2>".$request->getFirstname()." ".$request->getLastname()." </h2>";
        echo "Born in ".$request->getBirthyear()."<br/>";
        if(!$request->isAlive())
          echo "Died on ".$request->getDeathyear()." <br/>";
        echo "</div><br/>";
      }
    }
    catch (Exception $e) {
      echo "<div class='error-message'>Erreur:".$e->getMessage()."</div>";
      die();
    }
    try{
      $request = Movie::getFromDirectorId($_GET['id']);
      //var_dump($request);
      echo "<div class='castWrapper'>
              <h3>Movie as Director :</h3><br/> ";
      foreach( $request as $cast){
        //var_dump($cast);
        //echo $cast['title'];
        echo "<a href=movies.php?id=".$cast['idMovie'].">".$cast['title']."  (".$cast['releaseDate'].") </a><br/";

      }
      echo "</div><br/>";
    }catch(GETALLException $e){
      echo "<div class='error-message'>Erreur:".$e->getMessage()."</div>";
      die();
    }
    
    try{
      $request = Movie::getFromActorId($_GET['id']);
      echo "<div class='castWrapper'>
        <h3>Movie as Actor  :</h3> <br/> ";
      foreach( $request as $cast){
        //var_dump($cast);
        //echo $cast['title'];
        echo "<a href=movies.php?id=".$cast['idMovie'].">".$cast['title']."  (".$cast['releaseDate'].") </a><br/>";

      }
      echo "</div>";
    }catch(GETALLException $e){
      echo "<div class='error-message'>Erreur:".$e->getMessage()."</div>";
      die();
    }

  } 

  if(!isset($_GET['id'])){
    try{
      $request = Cast::getAll();
      echo "<div class='castWrapper'>";
      foreach( $request as $cast){
        //var_dump($cast);
        //echo $cast->getId();
        echo "<div class='castMember'><a href=cast.php?id=".$cast->getId().">".$cast->getFirstname()." ".$cast->getLastname()."</a></div>";
      }
      echo "</div>";
    }catch(GETALLException $e){
      echo "<div class='error-message'>Erreur:".$e->getMessage()."</div>";
      die();
    }
  }




  ?>
</body>