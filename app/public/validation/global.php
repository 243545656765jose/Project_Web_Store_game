<?php

function validate_username($username)
{
    if (empty($username)) {
        return 'Debes ingresar un nombre de usuario.';
    } elseif (strlen($username) < 3 || strlen($username) > 30) {
        return 'El nombre de usuario debe tener  mas de 3 dijitos.';
    } elseif (preg_match('/\d/', $username)) {
        return 'El nombre de usuario no debe contener números.';
    }
    return null;
}

function validate_email($email)
{
    if (empty($email)) {
        return 'El correo electrónico es requerido.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 'El correo electrónico no es válido.';
    }
    return null;
}

function validate_password($password)
{
    if (empty($password)) {
        return 'La contraseña es requerida.';
    } elseif (strlen($password) <= 8) {
        return 'La contraseña debe tener más de 8 caracteres.';
    }
    return null;
}
