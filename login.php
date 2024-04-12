<?php
require_once './session.php';

$userController = new UserController();
$user = $userController->getUserByEmail($_POST['email']);

$_SESSION["user"] = $user;

$_SESSION["id"] = $user->getId();
$_SESSION["name"] = $user->getName();
$_SESSION["email"] = $user->getEmail();
$_SESSION["level"] = $user->getLevel();
$_SESSION["host"] = $user->getHost();

echo "<script>window.location='index.php';</script>";

?>
