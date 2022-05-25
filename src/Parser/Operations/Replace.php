<?php

namespace FineDiff\Parser\Operations;

class Replace implements OperationInterface
{
	/**
     * @var int|string
	 */
	private $len;

	/**
	 */
	private string $text;

	/**
     * @param int|string $fromLen
	 */
	public function __construct($fromLen, string $text)
	{
		$this->len = $fromLen;
		$this->text = $text;
	}

	/**
	 * @inheritdoc
	 */
	public function getFromLen()
	{
		return $this->len;
	}

	/**
	 * @inheritdoc
	 */
	public function getToLen(): int
	{
		return mb_strlen($this->text);
	}

	/**
	 * Get the text the operation is working with.
	 *
	 */
	public function getText(): string
	{
		return $this->text;
	}

	/**
	 * @inheritdoc
	 */
	public function getOperationCode(): string
	{
		if ($this->len === 1) {
			$del_opcode = static::DELETE;
		} else {
			$del_opcode = static::DELETE.$this->len;
		}

		$to_len = mb_strlen($this->text);

		if ($to_len === 1) {
			return $del_opcode.static::INSERT.':'.$this->text;
		}

		return $del_opcode.static::INSERT.$to_len.':'.$this->text;
	}
}
