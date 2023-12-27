<?php

class company
{
    private $name;
    private $img;

    public function __construct($name, $img)
    {
        $this->name = $name;
        $this->img = $img;
    }

    public function getImg()
    {
        return $this->img;
    }
    public function getName()
    {
        return $this->name;
    }
}
