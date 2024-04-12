<?php

require_once ('Model/HostingForm.php');
require_once('bdd.php');


class HostingFormController {

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
        $hosts= [];
        $stmt = $this->pdo->query("SELECT * FROM `HostingForm`");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $host){
            $hosts[] = new HostingForm($host);
        }
        return $hosts;
    
    }

    public function get(int $id): HostingForm
    {
        $req = $this->pdo->prepare("SELECT * FROM `HostingForm` WHERE id = :id");
        $req->bindParam(":id", $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch();
        $host = new HostingForm($data);
        return $host;
    }

    public function getHostingFormByUser(int $user_id): array
    {
        $disponibilities = [];
        $stmt = $this->pdo->prepare("SELECT * FROM `HostingForm` WHERE user_id = :user_id");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $disponibility){
            $disponibilities[] = new HostingForm($disponibility);
        }
        return $disponibilities;
    }

    public function create(HostingForm $newHost): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO `HostingForm` (user_id, date, hour, capacity, street_num, street_name, postcode, city, message) 
                                    VALUES (:user_id, :date, :hour, :capacity, :street_num, :street_name, :postcode, :city, :message)");


        $stmt->bindValue(":user_id", $newHost->getUser_id(), PDO::PARAM_INT);
        $stmt->bindValue(":date", $newHost->getDate(), PDO::PARAM_STR);
        $stmt->bindValue(":hour", $newHost->getHour(), PDO::PARAM_STR);
        $stmt->bindValue(":capacity", $newHost->getCapacity(), PDO::PARAM_INT);
        $stmt->bindValue(":street_num", $newHost->getStreet_num(), PDO::PARAM_INT);
        $stmt->bindValue(":street_name", $newHost->getStreet_name(), PDO::PARAM_STR);
        $stmt->bindValue(":postcode", $newHost->getPostcode(), PDO::PARAM_INT);
        $stmt->bindValue(":city", $newHost->getCity(), PDO::PARAM_STR);
        $stmt->bindValue(":message", $newHost->getMessage(), PDO::PARAM_STR);

        $stmt->execute();
        
    }

    public function update(HostingForm $host): void
    {
        $stmt = $this->pdo->prepare("UPDATE `HostingForm` 
                                    SET id = :id,
                                        user_id = :user_id,
                                        date = :date,
                                        hour = :hour,
                                        capacity = :capacity,
                                        street_num = :street_num,
                                        street_name = :street_name,
                                        postcode = :postcode,
                                        city = :city,
                                        message = :message
                                    WHERE id = :id");

        $stmt->bindValue(":id", $host->getId(), PDO::PARAM_INT);
        $stmt->bindValue(":user_id", $host->getUser_id(), PDO::PARAM_INT);
        $stmt->bindValue(":date", $host->getDate(), PDO::PARAM_STR);
        $stmt->bindValue(":hour", $host->getHour(), PDO::PARAM_STR);
        $stmt->bindValue(":capacity", $host->getCapacity(), PDO::PARAM_INT);
        $stmt->bindValue(":street_num", $host->getStreet_num(), PDO::PARAM_INT);
        $stmt->bindValue(":street_name", $host->getStreet_name(), PDO::PARAM_STR);
        $stmt->bindValue(":postcode", $host->getPostcode(), PDO::PARAM_INT);
        $stmt->bindValue(":city", $host->getCity(), PDO::PARAM_STR);
        $stmt->bindValue(":message", $host->getMessage(), PDO::PARAM_STR);

        $stmt->execute();
    }

    public function delete(int $id): void
    {
        $req = $this->pdo->prepare("DELETE FROM `HostingForm` WHERE id = :id");
        $req->bindParam(":id", $id, PDO::PARAM_INT);
        
        $req->execute();
    }
}

?>