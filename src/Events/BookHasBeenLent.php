<?php declare(strict_types=1);

namespace Library\Events;

use Library\BookId;
use Library\UserId;
use Library\Uuid;

final class BookHasBeenLent implements DomainEvent
{

	/** @var BookId @readonly  */
	public $id;

	/** @var UserId @readonly */
	public $lentTo;

	public function __construct(BookId $id, UserId $lentTo)
	{
		$this->id = $id;
		$this->lentTo = $lentTo;
	}

	public function getAggregateId(): Uuid
	{
		return $this->id;
	}
}
