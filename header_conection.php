<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>gestion des stagiaires</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">
</head>
<body>
    <header class="head_style">
        <img src="img/images.png" alt="logo">
        <p>gestion des stagiaires</p>
    </header>
    <nav class="nav_style">
            <a href="index.php">Accueille</a>
            <a href="ajouter_stagiaire.php">Ajouter un Stagiaire</a>
            <a href="modifier_stagiaire.php">Modifier un Stagiaire</a>
            <a href="rechercher_stagiaires.php">Rechercher un Stagiaire</a>
            <a href="supprimer_stagiaire.php">Supprimer un Stagiaire</a>
    </nav>
    <div class="fouter">
    <p>droits d'auteur ©</p> <p>2024 tous droits réservés</p> |<p>gestion des stagiaires</p>
    </div>
</body>
</html>
<?php
 function conection(){
    $pdo = new PDO("mysql:host=localhost;dbname=mysql","root","");
    
    $sql = "CREATE DATABASE IF NOT EXISTS db_stagiaires";
    $pdo->exec($sql);

    $sql = "use db_stagiaires;";
    $pdo->exec($sql);

    $sql = "CREATE TABLE IF NOT EXISTS stagiaires(
     cne varchar(20) PRIMARY KEY,
     nom varchar(30) not null,
     prenom varchar(30) not null,
     daten date not null,
     sexe varchar(20) not null,
     filiere varchar(20) not null,
     groupe varchar(20) not null
     )";
    $pdo->exec($sql);
    
    return $pdo;
 }
 ?>