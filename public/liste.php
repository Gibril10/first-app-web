<?php

// Charger les fichiers nécessaires via l'autoload de Composer
require_once("../vendor/autoload.php");

// Instancier BDMapper pour récupérer la liste des personnes
$bdMapper = new BDMapper(); // Assurez-vous que BDMapper est bien implémenté
$personnes = $bdMapper->getAll(); // Méthode qui retourne toutes les personnes

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des personnes</title>
</head>
<body>
<h1>Liste des personnes</h1>

<table border="1">
    <thead>
    <tr>
        <th>#id</th>
        <th>Nom</th>
        <th>Téléphone</th>
        <th>Actif</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($personnes as $personne) { ?>
        <tr>
            <td><?= $personne->getId() ?></td>
            <td><?= $personne->getName() ?></td>
            <td><?= $personne->getPhone() ?></td>
            <td><input type="checkbox" <?= $personne->isActif() ? "checked" : "" ?> disabled></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html
