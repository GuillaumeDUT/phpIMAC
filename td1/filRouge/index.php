<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>FIL ROUGE</title>
  </head>
  <body>
    <?php
    include_once("./data.movie.php");
    
    echo "<br/>";
    $time = date("Y",time());
    
    function renderMovieList($array,$annee,$genre){
      if(empty($array)){
        echo "Le tableau est vide";
        return 0;
      }else{
        foreach($array as $elt){
          if($elt['genre'] == $genre && $elt['year']>$annee){
            echo "<ul>
                    <li>".$elt['title']." (".$elt['year'].") 
                        <ul>
                          <li>Genre : ".$elt['genre']."</li>
                          <li>Réalisateur : ".$elt['director']."</li>
                        </ul>
                    </li>
                  </ul>
                    ";
          }
        }
      }
      

    }
    $array = Array();
    echo "Render Movie List avec pour paramètre 1980 et Science Fiction<br/";
    renderMovieList($movies,1980,"Science Fiction");
    
    
    echo "<br/> Première aprtie de l'exo";
    
    foreach($movies as $elt){
      //var_dumpt($elt);
      echo "<ul>
        <li>".$elt['title']." (";
      if($time-$elt['year'] <10){
        echo "<b>".$elt['year']."</b>";
      }else{
        echo $elt['year'];
        
      }
      
      echo ") </li>
        <ul><li> Genre : ";
      if($elt['genre'] == "Science Fiction"){
        
          echo "<span style='color:red;text-transform:uppercase'>".$elt['genre']."</span>";
        }else{
          echo $elt['genre'];
        }
      echo "</li>
        <li> Réalisateur : ".$elt['director']."</ul>
        </ul>";
    }

    
    ?>
  </body>
</html>