<?php
require './vendor/autoload.php';
use Tecgdcs\Validator;

session_start();

$_SESSION['errors'] = null;
$_SESSION['old'] = null;

$countries = require './config/countries.php';
$messages = require './lang/fr/validation.php';
$animal_types = require './config/animal_types.php';

$email = '';
$phone = '';
$country = '';
$animal_type = '';
$animal_name = '';@


Validator::check([
   'email' => 'required|email',
   'vemail' => 'required|same:email',
    'animal_name' => 'required',
    'phone' => 'phone',
    'country' => 'in_collection:countries',
    'animal_types' => 'in_collection:animal_types',
]);
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
