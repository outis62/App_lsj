<?php
    include('connexionbd.php');

    class User {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function login($email, $motpasse) {
            $connection = $this->db->getConnection();
            $query = "SELECT motpasse FROM administrateur WHERE email = :email";
            $statement = $connection->prepare($query);
            $statement->bindParam(':email', $email);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result && password_verify($motpasse, $result['motpasse'])) {
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

            if ($totalUsers >= 2) {
                return false;
            } else {
                return true;
            }
        }
    }

    // Vérifier si le formulaire de connexion a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        $user = new User(); // Créer l'instance de la classe User
        $email = $_POST['email'];
        $motpasse = $_POST['motpasse'];

        if ($user->login($email, $motpasse)) {
            header("Location: inscription.php"); // Redirection vers la page d'inscription
            exit;
        } else {
            echo "Email ou mot de passe incorrect";
        }
    }

    // Créeation de l'instance de la classe User en dehors de la condition du formulaire de connexion
    $user = new User();

    // Affichage le lien d'inscription des admin
    if ($user->lienvisible()) {
        echo '<button><a href="inscription.php" class="inscription">Inscription</a></button>';
    }
    ?>