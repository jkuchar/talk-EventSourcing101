<?php declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$book = \Library\Model\Book::inventorize(
	"The Hitchhiker's Guide to the Galaxy",
	'ISBN 978-80-257-0030-3'
);

print_r($book->getRecordedEvents());

