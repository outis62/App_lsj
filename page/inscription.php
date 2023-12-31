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
}

.input {
  background: none;
  border: 0;
  outline: 0;
  height: 40px;
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
  /* padding: 10px 16px 10px; */
  margin-left: 30px;
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
    margin-left: 15px;
}
    </style>
    <div class="form-box">
    <form class="form" method="post">
  <span class="title">Compte Directeur</span>
  <span class="subtitle">Créez un compte gratuit avec votre adresse e-mail.</span>
  <div class="form-container">
    <input type="text" class="input" name="nom" placeholder="Nom" required>
    <input type="text" class="input" name="prenom" placeholder="Prénom" required>
    <input type="email" class="input" name="email" placeholder="Email" required>
    <select class="input" name="fonction">
      <option value="directeur">Directeur</option>
    </select>
  </div>
  <button type="submit">Créer le compte</button>
</form>
        <div class="form-section">
          <p><a class="spaceadmin" href="authentification.php">Authentifier</a> </p>
        </div>
        </div>
</body>
</html>


<?php
include('connexionbd.php');

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function enregistrement($nom, $prenom, $email, $fonction) {
        $connection = $this->db->getConnection();
        $query = "INSERT INTO administrateur (nom, prenom, email, fonction) VALUES (:nom, :prenom, :email, :fonction)";
        $statement = $connection->prepare($query);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':prenom', $prenom);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':fonction', $fonction);

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
    $fonction = $_POST['fonction'];

    if ($user->enregistrement($nom, $prenom, $email, $fonction)) {
        echo "Inscription réussie";
    } else {
        echo "Erreur lors de l'inscription";
    }
}
?>



