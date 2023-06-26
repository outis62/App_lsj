<!DOCTYPE html>
<html>
<head>
    <title>Formulaire d'inscription d'élève</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script.js"></script>
    <style>
        #suggestions {
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            padding: 10px;
            display: none;
        }
        
        #suggestions div {
            cursor: pointer;
            padding: 5px;
        }
        
        #suggestions div:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>
    <h1>Formulaire d'inscription d'élève</h1>
    
    <form method="post" action="inscription_eleve.php">
        <h2>Informations parent</h2>
        <label for="nomParent">Nom du parent:</label>
        <input type="text" name="nomParent" id="nomParent" required autocomplete="off">
        <div id="suggestions"></div>
        <input type="hidden" name="idParent" id="idParent">
        
        <h2>Informations élève</h2>
        <label for="nomEleve">Nom de l'élève:</label>
        <input type="text" name="nom" id="nomEleve" required><br><br>
        
        <label for="prenomEleve">Prénom de l'élève:</label>
        <input type="text" name="prenom" id="prenomEleve" required><br><br>
        
        <label for="genreEleve">Genre de l'élève:</label>
        <select name="genre" id="genre" required>
            <option value="masculin">Masculin</option>
            <option value="feminin">Féminin</option>
        </select><br><br>
        
        <label for="classeEleve">Classe de l'élève:</label>
        <input type="text" name="classe" id="classeEleve" required><br><br>
        
        <label for="anneeInscription">Année d'inscription:</label>
        <input type="text" name="anneeinscription" id="anneeInscription" required><br><br>
        
        <input type="submit" value="Enregistrer">
    </form>
    <script>
       $(document).ready(function() {
    $('#nomParent').keyup(function() {
        var nomParent = $(this).val();
        if (nomParent.length >= 2) {
            $.ajax({
                url: 'ajoutparent.php',
                method: 'POST',
                data: { nomParent: nomParent },
                success: function(data) {
                    afficherSuggestions(data);
                }
            });
        } else {
            $('#suggestions').hide();
        }
    });

    function afficherSuggestions(suggestions) {
        var suggestionsDiv = $('#suggestions');
        suggestionsDiv.empty();

        if (suggestions.length > 0) {
            suggestions.forEach(function(parent) {
                var suggestionItem = $('<div></div>');
                suggestionItem.text(parent.nom + ' ' + parent.prenom);

                suggestionItem.click(function() {
                    $('#nomParent').val($(this).text());
                    $('#idParent').val(parent.id);
                    suggestionsDiv.hide();
                });

                suggestionsDiv.append(suggestionItem);
            });

            suggestionsDiv.show();
        } else {
            suggestionsDiv.hide();
        }
    }
});

    </script>
</body>
</html>

<?php
include('../connexionbd.php');

class EleveInscription {
    private $connexion;

    public function __construct() {
        $this->connexion = new Database();
    }

    public function insererEleve($nom, $prenom, $genre, $classe, $anneeinscription, $idParent) {
        $connection = $this->connexion->getConnection();
        $requeteEleve = $connection->prepare('INSERT INTO eleve (nom, prenom, genre, classe, anneeinscription, idparent) VALUES (?, ?, ?, ?, ?, ?)');
        $requeteEleve->bindParam(1, $nom);
        $requeteEleve->bindParam(2, $prenom);
        $requeteEleve->bindParam(3, $genre);
        $requeteEleve->bindParam(4, $classe);
        $requeteEleve->bindParam(5, $anneeinscription);
        $requeteEleve->bindParam(6, $idParent);
        $requeteEleve->execute();
    }

    public function recupererParent($idParent) {
        $connection = $this->connexion->getConnection();
        $requeteParent = $connection->prepare('SELECT nom, prenom FROM parent WHERE id = ?');
        $requeteParent->bindParam(1, $idParent);
        $requeteParent->execute();
        $resultat = $requeteParent->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }
}

$eleveInscription = new EleveInscription();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $genre = $_POST['genre'];
    $classe = $_POST['classe'];
    $anneeinscription = $_POST['anneeinscription'];
    $idParent = $_POST['idParent'];

    $eleveInscription->insererEleve($nom, $prenom, $genre, $classe, $anneeinscription, $idParent);

    // Récupérer le nom et le prénom du parent
    $parent = $eleveInscription->recupererParent($idParent);
    $nomParent = $parent['nom'];
    $prenomParent = $parent['prenom'];

    // Fermer la connexion à la base de données

    // Rediriger vers une page de confirmation ou afficher un message de réussite
    echo 'Inscription réussie !<br>';
    echo 'Parent: ' . $nomParent . ' ' . $prenomParent;
    exit();
}
?>
