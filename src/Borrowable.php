<?php

declare(strict_types=1);


interface Borrowable{
    public function BorrowBook();
    public function ReturnBook();
}