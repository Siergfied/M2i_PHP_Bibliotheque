<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Exceptions\LivreException;
use App\Helpers\UIHelper;
use App\Managers\BibliothequeManager;
use App\Models\Livre;
use App\Models\LivreSpecialise;

$bibliotheque = new BibliothequeManager();

$bibliotheque->addLivre(new LivreSpecialise("titre", 'auteur', "2001", "test"));
$bibliotheque->addLivre(new Livre("titre2", 'auteur2', "2002"));
$bibliotheque->addLivre(new Livre("titre3", 'auteur3', "2003"));

while (true) {
    UIHelper::afficherMenu();
    $choix = readline("Choisissez une option : ");

    switch ($choix) {
            //1. Ajouter un livre
        case "1":
            try {
                $titre = readline("Entrez le titre : ");
                $auteur = readline("Entrez l'auteur : ");
                $anneePublicationStr = readline("Entrez l'année de publication : ");
                $domaine = readline("Entrez le domaine (ou laissez vide) : ");

                $anneePublication = filter_var($anneePublicationStr, FILTER_VALIDATE_INT, [
                    "options" => [
                        "min_range" => 1450,
                        "max_range" => date('Y')
                    ]
                ]);

                if ($anneePublication === false) {
                    throw new LivreException("L'année de publication doit être un nombre à 4 chiffres compris entre 1450 et " . date('Y'));
                }

                if (empty($domaine)) {
                    $livre = new Livre($titre, $auteur, $anneePublication);
                } else {
                    $livre = new LivreSpecialise($titre, $auteur, $anneePublication, $domaine);
                }

                $bibliotheque->addLivre($livre);
                echo "Livre ajouté.\n";
            } catch (LivreException $erreur) {
                echo "Erreur lors de l'ajout du livre : " . $erreur->getMessage() . "\n";
            }
            break;

            //2. Lister tous les livres
        case "2":
            UIHelper::afficherLivresSousFormeDeTableau($bibliotheque->getLivres());
            break;

            //3. Rechercher un livre par titre
        case "3":
            $titreRecherche = readline("Entrez le titre à rechercher : ");
            $resultats = $bibliotheque->rechercherTitre($titreRecherche);

            if (count($resultats) > 0) {
                UIHelper::afficherLivresSousFormeDeTableau($resultats);
            } else {
                echo "\nAucun livre trouvé avec le titre contenant '$titreRecherche'.\n";
            }

            break;

            //4. Rechercher un livre par domaine
        case "4":
            $domaineRecherche = readline("Entrez le domaine à rechercher : ");
            $resultats = $bibliotheque->rechercherDomaine($domaineRecherche);

            if (count($resultats) > 0) {
                UIHelper::afficherLivresSousFormeDeTableau($resultats);
            } else {
                echo "\nAucun livre trouvé avec le domaine '$domaineRecherche'.\n";
            }

            break;

            //5. Quitter
        case "5":
            exit("\033[0;31mFin du programme.\n\033[0m");

        default:
            echo "\033[1;31mOption non valide. Veuillez réessayer.\n\033[0m";
            break;
    }
}
