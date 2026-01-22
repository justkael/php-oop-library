<?php
declare(strict_types=1);

class Loan
{
    private Book $book;
    private Member $member;
    private bool $active = true;

    public function __construct(Book $book, Member $member)
    {
        $this->book = $book;
        $this->member = $member;
    }

    public function getBook(): Book
    {
        return $this->book;
    }

    public function getMember(): Member
    {
        return $this->member;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function markReturned(): void
    {
        $this->active = false;
    }
}
