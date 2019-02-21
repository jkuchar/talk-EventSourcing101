<?php

namespace Library\EventSourcing;

use Library\Uuid;
use Ramsey\Uuid\UuidInterface;

class AggregatePersister
{
	public function save(string $aggregateRoot, RecordsEvents $aggregate) : void {

	}

	public function load(string $aggregateRootType, Uuid $id) {

		// load event stream


	}
}
