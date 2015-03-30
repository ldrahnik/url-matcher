<?php

namespace UrlMatcher\Tests\Utils;

use UrlMatcher\Matcher;
use	Tester;
use	Tester\Assert;

require __DIR__ . '/../bootstrap.php';

/**
 * Class MatchTest
 *
 * @author Lukáš Drahník (http://drahnik-lukas.com/)
 * @package ldrahnik\MatcherTest\Tests
 *
 * @testCase
 */
class MatchTest extends Tester\TestCase
{
	function testMatch()
	{
		$patterns = [
			'foo' => 1,
			'bar' => 2
		];
		$mask = '<foo>/<foo>';
		$matcher = new Matcher($mask, $patterns);

		Assert::equal(true, $matcher->match('4/6'));
	}
}

$test = new MatchTest();
$test->run();
