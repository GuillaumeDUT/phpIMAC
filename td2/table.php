<head>
  <meta charset="utf-8"/>
</head>
 <form action="table.php" method="POST">
  <input type="number" required="required" placeholder="Entrez un chiffre" name="number">
  <input type="submit" value="Afficher la table">
</form>
<style>
  table {
    border:1px solid black; 
    text-align: center;
    width:200px;
  }
  tr{border:1px  solid black;}
  td{text-align: center;width:50%;}
</style>
<?php

if($_POST){
  echo "<table><tbody><th>Table de ".$_POST['number']."</th>";
  for($i=0;$i<10;$i++){
    echo "<tr><td>".($i+1)."</td><td>".($i+1)*$_POST['number']."</td></tr>";
  }
  echo "</tbody></table>";
}

?>