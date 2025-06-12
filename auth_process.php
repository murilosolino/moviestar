<?php

require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("globals.php");
require_once("db.php");


$message = new Message($BASE_URL);

//Verifica o tipo do formulario;

$type = filter_input(INPUT_POST, "type");

if ($type === "register") {
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    // verificacao de dados minimos

    if ($name && $lastname && $email && $password) {
        # code...
    } else {
        $message->setMessage("Por favor preencha todos os campos", "error", "back");
    }
} elseif ($type === "login") {
}
