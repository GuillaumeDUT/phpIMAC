<?php
require_once 'MyPDO.imac-movie.include.php'; //TO DO : à modifier

/**
 * Classe Genre
 */
class Genre {

  /***********************ATTRIBUTS***********************/

  // Identifiant
  private $id = null;
  // Nom
  private $name = null;


  /*********************CONSTRUCTEURS*********************/

  // Constructeur non accessible
  function __construct() {}

  /**
	 * Usine pour fabriquer une instance de Genre à partir d'un id (via la bdd)
	 * @param int $id identifiant du genre à créer (bdd)
	 * @return Genre instance correspondant à $id
	 * @throws Exception s'il n'existe pas cet $id dans a bdd
	 */
  public static function createFromId($id){
    // TO DO
    $stmt = MyPDO::getInstance()->prepare("SELECT * FROM Genre WHERE id=?");
    $stmt->execute(Array($id));
    $stmt->setFetchMode(PDO::FETCH_CLASS, "Genre");
    if(($object = $stmt->fetch()) !== false){
      return $object;
    }else{
      throw new Exception('L\'id n\'est pas dans la base');
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
	 * Getter sur le nom
	 * @return string $name
	 */
  public function getName() {
    // TO DO
    return $this->name;
  }

  /*******************GETTERS COMPLEXES*******************/

  /**
	 * Récupère tous les enregistrements de la table Genre de la bdd
	 * qui ont au moins un film associé au genre
	 * Tri par ordre alphabétique
	 * @return array<Genre> liste d'instances de Genre
	 */
  public static function getAll() {
    // TO DO
    $stmt = MyPDO::getInstance()->prepare("SELECT * FROM genre,moviegenre,movie WHERE genre.id = moviegenre.idGenre AND moviegenre.idMovie = movie.id GROUP BY genre.name ");
    $stmt->execute();
    //$stmt->setFetchMode(PDO::FETCH_CLASS, "Genre");
    if(($object = $stmt->fetchAll()) !== false){
      return $object;
    }else{
      throw new Exception('L\'id n\'est pas dans la base');
    }
  }
}
