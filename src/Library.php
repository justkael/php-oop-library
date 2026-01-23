<?php
declare(strict_types=1);

class Library
{
    private array $availableBooks = [];
    private array $activeLoans = [];
    private array $returnedLoans = [];

    public function addBook(Book $book): void
    {
        $this->availableBooks[] = $book;
    }

    public function borrowBook(Member $member, Book $book): string
{

    $currentLoans = $this->countActiveLoans($member);

    $limit = 0;
    if ($member->getType() === "Student") {
        $limit = 1;
    } elseif ($member->getType() === "Regular") {
        $limit = 2;
    }

    if ($currentLoans >= $limit) {
        throw new Exception("Borrow FAILED: {$member->getType()} {$member->__get('name')} has reached the borrowing limit");
    }

    $loan = new Loan($book, $member);
    $this->activeLoans[] = $loan;

    return $member->BorrowBook($book);
}


    public function returnBook(Member $member, Book $book): string
    {
        foreach ($this->activeLoans as $index => $loan) {
            if (
                $loan->getBook() === $book &&
                $loan->getMember() === $member &&
                $loan->isActive()
            ) {
                $loan->markReturned();
                $this->returnedLoans[] = $loan;
                unset($this->activeLoans[$index]);

                return $member->ReturnBook($book);
            }
        }

        throw new Exception("No active loan found for this book and member.");
    }

    private function countActiveLoans(Member $member){
        $count = 0;

        foreach($this->activeLoans as $loan){
            if (
                $loan->getMember() === $member && $loan->isActive()
            ){
                $count++;
            }
        }
        return $count;
    }

    public function getAvailableBooks(): array {
    return array_filter($this->availableBooks, function($book) {
        foreach ($this->activeLoans as $loan) {
            if ($loan->getBook() === $book && $loan->isActive()) {
                return false; 
            }
        }
        return true; 
    });
}

public function getActiveLoans(): array {
    return $this->activeLoans;
}

public function getReturnedLoans(): array {
    return $this->returnedLoans;
}

}