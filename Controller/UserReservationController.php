
<?php
require_once ('Model/UserReservation.php');
require_once('bdd.php');


class UserReservationController {

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
        $reservations= [];
        $stmt = $this->pdo->query("SELECT * FROM `userReservation`");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $reservation){
            $reservations[] = new UserReservation($reservation);
        }
        return $reservations;
    
    }

    public function getReservationsByUserId(int $user_id): array
    {
        $reservations = [];
        $stmt = $this->pdo->prepare("SELECT * FROM `userReservation` WHERE user_id = :user_id");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $reservation){
            $reservations[] = new UserReservation($reservation);
        }
        return $reservations;
    }

    public function get(int $id): UserReservation
    {
        $req = $this->pdo->prepare("SELECT * FROM `userReservation` WHERE id = :id");
        $req->bindParam(":id", $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch();
        $reservation = new UserReservation($data);
        return $reservation;
    }

    public function create(UserReservation $newUserReservation): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO `userReservation` (user_id, reservation_id) 
                                    VALUES (:user_id, :reservation_id)");

        $stmt->bindValue(":user_id", $newUserReservation->getUser_id(), PDO::PARAM_INT);
        $stmt->bindValue(":reservation_id", $newUserReservation->getReservation_id(), PDO::PARAM_INT);
    
        $stmt->execute();
    }

    public function update(UserReservation $reservation): void
    {
        $stmt = $this->pdo->prepare("UPDATE `userReservation` 
                                    SET id = :id,
                                        user_id = :user_id,
                                        reservation_id = :reservation_id
                                    WHERE id = :id");

        $stmt->bindValue(":id", $reservation->getId(), PDO::PARAM_INT);
        $stmt->bindValue(":user_id", $reservation->getUser_id(), PDO::PARAM_INT);
        $stmt->bindValue(":reservation_id", $reservation->getReservation_id(), PDO::PARAM_INT);

        $stmt->execute();
    }

    public function delete(int $id): void
    {
        $req = $this->pdo->prepare("DELETE FROM `userReservation` WHERE id = :id");
        $req->bindParam(":id", $id, PDO::PARAM_INT);
        
        $req->execute();
    }
}

?>