<?php

namespace UrlMatcher\Tests;

use	Tester;
use	Tester\Assert;
use UrlMatcher\Matcher;

require __DIR__ . '/bootstrap.php';

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

	function testDuplicatedOffset()
	{
		Assert::exception(function() {
			$patterns = [
				'foo' => 1,
				'bar' => 2
			];
			$mask = 'foo/bar';
			$offsets = [
				'separator_left' => '>',
				'separator_right' => '>'
			];

			$matcher = new Matcher($mask, $patterns, $offsets);
			Assert::equal('1/2', $matcher->parse());
		}, 'UrlMatcher\DuplicatedOffset');

		Assert::exception(function() {
			$patterns = [
				'foo' => 1,
				'bar' => 2
			];
			$mask = 'foo/bar';
			$offsets = [
				'separator_left' => '>',
				'separator_right' => '>'
			];

			$matcher = new Matcher($mask, $patterns, $offsets);
			Assert::equal('1/2', $matcher->parse());
		}, 'UrlMatcher\DuplicatedOffset');
	}
}

$test = new exceptionsTest();
$test->run();
