<?php

class Eleve {
    private $database;

    public function __construct(Database $database) {
        $this->database = $database;
    }

    public function getListeParents() {
        $connection = $this->database->getConnection();

        $query = "SELECT * FROM parent ";
        $statement = $connection->prepare($query);
        $statement->execute();

        $parents = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $parents[] = [
                'nom' => $row['nom'],
                'prenom' => $row['prenom'],
                'email' => $row['email'],
                'telparent' => $row['telparent']
            ];
        }

        return $parents;
    }
}
?>
