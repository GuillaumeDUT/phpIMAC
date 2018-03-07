<?php
class Personne {
  private $prenom;
  private $nom;
  private $age;
  private $ville;

  public function __construct($age,$nom,$prenom,$ville){
    $this->age = $age;
    $this->prenom = ucfirst(strtolower($prenom));
    $this->nom = ucfirst(strtolower($nom));
    $this->ville = ucfirst(strtolower($ville));
  }
  //Function set et get générales
  public function get($nomAttribut){
    return $this->$nomAttribut;
  }
  public function set($nomAttribut,$valeur){
    $this->$nomAttribut = $valeur;
  }
  
  //setter et getter spécifiques 
  public function getAge(){
    return $this->age;
  }
  public function getNom(){
    return $this->nom;
  }
  public function getPrenom(){
    return $this->prenom;
  }
  public function getVille(){
    return $this->ville;
  }
  
  public function setAge(){
    $this->age = $age;
  }
  public function setNom(){
    $this->nom = $nom;
  }
  public function setPrenom(){
    $this->prenom = $prenom;
  }
  public function setVille(){
    $this->ville = $ville;
  }
  
  
  public function affiche(){
    $time = date("H");
    if($time<18 && $time>4){
      echo "BONJOUREEENNNN";
    }else{
      echo "BONSOIIIREEENNNN";
    }
    echo ", je m'appelle ".$this->getPrenom()." ".$this->getNom().", j'ai ".$this->getAge()." ans et je viens de ".$this->getVille().".";
  }
}

?>