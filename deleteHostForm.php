<?php
require_once ('Model/header.php');
require_once ('Controller/HostingFormController.php');


$HostingFormController = new HostingFormController();
$HostingFormController->delete($_POST['id']);
echo ('<div class="alert alert-success"><p>Message effacé</p></div>');
echo "<script>setTimeout(() => {window.location='hostingProposition.php';}, '1500')</script>";

require_once ('Model/footer.php');

?>