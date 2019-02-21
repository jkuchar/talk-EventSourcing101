<?php declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$book = \Library\Model\Book::inventorize(
	"The Hitchhiker's Guide to the Galaxy",
	'ISBN 978-80-257-0030-3'
);

$theHichhikersGuideFan = \Library\UserId::generate();

$book->lendTo($theHichhikersGuideFan);
$book->return($theHichhikersGuideFan);
print_r($book->getRecordedEvents());

//\Tester\Assert::exception(function() use ($book) {
//	$theHichhikersGuideFan2 = \Library\UserId::generate();
//	$book->lendTo($theHichhikersGuideFan2);
//}, \Library\Model\AlreadyLent::class);

