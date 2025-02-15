<?php

session_start();
$countries = require './config/countries.php';
require './core/validation.php';

$email = '';
$phone = '';
$country = '';

check_required('email');
check_required('vemail');
check_email('email');
check_same('vemail', 'email');
check_phone('phone');
check_in_collection('country', 'countries', $countries);
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
</dl>
</body>
</html>
