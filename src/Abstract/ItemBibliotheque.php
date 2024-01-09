<?php

namespace App\Abstract;

abstract class ItemBibliotheque
{
    abstract protected function getTitre();
    abstract protected function getAuteur();
    abstract protected function getAnneePublication();
}
