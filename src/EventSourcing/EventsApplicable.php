<?php

namespace Library\EventSourcing;

use Library\Events\DomainEvent;

interface EventsApplicable
{
	/**
	 * Apply domain event if this aggregate accepts this event
	 * @param DomainEvent $domainEvent
	 * @internal
	 */
	public function applyIfAccepts(DomainEvent $domainEvent): void;

	/**
	 * Apply domain event; if objects does not accepts this event -> fail
	 * @param DomainEvent $domainEvent
	 */
	public function apply(DomainEvent $domainEvent): void;
}
