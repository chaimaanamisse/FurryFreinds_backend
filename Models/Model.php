<?php
namespace App\Models;

use App\Core\Db; //use s'ajoute automatiquement

class Model extends Db
{
    //Table de la base de données
    protected $table;

    //Instance de Db
    private $db;

   // méthode pour aller chercher tout les enregistrements d'une table

   public function findAll()
   {
       $query = $this->chercher('SELECT * FROM '. $this->table);
       return $query->fetchAll();

   }

   public function findBy(array $criteres)
   {
       $champs = [];
       $valeurs = [];

       //on boucle pour éclater le tableau
       foreach($criteres as $champ => $valeur){
           // SELECT * FROM table WHERE champ = ?
           $champs[] = " $champ = ? ";
           $valeurs[] = $valeur;
       }
   

     // on transforme le tableau "champs" en une chaine de caracères
       $liste_champs = implode(' AND ', $champs);
        //  var_dump($liste_champs);
       //    on exécute la requete

       return $this->chercher('SELECT * FROM '.$this->table.' WHERE '. $liste_champs, $valeurs)->fetchAll();
   }


   public function find(int $id)
   {
       return $this->chercher("SELECT * from ". $this->table . " WHERE `id ` = " .  $id )->fetch();
   }


   public function create()
   {
    $champs = [];
    $inter = [];
    $valeurs = [];

    //on boucle pour éclater le tableau
    foreach($this as $champ => $valeur){
        // INSERT INTO table WHERE (champX, champY, champZ) VALUES (?, ?, ?) 
        if($champ != null && $champ != 'db' && $champ != 'table'){
        $champs[] =  $champ ;
        $inter[] = "?";
        $valeurs[] = $valeur;
        }
    }


  // on transforme le tableau "champs" en une chaine de caracères
    $liste_champs = implode(', ', $champs);
    $liste_inter = implode(',', $inter);
     //  var_dump($liste_champs);
    //    on exécute la requete

    return $this->chercher('INSERT INTO '.$this->table.'( '. $liste_champs.') VALUES('.$liste_inter.')', $valeurs); 
   }


   public function update()
   {
    $champs = [];
    $valeurs = [];

    //on boucle pour éclater le tableau
    foreach($this as $champ => $valeur){
        // UPDATE table SET (champX = ?, champY = ?, champZ  = ?) WHERE id = ?
        if($champ != 'db' && $champ != 'table'){
        $champs[] =  "$champ = ?" ;
        $valeurs[] = $valeur;
        }
    }
    $valeurs[] = $this->id;


  // on transforme le tableau "champs" en une chaine de caracères
    $liste_champs = implode(', ', $champs);
   
     //  var_dump($liste_champs);
    //    on exécute la requete

    return $this->chercher('UPDATE'.$this->table.' SET '. $liste_champs.' WHERE id = ?', $valeurs); 
   }

   public function delete(int $id)
   {
       return $this->chercher("DELETE FROM {$this->table} WHERE id = ?", [$id]);
   }


    
    // méthode pour voir si il va préparer ou pas la requete
    public function chercher(string $sql, array $attributs = null)
    {
       // on récupère l'instance de Db 
       $this->db = Db::getInstance();

       // On vérifie si on a des attributs
       if($attributs !== null){
           // Requete Préparée
           $query = $this->db->prepare($sql);
           $query->execute($attributs);
           return $query;

       }else{
           // Requete simple
           return $this->db->query($sql);
       }
    }
    public function hydrate( $donnees)
    {
        foreach($donnees as $key => $value){
            // on recupere le nom du setter correspondant à la clè (key)
           $setter = 'set'.ucfirst($key);

           // on verifie si le setter existe
           if(method_exists($this, $setter)){
               // on appelle le setter
               $this->$setter($value);
           }

        }
        return $this;
    }
}