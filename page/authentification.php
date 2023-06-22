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
        <form method="POST">
            <div class="user-box">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="user-box">
                <select name="fonction">
                    <option value="directeur">Directeur</option>
                    <option value="secretaire">Secrétaire</option>
                </select>
            </div>
            <div>
                <input type="submit" name="login" class="butt" value="Se connecter">
            </div>
            <?php
            include('authenttraitement.php');
            ?>
        </form>
    </div>
</body>
</html>
