<?php

namespace Linguistics;
/**
 * Caverphone phonetics encoding, versions 1.0 and 2.0.
 *
 * @since   1.2.0
 * @author  Carlos Matos - carlos@wp-helpers.com
 */
class Caverphone
{
	protected $version = '1.0';
	protected $string;

	public function __construct(string $string, int $version = null)
	{
		$this->string = strtolower($string);
	}
}