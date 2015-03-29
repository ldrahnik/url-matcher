<?php

namespace UrlMatcher\Utils;

/**
 * Class Arrays
 *
 * @author Lukáš Drahník (http://drahnik-lukas.com/)
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
}