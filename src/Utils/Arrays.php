<?php

namespace UrlMatcher\Utils;

/**
 * Class Arrays
 *
 * @author Lukáš Drahník (http://ldrahnik.com)
 * @package ldrahnik\UrlMatcher\Utils
 */
class Arrays
{
	/**
	 * @param $arr
	 * @param $defaults
	 * @return array
	 */
	public static function merge($arr, $defaults)
	{
		if($arr == NULL) {
			return $defaults;
		} else {
			return array_merge($defaults, $arr);
		}
	}

	/**
	 * @param $arr
	 * @param $defaults
	 * @return array
	 */
	public static function merge_only_exist_keys($arr, $defaults)
	{
		$merged = array_intersect_key($defaults, $arr) + $arr;
		ksort($merged);
		return $merged;
	}
}