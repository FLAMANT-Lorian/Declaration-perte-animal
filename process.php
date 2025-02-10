<?php
session_start(); // Créer l'identifiant lié a nos cookies, pour nous reconaitre ! A faire dans toutes les pages ou on a besoin des données de session !!!

$email = '';
$vemail = '';
$tel = '';
$country = '';
if (array_key_exists('email', $_REQUEST)) {
    $email = trim($_REQUEST['email']); //Le trim pour éviter d'avoir des espaces
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors']['email'] = 'L’email proposé n’est pas valide';
    }
} else {
    $_SESSION['errors']['email'] = 'L’email devrait être fourni !';
}


if (array_key_exists('vemail', $_REQUEST)) {
    $vemail = trim($_REQUEST['vemail']); //Le trim pour éviter d'avoir des espaces
    if ($email !== $vemail) {
        $_SESSION['errors']['vemail'] = 'La vérification de l’email a échoué';
    }
} else {
    $_SESSION['errors']['vemail'] = 'Vous devez répéter votre email';
}


if (array_key_exists('tel', $_REQUEST)) {
    $tel = trim($_REQUEST['tel']);
    if (!is_numeric($tel)) { // Tester si on a une chaine numérique
        $_SESSION['errors']['tel'] = 'Vous devez entrer un numéro de téléphone Belge !';
    }
} else {
    $_SESSION['errors']['tel'] = 'Vous devez entrer un numéro de téléphone';
}

$country_references = ['be' => 'Belgique', 'fr' => 'France', 'de' => 'Allamgne', 'ne' => 'Pays-Bas'];

if (array_key_exists('country', $_REQUEST)) {
    $country = $_REQUEST['country'];
    foreach ($country_references as $initiales => $country_reference) {
        if ($country !== $initiales) { // Trouver pour vérifier !!
            $_SESSION['errors']['country'] = 'Pays non valide !';
        }
    }
} else {
    $_SESSION['errors']['country'] = 'Veuillez séléctionner un pays !';
}


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
        <dt>Email&nbsp;:</dt>
        <dd><?= $email; ?></dd>
        <dt>Téléphone&nbsp;:</dt>
        <dd><?= $tel; ?></dd>
        <dt>Pays&nbsp;:</dt>
        <dd><?= $country; ?></dd>
    </div>
</dl>
</body>
</html>
