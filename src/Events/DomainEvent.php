<?php
namespace Library\Events;

use Library\Uuid;

interface DomainEvent
{

	/**
	 * Aggregate instance identifier (must be unique per aggregate)
	 */
	public function getAggregateId(): Uuid;

}
