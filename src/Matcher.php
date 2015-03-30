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
		'optional_rgt' => ']'
	];

	/** @var array */
	private $results = [];

	/** @var int */
	private $depth = 0;

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

		$this->block($sub_patterns);

		if(count($this->results) > 1) {
			return $this->results;
		}
		return $this->results[0];
	}

	/**
	 * @param $string
	 * @return int
	 */
	public function block($string)
	{
		for($i = 0; $i < strlen($string); $i++) {
			if($string[$i] == $this->offsets['optional_lft']) {
				$this->depth++;
				$string = $this->block(substr($string, $i + 1));
				$i = 0;
			} else if($string[$i] == $this->offsets['optional_rgt']) {
				if(empty($this->results)) {
					$this->results[] = '';
					$this->results[] = substr($string, 0, $i);
				} else {
					$backup = $this->results;
					foreach($backup as $key => $field) {
						$backup[$key] = $field . substr($string, 0, $i);
					}
					$this->results = array_merge($this->results, $backup);
				}
				$this->depth--;

				if($i + 1 == strlen($string)) {
					if($this->depth == 0) {
						return substr($string, $i);
					} else {
						//error, ukonceni stringu bez vynoreni
					}
				} else {
					return substr($string, $i);
				}
			} else if($this->depth == 0) {
				if(empty($this->results)) {
					$this->results[] = $string[$i];
				} else {
					foreach ($this->results as $key => $field) {
						$this->results[$key] = $field . $string[$i];
					}
				}
			}
		}
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