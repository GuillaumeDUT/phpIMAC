<?php
require_once './Personne.class.php';
?>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>OUPS</title>
  </head>
  <body>
    <?php

    $personne1 = new Personne(25,"Ho","Pascaaaaaale1","Soupe sur loing");
    $personne2 = new Personne(24545,"Ho","Pascaaaeazzaazeaaale2","Soupe sur loing");
    $personne3 = new Personne(25555,"Ho","Pascaaaaaale3","Soupe sur aezeaeazzeazealoing");
    //$personne1->affiche();
    $tab = Array($personne1,$personne2,$personne3);
    
    foreach($tab as $elt){
      $elt->affiche();
      echo "<br>";
    }
    ?>
  </body>
</html>