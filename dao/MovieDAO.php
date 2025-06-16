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
    public function getLatestMovies() {}
    public function getMoviesByCategory($category) {}
    public function getMoviesByUserID($id) {}
    public function findByID($id) {}
    public function findByTitle($title) {}
    public function create(Movie $movie) {}
    public function update(Movie $movie) {}
    public function destroy($id) {}
}
