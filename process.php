<?php

session_start();
$countries = require './config/countries.php';
$animal_types = require './config/animal_types.php';
require './core/validation.php';

$email = '';
$phone = '';
$country = '';
$animal_type = '';
$animal_name = '';

check_required('email');
check_required('vemail');
check_required('animal_name');
check_email('email');
check_same('vemail', 'email');
check_phone('phone');
check_in_collection('country', 'countries', $countries);
check_animal_type('animal_type', 'animal_types', $animal_types);
// check_min('phone',9); // TO DO !

// REDIRECTION
if (!is_null($_SESSION['errors'])) {
    $_SESSION['old'] = $_REQUEST;
    header('Location: /index.php'); //Redirection en cas d'erreur, on relance la page index.php
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="description">
    <meta name="keywords" content="keywords">
    <meta name="Auhtor" content="auhtor">
    <title>Merci !</title>
</head>
<body>
<h1>Merci&nbsp;!</h1>
<p>J'ai bien reçu les informations !</p>
<dl>
    <div>
        <h2>Informations sur le propriétaire&nbsp;:</h2>
        <div>
            <dt>Votre email&nbsp;:</dt>
            <dd><?= $email; ?></dd>
        </div>

        <div>
            <dt>Votre numéro de téléphone&nbsp;:</dt>
            <dd> <?= $phone; ?></dd>
        </div>

        <div>
            <dt>Pays de résidence&nbsp;:</dt>
            <dd><?= $country; ?></dd>
        </div>
    </div>
    <div>
        <h2>Informations sur l'animal&nbsp;:</h2>
        <div>
            <dt>Type de l'animal&nbsp;:</dt>
            <dd><?= $animal_type; ?></dd>
        </div>
        <div>
            <dt>Nom de l'animal&nbsp;:</dt>
            <dd><?= $animal_name; ?></dd>
        </div>
    </div>
</dl>
</body>
</html>
