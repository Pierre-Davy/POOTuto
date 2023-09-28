<?php

namespace App\Banque;

/**
 * Compte bancaire (hérite de compte)
 */
class CompteCourant extends Compte
{
    private $decouvert;

    //constructeur
    /**
     * constructeur du compte courant
     *
     * @param string $nom
     * @param float $montant
     * @param integer $decouvert
     */
    public function __construct(string $nom, float $montant, int $decouvert)
    {
        //on transefr les informations nécessaire au constructeur de compte
        parent::__construct($nom, $montant);
        $this->decouvert = $decouvert;
    }

    //accesseurs

    public function getDecouvert(): int
    {
        return $this->decouvert;
    }

    public function setDecouvert(int $montant): self
    {
        if ($montant >= 0) {
            $this->decouvert = $montant;
        }
        return $this;
    }

    public function retirer(float $montant)
    {
        //on vérifie le montant et le solde
        if (($montant > 0) && ($this->solde - $montant >= -$this->decouvert)) {
            $this->solde -= $montant;
        } else {
            echo "Montant invalide ou solde insuffisant";
        }
    }
}
