<?php

namespace App\Models;

use App\Db\Db;



class Model extends Db
{
    // Table de la base de données
    protected $table;

    //Instance de Db
    private $db;

    //On créé une méthode de recherche
    public function findAll()
    {
        $query = $this->requete('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }

    //On créé une méthode de recherche spécifique
    public function findBy(array $criteres)
    {
        $champs = [];
        $valeurs = [];

        //On boucle pour éclater le tableau
        foreach ($criteres as $champ => $valeur) {
            //SELECT * FROM annonces WHERE actif = ?
            //bindvalue(1, valeur)
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }

        //On transforme le tableau "champs" en une chaine de caractères 
        $liste_champs = implode(' AND ', $champs);

        //On execute la requete
        return $this->requete('SELECT * FROM ' . $this->table . ' WHERE ' . $liste_champs, $valeurs)->fetchAll();
    }
    //On créé une méthode de recherche simplifié pour les articles
    public function find(int $id)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }

    //On créé une méthode d'insertion de données
    public function create(Model $model)
    {
        $champs = [];
        $inter = [];
        $valeurs = [];

        //On boucle pour éclater le tableau
        foreach ($model as $champ => $valeur) {
            //INSERT INTO annonces (titre, description, actif) VALUE (?, ?, ?)
            if ($valeur !== null && $champ != 'db' && $champ != 'table') {
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
        }

        //On transforme le tableau "champs" en une chaine de caractères 
        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);

        //On execute la requete
        return $this->requete('INSERT INTO ' . $this->table . '(' . $liste_champs . ') VALUES (' . $liste_inter . ')', $valeurs);
    }

    //Méthode hydratation d'insertion de données
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            //On récupère le nom du setter correspondant à la clé (key)
            //titre -> setTitre
            $setter = 'set' . ucfirst($key);

            //On vérifie si le setter existe
            if (method_exists($this, $setter)) {
                //On appelle le setter
                $this->$setter($value);
            }
        }
        return $this;
    }

    // Methode UPDATE
    public function update(int $id, Model $model)
    {
        $champs = [];
        $valeurs = [];

        //On boucle pour éclater le tableau
        foreach ($model as $champ => $valeur) {
            //UPDATE annonces SET titre = ?, description = ?, actif = ? WHERE id = ?
            if ($valeur !== null && $champ != 'db' && $champ != 'table') {
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $id;

        //On transforme le tableau "champs" en une chaine de caractères 
        $liste_champs = implode(', ', $champs);

        //On execute la requete
        return $this->requete('UPDATE ' . $this->table . ' SET ' . $liste_champs . ' WHERE id = ?', $valeurs);
    }

    //Methode DELETE
    public function delete(int $id)
    {
        return $this->requete('DELETE FROM ' . $this->table . ' WHERE id = ?', [$id]);
    }

    public function requete(string $sql, array $attributs = null)
    {
        // On récupère l'instance de DB
        $this->db = Db::getInstance();

        //On vérifie si on a des attributs
        if ($attributs !== null) {
            //Requête préparée
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            //Requête simple
            return $this->db->query($sql);
        }
    }
}
