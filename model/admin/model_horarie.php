
<?php

class horaire
{
    private $departure_time;
    private $destination_time;
    private $matricule;
    private $date;
    private $available_seats;
    private $departure_city;
    private $destination_city;

    public function __construct($departure_time, $destination_time, $matricule, $date, $available_seats, $departure_city, $destination_city)
    {
        $this->departure_time = $departure_time;
        $this->destination_time = $destination_time;
        $this->matricule = $matricule;
        $this->date = $date;
        $this->available_seats = $available_seats;
        $this->departure_city = $departure_city;
        $this->destination_city = $destination_city;
    }

    public function toJson() {
        return get_object_vars($this);
    }

    public function getDeparture_time()
    {
        return $this->departure_time;
    }
 
    public function getDestination_time()
    {
        return $this->destination_time;
    }
 
    public function getMatricule()
    {
        return $this->matricule;
    }
 
    public function getDate()
    {
        return $this->date;
    }
 
    public function getAvailable_seats()
    {
        return $this->available_seats;
    }
 
    public function getDeparture_city()
    {
        return $this->departure_city;
    }
 
    public function getDestination_city()
    {
        return $this->destination_city;
    }
}

