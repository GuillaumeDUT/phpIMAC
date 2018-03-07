<style>
  .film{
    border: 1px solid #eee;
    height:100px;
    width:200px;
    margin:10px;
    display:inline-block;
    background:#dbdbdb;
    padding:10px;
  }
  .container{
    display:block;
  }
</style>
<?php
header('Content-Type: text/html; charset=utf-8');
require_once 'data.movies.php';

if(isset($_GET)){
  //var_dump($_GET);
  if(isset($_GET['Titre']) && isset($_GET['Genre']) && isset($_GET['Cast']) && isset($_GET['Date']) ){
    echo "<div class='container'>";
    foreach($movies as $movie){
      if($_GET['Date'] == date('Y',strtotime($movie['releaseDate'])) || $_GET['Titre'] == $movie['title'] || $_GET['Cast'] == $movie['director'] || 
      $_GET['Genre'] == $movie['genre']){
        echo "<div class='film'>
                Titre : ".$movie['title']."<br/>
                Réalisateur: ".$movie['director']."<br/>
                Genre : ".$movie['genre']."<br/>
                Année de sortie : ".date('Y',strtotime($movie['releaseDate']))."<br/>
        
              </div>  ";
      }
    }
    echo "</div>";
  }
}else{
  echo "Sorry bb, la recherche n'a aucun paramètres.";
}

?>