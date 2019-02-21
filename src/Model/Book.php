<?php declare(strict_types=1);

namespace Library\Model;

use Library\BookId;
use Library\Events\BookHasBeenInventoried;
use Library\Events\BookHasBeenLent;
use Library\Events\BookHasBeenReturned;
use Library\Events\DomainEvent;
use Library\EventSourcing\AbstractAggregate;
use Library\EventSourcing\AggregateHistory;
use Library\EventSourcing\DomainEvents;
use Library\EventSourcing\EventsApplicable;
use Library\EventSourcing\ReconstitutesFromHistory;
use Library\EventSourcing\RecordsEvents;
use Library\UserId;
use Library\Uuid;

final class Book extends AbstractAggregate
{

	/** @var BookId */
	private $id;

	public function __construct(BookId $id)
	{
		$this->id = $id;
	}

	public static function inventorize(string $title, string $isbn): self
	{
		$me = new self(BookId::generate());
		$me->recordThat(new BookHasBeenInventoried(
			$me->id,
			$title,
			$isbn
		));
		return $me;
	}

	/** @internal */
	public function applyBookHasBeenInventoried(BookHasBeenInventoried $event): void {
		// intentionally nothing
	}

	/**
	 * @param UserId $lentTo
	 * @throws AlreadyLent
	 */
	public function lendTo(UserId $lentTo): void
	{
		// todo: check invariants

		$this->recordThat(new BookHasBeenLent($this->id, $lentTo));
	}

	/** @internal */
	public function applyBookHasBeenLent(BookHasBeenLent $event): void
	{
		// todo: fix me
	}

	public function return(UserId $returnedBy): void
	{
		// todo: check invariants

		$this->recordThat(new BookHasBeenReturned(
			$this->id,
			$returnedBy
		));
	}

	/** @internal  */
	public function applyBookHasBeenReturned(BookHasBeenReturned $event): void
	{
		// todo
	}

}
