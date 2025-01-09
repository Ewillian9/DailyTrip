<?php

/**
 * Classe de gestion de la base de données
 * Pour gérer la connexion et les requêtes
 * à la base de données nous utilisons PDO, 
 * il s'agit d'une classe PHP qui permet de 
 * manipuler des données dans une base de données
 */
class Database
{

    private string $host = "localhost:3306";
    private string $dbname = "dailytrip";
    private string $user = "root";
    private string $password = "";
    private PDO $connect;

    // Connexion à la base de données SQLite
    public function __construct()
    {
        $this->connect = new PDO(
            "mysql:host=" . $this->host . ";dbname=" . $this->dbname,
            $this->user,
            $this->password
        );
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // MÉTHODES

    /**
     * Méthode "All" pour tous récupérer
     * @return array
     */
    public function all(string $item): array
    {
        $query = "SELECT * FROM $item";
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Méthode "One" pour récupérer un élément
     * @return array|false
     */
    public function one(string $item, string $ref): array|false
    {
        $query = "SELECT * FROM $item WHERE ref = :ref";
        $stmt = $this->connect->prepare($query);
        $stmt->execute(['ref' => $ref]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Méthode "Add" pour ajouter un élément
     * @return bool
     */
    public function add(string $item, array $data): bool
    {
        // Mise en place des vairables pour la requête SQL
        $dataKeys = ""; // Une ligne pour les clés de la table visée
        $dataValues = ""; // Une ligne pour les valeurs de ces clés

        if (!empty($data)) {
            // Préparation des données pour la requête SQL
            foreach ($data as $key => $value) {
                $dataKeys = $dataKeys . $key . ", ";
                $dataValues = $dataValues . "\"" . $value . "\", ";
            }

            $query = "INSERT INTO $item ($dataKeys) VALUES ($dataValues)"; // Requête SQL
            $stmt = $this->connect->prepare($query); // Préparation de la requête SQL
            $stmt->execute(); // Exécution de la requête SQL
            return true; // Retourne vrai si la requête SQL s'est bien déroulée
        } else {
            return false; // Retourne faux si la requête SQL s'est mal déroulée
        }
    }

    /**
     * Méthode "Delete" pour supprimer un élément
     * @return bool
     */
    public function delete(string $item, string $ref): bool
    {
        $query = "DELETE FROM $item WHERE ref = $ref";
        $stmt = $this->connect->prepare($query);
        return $stmt->execute(); // SQL renvoie un booléen automtiquement
    }
}
