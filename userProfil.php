<?php
require_once(__DIR__.'/Model/header.php');
require_once('Controller/HostingFormController.php');
require_once('Controller/UserReservationController.php');
require_once('Controller/ReservationController.php');

$hostingFormController = new HostingFormController();
$disponibilities = $hostingFormController->getHostingFormByUser($_SESSION['id']);

$userReservationController = new UserReservationController();
$reservations = $userReservationController->getReservationsByUserId($_SESSION['id']);
?>

<div class="profil">

    <div class="text-end p-3">
        <span class="material-symbols-outlined"><a class="text-white text-decoration-none" href="./updateUser.php">edit</a></span>
    </div>
    <div class="d-flex">
        <img src="Assets/img/profil_picture.jpeg" class="img_picture" alt="Photo de profil"/>
        <div class="mx-4 text-start">
            <p><strong><?=$name?></strong> - <?=$_SESSION['email']?></p>
            <div class="d-flex">
                <span class="material-symbols-outlined">workspace_premium</span>
                <p class="px-2"><?=$_SESSION['level']?></p>
            </div>
        </div>
    
    
    </div>

    <div class="d-flex mx-4">
        <span class="material-symbols-outlined">event</span>
        <div class="container-fluid">
            <p class="px-2">Vos réservations:</p>
            <div class="row">
            <?php foreach ($reservations as $key => $reservation): 
                $reservationController = new ReservationController();
                $userReservation = $reservationController->get($reservation->getReservation_id());
                $date = $userReservation->getDate();
                $date = new DateTime($date);
            ?>
                <div class="card col-lg-5 col-sm-10 text-center m-1 mx-4 p-3">
                    <form method="POST" action="deleteUserReservation.php" class="text-end">
                        <input class="d-none" name="id" id="id" value="<?= $reservation->getId()?>"/>
                        <input class="d-none" name="idReservation" id="idReservation" value="<?= $userReservation->getId()?>"/>
                        <button class="button-delete" type="submit">
                            <span class="material-symbols-outlined">
                                <a class="text-white text-decoration-none">delete</a>
                            </span>
                        </button>
                    </form>
                    
                    <h5 class="card-title">Le <?= $date->format('j/m')?> à <?= $userReservation->getHour()?></h5>
                    
                    <p>Lieu:  <?= $userReservation->getAddress()?></p>
                    <p>Niveau: 
                        <?= ucfirst($userReservation->getLevel())?>, 
                        <?php if ($userReservation->getEquipment() === 1){
                                echo('Matériel');
                            } else { 
                                echo('Sans matériel');
                            }?>
                    </p>
                    <p>Nombre de personnes maximum:  <?= $userReservation->getCapacity()?></p>
                </div>
            <?php endforeach ?> 
            </div>
        </div>
    </div>
   
    <div class="d-flex mx-4">
        <span class="material-symbols-outlined">spa</span>
        <div class="container-fluid">
            <p class="p-2">Vos disponibilités:</p>
            <div class="row">
            <?php foreach ($disponibilities as $key => $disponibility): 
                $date = $disponibility->getDate();
                $date = new DateTime($date);?>
                <div class="card col-lg-5 col-sm-10 text-center m-1 mx-4 p-2">
                    <span class="material-symbols-outlined text-end">
                        <a class="text-white  text-decoration-none" href="./updateUserDisponibilities.php">edit</a>
                    </span>
                    <h5 class="card-title">Le <?= $date->format('j/m')?> à <?= $disponibility->getHour()?></h5>
                    <p class="card-text">Capacité d'accueil:  <?= $disponibility->getCapacity()?> personnes.</p>
                </div>
            <?php endforeach ?> 
            </div>
        </div>
    </div>

</div>


<?php


require_once ('Model/footer.php');

?>