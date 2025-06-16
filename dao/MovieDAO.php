<?php
require_once("models/Movie.php");
require_once("models/Message.php");
//Rewiew DAO


class MovieDAO implements MovieDaoInterface
{

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url)
    {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildMovie($data)
    {
        $movie = new Movie();
        $movie->setId($data['id'] ?? null);
        $movie->setTitle($data['title'] ?? '');
        $movie->setDescription($data['description'] ?? '');
        $movie->setTrailer($data['trailer'] ?? '');
        $movie->setImage($data['image'] ?? '');
        $movie->setCategory($data['category'] ?? '');
        $movie->setLength($data['length'] ?? '');
        $movie->setUser_id($data['user_id'] ?? null);

        return $movie;
    }
    public function findAll() {}

    public function getLatestMovies()
    {

        $movies = [];
        $stmt = $this->conn->query("SELECT * FROM movies ORDER BY id DESC");
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $moviesArray = $stmt->fetchAll();

            foreach ($moviesArray as $movie) {
                $movies[] = $this->buildMovie($movie);
            }
        }

        return $movies;
    }

    public function getMoviesByCategory($category)
    {
        $movies = [];
        $stmt = $this->conn->prepare("SELECT * FROM movies WHERE category = :category ORDER BY id DESC");
        $stmt->bindParam(':category', $category);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $moviesArray = $stmt->fetchAll();

            foreach ($moviesArray as $movie) {
                $movies[] = $this->buildMovie($movie);
            }
        }

        return $movies;
    }
    public function getMoviesByUserID($id) {}
    public function findByID($id) {}
    public function findByTitle($title) {}
    public function create(Movie $movie)
    {
        $stmt = $this->conn->prepare("INSERT INTO movies (
        title, description, image, trailer, category, length, user_id
        ) VALUES (
            :title, :description, :image, :trailer, :category, :length, :user_id
        )");

        $title = $movie->getTitle();
        $description = $movie->getDescription();
        $image = $movie->getImage();
        $trailer = $movie->getTrailer();
        $category = $movie->getCategory();
        $length = $movie->getLength();
        $user_id = $movie->getUser_id();

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':trailer', $trailer);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':length', $length);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        $this->message->setMessage("Filme adicionado com sucesso!", "success", "index.php");
    }
    public function update(Movie $movie) {}
    public function destroy($id) {}
}
