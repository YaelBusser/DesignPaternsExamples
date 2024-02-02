<?php

// Memento
class TextEditorMemento extends History
{
    private $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }
}

// Originator
class TextEditor extends TextEditorMemento
{
    private $content;
    private $history;

    public function __construct()
    {
        $this->history = new History();
    }

    public function write($text)
    {
        $this->content .= $text;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function save()
    {
        $this->history->addMemento(new TextEditorMemento($this->content));
    }

    public function undo()
    {
        $lastMemento = $this->history->getPreviousMemento();
        if ($lastMemento !== null) {
            $this->content = $lastMemento->getContent();
        }
    }
}

// Caretaker
class History
{
    private $mementos = [];

    public function addMemento(TextEditorMemento $memento)
    {
        $this->mementos[] = $memento;
    }

    public function getPreviousMemento()
    {
        if (count($this->mementos) > 1) {
            array_pop($this->mementos);
            return end($this->mementos);
        }

        return null;
    }
}

$textEditor = new TextEditor();

$textEditor->write("CS ");
$textEditor->save();

$textEditor->write("< ");
$textEditor->save();

$textEditor->write("Valorant");
echo "Texte actuel : " . $textEditor->getContent() . "\n";

// L'utilisateur fait 2 ctrl+z
$textEditor->undo();
$textEditor->undo();
echo "Texte après 2 control+z : " . $textEditor->getContent() . "\n";

$textEditor->write("> ");
$textEditor->save();

$textEditor->write("Valorant");
$textEditor->save();

echo "Texte actuel mit à jour : " . $textEditor->getContent() . "\n";