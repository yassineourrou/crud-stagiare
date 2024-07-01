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
    <form action="modifier_stagiaire.php"  method="POST">
        <p>MODIFIER</p>
        <select name="cne">
        <?php
            $conn = conection();
            $sql = $conn->prepare("SELECT cne FROM stagiaires");
            $sql->execute();
            $cne = $sql->fetchAll();
            foreach($cne as $value){
                echo"<option>".$value['cne']."</option>";
            }
        ?>
        </select>
        <input type="text" name="nom" placeholder="NOM">
        <input type="text" name="prenom" placeholder="PRENOM">
        <div class="select">
        <label for="" class="labeldate">DATE NAISSANCE:</label><input class="inputdate" type="date" name="daten" >
        </div>
        <fieldset>
            <legend>SEXE</legend>
            <input type="radio" class="radiobtn" name="sexe" value="homme"><label for="sexe">homme</label> 
            <input type="radio" class="radiobtn" name="sexe" value="femme"><label for="sexe">femme</label>
        </fieldset>
        <div class="select">
        <label for="">FILIERE:</label><select class="filslect selectdif" name="filiere" id="fil">
            <option value="developement digital">developement digital</option>
            <option value="infrastructure digital">infrastructure digital</option>
            <option value="gestion des entreprises">gestion des entreprises</option>
        </select>
        <label for="groupe">GROUPE:</label><select class="selectdif" name="groupe" id="group"></select></div>
        <input type="submit" class="btn" value="MODIFIER">
        <p class="missage">
        <?php
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $cne = $_POST["cne"];
                    $nom = $_POST["nom"];
                    $prenom = $_POST["prenom"];
                    $daten = $_POST["daten"];
                    @$sexe = $_POST["sexe"];
                    $filiere = $_POST["filiere"];
                    $groupe = $_POST["groupe"];
                    if(empty($cne) or empty($nom) or empty($prenom) or empty($daten) or 
                        empty($sexe) or empty($filiere) or empty($groupe)){
                        echo "Entrez toutes les informations s'il vous plaît!";
                    }elseif(!empty($cne) and !empty($nom) and !empty($prenom) and !empty($daten) and 
                        !empty($sexe) and !empty($filiere) and !empty($groupe)){
                        $sql = $conn->prepare("UPDATE stagiaires SET nom = ?, prenom = ?, daten = ?, sexe = ?, filiere = ?, groupe = ? WHERE cne = ?");
                        $sql->execute([$nom,$prenom,$daten,$sexe,$filiere,$groupe,$cne]);
                        echo "Les informations ont été modifier avec succès!";
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


