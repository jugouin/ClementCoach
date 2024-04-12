<?php

require_once('Model/header.php');
require_once('Model/User.php');
require_once('Controller/UserController.php');
require_once('Model/data.php');


if($_POST){

    if ($_POST["password"] === $_POST["confirmPassword"]){
        unset($_POST["confirmPassword"]);  

    } else {
        echo ('<div class="alert alert-danger"><p>Le mot passe ne correspond pas.</p></div>');
        echo "<script>
                setTimeout(() => {
                  window.location='userProfil.php';
                }, '1500')
            </script>";
        return;
    }
    
    $password = $_POST['password'];

    $uppercase    = preg_match('@[A-Z]@', $password);
    $lowercase    = preg_match('@[a-z]@', $password);
    $number       = preg_match('@[0-9]@', $password);

    if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
        echo ('<div class="alert alert-danger"><p>Le mot de passe doit contenir au moins 8 charactères comprenant 1 majuscule, 1 minuscule et un chiffre</p></div>');
        return;
    }

    else {

        $_POST["password"] = password_hash(($_POST["password"]), PASSWORD_DEFAULT);

        $UserController = new UserController;
        $user = new User($_POST);
        $UserController->update($user);

        $_SESSION["level"] = $_POST["level"];
        $_SESSION["host"] = $_POST["host"];

        echo ('<div class="alert alert-success"><p>Vos modifications ont été prises en compte.</p></div>');
        echo "<script>
                setTimeout(() => {
                  window.location='userProfil.php';
                }, '1500')
            </script>";

    }
} 
?>

<div class="profil">
    <form class="" method="POST">
        <div class="d-none">
            <input name="id" id="id" value="<?= $_SESSION['id'] ?>">
            <input name="name" id="name" value="<?= $_SESSION['name'] ?>">
            <input name="email" id="email" value="<?= $_SESSION['email'] ?>">
        </div>

        
        <div class="text-end p-2">
            <a class="text-white text-decoration-none m-3" href="userProfil.php">Retour</a>
            <span class="material-symbols-outlined"><a class="text-white" href="./deleteUser.php">delete</a></span>
        </div>

        <div class="d-flex">
            <img src="Assets/img/profil_picture.jpeg" class="img_picture" alt="Photo de profil"/>
            <div class=" mx-4 text-start">
                <p><strong><?=$name?></strong></p>
                <p><?=$_SESSION['email']?></p>
            </div>
        </div>
        <div class="form-floating m-1 mx-5">
            <input type="password" class="form-control" name="password" id="password" required>
            <label for="password">Mot de passe</label>
        </div>

        <div class="form-floating m-1 mx-5">
            <input type="Password" class="form-control" name="confirmPassword" id="confirmPassword" required>
            <label for="password">Confirmation du mot de passe</label>
        </div>

        <div class="form-floating m-1 mx-5">
            <select name="level" id="level" class="form-select" id="level" required>
                <?php foreach($levels as $level): ?>
                    <option value="<?= $level ?>"><?= $level ?></option>
                    <?php endforeach?>
                </select>
            <label for="level">Niveau</label>
        </div>

        <div class="form-floating m-1 mx-5">
            <div class="d-flex">
                <input class="m-2" type="radio" id="true" name="host" value="true">
                <label class="m-2" for="host">Je souhaite accueillir des séances chez moi</label>
            </div>
            <div class="d-flex">
                <input class="m-2" type="radio" id="false" name="host" value="false" checked>
                <label class="m-2" for="host">Je ne souhaite pas accueillir des séances chez moi</label>
            </div>
        </div>
        <div class="text-end p-2">
            <button class="px-4 button-custom" type="submit">Modifier</button>
        </div>
    </form>

</div>


<?php
require_once ('Model/footer.php');

?>
