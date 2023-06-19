<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../style/bootstrap/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../style/styleauthentadmin.css">
    <link rel="shortcut icon" href="../image/logolsj.png">
    <title>LSJ Authentification</title>   
</head>
<body>
    <div class="login-box">
        <img src="../image/imgauthent.jpg" alt="">
        <h2>S'authentifier</h2>
        <form method="POST" action="">
            <div class="user-box">
                <input type="email" name="email" required="">
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="motpasse" required="">
                <label>Password</label>
            </div>
            <div>
                <input type="submit" name="login" class="butt" value="Se connecter">
            </div>
        </form>
    </div>

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

    // Créer l'instance de la classe User en dehors de la condition du formulaire de connexion
    $user = new User();

    // Afficher le lien d'inscription
    if ($user->lienvisible()) {
        echo '<button><a href="inscription.php" class="inscription">Inscription</a></button>';
    }
    ?>
    
</body>
</html>
