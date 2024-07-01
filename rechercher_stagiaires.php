<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Stagiaires</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include "header_conection.php"; ?>

    <div class="contener nosenter">
        <form action="rechercher_stagiaires.php" class="fsupp nomarg" method="POST" id="searchForm">
            <p>RECHERCHER</p>
            <select name="filiere_r" id="fil">
                <option value="developement digital">Developement Digital</option>
                <option value="infrastructure digital">Infrastructure Digital</option>
                <option value="gestion des entreprises">Gestion des Entreprises</option>
            </select>
            <select name="groupe_r" id="group"></select>
            <input type="submit" id="btn" class="btn" value="RECHERCHER">
        </form>
            <div class="recherchtble">
                <table class="tbl_style nomargin table">
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
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $groupe = $_POST["groupe_r"];
                                $sql = $conn->prepare("SELECT * FROM stagiaires WHERE groupe = ? ORDER BY nom");
                                $sql->execute([$groupe]);
                                $info = $sql->fetchAll();
                                if (!empty($info)){
                                    foreach ($info as $value) {
                                        echo "<tr>";
                                        echo "<td>" . $value['cne'] . "</td>";
                                        echo "<td>" . $value['nom'] . "</td>";
                                        echo "<td>" . $value['prenom'] . "</td>";
                                        echo "<td>" . $value['daten'] . "</td>";
                                        echo "<td>" . $value['sexe'] . "</td>";
                                        echo "<td>" . $value['filiere'] . "</td>";
                                        echo "<td>" . $value['groupe'] . "</td>";
                                        echo "</tr>";
                                    }
                                }else{
                                    echo "<caption>";
                                    echo "Il n'y a aucun stagiaire dans ce groupe";
                                    echo "</caption>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
    </div>

    <script>
        function changegroup() {
            var select = document.getElementById("fil").value;
            if (select == "developement digital") {
                document.getElementById("group").innerHTML = "<option>DEV 101</option><option>DEV 102</option>";
            } else if (select == "infrastructure digital") {
                document.getElementById("group").innerHTML = "<option>ID 101</option><option>ID 102</option>";
            } else {
                document.getElementById("group").innerHTML = "<option>GSE 101</option><option>GSE 102</option><option>GSE 103</option>";
            }
        }

        document.getElementById("fil").addEventListener("change", changegroup);
        window.onload = changegroup;
    </script>
</body>
</html>

