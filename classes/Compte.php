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
    public $titulaire;

    /**
     * Solde du compte bancaire
     *
     * @var float
     */
    public $solde;


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
