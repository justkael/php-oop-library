<?php
declare(strict_types=1);


require_once __DIR__ . '/src/Book.php';
require_once __DIR__ . '/src/Member.php';
require_once __DIR__ . '/src/Borrowable.php';
require_once __DIR__ . '/src/StudentMember.php';
require_once __DIR__ . '/src/RegularMember.php';

// require_once __DIR__ . '/src/Loan.php';


$book1 = new Book("Harry Potter", "JK Rowling");
$student = new StudentMember("Ana", 101);
$student2 = new RegularMember("John", 102);

echo $book1->getInfo();
echo "\n";
echo $student->getInfo();
echo "\n";
echo $student2->getInfo();
