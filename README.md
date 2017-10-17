ldrahnik/url-matcher
======

[![Build Status](https://travis-ci.org/ldrahnik/url-matcher.svg)](https://travis-ci.org/ldrahnik/url-matcher)
[![Latest stable](https://img.shields.io/packagist/v/ldrahnik/url-matcher.svg)](https://packagist.org/packages/ldrahnik/url-matcher)
[![Downloads total](https://img.shields.io/packagist/dt/ldrahnik/url-matcher.svg?style=flat-square)](https://packagist.org/packages/ldrahnik/url-matcher)

Requirements
------------

ldrahnik/url-matcher requires PHP 5.4 or higher.

- [Nette Framework](https://github.com/nette/nette)

Installation
------------

Install url-matcher to your project using  [Composer](http://getcomposer.org/):

```sh
$ composer require ldrahnik/url-matcher
```

Usage
-----

create url

```php
	$patterns = [
		'lang' => 'cz',
		'presenter' => 'home',
		'action' => 4
	];
	$mask = '[<lang>/]<presenter>/<action>';
	$matcher = new Matcher($mask, $patterns);
	
    	$results = $matcher->parse();
    	/*array [
		 'home/4',
		 'cz/home/4',
	];*/
```

confirm url

```php
	$mask = '[<lang>/]<presenter>[/<action>]';
	$matcher = new Matcher($mask);

	$result = $matcher->match('en/admin');
	// true
```
Examples
------------

```php
	$mask = 'root/<folder>/<subfolder>/<file>.latte';
	
	$matcher = new UrlMatcher\Matcher($mask, [
		'folder' => '*',
		'subfolder' => 'foo',
		'file' => '*'
	]);
	
	$mask = $matcher->parse();
	// root/*/foo/*.latte

	foreach (glob($mask) as $filename) {
		echo basename($filename);
	}
```

Configuration
-------------

```php
	$default = [
		'separator_lft' => '<',		
		'separator_rgt' => '>',		
		'optional_lft' => '[',		
		'optional_rgt' => ']'
	];
	$matcher = new Matcher(..., ..., $default);
```
