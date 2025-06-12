<?php
require_once("templates/header.php");

require_once("dao/UserDAO.php");

$userDao = new UserDAO($conn, $BASE_URL);
$userData = $userDao->verifyToken();

?>

<div id="main-container" class="conteiner-fluid">
    <h1>Edição de perfil</h1>
</div>

<?php
require_once("templates/footer.php");
?>