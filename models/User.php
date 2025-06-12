<?php
class User
{

    private ?int $id;
    private string $name;
    private string $lastname;
    private string $email;
    private string $password;
    private string $image;
    private string $bio;
    private string $token;

    public function __construct(
        ?int $id = null,
        string $name = "",
        string $lastname = "",
        string $email = "",
        string $password = "",
        string $image = "",
        string $bio = "",
        string $token = ""
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->image = $image;
        $this->bio = $bio;
        $this->token = $token;
    }


    public function generateToken()
    {
        return bin2hex(random_bytes(50));
    }

    public function generetedPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of bio
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set the value of bio
     *
     * @return  self
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get the value of token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }
}

interface UserDAOInterface
{

    public function buildUser(array $data);
    public function create(User $user, bool $authUser = false);
    public function update(User $user);
    public function verifyToken(bool $protected = false);
    public function setTokenSession(string $token, bool $redirect =  true);
    public function authUser(string $email, string $password);
    public function findByEmail(string $email);
    public  function findById(int $id);
    public function findByToken(string $token);
    public function destroyToken();
}
