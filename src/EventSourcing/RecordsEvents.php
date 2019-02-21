<?php

namespace Library\EventSourcing;

interface RecordsEvents
{
	public function getRecordedEvents(): DomainEvents;

	public function clearRecordedEvents(): void;

}
