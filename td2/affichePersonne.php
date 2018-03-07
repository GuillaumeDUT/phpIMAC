<?php

  require_once 'Personne.class.php';
  if(isset($_GET)){
    if($_GET['Age']<0){
      echo "C'est pas bien de mentir sur son age, ban fdp";
      exit();
    }
    $personne = new Personne($_GET['Age'],$_GET['Nom'],$_GET['Prenom'],$_GET['Ville']);
    $personne->affiche();
  }
?>