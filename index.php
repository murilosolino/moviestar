<?php
require_once("templates/header.php");

require_once("dao/MovieDAO.php");

//DAO dos filmes
$movieDAO = new MovieDAO($conn, $BASE_URL);

$latestMovies = $movieDAO->getLatestMovies();
$acctionMovies = $movieDAO->getMoviesByCategory("Ação");
$comedyMovies = $movieDAO->getMoviesByCategory("Comédia");
print_r($latestMovies);
?>

<div id="main-container" class="conteiner-fluid">
    <h2 class="dection-title">Filmes novos</h2>
    <p class="section-description">Veja as criticas dos últimos filems adicionados ao MovieStar</p>
    <div class="movies-container">
        <?php foreach ($latestMovies as $movie): ?>
            <?php
            require("templates/movie_card.php");
            ?>
        <?php endforeach; ?>
        <?php if (count($latestMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes cadastrados</p>
        <?php endif; ?>
    </div>

    <h2 class="dection-title">Ação</h2>
    <p class="section-description">Veja os melhores filmes de ação</p>
    <div class="movies-container">
        <?php foreach ($acctionMovies as $movie): ?>
            <?php
            require("templates/movie_card.php");
            ?>
        <?php endforeach; ?>
        <?php if (count($acctionMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes cadastrados nesta seção</p>
        <?php endif; ?>
    </div>

    <h2 class="dection-title">Comédia</h2>
    <p class="section-description">Veja os melhores filmes de comédia</p>
    <div class="movies-container">
        <?php foreach ($comedyMovies as $movie): ?>
            <?php
            require("templates/movie_card.php");
            ?>
        <?php endforeach; ?>
        <?php if (count($comedyMovies) === 0): ?>
            <p class="empty-list">Ainda não há filmes cadastrados nesta seção</p>
        <?php endif; ?>
    </div>
</div>

<?php
require_once("templates/footer.php");
?>