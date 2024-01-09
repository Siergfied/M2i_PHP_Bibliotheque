<?php

namespace App\Models;

use App\Abstract\ItemBibliotheque;

class Livre extends ItemBibliotheque
{
    protected $titre;
    protected $auteur;
    protected $anneePublication;

    public function __construct($titre, $auteur, $anneePublication)
    {
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->anneePublication = $anneePublication;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getAuteur()
    {
        return $this->auteur;
    }

    public function getAnneePublication()
    {
        return $this->anneePublication;
    }

    public function afficherLivre()
    {
        echo "Titre : " . $this->titre . "\n";
        echo "Auteur : " . $this->auteur . "\n";
        echo "Année de publication : " . $this->anneePublication . "\n";
    }
}
