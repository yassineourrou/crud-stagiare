<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>gestion des stagiaires</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
    include "header_conection.php";
?>
    <div class="contener nosenter">
        <table class="tbl_style">
            <thead>
                <tr>
                    <th>CNE</th>
                    <th>NOM</th>
                    <th>PRENOM</th>
                    <th>DATE DE NAISSANCE</th>
                    <th>SEXE</th>
                    <th>GROUPE</th>
                    <th>FILIERE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        $conn = conection();
                        $sql = $conn->prepare("SELECT * FROM stagiaires");
                        $sql->execute();
                        $info = $sql->fetchAll();
                        foreach($info as $value){
                        echo "<tr>";
                        echo "<td>".$value['cne']."</td>";
                        echo "<td>".$value['nom']."</td>";
                        echo "<td>".$value['prenom']."</td>";
                        echo "<td>".$value['daten']."</td>";
                        echo "<td>".$value['sexe']."</td>";
                        echo "<td>".$value['filiere']."</td>";
                        echo "<td>".$value['groupe']."</td>";
                        echo "</tr>";
                        }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
