<?php


class Reservation {
    private $id;
    private $date;
    private $hour;
    private $address;
    private $equipment;
    private $level;
    private $capacity;
    private $limitation;

    
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

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;            
        return $this;
    }

    public function getHour()
    {
        return $this->hour;
    }

    public function setHour(string $hour): self
    {
        $this->hour = $hour;            
        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

   
    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getEquipment(): int
    {
        return $this->equipment;
    }

   
    public function setEquipment(int $equipment): self
    {
        if ($equipment == 0 || $equipment == 1 ) {
            $this->equipment = $equipment; 
        }
        return $this;
    }

    public function getLevel(): string
    {
        return $this->level;
    }

  
    public function setLevel(string $level): self
    {
        if ($level === 'débutant' || 'intermédiaire' || 'expérimenté') {
            $this->level = $level;
        }
        return $this;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

   
    public function setCapacity(int $capacity): self
    {
        if ($capacity > 0) {
            $this->capacity = $capacity; 
        }
        return $this;
    }

    public function getLimitation(): int
    {
        return $this->limitation;
    }

   
    public function setLimitation(int $limitation): self
    {
        if ($limitation > 0) {
            $this->limitation = $limitation; 
        }
        return $this;
    }

}
?>