<?php


require_once("models/User.php");

class UserDAO implements UserDAOInterface
{

    private PDO $conn;
    private string $url;

    public function __construct(PDO $conn, string $url)
    {
        $this->conn = $conn;
        $this->url = $url;
    }

    public function buildUser(array $data)
    {
        $user  = new User(
            $data["id"],
            $data["name"],
            $data["lastname"],
            $data["email"],
            $data["password"],
            $data["image"],
            $data["bio"],
            $data["token"]
        );

        return $user;
    }
    public function create(User $user, bool $authUser = false) {}
    public function update(User $user) {}
    public function verifyToken(bool $protected = false) {}
    public function setTokenSession(string $token, bool $redirect =  true) {}
    public function authUser(string $email, string $password) {}
    public function findByEmail(string $email) {}
    public  function findById(int $id) {}
    public function findByToken(string $token) {}
}
