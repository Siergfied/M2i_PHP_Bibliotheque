<?php

namespace App\Managers;

use App\Interfaces\Recherchable;
use App\Models\Livre;
use App\Models\LivreSpecialise;

class BibliothequeManager implements Recherchable
{
    private  $livres;

    public function __construct()
    {
        $this->livres = [];
    }

    public function addLivre(Livre $livre)
    {
        $this->livres[] = $livre;
    }

    public function getLivres()
    {
        return $this->livres;
    }

    public function rechercherTitre($titre)
    {
        return array_filter($this->livres, function ($livre) use ($titre) {
            return strpos(strtolower($livre->getTitre()), strtolower($titre)) !== false;
        });
    }

    public function rechercherDomaine($domaine)
    {
        return array_filter($this->livres, function ($livre) use ($domaine) {
            return $livre instanceof LivreSpecialise && strtolower($livre->getDomaine()) === strtolower($domaine);
        });
    }
}
