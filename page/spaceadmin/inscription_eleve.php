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

class parenteleve {
    private $database;

    public function __construct(Database $database) {
        $this->database = $database;
    }

    public function getParentsByName($searchTerm) {
        $connection = $this->database->getConnection();
        $searchTerm = '%' . $searchTerm . '%';

        $query = "SELECT * FROM parent WHERE nom LIKE :searchTerm OR prenom LIKE :searchTerm OR telparent LIKE :searchTerm";
        $statement = $connection->prepare($query);
        $statement->bindParam(':searchTerm', $searchTerm);
        $statement->execute();

        $parents = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $parents[] = [
                'idParent' => $row['idParent'],
                'nom' => $row['nom'],
                'prenom' => $row['prenom'],
                'telparent' => $row['telparent']
            ];
        }

        return $parents;
    }
}

class Eleve {
    private $database;

    public function __construct(Database $database) {
        $this->database = $database;
    }

    public function inscrireEleve($nomEleve, $prenomEleve, $classeEleve, $genreEleve, $anneeInscription, $idParent) {
        $connection = $this->database->getConnection();

        // Insérer l'élève dans la table "eleve" avec l'ID du parent
        $insertQuery = "INSERT INTO eleve (nom, prenom, classe, genre, anneeinscription, idParent) VALUES ('$nomEleve', '$prenomEleve', '$classeEleve', '$genreEleve', '$anneeInscription', '$idParent')";
        $connection->query($insertQuery);
    }
}

// Utilisation du code

$database = new Database();
$parent = new parenteleve($database);
$eleve = new Eleve($database);

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs du formulaire
    $nomEleve = $_POST['nom'];
    $prenomEleve = $_POST['prenom'];
    $classeEleve = $_POST['classe'];
    $genreEleve = $_POST['genre'];
    $anneeInscription = $_POST['anneeinscription'];
    $idParent = $_POST['idParent'];

    // Inscrire l'élève en l'associant au parent
    $eleve->inscrireEleve($nomEleve, $prenomEleve, $classeEleve, $genreEleve, $anneeInscription, $idParent);

    // echo 'L\'élève a été inscrit avec succès.';
}

// Traitement de la requête AJAX pour les suggestions de parent
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['searchTerm'])) {
    $searchTerm = $_GET['searchTerm'];
    $parents = $parent->getParentsByName($searchTerm);
    echo json_encode($parents);
    exit();
}

?>

<!-- Formulaire HTML -->
<!DOCTYPE html>
<html>
<head>
    <title>Inscription d'un élève</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
<style>
    body{
            background-color: #0DCAF0;
        }
        .form-box {
  max-width: 300px;
  background: #0DCAF0;
  overflow: hidden;
  border-radius: 16px;
  color: #010101;
  margin-left: 470px;
  box-shadow: 0 15px 25px rgba(0,0,0,.6);
}

.form {
  position: relative;
  display: flex;
  flex-direction: column;
  padding: 32px 24px 24px;
  gap: 16px;
  text-align: center;
}

/*Form text*/
.title {
  font-weight: bold;
  font-size: 1.6rem;
}

.subtitle {
  font-size: 1rem;
  color: #666;
}

/*Inputs box*/
.form-container {
  overflow: hidden;
  border-radius: 8px;
  background-color: #fff;
  margin: 1rem 0 .5rem;
  width: 100%;
  height: 220px;
}

.input {
  background: none;
  border: 0;
  outline: 0;
  height: 30px;
  width: 100%;
  border-bottom: 1px solid #eee;
  font-size: .9rem;
  padding: 8px 15px;
}

.form-section {
  padding: 16px;
  font-size: .85rem;
  background-color: #e0ecfb;
  box-shadow: rgb(0 0 0 / 8%) 0 -1px;
}

.form-section a {
  font-weight: bold;
  color: #0066ff;
  transition: color .3s ease;
}

.form-section a:hover {
  color: #005ce6;
  text-decoration: underline;
}

/*Button*/
.form button {
  background-color: #0066ff;
  color: #fff;
  border: 0;
  border-radius: 24px;
  padding: 10px 16px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: background-color .3s ease;
}

.form button:hover {
  background-color: #005ce6;
}
.spaceadmin
{
    text-decoration: none;
    margin-left: 75px;
}
</style>
    <div class="form-box">
    <form class="form" method="post">
  <span class="title">Ajoutez un élève</span>
  <span class="subtitle">Inscrivez chaque élève.s avec son parent !</span>
  <div class="form-container">
    <input type="text" class="input" name="nom" placeholder="Nom" required>
    <input type="text" class="input" name="prenom" placeholder="Prénom" required>
    <input type="number" class="input" name="anneeinscription" placeholder="Année scolaire" required>
    <select name="classe" placeholder="Classe" required>
            <option value="6ème">6ème</option>
            <option value="5ème">5ème</option>
            <option value="4ème">4ème</option>
            <option value="3ème">3ème</option>
        </select>
        <select name="genre" placeholder="Genre" required>
            <option value="Masculin">Masculin</option>
            <option value="Féminin">Féminin</option>
        </select></br>
    <input type="text" class="input" name="nomparent" id="nomparent" placeholder="Nom parent" required><br>
        <input type="hidden" name="idParent" id="idparent">
  </div>
  <button type="submit">Enregistrer</button>
</form>
        <div class="form-section">
          <p><a class="spaceadmin" href="espacedirecteur.php">Mon space de travail</a> </p>
        </div>
        </div>
    <script>
        $(document).ready(function() {
            $('#nomparent').on('input', function() {
                var searchTerm = $(this).val().trim();
                if (searchTerm !== '') {
                    $.ajax({
                        url: 'inscription_eleve.php',
                        method: 'GET',
                        data: { searchTerm: searchTerm },
                        dataType: 'json',
                        success: function(response) {
                            var suggestions = [];
                            response.forEach(function(parent) {
                                suggestions.push({
                                    value: parent.nom + ' ' + parent.prenom,
                                    label: parent.nom + ' ' + parent.prenom + ' - ' + parent.telparent,
                                    id: parent.idParent
                                });
                            });

                            $('#nomparent').autocomplete({
                                source: suggestions,
                                select: function(event, ui) {
                                    $('#idparent').val(ui.item.id);
                                }
                            });
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
