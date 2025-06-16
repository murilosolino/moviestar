<?php
require_once("models/Movie.php");
require_once("models/Message.php");
require_once("dao/MovieDAO.php");
require_once("dao/UserDAO.php");
require_once("globals.php");
require_once("db.php");

$message = new Message($BASE_URL);
$userDAO = new UserDAO($conn, $BASE_URL);
$movieDAO = new MovieDAO($conn, $BASE_URL);

$type = filter_input(INPUT_POST, "type");
$userData = $userDAO->verifyToken();

if ($type === "create") {

    $title = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');
    $trailer = filter_input(INPUT_POST, 'trailer');
    $category = filter_input(INPUT_POST, 'category');
    $length = filter_input(INPUT_POST, 'length');



    $movie = new Movie();

    //validacao de dados
    if (!empty($title) && !empty($description) && !empty($category)) {

        $movie->setTitle($title);
        $movie->setCategory($category);
        $movie->setDescription($description);
        $movie->setTrailer($trailer);
        $movie->setLength($length);
        $movie->setUser_id($userData->getId());

        //upload de imagem do filme
        if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

            $image = $_FILES["image"];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArr = ["image/jpeg", "image/jpg"];

            if (in_array($image["type"], $imageTypes)) {

                if (in_array($image["type"], $jpgArr)) {
                    $imageFile = imagecreatefromjpeg($image["tmp_name"]);
                } else {
                    $imageFile = imagecreatefrompng($image["tmp_name"]);
                }

                $imageName = $movie->imageGeneretaName();

                imageJpeg($imageFile, "./img/movies/" . $imageName, 100);

                $movie->setImage($imageName);
            } else {
                $message->setMessage("Tipo invalido de imagem, insira png ou jpg", "error", "index.php");
            }
        }

        $movieDAO->create($movie);
    } else {
        $message->setMessage("Necessário título, descrição e categoria", "error", "back");
    }
} else {
    $message->setMessage("Informacoes invalidas", "error", "index.php");
}
