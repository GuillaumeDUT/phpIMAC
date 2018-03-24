<?php
require_once 'MyPDO.imac-movie.include.php'; //TO DO : à modifier

/**
 * Classe Movie
 */
class Movie {

  /***********************ATTRIBUTS***********************/

  // Identifiant
  private $id = null;
  // Titre
  private $title = null;
  // Date de sortie
  private $releaseDate = null;
  //Identifiant du pays
  private $idCountry = null;

  /*********************CONSTRUCTEURS*********************/

  // Constructeur non accessible
  function __construct() {}

  /**
	 * Usine pour fabriquer une instance de Movie à partir d'un id (via la bdd)
	 * @param int $id identifiant du film à créer (bdd)
	 * @return Movie instance correspondant à $id
	 * @throws Exception s'il n'existe pas cet $id dans a bdd
	 */
  public static function createFromId($id){
    // TO DO
    $stmt = MyPDO::getInstance()->prepare("SELECT * FROM movie WHERE id=?");
    $stmt->execute(Array($id));
    $stmt->setFetchMode(PDO::FETCH_CLASS, "Movie");
    if(($object = $stmt->fetch()) !== false){
      return $object;
    }else{
      throw new Exception('L\'id n\'est pas dans la base !');
    }
  }

  /********************GETTERS SIMPLES********************/

  /**
	 * Getter sur l'identifiant
	 * @return int $id
	 */
  public function getId() {
    // TO DO
    return $this->id;
  }

  /**
	 * Getter sur le titre
	 * @return string $title
	 */
  public function getTitle() {
    // TO DO
    return $this->title;
  }

  /**
	 * Getter sur la date de sortie
	 * @return string $releaseDate
	 */
  public function getReleaseDate() {
    // TO DO
    return $this->releaseDate;
  }

  /**
	 * Getter sur l'identifiant du pays
	 * @return string $idCountry
	 */
  public function getIdCountry() {
    // TO DO
    return $this->idCountry;
  }

  /*******************GETTERS COMPLEXES*******************/

  /**
	 * Récupère tous les enregistrements de la table Movie de la bdd
	 * Tri par ordre décroissant sur la date de sortie
	 * puis par ordre alphabétique sur le titre
	 * @return array<Movie> liste d'instances de Movie
	 */
  public static function getAll() {
    // TO DO
    $stmt = MyPDO::getInstance()->prepare("SELECT * FROM movie ORDER BY releaseDate,title ASC");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, "Movie");
    if(($object = $stmt->fetchAll()) !== false){
      return $object;
    }else{
      throw new GetAllException('Erreur lors de la récupération du cast');
    }
  }

  /**
	 * Récupère tous les films du réalisateur/de la réalisatrice
	 * Tri par ordre décroissant sur la date de sortie
	 * puis par ordre alphabétique sur le titre sur le titre
	 * @param int $idDirector identifiant du réalisateur/de la réalisatrice
	 * @return array<Movie> liste d'instances de Movie
	 */
  public static function getFromDirectorId($idDirector){
    //TO DO next : #04 Jointure Cast - Movie
    $stmt = MyPDO::getInstance()->prepare("SELECT * FROM movie,cast,director WHERE movie.id = director.idMovie AND director.idDirector = cast.id AND cast.id=?");
    $stmt->execute(Array($idDirector));
    if(($object = $stmt->fetchAll()) !== false){
      return $object;
    }else{
      throw new GetAllException('Erreur lors de la récupération du cast');
    }
  }

  /**
	 * Récupère tous les films de l'act.eur.rice avec son rôle pour chaque
	 * Tri par ordre décroissant sur la date de sortie
	 * puis dans l'ordre alphabétique sur le titre
	 * @param int $idActor identifiant l'act.eur.rice
	 * @return array<Movie> liste d'instances de Movie
	 */
  public static function getFromActorId($idActor){
    // TO DO next : #04 Jointure Cast - Movie
    $stmt = MyPDO::getInstance()->prepare("SELECT * FROM movie,cast,actor WHERE movie.id = actor.idMovie AND cast.id = actor.idActor AND idActor = ?");
    $stmt->execute(Array($idActor));
    if(($object = $stmt->fetchAll()) !== false){
      return $object;
    }else{
      throw new GetAllException('Erreur lors de la récupération du cast');
    }
  }

  /**
	 * Récupère les genres du film courant ($this)
	 * Tri par ordre alphabétique
	 * @return array<Genre> liste d'instances de Genre
	 */
  public function getGenres() {
    // TO DO next : #05 Classe Genre
    $stmt = MyPDO::getInstance()->prepare("SELECT name FROM genre,movie,moviegenre WHERE movie.id = moviegenre.idMovie AND genre.id = moviegenre.idGenre AND movie.id = ?");
    $stmt->execute(Array($this->getId()));
    if(($object = $stmt->fetchAll()) !== false){
      return $object;
    }else{
      throw new GetAllException('Erreur lors de la récupération du cast');
    }

  }

  public static function researchFromForm($movieTitle,$castName,$dateFrom,$dateTo,$genres){

    $request = "
    SELECT DISTINCT * FROM Movie,Genre,MovieGenre,Director,Cast
              WHERE movie.id = moviegenre.idMovie
              AND genre.id = moviegenre.idGenre
              AND movie.id = director.idMovie
              AND cast.id = director.idDirector
              ";
    
    if(!empty($movieTitle)){
      $request .= " AND ( movie.title LIKE '%".$movieTitle."%' ) "; 
    }

    if(!empty($castName)){
      $request .= "AND ( CONCAT(cast.firstname,cast.lastname) LIKE '%".$castName."%' ) ";
    }

    if(!empty($dateFrom) && !empty($dateTo)){
      $request .= " AND (YEAR(releaseDate) BETWEEN YEAR('".$dateFrom."') AND YEAR('".$dateTo."') )";
    }elseif( !empty($dateFrom) && empty($dateTo) ) {
      $request .= " AND (YEAR(releaseDate) BETWEEN YEAR('".$dateFrom."') AND 2020 )";
    }elseif( empty($dateFrom) && !empty($dateTo) ){ 
      $request .= " AND (YEAR(releaseDate) BETWEEN 1900 AND YEAR('".$dateTo."') )";
    }

    if(!empty($genres) ){
      $request .= " AND (";
      for($i=0;$i<sizeof($genres);$i++){
        if($i != sizeof($genres)-1){
          $request .= "genre.name = '".$genres[$i]."' OR ";
        }else{
          $request .= "genre.name = '".$genres[$i]."' ) ";
        }
      }
    }

    $request .= " GROUP BY movie.title";
    //echo $request."<br><br/>";
    $stmt = MyPDO::getInstance()->prepare($request);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, "Movie");
    if(($object = $stmt->fetchAll()) !== false){
      return $object;
    }else{
      throw new GetAllException('Erreur lors de la récupération du.es films');
    }
  }
}
