<head>
  <link rel="stylesheet"  href="stylemoche.css" type="text/css">
</head>

<body>

  <h1>MOVIES</h1>
  <?php
  require_once('MyPDO.imac-movie.include.php');
  require_once('Movie.class.php');
  require_once('Cast.class.php');
  require_once('Genre.class.php');

  header('Content-Type: text/html; charset=utf-8');


  if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id']>0){
    try{
      if($request = Movie::createFromId($_GET['id']) ){
        //var_dump($request);
        echo "<div class='castWrapper'>";
        echo "<h2>".$request->getTitle()." (".$request->getReleasedate().")</h2><br/> ";
        echo "Country : ".$request->getIdCountry()."<br/>";
        echo "Genre : ";
        $genres = $request->getGenres();
        for($i=0;$i<sizeof($genres);$i++){
          echo $genres[$i]['name'];
          if($i != sizeof($genres)-1)
            echo " / ";
        }
        echo "<br/><br/>";
      }
    }
    catch (Exception $e) {
      echo "<div class='error-message'>Erreur:".$e->getMessage()."</div>";
      die();
    }
    try{
      if($request = Cast::getDirectorsFromMovieId($_GET['id']) ){
        echo "<div class='castWrapper'>
              <h3>Director(s) :</h3><br/> ";

        foreach( $request as $director){
          //var_dump($director);
          echo "<a href=cast.php?id=".$director['idDirector']."><h3>".$director['firstname']." ".$director['lastname']."</a><br/><br/>";
        }
        echo "</div>";
        /* echo $request->getTitle()."<br/>";
        echo $request->getReleasedate()."<br/>";
        echo $request->getIdCountry()."<br/>";*/
      }
    }
    catch (Exception $e) {
      echo "<div class='error-message'>Erreur:".$e->getMessage()."</div>";
      die();
    }
    try{
      if($request = Cast::getActorsFromMovieId($_GET['id']) ){
        echo "<div class='castWrapper'>
              <h3>Actor(s) :</h3><br/> ";

        foreach( $request as $actor){
          //var_dump($actor);
          echo "<a href=cast.php?id=".$actor['idActor']."><h4>".$actor['firstname']." ".$actor['lastname']." : ".$actor['name']."</h4></a>";
        }
        echo "</div>";
        /* echo $request->getTitle()."<br/>";
        echo $request->getReleasedate()."<br/>";
        echo $request->getIdCountry()."<br/>";*/
      }
    }
    catch (Exception $e) {
      echo "<div class='error-message'>Erreur:".$e->getMessage()."</div>";
      die();
    }

  } 

  if(!isset($_GET['id']) ){
    $today = date('Y-m-d');
    echo "
      <form id='formPost'method='POST' action='movies.php'>
        <input type='text' name='movieTitleRequest' placeholder='Sylvie and the key of 1B0016'>
        <input type='text' name='castNameRequest' placeholder='PH hisu' >
        <input type='date' name='dateFromRequest' placeholder='1900-01-01' >
        <input type='date' name='dateToRequest' placeholder='".$today."'>";

    try{
      if($request = Genre::getAll()){
        /*var_dump($request);*/
        foreach( $request as $genre){
          echo "<input type='checkbox' name='genre[]' value='".$genre['name']."'> <label for='".$genre['name']."' >".$genre['name']."</label> ";
        }
      }
    }catch (Exception $e) {
      echo "<div class='error-message'>Erreur:".$e->getMessage()."</div>";
      die();
    }


    echo " <input type='submit' value='Lancer la recherche !'>

      </form>
    ";
    /*
    try{
      $request = Movie::getAll();
      echo "<div class='castWrapper'>";
      foreach( $request as $movie){
        //var_dump($movie);
        //echo $movie->getId();
        echo "<div class='castMember'><a href=movies.php?id=".$movie->getId().">".$movie->getTitle()." (".$movie->getReleasedate().")</a></div>";
      }
      echo "</div>";
    }catch(GETALLException $e){
      echo "<div class='error-message'>Erreur:".$e->getMessage()."</div>";
      die();
    }*/

  }
  if(isset($_POST) && $_POST != [] ){
    //var_dump($_POST);
    try{
      if(!isset($_POST['genre'])){
        $_POST['genre'] = [];
        /*$temp = Genre::getAll();
        //var_dump( $temp);
        //var_dump( $_POST['genre']);

        for($i=0;$i<sizeof($temp);$i++){
          array_push($_POST['genre'],$temp[$i]['name']) ;
        }*/
        //var_dump($_POST['genre']);
      } 
      if($request = Movie::researchFromForm($_POST['movieTitleRequest'],$_POST['castNameRequest'],$_POST['dateFromRequest'],$_POST['dateToRequest'],$_POST['genre'])){
        //var_dump($request);

        foreach($request as $movie){
          $genres = $movie->getGenres();
          //var_dump($genres);
          echo $movie->getTitle()." ( ".$movie->getReleaseDate()." ) Genre : ";
          for($i=0;$i<sizeof($genres);$i++){
            echo $genres[$i]['name'];
            if($i != sizeof($genres)-1)
              echo " / ";
          }
          echo "<br/>";
        }
      }
    }catch (Exception $e) {
      echo "<div class='error-message'>Erreur:".$e->getMessage()."</div>";
      die();
    }
  }

  ?>

</body>