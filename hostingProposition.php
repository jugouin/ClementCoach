<?php
require_once('Model/header.php');
require_once('Controller/HostingFormController.php');
require_once('Controller/UserController.php');

$hostingFormController = new hostingFormController();
$hostingForms = $hostingFormController->getAll();
?>

<div class="host-container">
    <?php foreach($hostingForms as $key => $hostingForm):

        $userController = new UserController();
        $user = $userController->get($hostingForm->getUser_id());

        $date = $hostingForm->getDate();
        $date = new DateTime($date); ?>
        <div class="host-wrapper m-1">
            <div class="host-box">
            <form method="POST" action="deleteHostForm.php" class="text-end">
                        <input class="d-none" name="id" id="id" value="<?= $hostingForm->getId()?>"/>
                        <button class="button-delete-hostForm" type="submit">
                            <span class="material-symbols-outlined">
                                <a class="text-white text-decoration-none">delete</a>
                            </span>
                        </button>
                    </form>
                <h4>Le <?= $date->format('j/m')?> à <?= $hostingForm->getHour()?></h4>
                <h5>Lieu: <?= $hostingForm->getStreet_num()?> <?= $hostingForm->getStreet_name()?>,</br>
                <?= $hostingForm->getPostcode()?> <?= $hostingForm->getCity()?></h5>
                <p>Capacité d'accueil: <?= $hostingForm->getCapacity()?> personnes</p>
                <p>Informations additionnelles:</br><?= $hostingForm->getMessage()?></p>
                <p>Contact: <?= ucfirst($user->getName())?> - <?= $user->getEmail()?></p>
            </div>
        </div>  
    <?php endforeach; ?>
</div>
    

<?php
require_once ('Model/footer.php');
?>