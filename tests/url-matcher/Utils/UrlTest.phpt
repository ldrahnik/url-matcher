<?php

namespace UrlMatcher\Tests\Utils;

use UrlMatcher\Utils\Url;
use	Tester;
use	Tester\Assert;

require __DIR__ . '/../bootstrap.php';

/**
 * Class UrlTest
 *
 * @author Lukáš Drahník (http://ldrahnik.com)
 * @package ldrahnik\UrlMatcher\Tests
 *
 * @testCase
 */
class UrlTest extends Tester\TestCase
{
	function testGetBlocksCount()
	{
		Assert::equal(3, Url::getBlocksCount('foo/foo/foo'));
		Assert::equal(3, Url::getBlocksCount('/foo/foo/foo'));
		Assert::equal(3, Url::getBlocksCount('/foo/foo/foo/'));
		Assert::equal(3, Url::getBlocksCount('foo/foo/foo/'));
		Assert::equal(0, Url::getBlocksCount(''));
	}
}

$test = new UrlTest();
$test->run();
