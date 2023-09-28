<?php

namespace App\Banque;

/**
 * Compte avec taux d'intérets
 */
class CompteEpargne extends Compte
{
    /**
     * taux d'interets du compte
     *
     * @var int
     */
    private $taux_interets;

    //contructeur
    /**
     * constructeur du compte epargne
     *
     * @param string $nom nom du titulaire
     * @param float $montant solde du compte
     * @param integer $taux taux d'interets
     */
    public function __construct(string $nom, float $montant, float $taux)
    {
        //on transfere les valeurs au constructeur du parent
        parent::__construct($nom, $montant);
        $this->taux_interets = $taux;
    }


    /**
     * getter taux interets du compte
     *
     * @return integer
     */
    public function getTauxInterets(): float
    {
        return $this->taux_interets;
    }

    /**
     * setter du taux d'interet
     *
     * @param integer $taux_interets
     * @return self
     */
    public function setTauxInterets(float $taux_interets): self
    {
        if ($taux_interets >= 0) {
            $this->taux_interets = $taux_interets;
        }
        return $this;
    }

    public function verserInterets()
    {
        $this->solde = $this->solde + ($this->solde * $this->taux_interets / 100);
    }
}
