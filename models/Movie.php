<?php


class Movie
{

    private $id;
    private $title;
    private $description;
    private $image;
    private $trailer;
    private $category;
    private $length;
    private $user_id;


    public function __construct($data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->title = $data['title'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->image = $data['image'] ?? null;
        $this->trailer = $data['trailer'] ?? null;
        $this->category = $data['category'] ?? null;
        $this->length = $data['length'] ?? null;
        $this->user_id = $data['users_id'] ?? null;
    }



    public function imageGeneretaName()
    {
        return bin2hex(random_bytes(50)) . "jpg";
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
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
     * Get the value of trailer
     */
    public function getTrailer()
    {
        return $this->trailer;
    }

    /**
     * Set the value of trailer
     *
     * @return  self
     */
    public function setTrailer($trailer)
    {
        $this->trailer = $trailer;

        return $this;
    }

    /**
     * Get the value of category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the value of length
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set the value of length
     *
     * @return  self
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get the value of users_id
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of users_id
     *
     * @return  self
     */
    public function setUser_id($users_id)
    {
        $this->user_id = $users_id;

        return $this;
    }
}

interface MovieDaoInterface
{
    public function buildMovie($data);
    public function findAll();
    public function getLatestMovies();
    public function getMoviesByCategory($category);
    public function getMoviesByUserID($id);
    public function findByID($id);
    public function findByTitle($title);
    public function create(Movie $movie);
    public function update(Movie $movie);
    public function destroy($id);
}
