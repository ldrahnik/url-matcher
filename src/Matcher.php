<?php

namespace UrlMatcher;

use UrlMatcher\Checker\Checker;
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
		'optional_rgt' => ']'
	];

	/**
	 * Obtain array $patterns ('key' => 'value') and string $mask if there are 'key's in $mask method will replace them.
	 *
	 * @param $mask
	 * @param $patterns
	 * @param $offsets
	 */
	public function __construct($mask, array $patterns = [], array $offsets = [])
	{
		$this->mask = $mask;
		$this->patterns = $patterns;
		$this->setOffsets($offsets);
	}

	/**
	 * @return string
	 */
	public function parse()
	{
		$patterns = [];
		foreach ($this->patterns as $k => $v) {
			unset ($patterns[$k]);
			$patterns[$this->offsets['separator_lft'] . $k . $this->offsets['separator_rgt']] = $v;
		}
		$sub_patterns = str_replace(array_keys($patterns), array_values($patterns), $this->mask);

		$checker = new Checker($this->offsets['optional_lft'], $this->offsets['optional_rgt']);
		return $checker->decode($sub_patterns);
	}

	/**
	 * Test if url corresponds with $mask
	 *
	 * @param $url
	 * @return bool
	 */
	public function match($url)
	{
		if(substr_count($url, '/') == substr_count($this->mask, '/')) {
			return true;
		}
		return false;
	}

	/**
	 * @param array $offsets
	 * @return array
	 */
	public function setOffsets($offsets)
	{
		if(isset($offsets['optional_lft']) && strlen($offsets['optional_lft']) > 1) {
			throw new InvalidParameter("Start char of optional block must be type of char:" . $offsets['optional_lft']);
		}
		if(isset($offsets['optional_rgt']) && strlen($offsets['optional_rgt']) > 1) {
			throw new InvalidParameter("End char of optional block must be type of char:" . $offsets['optional_rgt']);
		}
		$this->offsets = Arrays::merge_only_exist_keys($this->defaultOffsets, $offsets);
	}

	public function setOffsetsDefault()
	{
		$this->offsets = $this->defaultOffsets;
	}

	/**
	 * @return array
	 */
	public function getOffsets()
	{
		return $this->offsets;
	}

	/**
	 * @return array
	 */
	public function getPatterns()
	{
		return $this->patterns;
	}

	/**
	 * @param array $patterns
	 */
	public function setPatterns($patterns)
	{
		$this->patterns = $patterns;
	}

	/**
	 * @return string
	 */
	public function getMask()
	{
		return $this->mask;
	}

	/**
	 * @param string $mask
	 */
	public function setMask($mask)
	{
		$this->mask = $mask;
	}
} 