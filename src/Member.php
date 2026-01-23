<?php
declare(strict_types=1);

abstract class Member implements Borrowable{
    private $name;
    private $memberId;
    
    public function __construct($name){
        $this->name=$name;
    }

    //magic method
    public function __get($property){
        if (property_exists($this,$property)){
            return $this->$property;
        }
    }


    abstract public function getType();
    abstract public function BorrowBook(Book $book);
    abstract public function ReturnBook(Book $book);
}

