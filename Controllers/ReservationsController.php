<?php
namespace App\Controllers;

use App\Core\Form;
use App\Models\ReservationsModel;
// use App\Models\RoomsModel;

class ReservationsController extends Controller
{

    // cette méthode affichra les réservation de la base de données
    public function index()
    {   // on instancie le modèle correspondant à la table reservation
        // include_once ROOT.'/Views/reservations/index.php';

        // $reservationsModel = new ReservationsModel;
        // // $roomsModel = new RoomsModel;

        // // On va chercher les reservations
        // $reservations = $reservationsModel->find(3);
        // $rooms = $roomsModel->findBy(['id' => 3]);


        // var_dump($reservations);
        // var_dump($rooms);

        // On génère la vue
        // $this->render('reservations/index',['reservations' => $reservations]);
        // $this->render('reservations/index',compact('reservations'));
        $this->render('reservations/index');
        
        
    }

    // public function index()
    // { 
    //     // On vérifie si l'utilisateur est connecté
    //     if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
    //         // L'utilisateur est connecté
    //         // On vérifie si le formulaire est complet
    //         $this->render('reservations/index');
    //     }else{
    //         // L'utilisateur n'est pas connecté
    //          $_SESSION['erreur'] = "Vous devez être connecté(e) pour accéder à cette page";
    //          header('Location: users/login');
    //          exit;
    //     }
        
    // }

    // /**
    //  * Ajouter une annonce
    //  * @return void 
    //  */
    // public function ajouter()
    // {
    //     // On vérifie si l'utilisateur est connecté
    //     if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
            // L'utilisateur est connecté
            // On vérifie si le formulaire est complet
    //   if(
     // isset($_POST['boutonTypeChambre']) && !empty($_POST['boutonTypeChambre']) && isset($_POST['boutonTypeChambre']) && !empty($_POST['boutonTypeChambre'])
        // ){
    //             // Le formulaire est complet
    //             // On se protège contre les failles XSS
    //             // strip_tags, htmlentities, htmlspecialchars
    //             $titre = strip_tags($_POST['titre']);
    //             $description = strip_tags($_POST['description']);

    //             // On instancie notre modèle
    //             $annonce = new AnnoncesModel;

    //             // On hydrate
    //             $annonce->setTitre($titre)
    //                 ->setDescription($description)
    //                 ->setUsers_id($_SESSION['user']['id']);

    //             // On enregistre
    //             $annonce->create();

    //             // On redirige
    //             $_SESSION['message'] = "Votre annonce a été enregistrée avec succès";
    //             header('Location: /');
    //             exit;
    //         }else{
    //             // Le formulaire est incomplet
    //             $_SESSION['erreur'] = !empty($_POST) ? "Le formulaire est incomplet" : '';
    //             $titre = isset($_POST['titre']) ? strip_tags($_POST['titre']) : '';
    //             $description = isset($_POST['description']) ? strip_tags($_POST['description']) : '';
    //         }


           
    //     }else{
    //         // L'utilisateur n'est pas connecté
    //         $_SESSION['erreur'] = "Vous devez être connecté(e) pour accéder à cette page";
    //         header('Location: users/login');
    //         exit;
    //     }
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
            if(Form::validate($_POST, ['nombre_de_chambres', 'nombre_lit_bebe', 'pension_type'])){
                // Le formulaire est complet
                // On se protège contre les failles XSS
                // strip_tags, htmlentities, htmlspecialchars
                $nbChambres = strip_tags($_POST['nombre_de_chambres']);
                $nbLitBebe = strip_tags($_POST['nombre_lit_bebe']);
                $typePension = strip_tags($_POST['pension_type']);

                // On instancie notre modèle
                $reservation = new ReservationsModel;

                // On hydrate
                $reservation->setNbChambres($nbChambres)
                    ->setNbLitBebe($nbLitBebe)
                    ->setPension($typePension)
                    ->setusersId($_SESSION['user']['id']);

                // On enregistre
                $reservation->create();

                // On redirige
                $_SESSION['message'] = "Votre reservation a été enregistrée avec succès";
                header('Location: ');
                exit;
            }else{
                // Le formulaire est incomplet
                $_SESSION['erreur'] = !empty($_POST) ? "Le formulaire est incomplet" : '';
                $titre = isset($_POST['titre']) ? strip_tags($_POST['titre']) : '';
                $description = isset($_POST['description']) ? strip_tags($_POST['description']) : '';
            }


            $form = new Form;

            $form->debutForm()
                ->ajoutLabelFor('nombre_de_chambres', 'Entrer le nombre de chambres')
                ->ajoutInput('number', 'nombre_de_chambres', [
                    'id' => 'nombre_de_chambres',
                    'class' => 'form-control'
                    // ,'value' => $nb_chambres
                ])
                ->ajoutLabelFor('nombre_lit_bebe', 'Entrer le nombre de lit pour les bébés')
                ->ajoutInput('number', 'nombre_lit_bebe', [
                    'id' => 'nombre_lit_bebe',
                    'class' => 'form-control'
                    // 'value' => $nb_lit_bebe
                ])
                ->ajoutLabelFor('pension_type', 'Entrer le type de pension')
                ->ajoutInput('text', 'pension_type', [
                    'id' => 'pension_type',
                    'class' => 'form-control'
                    // 'value' => $pension
                ])
                ->ajoutBouton('Ajouter', ['class' => 'btn btn-primary'])
                ->finForm()
            ;

            $this->render('reservations/ajouter', ['form' => $form->create()]);
        }else{
            // L'utilisateur n'est pas connecté
            $_SESSION['erreur'] = "Vous devez être connecté(e) pour accéder à cette page";
            header('Location: ../users/login');
            exit;
        }
    }
}