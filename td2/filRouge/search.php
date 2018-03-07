<?php
header('Content-Type: text/html; charset=utf-8');
?>
<form method="GET" action="movie.php">
  <input type="text" placeholder="Titre" name="Titre">
  <select name="Genre">
    <option value="Drama">Drama</option>
    <option value="Science Fiction">Science Fiction</option>
    <option value="Action">Action</option>
    <option value="Adventure">Adventure</option>
    <option value="Animation">Animation</option>
    <option value="Thriller">Thriller</option>
    <option value="Horror">Horror</option>
    <option value="Western">Wester</option>
    <option value="Comedy">Comedy</option>
  </select>
  <input type="text" placeholder="Cast" name="Cast">
  <input type="number" placeholder="Date" name="Date" min="1980" max="2018">
  <input type="submit">
</form>