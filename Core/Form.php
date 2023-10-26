<?php

namespace App\Core;

class Form
{
    private $formCode = '';

    /**
     * Génère le formulaire html
     *
     * @return string
     */
    public function create()
    {
        return $this->formCode;
    }

    /**
     * Valide si tous las champs proposés sont remplis
     *
     * @param array $form Tableau issu du formulaire ($_POST ou $_GET)
     * @param array $champs Tableau listant les champs obligatoire
     * @return bool
     */
    public static function validate(array $form, array $champs)
    {
        //on parcourt les champs
        foreach ($champs as $champ) {
            //si le champ es tabsent ou vide dans le formulaire
            if (!isset($form[$champ]) || empty($form[$champ])) {
                //on sort en retournant false
                return false;
            }
        }
        return true;
    }

    /**
     * Ajoute les attributs envoyés à la balise
     *
     * @param array $attributs Tableau associatif ['class'=>'form-control']
     * @return string Chaine de caractères générée
     */
    public function ajoutAttributs(array $attributs): string
    {
        //on initialise une chaine de caractères
        $str = '';

        //on liste les attributs "cours"
        $courts = ['check', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 'novalidate', 'formnovalidate'];

        //on boucle sur le tableau d'attributs
        foreach ($attributs as $attribut => $valeur) {
            //si l'attribut est fdans la liste des attributs courts
            if (in_array($attribut, $courts) && $valeur == true) {
                $str .= " $attribut";
            } else {
                //on ajoute attribut=valeur
                $str .= " $attribut='$valeur'";
            }
        }

        return $str;
    }

    /**
     * Balise d'ouverture du formulaire
     *
     * @param string $methode Méthode du formulaire (post ou get)
     * @param string $action Action du formulaire
     * @param array $attributs Attribut
     * @return Form
     */
    public function debutForm(string $methode = 'post', string $action = '#', array $attributs = []): self
    {
        //on créé la balise form
        $this->formCode .= "<form action='$action' method='$methode'";

        //on ajoute les attibuts eventuels
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) . '>' : '>';


        return $this;
    }

    /**
     * Balise de fermeture du formulaire
     *
     * @return Form
     */
    public function finForm(): self
    {
        $this->formCode .= '</form>';
        return $this;
    }

    /**
     * Ajout d'un label
     *
     * @param string $for
     * @param string $texte
     * @param array $attributs
     * @return self
     */
    public function ajoutLabelFor(string $for, string $texte, array $attributs = []): self
    {
        //on ouvre la balise
        $this->formCode .= "<label for='$for'";

        //on ajoute les attributs
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) : '';

        //on ajoute le texte
        $this->formCode .= ">$texte</label>";

        return $this;
    }

    public function ajoutInput(string $type, string $nom, array $attributs = []): self
    {
        //on ouvre la balise
        $this->formCode .= "<input type='$type' name='$nom'";

        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) . '>' : '>';

        return $this;
    }

    public function ajoutTextArea(string $nom, string $valeur = '', array $attributs = []): self
    {
        //on ouvre la balise
        $this->formCode .= "<textarea name='$nom'";

        //on ajoute les attributs
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) : '';

        //on ajoute le texte
        $this->formCode .= ">$valeur</textarea>";

        return $this;
    }

    /**
     * Ajout d'un formulaire de type select
     *
     * @param string $nom Nom du formulaire
     * @param array $options Option sous forme d'un tableau
     * @param array $attributs
     * @return self
     */
    public function ajoutSelect(string $nom, array $options, array $attributs = []): self
    {
        //on créé le select
        $this->formCode .= "<select name='$nom'";

        //on ajoute les attributs
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) . '>' : '>';

        //on ajoute les options
        foreach ($options as $valeur => $texte) {
            $this->formCode .= "<option value ='$valeur'>$texte</option>";
        }

        //on ferme le select
        $this->formCode .= "</select>";

        return $this;
    }

    public function ajoutBoutton(string $texte, array $attributs = []): self
    {
        //on ouvre le bouton
        $this->formCode .= "<button ";

        //on ajoute les attributs
        $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) : '';

        //on ferme le bouton
        $this->formCode .= ">$texte</button>";

        return $this;
    }
}
