<?php
declare(strict_types=1);

class StudentMember extends Member implements Borrowable{

    public function getType(){
    return "Student";
    }

    public function BorrowBook(){

    }
    
    public function ReturnBook(){
        
    }
}