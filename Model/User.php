<?php

class User {
    private $id;
    private $name;
    private $email;
    private $password;
    private $level;
    private $host;

    
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


    public function getName(): string
    {
        return $this->name;
    }

    
    public function setName(string $name): self
    {
        if (strlen($name) >= 3 && strlen($name) <= 50){
        $this->name = $name;            
        }
        return $this;
    }

    
    public function getEmail(): string
    {
        return $this->email;
    }

    
    public function setEmail(string $email): self
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->email = $email;
        }
        return $this;
    }

    
    public function getPassword(): string
    {
        return $this->password;
    }

   
    public function setPassword(string $password): self
    {
        $this->password = $password;
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

    public function getHost(): string
    {
        return $this->host;
    }

   
    public function setHost(string $host): self
    {
        if ($host === 'true' || 'false') {
            $this->host = $host;
        }
        return $this;
    }

}
?>