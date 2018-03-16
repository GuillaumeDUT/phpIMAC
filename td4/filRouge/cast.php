<?php
require_once('MyPDO.imac-movie.include.php');
require_once('Cast.class.php');

if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id']>0){
  if($request = Cast::createFromId($_GET['id']) ){
    echo $request->getId()."<br/>";
    echo $request->getFirstname()."<br/>";
    echo $request->getLastname()."<br/>";
    echo $request->getBirthyear()."<br/>";
    echo $request->isAlive()."<br/>";
  }else{
    echo "L'ID n'est pas dans la BDD";
  }
} 



/*
echo($request->getId());
echo($request->getFirstname());
*/

?>