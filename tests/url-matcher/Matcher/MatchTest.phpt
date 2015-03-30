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
		$mask = '<foo>/<foo>';
		$matcher = new Matcher($mask);

		Assert::equal(true, $matcher->match('4/6'));
	}

	function testMatch2()
	{
		$mask = '<foo>[/<foo>]';
		$matcher = new Matcher($mask);

		Assert::equal(true, $matcher->match('4/6'));
		Assert::equal(true, $matcher->match('4'));
	}

	function testMatch3()
	{
		$mask = '[<lang>/]<presenter>[/<action>]';
		$matcher = new Matcher($mask);

		Assert::equal(true, $matcher->match('en/admin'));
	}
}

$test = new MatchTest();
$test->run();
