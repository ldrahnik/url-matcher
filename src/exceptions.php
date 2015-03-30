<?php

namespace UrlMatcher;

/**
 * Interface Exception
 *
 * @author Lukáš Drahník (http://drahnik-lukas.com/)
 * @package ldrahnik\UrlMatcher
 */
interface Exception
{

}

/**
 * Class InvalidParameter
 * @package ldrahnik\ViewKeeper
 */
class InvalidParameter extends \LogicException
{

}

/**
 * Class InvalidMask
 * @package ldrahnik\ViewKeeper
 */
class InvalidMask extends \LogicException
{

}