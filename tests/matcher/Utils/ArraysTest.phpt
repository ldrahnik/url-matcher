<?php

namespace UrlMatcher\Tests\Utils;

use UrlMatcher\Utils\Arrays;
use	Tester;
use	Tester\Assert;

require __DIR__ . '/../bootstrap.php';

/**
 * Class ArraysTest
 *
 * @author Lukáš Drahník (http://drahnik-lukas.com/)
 * @package ldrahnik\UrlMatcher\Tests
 *
 * @testCase
 */
class ArraysTest extends Tester\TestCase
{
	function testMerge()
	{
		$defaults = [
			'c' => 'test',
		];
		$arr = [
			'a' => 'test',
			'b' => 'test'
		];
		$result = [
			'a' => 'test',
			'b' => 'test',
			'c' => 'test'
		];
		Assert::equal($result, Arrays::merge($arr, $defaults));
	}
}

$test = new ArraysTest();
$test->run();
