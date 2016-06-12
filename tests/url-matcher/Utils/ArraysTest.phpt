<?php

namespace UrlMatcher\Tests\Utils;

use UrlMatcher\Utils\Arrays;
use	Tester;
use	Tester\Assert;

require __DIR__ . '/../bootstrap.php';

/**
 * Class ArraysTest
 *
 * @author Lukáš Drahník (http://ldrahnik.com)
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

	function testMergeOnlyExistKeys()
	{
		$defaults = [
			'a' => 'test',
			'c' => 'test',
		];
		$arr = [
			'a' => 'test2',
			'b' => 'test',
			'c' => 'test2'
		];
		$result = [
			'a' => 'test2',
			'c' => 'test2'
		];
		Assert::equal($result, Arrays::merge_only_exist_keys($defaults, $arr));
	}
}

$test = new ArraysTest();
$test->run();
