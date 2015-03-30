<?php

namespace UrlMatcher\Tests;

use	Tester;
use	Tester\Assert;
use UrlMatcher\Matcher;

require __DIR__ . '/../bootstrap.php';

/**
 * Class exceptionTest
 *
 * @author Lukáš Drahník (http://drahnik-lukas.com/)
 * @package ldrahnik\UrlMatcher\Tests
 *
 * @testCase
 */
class exceptionsTest extends Tester\TestCase
{

	function testInvalidParameter()
	{
		Assert::exception(function() {
			$offsets = [
				'optional_lft' => '[[[',
				'optional_rgt' => ']]]]'
			];
			$matcher = new Matcher('', array(), array());
			$matcher->setOffsets($offsets);
		}, 'UrlMatcher\InvalidParameter');
	}

	function testInvalidMask()
	{
		Assert::exception(function() {
			$matcher = new Matcher('[[', array(), array());
			$matcher->parse();
		}, 'UrlMatcher\InvalidMask');
	}
}

$test = new exceptionsTest();
$test->run();
