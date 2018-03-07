 <?php
  header('Content-Type: text/html; charset=utf-8');
  if($_POST){
    //var_dump($_POST);
    echo "J'aime ça comme fruit :";
    foreach($_POST as $fruit){
      echo " les $fruit"."s";
      echo ",";
    }
    echo " et plein d'autre trucs !";
  }else{
    echo "Oups wrong conv mdr";
  }
?>