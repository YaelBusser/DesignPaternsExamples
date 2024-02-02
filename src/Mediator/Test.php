<?php

interface Mediator
{
    public function sendMessage(User $user, $message);
}

class ConcreteMediator implements Mediator
{
    private $users = [];

    public function addUser(User $user)
    {
        $this->users[] = $user;
    }

    public function sendMessage(User $user, $message)
    {
        foreach ($this->users as $recipient) {
            if ($recipient !== $user) {
                $recipient->receiveMessage($user, $message);
            }
        }
    }
}

class User
{
    private $name;
    private $mediator;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function setMediator(Mediator $mediator)
    {
        $this->mediator = $mediator;
    }

    public function getName()
    {
        return $this->name;
    }

    public function sendMessage($message)
    {
        $this->mediator->sendMessage($this, $message);
    }

    public function receiveMessage(User $sender, $message)
    {
        echo $this->name . " a reçu de " . $sender->getName() . " : " . $message . "\n";
    }
}

$yael = new User("Yael");
$adrien = new User("Adrien");
$timeo = new User("Timéo");

$mediator = new ConcreteMediator();

$mediator->addUser($yael);
$mediator->addUser($adrien);
$mediator->addUser($timeo);

$yael->setMediator($mediator);

$yael->sendMessage("Salut");