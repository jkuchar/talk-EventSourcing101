<?php declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$bookId = \Library\BookId::generate();
$user1 = \Library\UserId::generate();

$book = \Library\Model\Book::reconstituteFrom(
	new \Library\EventSourcing\AggregateHistory(
		$bookId,
		new \Library\EventSourcing\DomainEvents([
			new \Library\Events\BookHasBeenInventoried(
				$bookId,
				"The Hitchhiker's Guide to the Galaxy",
				'ISBN 978-80-257-0030-3'
			),
			new \Library\Events\BookHasBeenLent(
				$bookId,
				$user1
			),
		])
	)
);


\Tester\Assert::exception(function() use ($book) {
	$theHichhikersGuideFan2 = \Library\UserId::generate();
	$book->lendTo($theHichhikersGuideFan2);
}, \Library\Model\AlreadyLent::class);

