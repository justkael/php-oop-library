<?php
declare(strict_types=1);

class RegularMember extends Member implements Borrowable{
   
public function getType(){
        return "Regular";
    }

    public function BorrowBook(Book $book){
        return "Regular  {$this->__get('name')} borrowed {$book->__get('title')}";
    }
    
    public function ReturnBook(Book $book){
        return "Regular  {$this->__get('name')} returned {$book->__get('title')}";
    }
}

