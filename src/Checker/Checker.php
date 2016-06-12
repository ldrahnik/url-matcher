<?php

namespace UrlMatcher\Checker;

use UrlMatcher\InvalidMask;

/**
 * Class Checker
 *
 * @author Lukáš Drahník (http://ldrahnik.com)
 * @package ldrahnik\UrlMatcher\Checker
 */
class Checker {

	/** @var array */
	private $results = [];

	/** @var int */
	private $depth = 0;

	/** @var */
	private $separator_start;

	/** @var */
	private $separator_end;

	public function __construct($separator_start, $separator_end)
	{
		$this->separator_start = $separator_start;
		$this->separator_end = $separator_end;
	}

	/**
	 * @param $string
	 * @param $arr
	 * @return array | string
	 * @throw InvalidMask
	 */
	public function decode($string, $arr)
	{
		$this->block($string);
		if(count($this->results) > 1 || $arr) {
			return $this->results;
		} else if(empty($this->results)) {
			throw new InvalidMask("Mask is not valid.");
		}
		return $this->results[0];
	}

	/**
	 * @param $string
	 * @return int
	 */
	private function block($string)
	{
		for($i = 0; $i < strlen($string); $i++) {
			if($string[$i] == $this->separator_start) {
				$this->depth++;
				$string = $this->block(substr($string, $i + 1));
				$i = 0;
			} else if($string[$i] == $this->separator_end) {
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
						throw new InvalidMask("Mask is not valid.");
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
}