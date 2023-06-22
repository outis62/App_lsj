<?php
include('connexionbd.php');

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function login($email, $fonction) {
        $connection = $this->db->getConnection();
        $query = "SELECT fonction FROM administrateur WHERE email = :email";
        $statement = $connection->prepare($query);
        $statement->bindParam(':email', $email);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['fonction'] === $fonction) {
            return true;
        }

        return false;
    }

    public function lienvisible() {
        $connection = $this->db->getConnection();
        $query = "SELECT COUNT(*) as total FROM administrateur";
        $statement = $connection->query($query);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $totalUsers = $row['total'];

        if ($totalUsers >= 1) {
            return false;
        } else {
            return true;
        }
    }
}

// Création de l'instance de la classe User en dehors de la condition du formulaire de connexion
$user = new User();

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    // Récupérer les valeurs du formulaire
    $email = $_POST['email'];
    $fonction = $_POST['fonction'];

    // Effectuer le traitement en fonction du rôle sélectionné
    if ($user->login($email, $fonction)) {
        if ($fonction === 'directeur') {
            // Traitement pour le directeur
            // Redirection vers la page spécifique du directeur
            header("Location: spaceadmin/espacedirecteur.php");
            exit;
        } elseif ($fonction === 'secretaire') {
            // Traitement pour la secrétaire
            // Redirection vers la page spécifique de la secrétaire
            header("Location: spaceadmin/espacesecretaire.php");
            exit;
        } else {
            // Fonction inconnue
            echo "Fonction inconnue";
        }
    } else {
        // Échec de l'authentification
        echo "Email ou fonction incorrecte";
    }
}

// Affichage du lien d'inscription des admins
if ($user->lienvisible()) {
    echo '<button><a href="inscription.php" class="inscription">Inscription</a></button>';
}
?>
