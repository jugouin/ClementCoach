<?php

require_once(__DIR__.'/Model/header.php');
require_once('Controller/ReservationController.php');
require_once('Controller/UserReservationController.php');
require_once('Model/data.php');

$reservationController = new ReservationController();
$reservations = $reservationController->getAll();

if ($_SESSION['user']){
  if ($_POST){
    $reservation = $reservationController->get($_POST['id']);

    if ($reservation->getCapacity() >= $reservation->getLimitation() && $reservation->getLimitation() > 0){
      $reservation->hydrate($_POST);
      $reservationController->update($reservation);

      $newUserReservation = ['user_id' => $_SESSION['id'], 'reservation_id' => $_POST['id'] ];
      $userReservation = new UserReservation($newUserReservation);
      $userReservationController = new UserReservationController();
      $userReservationController->create($userReservation);
  
      echo ('<div class="alert alert-success"><p>Merci de votre réservation</p></div>');
      echo "<script>setTimeout(() => {window.location='userProfil.php';}, '1500')</script>";

    } else {
      echo ('<div class="alert alert-danger"><p>Il n\'y a plus de places disponibles pour ce créneau</p></div>');
      echo "<script>setTimeout(() => {window.location='calendar.php';}, '1500')</script>";
    }
  } 
} else {
  echo ('<div class="alert alert-primary"><p>Merci de bien vouloir vous connecter.</p></div>');
}

$currentDate = $_GET['year'].'-'.$_GET['month'].'-'.$_GET['day'];
$transformDate = 'Le '.$_GET['day'].' '.$months[$_GET['month']-1].' '.$_GET['year'];

foreach($reservations as $key => $reservation):
  $date = $reservation->getDate();
  if ($date === $currentDate): ?>
  <div class="modal-wrapper pb-5">
    <a class="text-decoration-none text-white" href="calendar.php">Retour</a>
    <div class="text-center">
      <h3><?=$transformDate?> - <?=$reservation->getHour()?></h3>
      <h5>Lieu: <?= $reservation->getAddress()?></h5>
      <p>Niveau: 
        <?= ucfirst($reservation->getLevel())?>, 
        <?php 
          if ($reservation->getEquipment() === 1){
            echo('Matériel');
          } else { 
            echo('Sans matériel');
          }?>
      </p>
      <p>Capacité d'accueil: <?= $reservation->getCapacity()?></p>
      <p>Place(s) restante(s): <?= $reservation->getLimitation()?></p>
      <form method="POST">
        <input class="d-none" name="id" id="id" value="<?= $reservation->getId()?>"/>
        <input class="d-none" name="limitation" id="limitation" value="<?= $reservation->getLimitation() -1?>"/>
        <button class="button-custom px-4" type="submit">Je réserve</button>
      </form>
    </div>
  </div>

<?php 
endif;
endforeach;



?>

<?php
require_once ('Model/footer.php');

?> 