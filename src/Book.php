<?php
declare(strict_types=1);

class Book{
    private $title;
    private $author;

    public function __construct(string $title, string $author){
        $this->title = $title;
        $this->author = $author;
    }

    //magic method
    public function __get($property){
        if (property_exists($this,$property)){
            return $this->$property;
        }
    }

    public function getInfo(): string {
        return "Book: {$this->__get('title')} by {$this->__get('author')}";
    }
}

