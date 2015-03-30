<?php

namespace UrlMatcher\Tests\Utils;

use UrlMatcher\Matcher;
use	Tester;
use	Tester\Assert;

require __DIR__ . '/bootstrap.php';

/**
 * Class MatcherTest
 *
 * @author Lukáš Drahník (http://drahnik-lukas.com/)
 * @package ldrahnik\MatcherTest\Tests
 *
 * @testCase
 */
class MatcherTest extends Tester\TestCase
{
	function testMatcherDefaults()
	{
		$patterns = [
			'foo' => 1,
			'bar' => 2
		];
		$mask = '<foo>/<bar>';

		$matcher = new Matcher($mask, $patterns);
		Assert::equal('1/2', $matcher->parse());

		$patterns = [
			'foo' => null,
			'bar' => null
		];
		$mask = '<foo>/<bar>';

		$matcher = new Matcher($mask, $patterns);
		Assert::equal('/', $matcher->parse());
	}

	function testMatcherOffsets()
	{
		$patterns = [
			'foo' => 1,
			'bar' => 2
		];
		$mask = ':foo:/:bar:';
		$offsets = [
			'separator_lft' => ':',
			'separator_rgt' => ':',
			'optional_lft' => '[',
			'optional_rgt' => '/]'
		];
		$matcher = new Matcher($mask, $patterns);
		$matcher->setOffsets($offsets);
		Assert::equal('1/2', $matcher->parse());
	}
}

$test = new MatcherTest();
$test->run();
