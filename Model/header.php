<?php 
require_once 'session.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="Assets/css/index.css">
    
    <title>Clément Coach Pilates</title>
</head>
<body>
    <header>
        <img class="logo" src='Assets/img/logo.png' alt="Logo"/>

<?php
   if($_SESSION["user"]){
        if($_SESSION["name"] === 'Admin' && $_SESSION["email"] === 'clementcoach@pilates.com'){
            echo ("<a href='logout.php'>Déconnexion</a>");
            echo ("<a href='admin.php'>Gérer mes créneaux</a>");
            echo ("<a href='newReservation.php'>Ajouter un nouveau créneau</a>");
            echo ("<a href='hostingProposition.php'>Propositions de créneau</a>");
        } else {
            echo ("<a href='logout.php'>Déconnexion</a>");
            $name = ucfirst($_SESSION['name']);
            echo ("<a href='userProfil.php'>Bienvenue $name</a>");
            $host = "<a href='welcomeCourse.php'>Accueillir un cours</a>";
        }
    } else {
        echo ("<a href='./connexion.php'>Se Connecter</a>");
    }
?>
    </div>
    </header>

    <nav class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="Course.php">Cours</a></li>
            <li><a href="calendar.php">Calendrier</a></li>
            <li><?= $host ?></li>
        </ul>
    </nav>

    <main>