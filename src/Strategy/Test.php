<?php

interface TransportStrategy
{
    public function goToAirport();
}

class BusTransport extends Traveler implements TransportStrategy
{
    public function goToAirport()
    {
        echo "Prendre le bus pour se rendre à l'aéroport.\n";
    }
}

class TaxiTransport extends Traveler implements TransportStrategy
{
    public function goToAirport()
    {
        echo "Commander un taxi pour se rendre à l'aéroport.\n";
    }
}

class BikeTransport extends Traveler implements TransportStrategy
{
    public function goToAirport()
    {
        echo "Monter à vélo pour se rendre à l'aéroport.\n";
    }
}

class Traveler
{
    private $transportStrategy;

    public function setTransportStrategy(TransportStrategy $transportStrategy)
    {
        $this->transportStrategy = $transportStrategy;
    }

    public function travelToAirport()
    {
        $this->transportStrategy->goToAirport();
    }
}

$traveler = new Traveler();

$traveler->setTransportStrategy(new BusTransport());
$traveler->travelToAirport();

$traveler->setTransportStrategy(new TaxiTransport());
$traveler->travelToAirport();

$traveler->setTransportStrategy(new BikeTransport());
$traveler->travelToAirport();