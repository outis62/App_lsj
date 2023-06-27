<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des élèves</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
</head>
<body>
    <?php
    require_once '../connexionbd.php';
    require_once 'listeparenttraitement.php';

    $database = new Database();
    $eleve = new Eleve($database);

    $listeEleves = $eleve->getListeParents();
    ?>

    <table id="myTable">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Tel parent</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listeEleves as $eleve) : ?>
                <tr>
                    <td><?php echo $eleve['nom']; ?></td>
                    <td><?php echo $eleve['prenom']; ?></td>
                    <td><?php echo $eleve['email']; ?></td>
                    <td><?php echo $eleve['telparent']; ?></td>
                    <td>
                        <button onclick="afficherDetails('<?php echo $eleve['nom']; ?>', '<?php echo $eleve['prenom']; ?>', '<?php echo $eleve['email']; ?>', '<?php echo $eleve['telparent']; ?>')">Détails</button>
                        <button onclick="modifierEleve('<?php echo $eleve['nom']; ?>', '<?php echo $eleve['prenom']; ?>', '<?php echo $eleve['email']; ?>', '<?php echo $eleve['telparent']; ?>')">Modifier</button>
                        <button onclick="supprimerEleve('<?php echo $parent['idParent']; ?>')">Supprimer</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable();
        });

        function afficherDetails(nom, prenom, email, telparent) {
            // Afficher les détails de l'élève (par exemple, dans une boîte de dialogue)
            alert("Détails de l'élève :\nNom : " + nom + "\nPrénom : " + prenom + "\nEmail : " + email + "\nTel parent : " + telparent);
        }

        function modifierEleve(nom, prenom, email, telparent) {
            // Effectuer des actions pour modifier l'élève
            // Par exemple, rediriger vers une page de modification avec les données de l'élève pré-remplies
            alert("Modification de l'élève :\nNom : " + nom + "\nPrénom : " + prenom + "\nEmail : " + email + "\nTel parent : " + telparent);
        }

        function supprimerEleve(id) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cet élève ?")) {
        $.ajax({
            url: 'listedesparent.php',
            method: 'POST',
            data: {id: id},
            success: function(response) {
                alert(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
}

    </script>
    <?php 

    // supprimer_eleve.php
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['idParent'])) {
            $idParent = $_POST['idParent'];
    
            // Effectuer la suppression dans la base de données en utilisant l'ID de l'élève
            $database = new Database();
            $connection = $database->getConnection();
    
            $query = "DELETE FROM parent WHERE idParent = :idParent";
            $statement = $connection->prepare($query);
            $statement->bindParam(':idParent', $idParent);
            $statement->execute();
    
            echo "L'élève avec l'ID : " . $idParent . " a été supprimé avec succès.";
        }
    }

    
    ?>
</body>
</html>
