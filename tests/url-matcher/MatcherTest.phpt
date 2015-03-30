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
			'optional_rgt' => ']'
		];
		$matcher = new Matcher($mask, $patterns);
		$matcher->setOffsets($offsets);
		Assert::equal('1/2', $matcher->parse());
	}

	function testMatcherOptional()
	{
		$patterns = [
			'foo' => 111,
			'bar' => 222
		];
		$mask = '[<foo>/]<bar>';
		$matcher = new Matcher($mask, $patterns);

		$result = [
			'222',
			'111/222'
		];
		Assert::equal($result, $matcher->parse());
	}

	function testMatcherOptional2()
	{
		$patterns = [
			'foo' => 111,
			'bar' => 222
		];
		$mask = '<foo>[/<bar>]/<foo>';
		$matcher = new Matcher($mask, $patterns);

		$result = [
			'111/111',
			'111/222/111'
		];
		Assert::equal($result, $matcher->parse());
	}

	function testMatcherOptional3()
	{
		$patterns = [
			'foo' => 111,
			'bar' => 222
		];
		$mask = '<foo>[/<bar>]/<foo>[/<bar>]';
		$matcher = new Matcher($mask, $patterns);

		$result = [
			'111/111',
			'111/222/111',
			'111/111/222',
			'111/222/111/222'
		];
		Assert::equal($result, $matcher->parse());
	}
}

$test = new MatcherTest();
$test->run();
