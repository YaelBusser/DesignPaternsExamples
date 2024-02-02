<?php

class BlogPost extends BlogSubscriber
{
    private $title;
    private $content;
    private $observers = [];

    public function attach(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function publishPost($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
        $this->notifyObservers();
    }

    private function notifyObservers()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }
}

interface Observer
{
    public function update(BlogPost $blogPost);
}

class BlogSubscriber implements Observer
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function update(BlogPost $blogPost)
    {
        echo "Salut {$this->name}, un nouveau sujet a été publié !\n";
        echo "Titre: {$blogPost->getTitle()}\n";
        echo "Contenu: {$blogPost->getContent()}\n\n";
    }
}

$blog = new BlogPost();

$subscriber1 = new BlogSubscriber("Adrien");
$subscriber2 = new BlogSubscriber("Timéo");
$subscriber3 = new BlogSubscriber("Martin");

$blog->attach($subscriber1);
$blog->attach($subscriber2);

$blog->publishPost("Pourquoi CS est mieux que Valorant ?", "-Valorant a été inspiré par CS \n -CS a un meilleur contrôle. \n -CS a plus de défi. \n -Il est plus difficile de distinguer les personnages sur CS");
