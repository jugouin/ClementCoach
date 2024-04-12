<?php
require_once ('Model/header.php');
require_once ('Controller/userReservationController.php');
require_once ('Controller/ReservationController.php');

$reservationController = new ReservationController();
$reservation = $reservationController->get($_POST['idReservation']);
$reservation->setLimitation($reservation->getLimitation() + 1);
$reservationController->update($reservation);


$userReservationController = new UserReservationController();
$userReservationController->delete($_POST['id']);
echo ('<div class="alert alert-success"><p>Réservation annulée</p></div>');
echo "<script>
        setTimeout(() => {
          window.location='calendar.php';
        }, '1500')
    </script>";

require_once ('Model/footer.php');

?>