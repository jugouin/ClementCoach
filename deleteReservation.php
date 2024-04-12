<?php
require_once ('Model/header.php');
require_once ('Controller/ReservationController.php');

$ReservationController = new ReservationController();
$ReservationController->delete($_POST['id']);
echo ('<div class="alert alert-success"><p>La réservation à été supprimée</p></div>');
echo "<script>setTimeout(() => {window.location='logout.php';}, '1500')</script>";

require_once ('Model/footer.php');

?>