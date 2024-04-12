
<?php
require_once ('Model/header.php');
require_once ('Controller/ReservationController.php');
require_once('Model/data.php');

if ($_POST){
    $newReservation = new Reservation($_POST);
    $reservationController = new ReservationController();
    $reservationController->create($newReservation);

    echo ('<div class="alert alert-success"><p>Votre créneau à été créé</p></div>');
    echo ("<script>setTimeout(() => {window.location='admin.php';}, '1500')</script>");
}

?>

<div class="profil">
    <a class="text-white text-decoration-none text-end m-3" href="admin.php">Retour</a>

    <form class="text-center" method="POST">
        <h2 class="mb-3">Modifier une réservation</h2>
        
        <div class="form-floating m-1 mx-5">
            <?php
                $start_date = date_create("now");
                $end_date   = date_create("5 week");

                $interval = DateInterval::createFromDateString('1 day');
                $daterange = new DatePeriod($start_date, $interval ,$end_date);
            ?>
            <select name="date" class="form-select" id="date" required>
                <option>Choissiez un jour</option>
                <?php foreach($daterange as $date): ?>
                <option id="selectedDay" value="<?= $date->format('Y-m-d') ?>"><?= $date->format('d/m/y') ?></option>
                <?php endforeach ?> 
            </select>
            <label for="date">Jour</label>
        </div>

        <div id="hour" class="form-floating m-1 mx-5">
            <?php
                $start_hour = "07:00";			 
                $end_hour = "21:00";
                $frequency = 30;

                for($i = strtotime($start_hour); $i<= strtotime($end_hour); $i = $i + $frequency * 60) {
                    $hours[] = date("H\hi", $i);  
                }
            ?>
            <select name="hour" class="form-select" id="hour" required>
            <?php foreach($hours as $hour): ?>
                        <option value="<?= $hour ?>"><?= $hour ?></option>
            <?php endforeach ?> 
            </select>
            <label for="hour">Heure</label>
        </div>

        <div class="form-floating m-1 mx-5">
            <input class="form-control" name="address" id="address" required>
            <label for="address">Adresse - ex: 45 rue du chemin, 73000 Chambéry</label>
        </div>

        <div class="form-floating m-1 mx-5">
            <select name="equipment" id="equipment" class="form-select" id="equipment" required>
                    <option value="<?= true ?>">Avec matériel</option>
                    <option value="<?= false ?>">Sans matériel</option>
            </select>
            <label for="equipment">Matériel</label>
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
            <select name="capacity" id="capacity" class="form-select" required>
                <?php for($i = 1; $i <= 8; $i ++):?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor ?>
                </select>
            <label for="capacity">Capacité d'accueil</label>
        </div>
        <div class="form-floating m-1 mx-5">
            <select name="limitation" id="limitation" class="form-select" required>
                <?php for($i = 1; $i <= 8; $i ++):?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor ?>
                </select>
            <label for="limitation">Limitation</label>
        </div>
        
        <button class="button-custom px-3" type="submit">Créer</button>

    </form>
</div>

<?php

require_once ('Model/footer.php');

?>