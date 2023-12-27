<?php

class bus {
    private $matricule;
    private $number_of_bus;
    private $capacity;
    private $company;

    public function __construct($matricule, $number_of_bus, $capacity, $company) {
        $this->matricule = $matricule;
        $this->number_of_bus = $number_of_bus;
        $this->capacity = $capacity;
        $this->company = $company;
    }
    
    public function getMatricule()
    {
        return $this->matricule;
    }
 
    public function getNumber_of_bus()
    {
        return $this->number_of_bus;
    }
 
    public function getCapacity()
    {
        return $this->capacity;
    }
 
    public function getCompany()
    {
        return $this->company;
    }
}




?>