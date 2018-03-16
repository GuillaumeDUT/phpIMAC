<?php 
    header('Content-Type: text/html; charset=utf-8');
   

    $pdo = new PDO('mysql:host=localhost;dbname=imac-movies;charset=utf8', 'root', '');

    //Q1
    $sql = "SELECT * FROM cast ";
    $query = $pdo->prepare($sql);
    $query -> execute();

    while($line = $query->fetch()){
      echo $line['firstname']." ".$line['lastname']." né.e en ".$line['birthYear'];
      if($line['deathYear'] != NULL){
        echo " mort.e en ".$line['deathYear']." <br>";
      }else{
        echo "</br>";
      }
    }

    $sql = "SELECT * FROM cast WHERE deathYear = 'NULL' ";
    $query = $pdo->prepare($sql);
    $query -> execute(array(NULL));

    while($line = $query->fetch()){
      echo $line['firstname']." ".$line['lastname']." né.e en ".$line['birthYear'];
    }

?>