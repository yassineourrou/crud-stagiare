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
    <div class="contener">
    <form action="ajouter_stagiaire.php" id="myForm" method="POST">
        <p>AJOUTER</p>
        <input type="text"  name="cne" placeholder="CNE">
        <input type="text" name="nom" placeholder="NOM">
        <input type="text" name="prenom" placeholder="PRENOM">
        <div class="select">
        <label for="" class="labeldate">DATE NAISSANCE:</label><input class="inputdate" type="date" name="daten">
        </div>
        <fieldset>
            <legend>sexe</legend>
            <input type="radio" class="radiobtn" name="sexe" value="homme"><label for="sexe">HOMME</label> 
            <input type="radio" class="radiobtn" name="sexe" value="femme"><label for="sexe">FEMME</label>
        </fieldset>
        <div class="select">
        <label for="">FILIERE:</label><select class="selectdif filslect" name="filiere" id="fil">
            <option value="developement digital">developement digital</option>
            <option value="infrastructure digital">infrastructure digital</option>
            <option value="gestion des entreprises">gestion des entreprises</option>
        </select>
        <label for="groupe">GROUPE:</label><select class="selectdif" name="groupe" id="group"></select></div>
        <input type="submit" class="btn" value="AJOUTER">
        <p class="missage">
        <?php
                $conn = conection();
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $sql = $conn->prepare("SELECT cne FROM stagiaires");
                    $sql->execute();
                    $info = $sql->fetchAll(PDO::FETCH_ASSOC);
                    $cne = $_POST["cne"];
                    $nom = $_POST["nom"];
                    $prenom = $_POST["prenom"];
                    $daten = $_POST["daten"];
                    @$sexe = $_POST["sexe"];
                    $filiere = $_POST["filiere"];
                    $groupe = $_POST["groupe"];
                    $virification = true;
                    foreach($info as $value){
                        if($value["cne"]==$cne){
                            $virification = false;
                        }
                    }
                    if(empty($cne) or empty($nom) or empty($prenom) or empty($daten) or 
                    empty($sexe) or empty($filiere) or empty($groupe)){
                        echo "Entrez toutes les informations s'il vous plaît!";
                    }elseif($virification==false){
                        echo "Le cne saisi existe déjà!";
                    }elseif(!empty($cne) and !empty($nom) and !empty($prenom) and !empty($daten) and 
                    !empty($sexe) and !empty($filiere) and !empty($groupe)){
                        $sql = $conn->prepare("INSERT INTO stagiaires VALUES(?,?,?,?,?,?,?)");
                        $sql->execute([$cne,$nom,$prenom,$daten,$sexe,$filiere,$groupe]);
                        echo "Les informations ont été ajoutées avec succès!";
                    } 
                }
            ?>
        </p>
    </form>
</div>
    <script>
        function changegroup(){
        var select = document.getElementById("fil").value;
        if (select == "developement digital"){
            document.getElementById("group").innerHTML="<option> DEV 101 </option>"+"<option> DEV 102 </option>";
        }
        else if(select == "infrastructure digital"){
            document.getElementById("group").innerHTML="<option> ID 101 </option>"+"<option> ID 102 </option>";
        }
        else{
            document.getElementById("group").innerHTML="<option> GSE 101 </option>"+"<option> GSE 102 </option>"+"<option> GSE 103 </option>";
        }}
        document.getElementById("fil").addEventListener("change",changegroup);
        window.onload = changegroup;
       
    </script>
</body>
</html>
