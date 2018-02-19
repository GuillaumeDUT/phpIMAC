<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title> Hello World en PHP </title>
  </head>
  <body>
    <?php
    $prenom="Pascale";
    $nom="Ho";
    $age=25;
    $ville="Champs sur Souague";


    echo "############## EXO  1 ##################<br/>";
    echo "Bonjour je m'appelle ".$prenom." ".$nom.", je viens de ".$ville." et j'ai ".$age." an";
    
    if($age >1){
      echo "s";
    }
    echo ". <br/>";
    echo "######################### FIN EXO 1 #######################<br/>";

    echo "############## EXO  2 ##################<br/>";
    $personne=Array(
      "nom"=> "Ho",
      "prenom" => "Pascale",
      "age"=>25,
      "ville"=>"Champs sur souague"
    );
    //var_dump($personne);
    echo "Bonjour je m'appelle ".$personne["prenom"]." ".$personne["nom"].", je viens de ".$personne["ville"]." et j'ai ".$personne["age"]." an";
    if($personne["age"] >1){
      echo "s";
    }
    echo ". <br/>";

    echo "######################### FIN EXO 2 #######################<br/>";
    echo "############## EXO  3 ##################<br/>";

    $week = ["Lundi", "Mardi", "Mercredi", "Jeudimac", "Vendredi", "Samedi","Dimanche"];

    for($i=0;$i<sizeof($week);$i++){
      echo "Jour de la semaine ".($i+1)." : ".$week[$i]." <br/>";
    }
    
    echo "######################### FIN EXO 3 #######################<br/>";
    
    echo "############## EXO  4 ##################<br/>";
    
    $personnes=Array($personne,$personne,$personne);
    
    echo "<ul>";
    //bonus exo 4
    if(empty($personnes)){
      echo "L'array est vide";
    }
    foreach($personnes as $element){
      echo "<li>"."je m'appelle : ".$element["prenom"]." ".$element["nom"]."</li>";
      //var_dump($element);
    }
    echo"</ul>";
    
    echo "######################### FIN EXO 4 #######################<br/>";
    ?>
  </body>
</html>