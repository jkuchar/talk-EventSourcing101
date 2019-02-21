<?php

namespace Library\EventSourcing;

interface ReconstitutesFromHistory
{
	/**
	 * @param \AggregateHistory $aggregateHistory
	 * @return static
	 */
	public static function reconstituteFrom(AggregateHistory $aggregateHistory);
}
