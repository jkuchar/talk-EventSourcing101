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


function whoHasBook(\Library\BookId $id): ?\Library\UserId {
	// todo implement
	return null;
};


// normally loaded from persistent storage
$loadedEvents = $eventsProduced;

$lentTo = false;

foreach($loadedEvents as $event) {

	echo 'Applying event ' . get_class($event) . "\n";

	if ($event instanceof \Library\Events\BookHasBeenLent) {
		$lentTo = $event->lentTo;
	}

	if ($event instanceof \Library\Events\BookHasBeenReturned) {
		$lentTo = null;
	}

	echo 'Lent to state ' . $lentTo . "\n";
	echo "\n";

}


