<?php
require_once('Model/header.php');
require_once('Controller/ReservationController.php');

$reservationController = new reservationController();
$reservations = $reservationController->getAll();
?>

<div class="container-flex w-75 mx-auto">
    <div class="row">
        
        <?php foreach($reservations as $key => $reservation):
            $date = $reservation->getDate();
            $date = new DateTime($date);?>
            <form class="modal-col col-3" action="updateReservation.php" method="POST">
                <input class="d-none" name="reservationId" value="<?= $reservation->getId()?>">
                <div class="text-center">
                    <h3><?= $date->format('j/m')?></h3>
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
                    <button type="submit" class="button-custom px-4">Je modifie</button>
                </div>  
            </form>
        <?php endforeach; ?>
    </div>
</div>

<?php
require_once ('Model/footer.php');
?>