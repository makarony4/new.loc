<?php
class NoteBookProduct extends Product {
public $cpu;

public function __construct($name, $price, $cpu)
{
    parent::__construct($name, $price, $cpu);
    $this->cpu = $cpu;
}

public function getProduct()
{
    $out = parent::getProduct(); // TODO: Change the autogenerated stub
    $out .= "Processor: {$this->cpu}";
    return $out;
}

    public function getCpu()
    {
        return $this->cpu;
    }
}