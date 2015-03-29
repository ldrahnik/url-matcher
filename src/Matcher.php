<?php

namespace UrlMatcher;

use UrlMatcher\Utils\Arrays;

/**
 * Class Matcher
 *
 * @author Lukáš Drahník (http://drahnik-lukas.com/)
 * @package ldrahnik\UrlMatcher\Utils
 */
class Matcher {


	/** @var string */
	private $mask;

	/** @var array */
	private $patterns;

	/** @var array */
	private $offsets;

	private $defaultOffsets = [
		'separator_lft' => '<',
		'separator_rgt' => '>',
		'optional_lft' => '[',
		'optional_rgt' => '/]'
	];

	/**
	 * Obtain array $patterns ('key' => 'value') and string $mask if there are 'key's in $mask method will replace them.
	 *
	 * @param $mask
	 * @param $patterns
	 * @param $offsets
	 */
	public function __construct($mask, array $patterns, $offsets = [])
	{
		$this->mask = $mask;
		$this->patterns = $patterns;
		$this->offsets = $this->setOffsets($offsets);
	}

	/**
	 * @return string
	 */
	public function parse()
	{
		$result = str_replace(array_keys($this->patterns), array_values($this->patterns), $this->mask);

		$patterns = [];
		foreach ($this->patterns as $k => $v) {
			unset ($patterns[$k]);
			$patterns[$this->offsets['separator_lft'] . $k . $this->offsets['separator_rgt']] = $v;
		}

		return $result;
	}

	/**
	 * @param array $offsets
	 * @return array
	 */
	public function setOffsets($offsets)
	{
		if(count(array_unique($offsets))<count($offsets)) {
			throw new DuplicatedOffset("Duplicated the same offset value.");
		}
		return Arrays::merge($offsets, $this->defaultOffsets);
	}
} 