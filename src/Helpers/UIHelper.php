<?php

namespace App\Helpers;

use App\Models\LivreSpecialise;

class UIHelper
{
    public static function afficherLivresSousFormeDeTableau($livres)
    {
        echo "\033[1;34m"; // Couleur bleue
        echo str_pad("Titre", 40) . str_pad("Auteur", 20) . str_pad("Annee", 10) . str_pad("Domaine", 20) . "\n";
        echo "\033[0m"; // Réinitialiser le style

        foreach ($livres as $livre) {
            echo str_pad($livre->getTitre(), 40);
            echo str_pad($livre->getAuteur(), 20);
            echo str_pad($livre->getAnneePublication(), 10);
            echo str_pad(($livre instanceof LivreSpecialise) ? $livre->getDomaine() : "", 20);
            echo "\n";
        }
    }

    public static function afficherMenu()
    {
        echo "\033[1;33m\n"; // Couleur jaune
        echo "1. Ajouter un livre\n";
        echo "2. Lister tous les livres\n";
        echo "3. Rechercher un livre par titre\n";
        echo "4. Rechercher un livre par domaine\n";
        echo "5. Quitter\n";
        echo "\033[0m"; // Réinitialiser le style
    }
}
