<?php

require_once ('Model/Reservation.php');
require_once('bdd.php');

class ReservationController {

    private $pdo;

    public function __construct()
    { 
        $this->setPdo(new PDO(MYSQL, USERNAME, PASSWORD));
    }

    public function setPdo(PDO $pdo)
    {
        $this->pdo = $pdo;
        return $this;
    }

    public function getAll() : array
    {
        $reservations = [];
        $stmt = $this->pdo->query("SELECT * FROM `reservation`");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $reservation){
            $reservations[] = new Reservation($reservation);
        }
        return $reservations;
    
    }

    public function get(int $id): Reservation
    {
        $req = $this->pdo->prepare("SELECT * FROM `reservation` WHERE id = :id");
        $req->bindParam(":id", $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch();
        $reservation = new Reservation($data);
        return $reservation;
    }

    public function create(Reservation $newResa): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO `reservation` (date, hour, address, equipment, level, capacity, limitation) 
                                    VALUES (:date, :hour, :address, :equipment, :level, :capacity, :limitation)");

        $stmt->bindValue(":date", $newResa->getDate(), PDO::PARAM_STR);
        $stmt->bindValue(":hour", $newResa->getHour(), PDO::PARAM_STR);
        $stmt->bindValue(":address", $newResa->getAddress(), PDO::PARAM_STR);
        $stmt->bindValue(":equipment", $newResa->getEquipment(), PDO::PARAM_INT);
        $stmt->bindValue(":level", $newResa->getLevel(), PDO::PARAM_STR);
        $stmt->bindValue(":capacity", $newResa->getCapacity(), PDO::PARAM_INT);
        $stmt->bindValue(":limitation", $newResa->getLimitation(), PDO::PARAM_INT);
       
        $stmt->execute();
        
    }

    public function update(Reservation $reservation): void
    {
        $req = $this->pdo->prepare("UPDATE `reservation` 
                                    SET id = :id,
                                        date = :date,
                                        hour = :hour,
                                        address = :address,
                                        equipment = :equipment,
                                        level = :level,
                                        capacity = :capacity,
                                        limitation = :limitation 
                                    WHERE id = :id");

        $req->bindValue(":id", $reservation->getId(), PDO::PARAM_INT);
        $req->bindValue(":date", $reservation->getDate(), PDO::PARAM_STR);
        $req->bindValue(":hour", $reservation->getHour(), PDO::PARAM_STR);
        $req->bindValue(":address", $reservation->getAddress(), PDO::PARAM_STR);
        $req->bindValue(":equipment", $reservation->getEquipment(), PDO::PARAM_INT);
        $req->bindValue(":level", $reservation->getLevel(), PDO::PARAM_STR);
        $req->bindValue(":capacity", $reservation->getCapacity(), PDO::PARAM_INT);
        $req->bindValue(":limitation", $reservation->getLimitation(), PDO::PARAM_INT);

        $req->execute();
    }

    public function delete(int $id): void
    {
        $req = $this->pdo->prepare("DELETE FROM `reservation` WHERE id = :id");
        $req->bindParam(":id", $id, PDO::PARAM_INT);
        
        $req->execute();
    }
}

?>