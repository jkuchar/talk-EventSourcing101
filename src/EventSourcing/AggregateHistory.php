<?php

namespace Library\EventSourcing;

use ArrayObject;
use Library\Events\DomainEvent;
use Library\Uuid;

/**
 * Collection of domain events
 */
class AggregateHistory extends ArrayObject {

	private $aggregateId;

	public function __construct(Uuid $aggregateId, DomainEvents $domainEvents)
	{
		$this->aggregateId = $aggregateId;

		// type check for DomainEvent[]
		array_filter((array) $domainEvents, function(DomainEvent $domainEvent) {});

		parent::__construct((array) $domainEvents);
	}

	public function getAggregateId(): Uuid
	{
		return $this->aggregateId;
	}


}
