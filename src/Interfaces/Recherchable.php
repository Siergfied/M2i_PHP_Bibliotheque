<?php

namespace App\Interfaces;

interface Recherchable
{
    public function rechercherTitre($titre);
    public function rechercherDomaine($domaine);
}
