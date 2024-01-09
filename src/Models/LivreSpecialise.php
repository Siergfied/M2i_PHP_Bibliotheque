<?php

namespace App\Models;

class LivreSpecialise extends Livre {
    private $domaine;

    public function __construct($titre, $auteur, $anneePublication, $domaine) {
        parent::__construct($titre, $auteur, $anneePublication);
        $this->domaine = $domaine;
    }

    public function getDomaine() {
        return $this->domaine;
    }

    public function afficherLivre() {
        parent::afficherLivre();
        echo "Domaine : " . $this->domaine;
    }
}