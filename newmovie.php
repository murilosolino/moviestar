<?php
require_once("templates/header.php");

//Verifica se usuario esta auutenticado
require_once("models/User.php");
require_once("dao/UserDAO.php");

$user = new User();
$userDao = new UserDAO($conn, $BASE_URL);
$userData = $userDao->verifyToken(true);

$fullName = $user->getFullName($userData);

if ($userData->getImage() == "") {
    $userData->setImage("user.png");
}
?>

<div id="main-container" class="conteiner-fluid">
    <div class="offset-md-4 col-md-4 new-movie-container">
        <h1 class="page-title">Adicionar Filme</h1>
        <p class="page-description">Adicone sua crítia e compartilhe com o mundo</p>
        <form action="<?= $BASE_URL ?>movie_process.php" id="add-movie-form" method="post" enctype="multipart/form-data">
            <input type="hidden" name="type" value="create">
            <div class="form-group">
                <label for="title">Título:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Digite o título do seu filme">
            </div>
            <div class="form-group">
                <label for="image">Capa:</label>
                <input type="file" class="form-control-file" id="image" name="image" placeholder="Adicione uma imagem para servir de capa ao filme">
            </div>
            <div class="form-group">
                <label for="length">Duração:</label>
                <input type="text" class="form-control" id="length" name="length" placeholder="Digite a duração do filme">
            </div>
            <div class="form-group">
                <label for="category">Categoria:</label>
                <select name="category" id="category" class="form-control">
                    <option value="">Selecione</option>
                    <option value="Ação">Ação</option>
                    <option value="Drama">Drama</option>
                    <option value="Comédia">Comédia</option>
                    <option value="Ficção">Ficção</option>
                    <option value="Romance">Romance</option>
                </select>
            </div>
            <div class="form-group">
                <label for="trailer">Trailer:</label>
                <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insira o link do trailer">
            </div>
            <div class="form-group">
                <label for="length">Descrição:</label>
                <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descreva o filme"></textarea>
            </div>
            <input type="submit" class="btn card-btn" value="Adicionar Filme">
        </form>
    </div>
</div>

<?php
require_once("templates/footer.php");
?>