<?php
require_once('Controller/ReservationController.php');

 $reservationController = new ReservationController;
 $reservation = new Reservation($_POST);
 $reservationController->update($reservation);

 echo('<script>window.location="admin.php"</script>')

?>""