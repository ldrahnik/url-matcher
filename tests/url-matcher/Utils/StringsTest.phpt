<?php

namespace UrlMatcher\Tests\Utils;

use UrlMatcher\Utils\Strings;
use	Tester;
use	Tester\Assert;

require __DIR__ . '/../bootstrap.php';

/**
 * Class StringsTest
 *
 * @author Lukáš Drahník (http://ldrahnik.com)
 * @package ldrahnik\UrlMatcher\Tests
 *
 * @testCase
 */
class StringsTest extends Tester\TestCase
{
	function testStrafter()
	{
		$string = "Hello bar foo";
		$substring = "Hello";
		$substringNotExist = "fooo";

		$out = Strings::strafter($string, $substring);
		Assert::Equal(' bar foo', $out);

		$out2 = Strings::strafter($string, $substringNotExist);
		Assert::Equal(null, $out2);

		$out3 = Strings::strafter($string, $substringNotExist, '');
		Assert::Equal('', $out3);
	}

	function testStrbefore()
	{
		$string = "Hello bar foo";
		$substring = "bar";
		$substringNotExist = 'fooo';

		$out = Strings::strbefore($string, $substring);
		Assert::Equal('Hello ', $out);

		$out2 = Strings::strbefore($string, $substringNotExist);
		Assert::Equal(null, $out2);

		$out3 = Strings::strbefore($string, $substringNotExist, '');
		Assert::Equal('', $out3);
	}
}

$test = new StringsTest();
$test->run();
