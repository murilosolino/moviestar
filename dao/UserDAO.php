<?php

require_once("models/User.php");
require_once("models/Message.php");


class UserDAO implements UserDAOInterface
{
    private PDO $conn;
    private string $url;
    private $message;

    public function __construct(PDO $conn, string $url)
    {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildUser(array $data)
    {
        $user  = new User(
            $data["id"] ?? null,
            $data["name"] ?? "",
            $data["lastname"] ?? "",
            $data["email"] ?? "",
            $data["password"] ?? "",
            $data["image"] ?? "",
            $data["bio"] ?? "",
            $data["token"] ?? ""
        );

        return $user;
    }

    public function create(User $user, bool $authUser = false)
    {
        $stmt = $this->conn->prepare("INSERT INTO users(
            name, lastname, email, password, token)
        VALUES (
            :name, :lastname, :email, :password, :token)");

        $name = $user->getName();
        $lastname = $user->getLastname();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $token = $user->getToken();

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":lastname", $lastname);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":token", $token);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            if ($authUser) {
                $this->setTokenSession($token, $redirect = true);
            }
        } else {
            $this->message->setMessage("Erro ao cadastrar usuário no banco de dados.", "error", "back");
        }
    }

    public function update(User $user) {}

    public function verifyToken(bool $protected = false)
    {

        if (!empty($_SESSION["token"])) {

            $token = $_SESSION["token"];
            $user = $this->findByToken($token);

            if ($user) {
                return $user;
            } else if ($protected) {
                $this->message->setMessage("Faça a auntenticação para acessar esta página!", "error", "index.php");
            }
        } else if ($protected) {
            $this->message->setMessage("Faça a auntenticação para acessar esta página!", "error", "index.php");
        }
    }

    public function setTokenSession(string $token, bool $redirect =  true)
    {
        // Salvar token na session

        $_SESSION["token"] = $token;

        if ($redirect) {
            //redireciona para o id do usuario;
            $this->message->setMessage("Seja bem-vindo!", "success", "editprofile.php");
        }
    }

    public function authUser(string $email, string $password) {}
    public function findByEmail(string $email)
    {

        if (!empty($email)) {

            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $user = $this->buildUser($data);

                return  $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public  function findById(int $id) {}

    public function findByToken(string $token)
    {

        if (!empty($token)) {

            $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");
            $stmt->bindParam(":token", $token);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $user = $this->buildUser($data);

                return  $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function destroyToken()
    {
        $_SESSION["token"] = "";

        $this->message->setMessage("Logout realizado com sucesso", "success", "index.php");
    }
}
