<?php
declare(strict_types=1);

require_once __DIR__ . '/src/Book.php';
require_once __DIR__ . '/src/Member.php';
require_once __DIR__ . '/src/Borrowable.php';
require_once __DIR__ . '/src/StudentMember.php';
require_once __DIR__ . '/src/RegularMember.php';
require_once __DIR__ . '/src/Library.php';
require_once __DIR__ . '/src/Loan.php';


$books = [
    new Book("Harry Potter", "JK Rowling"),
    new Book("Math Basics", "John Doe"),
    new Book("Physics Fundamentals", "Albert Newton"),
    new Book("Introduction to PHP", "Rasmus Lerdorf"),
    new Book("Clean Code", "Robert C. Martin"),
];

$student = new StudentMember("Ana");
$regular = new RegularMember("John");
$members = [$student, $regular];

$library = new Library();
foreach ($books as $book) {
    $library->addBook($book);
}

while (true) {
    echo "\n=== Library Menu ===\n";
    echo "1) Borrow a book\n";
    echo "2) Return a book\n";
    echo "3) View Summary\n";
    echo "4) Exit\n";

    $choice = readline("Select an option: ");

    switch ($choice) {
        case '1': 
            $name = readline("Enter your name: ");
            $member = null;
            foreach ($members as $m) {
                if (strtolower($m->__get('name')) === strtolower($name)) {
                    $member = $m;
                    break;
                }
            }

            if (!$member) {
                echo "Member not found!\n";
                break;
            }

            $availableBooks = $library->getAvailableBooks();
            if (empty($availableBooks)) {
                echo "No books are currently available for borrowing.\n";
                break;
            }

            echo "Available books:\n";
            foreach ($availableBooks as $i => $book) {
                echo ($i + 1) . ") " . $book->getInfo() . "\n";
            }

            $bookChoice = (int)readline("Choose a book number: ") - 1;
            if (!isset($availableBooks[$bookChoice])) {
                echo "Invalid book selection!\n";
                break;
            }

            try {
                echo $library->borrowBook($member, $availableBooks[$bookChoice]) . "\n";
            } catch (Exception $e) {
                echo $e->getMessage() . "\n";
            }
            break;

        case '2': 
            $name = readline("Enter your name: ");
            $member = null;
            foreach ($members as $m) {
                if (strtolower($m->__get('name')) === strtolower($name)) {
                    $member = $m;
                    break;
                }
            }

            if (!$member) {
                echo "Member not found!\n";
                break;
            }

            $memberLoans = array_filter($library->getActiveLoans(), fn($loan) => $loan->getMember() === $member);
            if (empty($memberLoans)) {
                echo "You have no books to return.\n";
                break;
            }

            echo "Books you can return:\n";
            $memberLoans = array_values($memberLoans);
            foreach ($memberLoans as $i => $loan) {
                echo ($i + 1) . ") " . $loan->getBook()->getInfo() . "\n";
            }

            $returnChoice = (int)readline("Choose book number to return: ") - 1;
            if (!isset($memberLoans[$returnChoice])) {
                echo "Invalid selection!\n";
                break;
            }

            try {
                echo $library->returnBook($member, $memberLoans[$returnChoice]->getBook()) . "\n";
            } catch (Exception $e) {
                echo $e->getMessage() . "\n";
            }
            break;

        case '3':
            echo "\n--- Available Books ---\n";
            foreach ($library->getAvailableBooks() as $book) {
                echo $book->getInfo() . "\n";
            }

            echo "\n--- Active Loans ---\n";
            foreach ($library->getActiveLoans() as $loan) {
                echo $loan->getMember()->__get('name') . " borrowed " . $loan->getBook()->__get('title') . "\n";
            }

            echo "\n--- Returned Loans ---\n";
            foreach ($library->getReturnedLoans() as $loan) {
                echo $loan->getMember()->__get('name') . " returned " . $loan->getBook()->__get('title') . "\n";
            }

            echo "\n--- Totals ---\n";
            echo "Total books: " . count($books) . "\n";
            echo "Available books: " . count($library->getAvailableBooks()) . "\n";
            echo "Total loans: " . (count($library->getActiveLoans()) + count($library->getReturnedLoans())) . "\n";
            echo "Active loans: " . count($library->getActiveLoans()) . "\n";
            echo "Returned loans: " . count($library->getReturnedLoans()) . "\n";
            break;

        case '4':
            echo "Goodbye!\n";
            exit;

        default:
            echo "Invalid option!\n";
    }
}
