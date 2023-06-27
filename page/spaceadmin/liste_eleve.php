<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/bootstrap/css/bootstrap.min.css">
    <title>LISTE DES ELEVES</title>
</head>
<body>
    <header>
    <style>
        section{
            background-color: #0DCAF0;
        }
        .colgnrl
{
	display: flex;
	margin: 20px;
	padding-top: 50px;
	margin-right: 100px;
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
    </header>
    <h1 class="text-center text-primary fw-bold mt-5">CONSULTEZ LA LISTE EN FONCTION DE LA CLASSE</h1>


    <div class="colgnrl mt-5">
 			<a href="liste6eme.php" class="col1"><img src="../../image/liste6eme.svg" width="70" height="70" id="img1" /><p>Liste 6ème</p></a>
 			<a href="liste5eme.php" class="col2"><img src="../../image/liste5eme.svg" width="70" height="70" id="img2" /><p>Liste 5ème</p></a>
 			<a href="liste4eme.php" class="col3"><img src="../../image/liste4eme.svg" width="70" height="70" id="img3" /><p>Liste 4ème</p></a>
             <a href="liste3eme.php" class="col3"><img src="../../image/liste3eme.svg" width="70" height="70" id="img3" /><p>Liste 3ème</p></a>
 		</div>
<footer>

</footer>
</body>
</html>
