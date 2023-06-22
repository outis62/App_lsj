<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace directeur</title>
</head>
<body>
    <style>
        section{
            background-color: #0DCAF0;
        }
        .colgnrl
{
	display: flex;
	margin: 20px;
	padding-top: 20px;
    padding-bottom: 10px;
	margin-right: 50px;
}
.col1,.col2,.col3,.col4
{
	border: 0px black solid;
	margin-left: 80px;
	background-color: white;
	box-shadow: 0 8px 8px 0 rgba(0,0,0,0.2),0 6px 6px 0 rgba(0,0,0,0.19);
	border-radius: 3px;
	text-align: center;
	width: 25%;
	height: 200px;
    text-decoration: none;
    font-weight: bold;
}
.col1:hover,.col2:hover,.col3:hover,.col4:hover
{
   box-shadow: 0 8px 17px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
   background: linear-gradient(180deg,#448AFF,#002a40);
   color: white;
   cursor: pointer;
}
img{
    margin-top: 30px;
}
    </style>
    <header>
    <?php
// Commencez la session
session_start();

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // L'utilisateur est connecté, vous pouvez afficher le bouton de déconnexion
    echo 'Connectez-vous';
} else {
    // L'utilisateur n'est pas connecté, vous pouvez afficher un message ou rediriger vers une page de connexion
    
    echo '<a href="deconnexion.php" style="text-decoration:none; font-weight:300; padding:20px; background-color:blue; 
    border-radius:20px; color:white; margin-top:30px;">Déconnexion</a>';
}
?>
    </header>
   <section>
    <div class="colgnrl">
 			<a href="savesecretaire.php" class="col1"><img src="../../image/secretaire.svg" width="70" height="70" id="img1" /><p>Creer compte secretaire</p></a>
 			<a href="ajoutparent.php" class="col2"><img src="../../image/parent.svg" width="70" height="70" id="img2" /><p>Creer un compte parent</p></a>
 			<a href="#" class="col3"><img src="../../image/eleve.svg" width="70" height="70" id="img3" /><p>Ajouter un eleve</p></a>
 		</div>
         <div class="colgnrl">
            <a href="#" class="col4"><img src="../../image/moyenne.svg" width="70" height="70" id="img4" /><p>Ajouter une moyenne</p></a>
 			<a href="#" class="col1"><img src="../../image/listeleve.svg" width="70" height="70" id="img1" /><p>Consulter Liste Eleve</p></a>
 			<a href="#" class="col2"><img src="../../image/listparent.svg" width="70" height="70" id="img2" /><p>Consulter Liste Parent</p></a>
 		</div>
   </section>
    <footer></footer>
</body>
</html>