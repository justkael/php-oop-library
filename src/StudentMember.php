<?php
declare(strict_types=1);

class StudentMember extends Member implements Borrowable{

    public function getType(){
    return "Student";
    }

    public function BorrowBook(Book $book){
        return "Student  {$this->__get('name')} borrowed {$book->__get('title')}";
    }
    
    public function ReturnBook(Book $book){
        return "Student  {$this->__get('name')} returned {$book->__get('title')}";
    }
}