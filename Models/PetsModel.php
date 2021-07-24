<?php
namespace App\Models;

class PetsModel extends Model
{
    protected $id;
    protected $nom;
    protected $espece;
    protected $race;
    protected $genre;
    protected $age;
    protected $ville;
    protected $description;
    protected $image;
    protected $proprietaire_id;

    public function __construct()
    {
        $class = str_replace(__NAMESPACE__.'\\', '', __CLASS__);
        $this->table = strtolower(str_replace('Model', '', $class));
    }

    
   

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of espece
     */ 
    public function getEspece()
    {
        return $this->espece;
    }

    /**
     * Set the value of espece
     *
     * @return  self
     */ 
    public function setEspece($espece)
    {
        $this->espece = $espece;

        return $this;
    }

    /**
     * Get the value of race
     */ 
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set the value of race
     *
     * @return  self
     */ 
    public function setRace($race)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get the value of genre
     */ 
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set the value of genre
     *
     * @return  self
     */ 
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get the value of age
     */ 
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set the value of age
     *
     * @return  self
     */ 
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get the value of ville
     */ 
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set the value of ville
     *
     * @return  self
     */ 
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of proprietaire_id
     */ 
    public function getProprietaire_id()
    {
        return $this->proprietaire_id;
    }

    /**
     * Set the value of proprietaire_id
     *
     * @return  self
     */ 
    public function setProprietaire_id($proprietaire_id)
    {
        $this->proprietaire_id = $proprietaire_id;

        return $this;
    }

//     public function create()
//     {
//      $champs = [];
//      $inter = [];
//      $valeurs = [];
 
//      //on boucle pour éclater le tableau
//      foreach($this as $champ => $valeur){
//          // INSERT INTO table WHERE (champX, champY, champZ) VALUES (?, ?, ?) 
//          if($champ != null && $champ != 'db' && $champ != 'table'){
//          $champs[] =  $champ ;
//          $inter[] = "?";
//          $valeurs[] = $valeur;
//          }
//      }
 
 
//    // on transforme le tableau "champs" en une chaine de caracères
//      $liste_champs = implode(', ', $champs);
//      $liste_inter = implode(',', $inter);
//       //  var_dump($liste_champs);
//      //    on exécute la requete
 
//      return $this->chercher('INSERT INTO '.$this->table.'( '. $liste_champs.') VALUES('.$liste_inter.')', $valeurs); 
//     }
}