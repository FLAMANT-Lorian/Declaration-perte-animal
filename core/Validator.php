<?php

namespace Tecgdcs; // Espace de nom


class Validator
{
    public static function required(string $field_name): bool // Valeur d'entrer 'string' et valeur de retour 'booleen'
    {
        global $messages; // Pour rendre la variable $messages disponible dans le scope de la fonction
        if (!array_key_exists($field_name, $_REQUEST)) {
            $_SESSION['errors'][$field_name] = sprintf($messages['required'], $field_name);
            return false;
        }

        if (trim($_REQUEST[$field_name]) === '') {
            $_SESSION['errors'][$field_name] = sprintf($messages['required'], $field_name);
            return false;
        }
        return true;
    }

    public static function email(string $field_name): bool
    {
        if (array_key_exists($field_name, $_REQUEST) && trim($_REQUEST[$field_name]) !== '') {
            if (!filter_var(trim($_REQUEST[$field_name]), FILTER_VALIDATE_EMAIL)) {
                global $messages;
                $_SESSION['errors'][$field_name] = sprintf($messages['email'], $field_name);
                return false;
            }
        }
        return true;
    }

    public static function phone(string $field_name): bool
    {
        if (array_key_exists($field_name, $_REQUEST) &&
            trim($_REQUEST[$field_name]) !== '' &&
            (strlen(trim($_REQUEST[$field_name])) < 9 ||
                !is_numeric(str_replace(['+', '(', ')', ' '], '', $_REQUEST[$field_name])))
        ) {
            global $messages;
            $_SESSION['errors'][$field_name] = sprintf($messages['phone'], $field_name);
            return false;
        }
        return true;
    }

    public static function same(string $verification_field_name, string $original_field_name): bool
    {
        global $messages;
        if (array_key_exists($original_field_name, $_REQUEST) &&
            array_key_exists($verification_field_name, $_REQUEST)) {
            if (trim($_REQUEST[$original_field_name]) !== trim($_REQUEST[$verification_field_name])) {
                $_SESSION['errors'][$verification_field_name] = sprintf($messages['same'], $verification_field_name, $original_field_name);
                return false;
            }
            return true;
        }
        return false;
    }

    public static function in_collection(string $field_name, string $collection_name, array $collection): bool
    {
        global $messages;
        if (array_key_exists($field_name, $_REQUEST) &&
            trim($_REQUEST[$field_name]) !== '' &&
            !array_key_exists($_REQUEST[$field_name], $collection)) {
            $_SESSION['errors'][$field_name] = sprintf($messages['in_collection'], $_REQUEST[$field_name], $collection_name);
            return false;
        }
        return true;
    }

    public static function check(array $rules)
    {

        self::parse_constraints($rules);
        // Analyser les contraintes de l'array
        // À partir de cette analyse, on va appeler les méthodes de validation correspondantes


        // REDIRECTION
        if (!is_null($_SESSION['errors'])) {
            $_SESSION['old'] = $_REQUEST;
            header('Location: /index.php'); //Redirection en cas d'erreur, on relance la page index.php
            exit;
        }
    }

    private static function parse_constraints(array $rules)
    {
        //
    }
}
