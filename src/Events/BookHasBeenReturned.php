<?php declare(strict_types=1);

namespace Library\Events;

use Library\BookId;
use Library\UserId;
use Library\Uuid;

final class BookHasBeenReturned implements DomainEvent
{

	/** @var Uuid @readonly  */
	public $id;

	/** @var UserId @readonly */
	public $returnedBy;

	public function __construct(BookId $id, UserId $returnedBy)
	{
		$this->id = $id;
		$this->returnedBy = $returnedBy;
	}

	public function getAggregateId(): Uuid
	{
		return $this->id;
	}
}
