<?php
require_once('Model/header.php');
require_once('Controller/ReservationController.php');

$reservationController = new reservationController();
$reservations = $reservationController->getAll();

$arrayReservation = [];
foreach($reservations as $key => $reservation){
    array_push($arrayReservation, $reservation->getDate());
}
$dataJson = json_encode($arrayReservation);

?>
<div class="calendar-wrapper">
    <div class="calendar-header">
        <p class="current-date"></p>
        <div class="icons">
            <button id="prev" class="material-symbols-outlined" onclick="prevMonth()">chevron_left</button>
            <button id="next" class="material-symbols-outlined" onclick="nextMonth()">chevron_right</button>        
        </div>
    </div>
    <div class="calendar">
        <ul class="weeks">
            <li>Lun</li>
            <li>Mar</li>
            <li>Mer</li>
            <li>Jeu</li>
            <li>Ven</li>
            <li>Sam</li>
            <li>Dim</li>
        </ul>
        <ul class="days">
        </ul>
    </div>
</div>

<script defer>

    let reservations = [];

    function getAllReservations() {
      reservations = <?= $dataJson ?>;
      return reservations;
    }

    let year = '';
    let month = '';
    let day = '';

    getAllReservations();

    const currentDate = document.querySelector(".current-date");
    const daysTag = document.querySelector(".days");

    let date = new Date();
    currentYear = date.getFullYear();
    currentMonth = date.getMonth();

    const months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];

    const renderCalendar = () => {

        let firstDayOfMonth = new Date(currentYear, currentMonth, 0).getDay();
        let lastDateOfMonth = new Date(currentYear, currentMonth +1, 0).getDate();
        let lastDayOfMonth = new Date(currentYear, currentMonth, lastDateOfMonth - 1).getDay();
        let lastDateOfLastMonth = new Date(currentYear, currentMonth, 0).getDate();

        let liTag ="";

        for (let i = firstDayOfMonth; i > 0; i --){
            liTag += `<li class="inactive">${lastDateOfLastMonth - i + 1}</li>`;
        }
     
        for (let i = 1; i <= lastDateOfMonth; i ++){
            console.log(lastDateOfMonth);
            let resa = "";
           
            reservations.forEach((e) => {

                const element = e.split('-');

                year = element[0];
                month = element[1];
                day = element[2];

                switch(true){
                    case (i == day && currentMonth == month-1 && currentYear == year):
                        resa = "Pilates";
                        liTag += `<li onClick="OpenModal(${i}, ${month}, ${year})" id="${i}"class="reservation">${i}<br>${resa}</li>`;
                        i += 1;
                        break;

                    default:
                        break;
                }
                
            });

            if(i <= lastDateOfMonth){
                let isToday = i === date.getDate() && currentMonth === new Date().getMonth() && currentYear === new Date().getFullYear() ? "active" : "";
                liTag += `<li class="${isToday}">${i}</li>`;
            }
        }
        
        for (let i = lastDayOfMonth; i < 6; i ++){
            liTag += `<li class="inactive">${i - lastDayOfMonth +1}</li>`;
        }

        currentDate.innerHTML = `${months[currentMonth]} ${currentYear}`;
        daysTag.innerHTML = liTag;
    }

    renderCalendar();
    
    function prevMonth (){
        currentMonth = currentMonth -1;
        switchMonth();
    }

    function nextMonth (){
        currentMonth = currentMonth + 1;
        switchMonth();
    }

    function switchMonth (){
        if(currentMonth < 0  || currentMonth > 11) {
            date = new Date(currentYear, currentMonth);
            currentYear = date.getFullYear();
            currentMonth = date.getMonth();
        } else {
            date = new Date();
        }
        renderCalendar();
    }

    function OpenModal(i, month, year){

        i = i.toString();
        if (i.length === 1){
           i = `0${i}`;
        }
        month = month.toString();
        if (month.length === 1){
           month = `0${month}`;
        }
        
        window.location=`Modal.php?day=${i}&month=${month}&year=${year}`;
    }
    


</script>
<?php
require_once('Model/footer.php');

?>