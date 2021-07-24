<?php
namespace App\Controllers;

use App\Core\Form;
use App\Models\PetsModel;
use App\Models\AnnoncesModel;

class AnnoncesController extends Controller
{
/**
     * Cette méthode affichera une page listant toutes les annonces de la base de données
     * @return void 
     */
    public function index()
    {
        // On instancie le modèle correspondant à la table 'annonces'
        // $annoncesModel = new AnnoncesModel;

        // On va chercher toutes les annonces actives
        // $annonces = $annoncesModel->findBy(['actif' => 1]);

        // On génère la vue
        $this->render('annonces/index');  //, compact('annonces')
    }

    // /**
    //  * Affiche 1 annonce
    //  * @param int $id Id de l'annonce 
    //  * @return void 
    //  */
    // public function lire(int $id)
    // {
    //     // On instancie le modèle
    //     $annoncesModel = new AnnoncesModel;

    //     // On va chercher 1 annonce
    //     $annonce = $annoncesModel->find($id);

    //     // On envoie à la vue
    //     $this->render('annonces/lire', compact('annonce'));
    // }

    /**
     * Ajouter une annonce
     * @return void 
     */
    public function ajouter()
    {
        // On vérifie si l'utilisateur est connecté
        if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
            // L'utilisateur est connecté
            // On vérifie si le formulaire est complet
            if((Form::validate($_POST, ['nom', 'espece', 'race', 'genre', 'age', 'ville', 'description'])) && isset($_FILES["profile_pic"]) && $_FILES["profile_pic"]["error"] === 0 ) {
                // On a reçu l'image
        // On procède aux vérifications
        // On vérifie toujours l'extension ET le type Mime
        $allowed = [
            "jpg" => "image/jpeg",
            "jpeg" => "image/jpeg",
            "png" => "image/png",
        ];
        $filename = $_FILES["profile_pic"]["name"];
        $filetype = $_FILES["profile_pic"]["type"];
        $filesize = $_FILES["profile_pic"]["size"];
         
        // pour récupèrer l'extension
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        // on vérifie l'absence de l'extension dans les clés de $allowed ou l'absence du type mime dans les valeurs
        if(!array_key_exists($extension, $allowed) || !in_array($filetype, $allowed)){
  
            // Ici soit l'extension soit le type est incorrect
            die("Erreur : format de fichier incorrect");
            
            $erreur8="<li> format de l'image incorrect </li>";
        }
            // Ici le type est correct
            // On limite à 1 Mo 
            if($filesize > 1024 * 1024){
                die("Fichier trop volumineux");
               
                $erreur8="<li> Image trop volumineuse </li>";
            }
  
            // On génère un nom unique
            $newname = md5(uniqid());
            $image = $newname.".".$extension;
            // On génère le chemin complet
            $newfilename = __DIR__ . "/../public/uploads/$image";
            
            // On déplace le fichier de tmp à uploads en le renommant
            if(!move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $newfilename)){
                die("L'upload a échoué");
                $erreur8="<li> L'upload a échoué </li>";
            }
  
            chmod($newfilename, 0644); // changement de mode

                // Le formulaire est complet
                // On se protège contre les failles XSS
                // strip_tags, htmlentities, htmlspecialchars
                $nom = strip_tags($_POST['nom']);
                $espece = strip_tags($_POST['espece']);
                $race = strip_tags($_POST['race']);
                $genre = strip_tags($_POST['genre']);
                $age = strip_tags($_POST['age']);
                $ville = strip_tags($_POST['ville']);
                $description = strip_tags($_POST['description']);

                // On instancie notre modèle
                $pet = new PetsModel;

                // On hydrate
                $pet->setnom($nom)
                    ->setEspece($espece)
                    ->setRace($race)
                    ->setGenre($genre)
                    ->setAge($age)
                    ->setVille($ville)
                    ->setDescription($description)
                    ->setImage($image)
                    ->setProprietaire_id($_SESSION['user']['id']);
                    // print_r($pet);

                // On enregistre
                $id_fiche = $pet->create();
                // print_r($fiche);


                // On instancie notre modèle
                $annonce = new AnnoncesModel;

                 // On hydrate

                 $annonce->setId_fiche($id_fiche)
                        ->setActif(0)
                        ->setIs_deleted(0);


                  // On enregistre

                $annonce->create();


                // var_dump($fiche);
                // print_r($fiche->id);
                //$id_fiche = $fiche-> lastInsertId() ;

                //$last_id = $conn->lastInsertId();

                // On redirige
                // $_SESSION['message'] = "Votre annonce a été enregistrée avec succès ";
                // header('Location: /testpara/public');
                // exit;
            }else{
                // Le formulaire est incomplet
                $_SESSION['erreur'] = !empty($_POST) ? "Le formulaire est incomplet" : '';
                $nom = isset($_POST['nom']) ? strip_tags($_POST['nom']) : '';
                $description = isset($_POST['description']) ? strip_tags($_POST['description']) : '';
            }


