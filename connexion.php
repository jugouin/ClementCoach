<?php

require_once ('Model/header.php');
require_once ('Controller/UserController.php');


if($_POST) {
    
    $userController = new UserController();
    $user = $userController->getUserByEmail($_POST['email']);
   
    if ($user && password_verify($_POST['password'], $user->getPassword() )){

        if(($_SESSION['name'] === 'Admin') && ($_SESSION['email'] === 'clementcoach@pilates.com')){
            echo "<script>window.location='admin.php';</script>"; 
        }
        
        $_SESSION["user"] = $user;
        
        $_SESSION["id"] = $user->getId();
        $_SESSION["name"] = $user->getName();
        $_SESSION["email"] = $user->getEmail();
        $_SESSION["level"] = $user->getLevel();
        $_SESSION["host"] = $user->getHost();
        
        echo "<script>window.location='index.php';</script>";

    } else {

        echo ('<div class="alert alert-danger"><p>E-mail ou mot de passe incorrect</p></div>');
        echo "<script>
                setTimeout(() => {
                window.location='connexion.php';
                }, '1500')
            </script>";
    }
 } 

?>

<p class="text-end m-3 px-4">
    <small><a class="text-muted" href="newUser.php">Je crée mon compte</a></small>
</p>

<form method="POST" class="text-center mx-5">
    <h3 class="mb-3 text-dark">Connexion</h3>

    <div class="form-floating m-1 mx-5 ">
        <input type="email" class="form-control" name="email" id="email" required>
        <label for="email">Adresse e-mail</label>
    </div>
    <div class="form-floating m-1 mx-5">
        <input type="password" class="form-control" name="password" id="password" required>
        <label for="password">Mot de passe</label>
    </div>

    <button class="button-custom p-2 px-4 m-2" type="submit">Se connecter</button>
</form>

<?php

require_once ('Model/footer.php');

?>