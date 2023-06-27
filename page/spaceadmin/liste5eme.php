<?php

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbName = "gestionlsj";

    private $connection;

    public function __construct() {
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
            exit();
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}

class Eleve {
    private $database;

    public function __construct(Database $database) {
        $this->database = $database;
    }

    public function getListeEleves() {
        $connection = $this->database->getConnection();

        $query = "SELECT * FROM eleve WHERE classe = '5ème'";
        $statement = $connection->prepare($query);
        $statement->execute();

        $eleves = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $eleves[] = [
                
                'nom' => $row['nom'],
                'prenom' => $row['prenom'],
                'classe' => $row['classe'],
                'genre' => $row['genre'],
                'annee_inscription' => $row['anneeinscription'],
                
            ];
        }

        return $eleves;
    }
}

// Utilisation du code

$database = new Database();
$eleve = new Eleve($database);

// Récupérer la liste des élèves
$listeEleves = $eleve->getListeEleves();

// Afficher la liste des élèves
foreach ($listeEleves as $eleve) {
    
    echo "Nom: " . $eleve['nom'] . "<br>";
    echo "Prénom: " . $eleve['prenom'] . "<br>";
    echo "Classe: " . $eleve['classe'] . "<br>";
    echo "Genre: " . $eleve['genre'] . "<br>";
    echo "Année d'inscription: " . $eleve['annee_inscription'] . "<br>";
    
    echo "<br>";
}

?>
