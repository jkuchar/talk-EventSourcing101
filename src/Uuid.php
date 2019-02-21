<?php declare(strict_types=1);


namespace Library;

use Ramsey\Uuid\UuidInterface;

/**
 * Very thin wrapper around bulky Ramsey UUID - isolating from its implementation
 */
abstract class Uuid implements \Serializable
{

	/** @var UuidInterface */
	private $uuid;

	private function __construct()
	{
	}

	/**
	 * @return static
	 */
	public static function generate() {
		$uuid = new static();
		$uuid->uuid = \Ramsey\Uuid\Uuid::uuid4();
		return $uuid;
	}

	/**
	 * @return static
	 */
	public static function of(string $uuidInString) {
		$uuid = new static();
		$uuid->uuid = \Ramsey\Uuid\Uuid::fromString($uuidInString);
		return $uuid;
	}

	/**
	 * @param string $validUUID A valid UUID in string
	 * @return static
	 */
	public static function reconstitute(string $validUUID) {
		return static::of($validUUID);
	}


	public function toString(): string
	{
		return $this->uuid->toString();
	}


	public function __toString(): string
	{
		return $this->toString();
	}


	public function serialize(): string
	{
		return \serialize($this->uuid);
	}


	/**
	 * @param string $serialized
	 */
	public function unserialize($serialized): void
	{
		$this->uuid = \unserialize($serialized, [\Ramsey\Uuid\Uuid::class]);
	}

	public function hash(): string
	{
		return $this->toString();
	}

	/**
	 * @param mixed $obj
	 */
	function equals($obj): bool
	{
		\assert(\is_object($obj));
		\assert($obj instanceof self);

		if (\get_class($obj) !== \get_class($this)) {
			// different child
			return FALSE;
		}

		return $this->toString() === $obj->toString();
	}

	public function __debugInfo()
	{
		return ['uuid' => (string)$this];
	}

}
