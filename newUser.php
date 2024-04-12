<?php
require_once('./session.php');
require_once ('Model/header.php');
require_once ('Controller/UserController.php');
require_once('Model/data.php');

if ($_POST){

    if ($_POST["password"] == $_POST["confirmPassword"]){
      unset($_POST["confirmPassword"]);
    
    } else {
      echo ('<div class="alert alert-danger"><p>Le mot passe ne correspond pas.</p></div>');
      echo "<script>setTimeout(() => window.location='newUser.php';}, '3000')</script>";
      return;
    }
  
    $password = $_POST['password'];
  
    $uppercase    = preg_match('@[A-Z]@', $password);
    $lowercase    = preg_match('@[a-z]@', $password);
    $number       = preg_match('@[0-9]@', $password);
  
  
    if ($uppercase && $lowercase && $number && strlen($password) >= 8) {
      $_POST["password"] = password_hash(($_POST["password"]), PASSWORD_DEFAULT);
  
      $newUser = new User($_POST);
      $userController = new UserController();
      $userController->create($newUser);
     
      echo ('<div class="alert alert-success"><p>Votre compte à été créé</p></div>');

      $user = $userController->getUserByEmail($_POST['email']);
      $_SESSION["user"] = $user;
        
      $_SESSION["id"] = $user->getId();
      $_SESSION["name"] = $user->getName();
      $_SESSION["email"] = $user->getEmail();
      $_SESSION["level"] = $user->getLevel();
      $_SESSION["host"] = $user->getHost();

      if ($_SESSION["host"] === 'true' ){
        echo "<script>setTimeout(() => {window.location='welcomeCourse.php';}, '1500')</script>";
      } else {
        echo "<script>setTimeout(() => {window.location='index.php';}, '1500')</script>";
      }
    
    } else {
        echo ('<div class="alert alert-danger">
                <p>Le mot de passe doit contenir au moins 8 caractères comprenant 1 majuscule, 1 minuscule et un chiffre</p>
            </div>');
        echo "<script>setTimeout(() => {window.location='newUser.php';}, '3000')</script>";
        return;
    }
  }

?>


<p class="text-end px-4">
    <small><a class="text-muted" href="connexion.php">J'ai déja un compte</a></small>
</p>

<form method="POST" class="text-center mx-5">
    <h3 class="mb-3 text-dark">Je crée mon compte</h3>

    <div class="form-floating m-1 mx-5 ">
        <input type="name" class="form-control" name="name" id="name" required>
        <label for="name">Nom</label>
    </div>

    <div class="form-floating m-1 mx-5 ">
        <input type="email" class="form-control" name="email" id="email" required>
        <label for="email">Adresse e-mail</label>
    </div>
    <div class="form-floating m-1 mx-5">
        <input type="password" title="Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre" class="form-control" name="password" id="password"  required>
        <label for="password">Mot de passe</label>
    </div>

    <div class="form-floating m-1 mx-5">
        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" required>
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
            <label class="text-dark m-2" for="host">Je souhaite accueillir des séances chez moi</label>
        </div>
        <div class="d-flex">
            <input class="m-2" type="radio" id="false" name="host" value="false" checked>
            <label class="text-dark m-2" for="host">Je ne souhaite pas accueillir des séances chez moi</label>
        </div>
    </div>
    <button type="submit" class="button-custom" name="newUser">Créer mon compte</button>
</form>


<?php

require_once ('Model/footer.php');

?>