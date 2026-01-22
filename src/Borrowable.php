<?php

declare(strict_types=1);


interface Borrowable{
    public function BorrowBook(Book $book);
    public function ReturnBook(Book $book);
}