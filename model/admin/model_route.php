<?php

class route {
    private $departue_city;
    private $destination_city;
    private $distance;
    private $duration;

    public function __construct($departue_city, $destination_city, $distance, $duration) {
        $this->departue_city = $departue_city;
        $this->destination_city = $destination_city;
        $this->distance = $distance;
        $this->duration = $duration;
    }

    public function getDepartue_city()
    {
        return $this->departue_city;
    }
 
    public function getDestination_city()
    {
        return $this->destination_city;
    }
 
    public function getDistance()
    {
        return $this->distance;
    }
 
    public function getDuration()
    {
        return $this->duration;
    }
}



?>