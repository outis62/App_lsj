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
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="motpasse" required>
                <label>Password</label>
            </div>
            <div>
                <input type="submit" name="login" class="butt" value="Se connecter">
                <?php
                include('authenttraitement.php');
                ?>
            </div>
            
        </form>
    </div>
    
</body>
</html>
