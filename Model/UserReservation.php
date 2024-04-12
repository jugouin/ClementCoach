<?php


class UserReservation {
    private $id;
    private $user_id;
    private $reservation_id;
    
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data){
        foreach ($data as $key =>$value){
            $method ="set".ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
    
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        if ($id > 0) {
            $this->id = $id; 
        }
        return $this;
    }

    public function getUser_id(): int
    {
        return $this->user_id;
    }

    public function setUser_id(int $user_id): self
    {
        if ($user_id > 0) {
            $this->user_id = $user_id; 
        }
        return $this;
    }

    public function getReservation_id(): int
    {
        return $this->reservation_id;
    }

    public function setReservation_id(int $reservation_id): self
    {
        if ($reservation_id > 0) {
            $this->reservation_id = $reservation_id; 
        }
        return $this;
    }
   
}
?>