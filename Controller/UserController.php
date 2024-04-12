<?php

require_once ('Model/User.php');
require_once('bdd.php');

class UserController {

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
        $users= [];
        $stmt = $this->pdo->query("SELECT * FROM `users`");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $user){
            $users[] = new User($user);
        }
        return $users;
    
    }

    public function get(int $id): User
    {
        $req = $this->pdo->prepare("SELECT * FROM `users` WHERE id = :id");
        $req->bindParam(":id", $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch();
        $user = new User($data);
        return $user;
    }

    public function getUserByEmail(string $email): User
    {
        $req = $this->pdo->prepare("SELECT * FROM `users` WHERE email = :email");
        $req->bindParam(":email", $email, PDO::PARAM_STR);
        $req->execute();
        $data = $req->fetch();
        $user = new User($data);
        return $user;
    }

    public function create(User $newUser): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO `users` (name, email, password, level, host) 
                                    VALUES (:name, :email, :password, :level, :host)");

        $stmt->bindValue(":name", $newUser->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":email", $newUser->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(":password", $newUser->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(":level", $newUser->getLevel(), PDO::PARAM_STR);
        $stmt->bindValue(":host", $newUser->getHost(), PDO::PARAM_STR);
       
        $stmt->execute();
        
    }

    public function update(User $user): void
    {
        $req = $this->pdo->prepare("UPDATE `users` 
                                    SET id = :id,
                                        name = :name,
                                        email = :email,
                                        password = :password,
                                        level = :level,
                                        host = :host 
                                    WHERE id = :id");

        $req->bindValue(":id", $user->getId(), PDO::PARAM_INT);
        $req->bindValue(":name", $user->getName(), PDO::PARAM_STR);
        $req->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);
        $req->bindValue(":password", $user->getPassword(), PDO::PARAM_STR);
        $req->bindValue(":level", $user->getLevel(), PDO::PARAM_STR);
        $req->bindValue(":host", $user->getHost(), PDO::PARAM_STR);

        $req->execute();
    }

    public function delete(int $id): void
    {
        $req = $this->pdo->prepare("DELETE FROM `users` WHERE id = :id");
        $req->bindParam(":id", $id, PDO::PARAM_INT);
        
        $req->execute();
    }
}

?>