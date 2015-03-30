<?php

namespace UrlMatcher\Utils;

/**
 * Class Url
 *
 * @author Lukáš Drahník (http://drahnik-lukas.com/)
 * @package ldrahnik\UrlMatcher\Utils
 */
class Url {

	/**
	 * Fo example url: '1/3/5' function returns 3.
	 *
	 * @param $url
	 * @return int
	 */
	public static function getBlocksCount($url)
	{
		$url_blocks = 1;
		for($i = 0; $i < strlen($url); $i++) {
			if($url[$i] == '/' && $i != 0 && $i+1 != strlen($url)) {
				$url_blocks++;
			}
		}
		return $url_blocks;
	}
}