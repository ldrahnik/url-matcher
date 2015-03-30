<?php

namespace UrlMatcher\Tests\Utils;

use UrlMatcher\Matcher;
use	Tester;
use	Tester\Assert;

require __DIR__ . '/../bootstrap.php';

/**
 * Class ParseTest
 *
 * @author Lukáš Drahník (http://drahnik-lukas.com/)
 * @package ldrahnik\MatcherTest\Tests
 *
 * @testCase
 */
class ParseTest extends Tester\TestCase
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

	function testMatcherOptional4() {
		$patterns = [
			'lang' => 'cz',
			'presenter' => 'home',
			'action' => 4
		];
		$mask = '[<lang>/]<presenter>/<action>';
		$matcher = new Matcher($mask, $patterns);
		$result =  [
			'home/4',
			'cz/home/4',
		];

		Assert::equal($result, $matcher->parse());
	}
}

$test = new ParseTest();
$test->run();
