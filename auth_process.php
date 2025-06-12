<?php

require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("globals.php");
require_once("db.php");


$message = new Message($BASE_URL);
$userDAO = new UserDAO($conn, $BASE_URL);

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

        if ($password === $confirmpassword) {

            //verificar se o email ja esta cadastrado no sistema
            if ($userDAO->findByEmail($email) === false) {
                $user = new User();
                $userToken = $user->generateToken();
                $finalPassword = $user->generetedPassword($password);

                $user->setName($name);
                $user->setLastname($lastname);
                $user->setEmail($email);
                $user->setToken($userToken);
                $user->setPassword($finalPassword);

                $authUser = true;

                $userDAO->create($user, $authUser);
            } else {

                $message->setMessage("Já esxiste um registro com esse email", "error", "back");
            }
        } else {
            $message->setMessage("Senhas não são iguias", "error", "back");
        }
    } else {
        $message->setMessage("Por favor preencha todos os campos", "error", "back");
    }
} elseif ($type === "login") {

    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");

    //Tenta Autenticar Usuario
    if ($userDAO->authUser($email, $password)) {
        $message->setMessage("Bem vindo", "success", "editprofile.php");
    } else {
        $message->setMessage("Usuário ou senha incorretos", "error", "back");
    }
} else {

    $message->setMessage("Informações inválidas!", 'error', 'index.php');
}
