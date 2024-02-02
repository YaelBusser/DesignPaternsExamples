<?php

interface State
{
    public function turnOn();
    public function turnOff();
}

class OnState extends Lamp implements State
{
    public function turnOn()
    {
        echo "La lampe est déjà allumée.\n";
        return $this;
    }

    public function turnOff()
    {
        echo "La lampe est éteinte maintenant.\n";
        return new OffState();
    }
}

class OffState extends Lamp implements State
{
    public function turnOn()
    {
        echo "La lampe est allumée maintenant.\n";
        return new OnState();
    }

    public function turnOff()
    {
        echo "La lampe est déjà éteinte.\n";
        return $this;
    }
}

class Lamp
{
    private $state;

    public function __construct()
    {
        $this->state = new OffState();
    }

    public function turnOn()
    {
        $this->state = $this->state->turnOn();
    }

    public function turnOff()
    {
        $this->state = $this->state->turnOff();
    }
}

$lamp = new Lamp();

$lamp->turnOff();
$lamp->turnOn();
$lamp->turnOff();
$lamp->turnOff();
$lamp->turnOn();
$lamp->turnOn();