<?php


class HostingForm {
    private $id;
    private $user_id;
    private $date;
    private $hour;
    private $capacity;
    private $street_num;
    private $street_name;
    private $postcode;
    private $city;
    private $message;

    
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

    public function getDate()
    {
        return $this->date;
    }

 
    public function setDate(string $date): self
    {
        $this->date = $date;            
        return $this;
    }

    public function getHour(): string
    {
        return $this->hour;
    }

   
    public function setHour(string $hour): self
    {
        $this->hour = $hour;
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

    public function getStreet_num(): int
    {
        return $this->street_num;
    }

    public function setStreet_num(int $street_num): self
    {
        if ($street_num > 0){
            $this->street_num = $street_num;
        }
        return $this;
    }

    public function getStreet_name(): string
    {
        
        return $this->street_name;
    }

   
    public function setStreet_name(string $street_name): self
    {
        if (strlen($street_name) >= 3 && strlen($street_name) <= 500){
            $this->street_name = $street_name;            
        }
        return $this;
    }

    public function getPostcode(): int
    {
        return $this->postcode;
    }

  
    public function setPostcode(int $postcode): self
    {
        if ($postcode > 0 && strlen($postcode) == 5){
            $this->postcode = $postcode;
        }
        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

   
    public function setCity(string $city): self
    {
        if (strlen($city) >= 3 && strlen($city) <= 50){
            $this->city = $city;
        }
        return $this;
    }


    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        if (strlen($message) <= 500){
            $this->message = $message;
        }        
        return $this;
    }

}
?>