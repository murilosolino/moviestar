<?php
require_once("templates/header.php");
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

<div id="main-container" class="conteiner-fluid edit-profile-page">
    <div class="col-md-12">
        <form action="<?= $BASE_URL ?>user_process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="row">
                <div class="col-md-4">
                    <h1><?= $fullName ?></h1>
                    <p class="page-description">Altere seus dados no fomrulario abaixo:</p>
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="digite seu nome" value="<?= $userData->getName() ?>">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Sobrenome</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="digite seu sobrenome" value="<?= $userData->getLastname() ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="text" readonly class="form-control disabled" name="email" id="email" placeholder="digite seu email" value="<?= $userData->getEmail() ?>">
                    </div>
                    <input type="submit" class="btn card-btn" value="Alterar">
                </div>
                <div class="col-md-4">
                    <div id="profile-image-container" style="background-image: url(<?= $BASE_URL ?>img/users/<?= $userData->getImage() ?>)">
                    </div>
                    <div class="form-group">
                        <label for="image">Foto:</label>
                        <input type="file" readonly class="form-control file" name="image">
                    </div>
                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea class="form-control" name="bio" id="bio" rows="5" placeholder="Fale sobre você"><?= $userData->getBio() ?></textarea>
                    </div>
                </div>
            </div>
        </form>
        <div class="row" id="change-password-container">
            <div class="col-md-4">
                <h2>Alterar a senha:</h2>
                <p class="page-description">Digite a nova senha e confirme para alterar sua senha</p>
                <form action="<?= $BASE_URL ?>user_process.php" method="post">
                    <input type="hidden" name="type" value="changepassword">
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="digite sua nova senha">
                    </div>
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirme sua nova senha">
                    </div>
                    <input type="submit" class="btn card-btn" value="Alterar Senha">
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once("templates/footer.php");
?>