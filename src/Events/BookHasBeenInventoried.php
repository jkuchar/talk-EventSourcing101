<?php declare(strict_types=1);

namespace Library\Events;

use Library\BookId;
use Library\Uuid;

final class BookHasBeenInventoried implements DomainEvent
{

	/** @var BookId @readonly  */
	public $id;

	/** @var string @readonly */
	public $title;

	/** @var string @readonly */
	public $isbn;

	public function __construct(BookId $id, string $title, string $isbn)
	{
		$this->id = $id;
		$this->title = $title;
		$this->isbn = $isbn;
	}

	public function getAggregateId(): Uuid
	{
		return $this->id;
	}
}