            // $form = new Form;

            // $form->debutForm()
            //     ->ajoutLabelFor('nom', 'nom de l\'annonce :')
            //     ->ajoutInput('text', 'nom', [
            //         'id' => 'nom',
            //         'class' => 'form-control',
            //         'value' => $nom
            //     ])
            //     ->ajoutLabelFor('description', 'Texte de l\'annonce')
            //     ->ajoutTextarea('description', $description, ['id' => 'description', 'class' => 'form-control'])
            //     ->ajoutBouton('Ajouter', ['class' => 'btn btn-primary'])
            //     ->finForm()
            // ;

            $this->render('annonces/ajouter'); //, ['form' => $form->create()]
        }else{
            // L'utilisateur n'est pas connecté
            $_SESSION['erreur'] = "Vous devez être connecté(e) pour accéder à cette page";
            header('Location: /users/login');
            exit;
        }
    }

    // /**
    //  * Modifier une annonce
    //  * @param int $id 
    //  * @return void 
    //  */
    // public function modifier(int $id){
    //     // On vérifie si l'utilisateur est connecté
    //     if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
    //         // On va vérifier si l'annonce existe dans la base
    //         // On instancie notre modèle
    //         $annoncesModel = new AnnoncesModel;

    //         // On cherche l'annonce avec l'id $id
    //         $annonce = $annoncesModel->find($id);

    //         // Si l'annonce n'existe pas, on retourne à la liste des annonces
    //         if(!$annonce){
    //             http_response_code(404);
    //             $_SESSION['erreur'] = "L'annonce recherchée n'existe pas";
    //             header('Location: /annonces');
    //             exit;
    //         }

    //         // On vérifie si l'utilisateur est propriétaire de l'annonce ou admin
    //         if($annonce->users_id !== $_SESSION['user']['id']){
    //             if(!in_array('ROLE_ADMIN', $_SESSION['user']['roles'])){
    //                 $_SESSION['erreur'] = "Vous n'avez pas accès à cette page";
    //                 header('Location: /annonces');
    //                 exit;
    //             }
    //         }

    //         // On traite le formulaire
    //         if(Form::validate($_POST, ['nom', 'description'])){
    //             // On se protège contre les failles XSS
    //             $nom = strip_tags($_POST['nom']);
    //             $description = strip_tags($_POST['description']);

    //             // On stocke l'annonce
    //             $annonceModif = new AnnoncesModel;

    //             // On hydrate
    //             $annonceModif->setId($annonce->id)
    //                 ->setnom($nom)
    //                 ->setDescription($description);

    //             // On met à jour l'annonce
    //             $annonceModif->update();

    //             // On redirige
    //             $_SESSION['message'] = "Votre annonce a été modifiée avec succès";
    //             header('Location: /');
    //             exit;
    //         }


    //         $form = new Form;

    //         $form->debutForm()
    //             ->ajoutLabelFor('nom', 'nom de l\'annonce :')
    //             ->ajoutInput('text', 'nom', [
    //                 'id' => 'nom',
    //                 'class' => 'form-control',
    //                 'value' => $annonce->nom
    //             ])
    //             ->ajoutLabelFor('description', 'Texte de l\'annonce')
    //             ->ajoutTextarea('description', $annonce->description, [
    //                 'id' => 'description',
    //                 'class' => 'form-control'
    //             ])
    //             ->ajoutBouton('Modifier', ['class' => 'btn btn-primary'])
    //             ->finForm()
    //         ;

    //         // On envoie à la vue
    //         $this->render('annonces/modifier', ['form' => $form->create()]);

    //     }else{
    //         // L'utilisateur n'est pas connecté
    //         $_SESSION['erreur'] = "Vous devez être connecté(e) pour accéder à cette page";
    //         header('Location: /users/login');
    //         exit;
    //     }
    // }
}