<?php declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$book = \Library\Model\Book::inventorize(
	"The Hitchhiker's Guide to the Galaxy",
	'ISBN 978-80-257-0030-3'
);

$theHichhikersGuideFan = \Library\UserId::generate();
$theHichhikersGuideFan2 = \Library\UserId::generate();

$book->lendTo($theHichhikersGuideFan);
$book->return($theHichhikersGuideFan);

$book->lendTo($theHichhikersGuideFan2);

$eventsProduced = $book->getRecordedEvents();

// --------------------------



// normally loaded from persistent storage
$loadedEvents = $eventsProduced;

/** @var null|\Library\UserId $lentTo */
$lentTo = null;

foreach($loadedEvents as $event) {

	echo 'Applying event ' . get_class($event) . "\n";

	if ($event instanceof \Library\Events\BookHasBeenLent) {
		$lentTo = $event->lentTo;
	}

	if ($event instanceof \Library\Events\BookHasBeenReturned) {
		$lentTo = null;
	}

	file_put_contents(__DIR__ . '/data/'. $event->getAggregateId(), (string) $lentTo);

	echo 'Lent to state ' . $lentTo . "\n";
	echo "\n";

}


function whoHasTheBook(\Library\BookId $id): ?\Library\UserId {
	$data = \file_get_contents(__DIR__ . '/data/'. $id);
	\assert($data !== false);
	if ($data === '') {
		return null;
	}
	return \Library\UserId::reconstitute($data);
};


