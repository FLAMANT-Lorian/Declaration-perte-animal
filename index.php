<?php
session_start();

$countries = require './config/countries.php'; // Importer d'autre fichier PHP dans un autre
$animal_types = require './config/animal_types.php';
?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="description">
        <meta name="keywords" content="keywords">
        <meta name="Auhtor" content="auhtor">
        <title>Formulaire de délcaration de perte d'animal</title>
        <link rel="stylesheet" href="/css/style.css">
        <script src="/js/main.js" defer></script>
    </head>
    <body>
    <h1>Déclaration de la perte de mon animal</h1>
    <form method="post" action="/process.php">    <!--Chemin absolue de puis la racine du serveur-->
        <fieldset>
            <legend>Vos coordonnées</legend>
            <div class="fields_rows">
                <div>
                    <label for="email" class="required">Email</label>
                    <input type="email"
                           id="email"
                        <?php if (isset($_SESSION['old']['email'])): ?>
                            value="<?= $_SESSION['old']['email']; ?>"
                        <?php endif; ?>
                           name="email" placeholder="placeholder">
                </div>
                <?php if (isset($_SESSION['errors']['email'])): ?>
                    <div>
                        <p><?= $_SESSION['errors']['email']; ?></p>
                    </div>
                <?php endif; ?>
                <div>
                    <label for="vemail" class="required">Vérification de l'email</label>
                    <input type="email"
                           id="vemail"
                        <?php if (isset($_SESSION['old']['vemail'])): ?>
                            value="<?= $_SESSION['old']['vemail']; ?>"
                        <?php endif; ?>
                           name="vemail" placeholder="placeholder">
                </div>
                <?php if (isset($_SESSION['errors']['vemail'])): ?>
                    <div>
                        <p><?= $_SESSION['errors']['vemail']; ?></p>
                    </div>
                <?php endif; ?>

                <div>
                    <label for="phone">Téléphone</label>
                    <input type="tel"
                           id="phone"
                        <?php if (isset($_SESSION['old']['phone'])): ?>
                            value="<?= $_SESSION['old']['phone']; ?>"
                        <?php endif; ?>
                           name="phone"
                           placeholder="0499 10 10 10">
                </div>
                <?php if (isset($_SESSION['errors']['phone'])): ?>
                    <div>
                        <p><?= $_SESSION['errors']['phone']; ?></p>
                    </div>
                <?php endif; ?>

                <div>
                    <label for="country">Pays</label>
                    <select name="country" id="country">
                        <?php foreach ($countries as $code => $country): ?>
                            <option value="<?= $code; ?>"
                                <?php if (isset($_SESSION['old']['country']) && $_SESSION['old']['country'] === $code): ?>
                                    selected
                                <?php endif; ?>
                            ><?= $country; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php if (isset($_SESSION['errors']['country'])): ?>
                    <div>
                        <p><?= $_SESSION['errors']['country']; ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </fieldset>
        <fieldset>
            <legend>Description de l'animal perdu</legend>
            <div class="fields_rows">
                <div>
                    <label for="animal_type">Type d'animal</label>
                    <select name="animal_type" id="animal_type">
                        <?php foreach ($animal_types as $type => $animal_type): ?>
                            <option value="<?= $type; ?>"
                                <?php if (isset($_SESSION['old']['animal_type']) && $_SESSION['old']['animal_type'] === $type): ?>
                                    selected
                                <?php endif; ?>
                            ><?= $animal_type; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php if (isset($_SESSION['errors']['animal_type'])): ?>
                    <div>
                        <p><?= $_SESSION['errors']['animal_type']; ?></p>
                    </div>
                <?php endif; ?>
                <div>
                    <label for="animal_name" class="required">Nom de l'animal</label>
                    <input type="text" name="animal_name" id="animal_name"
                        <?php if (isset($_SESSION['old']['animal_name'])): ?>
                            value="<?= $_SESSION['old']['animal_name']; ?>"
                        <?php endif; ?>
                           placeholder="Rex">
                </div>
                <?php if (isset($_SESSION['errors']['animal_name'])): ?>
                    <div>
                        <p><?= $_SESSION['errors']['animal_name']; ?></p>
                    </div>
                <?php endif; ?>
                <div>
                    <label for="puce">Puce (Obligatoire si chien)</label>
                    <input type="text" id="puce" name="chip" placeholder="1234567890">
                </div>
                <div>
                    <span>Sexe</span>
                    <input type="radio" id="male" value="male">
                    <label for="male">Mâle</label>
                    <input type="radio" id="female" value="female">
                    <label for="female">Femelle</label>
                </div>
                <div>
                    <label for="age">Âge (estimation)</label>
                    <input type="number" id="age" name="age" placeholder="5" min="0" max="100">
                </div>
                <div>
                    <label for="breed">Race</label>
                    <input type="text" id="breed" placeholder="Caniche">
                </div>
                <div class="tattoo_row">
                    <label for="tattoo">Tatouage</label>
                    <select name="tatoo" id="tattoo">
                        <option value="left-ear">oreille gauche</option>
                        <option value="right-ear">oreille droite</option>
                    </select>
                    <label for="tattoo-code">Code tatouage</label>
                    <input type="text" id="tattoo-code" name="tattoo-code" placeholder="B999AA">
                </div>
                <div class="textarea_row">
                    <label for="description">Description / Signes particuliers</label>
                    <textarea name="description" id="description" cols="30" rows="20"></textarea>
                </div>
                <div>
                    <label for="animal-picture">Photo de l'animal</label>
                    <input type="file" name="animal_picture" id="animal-picture"
                           accept="image/gif, image/jpg, image/png">
                </div>
            </div>
        </fieldset>
        <!--<fieldset>
             <legend>Date et localité de la perte</legend>
             <div class="fields_rows">
                 <div>
                     <label for="disparition-date">Date</label>
                     <input type="date" id="disparition-date" name="disparition-date">
                 </div>
                 <div>
                     <label for="disparition-hour">Heure</label>
                     <input type="time" id="disparition-hour" name="disparition-hour">
                 </div>
                 <div>
                     <label for="postal-code">Code postal</label>
                     <input type="text" id="postal-code" name="postal-code" placeholder="4000">
                 </div>
                 <div>
                     <label for="disparition-country">Pays</label>
                     <select name="disparition-country" id="disparition-country">
                         <option value="be">Belgique</option>
                         <option value="fr">France</option>
                         <option value="de">Allemagne</option>
                         <option value="ne">Pays-bas</option>
                     </select>
                 </div>
             </div>
         </fieldset>-->
        <input type="submit" value="Déclarer la disparation de mon animal">
        <!--Quand je click sur le bouton, je fais une requête PHP-->
    </form>
    </body>
    </html>

<?php
$_SESSION['errors'] = null;
$_SESSION['old'] = null;