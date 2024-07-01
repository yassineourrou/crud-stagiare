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
    <form action="supprimer_stagiaire.php" class="fsupp" method="POST">
        <p>SUPPRIMER</p>
        <select name="cne" id="">
        <?php
            $conn = conection();
            $sql = $conn->prepare("SELECT cne FROM stagiaires");
            $sql->execute();
            $cne = $sql->fetchAll();
            foreach($cne as $value){
                echo"<option>".$value['cne']."</option>";
            }
        ?>
        <input type="submit" class="btn" value="SUPPRIMER">
        <p class="missage">
            <?php
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $cne = $_POST["cne"];
                    $sql = $conn->prepare("DELETE FROM stagiaires WHERE cne = ?");
                    $sql->execute([$cne]);
                    echo "La suppression a réussi";
                }        
            ?>
        </p>
    </form>
    </div>
</body>
</html>
