<?php

/**
 * Objet Compte bancaire
 */
class Compte
{
    /**
     * Titulaire du compte bancaire
     *
     * @var string
     */
    private $titulaire;

    /**
     * Solde du compte bancaire
     *
     * @var float
     */
    private $solde;


    /**
     * Constructeur du compte bancaire
     *
     * @param string $nom Nom du titulaire du compte
     * @param float $montant Mon tant du solde à l'ouverture du compte
     */
    public function __construct(string $nom, float $montant = 0)
    {
        //on attribue le nom à la propriété titulaire de l'instance créée
        $this->titulaire = $nom;

        //on attribue le montant à la propriété solde de l'instance créée
        $this->solde = $montant;
    }

    //accesseur

    /**
     * Retourne la valeur du titulaire du compte
     *
     * @return string
     */
    public function getTitulaire(): string
    {
        return $this->titulaire;
    }
    /**
     * Retourne la valeur du solde du compte
     *
     * @return float
     */
    public function getSolde(): float
    {
        return $this->solde;
    }

    //setter
    /**
     * Modifie le nom du titulaire et retourne l'objet
     *
     * @param string $nom Nom du titulaire
     * @return Compte Compte bancaire
     */
    public function setTitulaire(string $nom): self
    {
        if ($nom != "") {
            $this->titulaire = $nom;
            return $this;
        }
    }
    /**
     * Modifie le solde du titulaire et retourne l'objet
     *
     * @param float $montant Montant du compte
     * @return Compte Compte bancaire
     */
    public function setSolde(float $montant): self
    {
        if ($montant >= 0) {
            $this->solde = $montant;
            return $this;
        }
    }


    /**
     * Déposer de l'argent sur le compte
     *
     * @param float $montant Montant à déposer
     * @return void
     */
    public function deposer(float $montant)
    {
        //on vérifie si le montant est positif
        if ($montant > 0) {
            $this->solde += $montant;
        }
    }

    /**
     * Retirer de l'argent sur le compte bancaire
     *
     * @param float $montant Montant à retirer
     * @return void
     */
    public function retirer(float $montant)
    {
        //on vérifie le montant et le solde
        if (($montant > 0) && ($this->solde > $montant)) {
            $this->solde -= $montant;
        } else {
            echo "Montant invalide ou solde insuffisant";
        }
    }

    /**
     * Afficher le solde du compte à l'écran
     *
     * @return string
     */
    public function voirSolde()
    {
        return "Le solde du compte est de <strong>$this->solde</strong> euros";
    }
}
