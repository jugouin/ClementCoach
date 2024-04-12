<?php

require_once ('Model/header.php');
require_once('Controller/HostingFormController.php');

if($_POST){


    if(settype($_POST['street_num'], "integer") === false){
        echo ('<div class="alert alert-danger"><p>Merci de saissir un numéro de rue valide</p></div>');
        echo "<script>setTimeout(() => {window.location='welcomeCourse.php';}, '1500')</script>";
    }

    if(settype($_POST['postcode'], "integer") === false){
        echo ('<div class="alert alert-danger"><p>Merci de saissir un code postal valide</p></div>');
        echo "<script>setTimeout(() => {window.location='welcomeCourse.php';}, '1500')</script>";
    }

    $hostingFormController = new HostingFormController();
    $newHost =  new HostingForm($_POST);
    $hostingFormController->create($newHost);
    echo ('<div class="alert alert-success"><p>Nous avons pris note de votre proposition de créneau</p></div>');
    echo "<script>setTimeout(() => {window.location='UserProfil.php';}, '1500')</script>";
}

?>

<form class="form text-center" method="POST">
    <h3 class="mb-3">Accueillir un cours chez moi</h3>
    <p>Si vous avez la possibilité d’accueillir une séance chez vous, remplissez ce formulaire que je puisse vous recontacter.<p>
    <div class="d-none">
        <input name="user_id" id="user_id" value="<?=$_SESSION["id"]?>" required>
    </div>

    <div class="form-floating m-1 mx-5">
        <?php
            $start_date = date_create("now");
            $end_date   = date_create("2 week");

            $interval = DateInterval::createFromDateString('1 day');
            $daterange = new DatePeriod($start_date, $interval ,$end_date);
        ?>
        <select name="date" class="form-select" id="date" required>
            <option disabled selected="selected">Choissiez un jour</option>
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
        <select name="capacity" id="capacity" class="form-select" required>
            <?php for($i = 1; $i <= 8; $i ++):?>
                <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor ?>
            </select>
        <label for="capacity">Capacité d'accueil</label>
    </div>

    <div class="d-flex mx-5">
        <div class="form-floating m-1 w-25">
            <input type="number" min="1" class="form-control" name="street_num" id="street_num" required>
            <label for="street_num">Numéro de rue</label>
        </div>
        <div class="form-floating m-1 w-75">
            <input type="tel" class="form-control" name="street_name" id="street_name"  required>
            <label for="street_name">Nom de la rue</label>
        </div>
    </div>
    
    <div class="d-flex mx-5">
        <div class="form-floating m-1 w-25">
            <input type="postcode" class="form-control" name="postcode" id="postcode" required>
            <label for="postcode">Code Postal</label>
        </div>
        <div class="form-floating m-1 w-75">
            <input class="form-control" name="city" id="city"  required>
            <label for="city">Ville</label>
        </div>
    </div>

    <div class="form-floating m-1 mx-5">
        <textarea class="form-control" name="message" id="message"></textarea>
        <label for="message">Informations complémentaires</label>
    </div>
    <button type="submit" class="mt-3 px-4 button-custom">Envoyer</button>
</form>


<?php
require_once ('Model/footer.php');
?>
