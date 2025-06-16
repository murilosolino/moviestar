<?php
require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("globals.php");
require_once("db.php");


$message = new Message($BASE_URL);
$userDAO = new UserDAO($conn, $BASE_URL);


$type = filter_input(INPUT_POST, "type");



if ($type === "update") {

    $userData = $userDAO->verifyToken();

    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $bio = filter_input(INPUT_POST, "bio");

    $user = new User();

    $userData->setName($name);
    $userData->setLastname($lastname);
    $userData->setEmail($email);
    $userData->setBio($bio);

    //upload de image
    if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
        $image = $_FILES["image"];
        $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
        $jpgArr = ["image/jpeg", "image/jpg"];

        //checagem de tipo de imagem
        if (in_array($image["type"], $imageTypes)) {

            if (in_array($image["type"], $jpgArr)) {
                $imageFile = imagecreatefromjpeg($image["tmp_name"]);
            } else {
                $imageFile = imagecreatefrompng($image["tmp_name"]);
            }

            $imageName = $user->imageGeneretaName();
            imagejpeg($imageFile, "./img/users/" . $imageName, 100);

            $userData->setImage($imageName);
        } else {
            $message->setMessage("Tipo invalido de imagem, insira png ou jpg", "error", "index.php");
        }
    }

    $userDAO->update($userData);
} elseif ($type == "changepassword") {

    $password =  filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    $userData = $userDAO->verifyToken();

    $id = $userData->getId();

    if ($password === $confirmpassword) {

        $user = new User();

        $finalPassword = $user->generetedPassword($password);
        $user->setPassword($finalPassword);
        $user->setId($id);

        $userDAO->changePassword($user);
    } else {
        $message->setMessage("As senhas nao sao iguais", "error", "back");
    }
} else {
    $message->setMessage("Informacoes invalidas", "error", "index.php");
}
