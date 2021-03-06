<?php

namespace UrlMatcher\Utils;

/**
 * Class Strings
 *
 * @author Lukáš Drahník (http://ldrahnik.com)
 * @package ldrahnik\UrlMatcher\Utils
 */
class Strings {

	/**
	 * Take part of $string after $substring or $return.
	 *
	 * @param $string
	 * @param $substring
	 * @param $return
	 * @return string
	 */
	public static function strafter($string, $substring, $return = null)
	{
		$pos = strpos($string, $substring);
		if ($pos === false)
			return $return;
		else
			return(substr($string, $pos+strlen($substring)));
	}

	/**
	 * Take part of $string before $substring or $return.
	 *
	 * @param $string
	 * @param $substring
	 * @param $return
	 * @return string
	 */
	public static function strbefore($string, $substring, $return = null)
	{
		$pos = strpos($string, $substring);
		if ($pos === false)
			return $return;
		else
			return (substr($string, 0, $pos));
	}
} 