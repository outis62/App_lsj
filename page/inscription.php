<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../style/bootstrap/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../style/styleinscription.css">
    <link rel="shortcut icon" href="../image/logolsj.png">
    <title>Inscription Admin LSJ</title>
</head>
<body>
<div class="Z">
    <h1>Inscription admin</h1>
     <p>veuillez renseigner vos données</p>

     <form method="post">
         <div class="A">
           <label>Nom </label>
             <input type="text" name="nom" required><br>
         </div>
        <div class="B">
           <label>Prénom(s) </label>
             <input type="text" name="prenom" required><br>
        </div>
        <div class="C">
            <label>Email </label>
              <input type="email" name="email" required><br>
        </div>
        <div class="D">
            <label>Mot de passe </label>
              <input type="password" name="motpasse" required><br>
        </div>

        <input type="submit" name="submit" value="SAVE">
    </form>
  </div>
</body>
</html>

<?php

include ('connexionbd.php');

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function enregistrement($nom, $prenom, $email, $motpasse) {
        // Crypter le mot de passe
        $motpassecrypte = password_hash($motpasse, PASSWORD_DEFAULT);

        $connection = $this->db->getConnection();
        $query = "INSERT INTO administrateur (nom, prenom, email, motpasse) VALUES (:nom, :prenom, :email, :motpasse)";
        $statement = $connection->prepare($query);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':prenom', $prenom);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':motpasse', $motpassecrypte);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

$user = new User();

// Vérifier si le formulaire d'inscription a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $motpasse = $_POST['motpasse'];

    if ($user->enregistrement($nom, $prenom, $email, $motpasse)) {
        echo "Inscription réussie";
    } else {
        echo "Erreur lors de l'inscription";
    }
}

?>


