<?php

namespace Linguistics;
/**
 * Process a string for returning The New York State Identification and 
 * Intelligence System Phonetic Code, commonly known as NYSIIS.
 *
 * @since   1.1.0
 * @author  Carlos Matos - carlos@wp-helpers.com
 */
class Nysiis
{

	public $string;
	public $initial;

	public function __construct(string $string)
	{
		$this->string = strtolower($string);
		$this->initial = strtoupper($string[0]);
	}

	public function firstLetters()
	{
		$three = substr($this->string, 0, 3);
		if ($three === 'mac') {
			$this->string = substr_replace($this->string, 'mcc', 0, 3);
		}
		if ($three === 'sch') {
			$this->string = substr_replace($this->string, 'sss', 0, 3);
		}

		$two = substr($this->string, 0, 2);
		if ($two === 'pf' || $two === 'ph') {
			$this->string = substr_replace($this->string, 'ff', 0, 2);
			$this->initial = 'F';
		}
		if ($two === 'kn') {
			$this->string = substr_replace($this->string, 'nn', 0, 2);
			$this->initial = 'N';
		}

		$one = substr($this->string, 0, 1);
		if ($one === 'k') {
			$this->string = substr_replace($this->string, 'c', 0, 1);
			$this->initial = 'C';
		}

	}

	public function lastLetters()
	{
		$two = substr($this->string, -2);
		if ($two === 'ee' || $two === 'ie') {
			$this->string = substr_replace($this->string, 'y', -2, 2);
		}
		if ($two === 'nd' || $two === 'nt' || $two === 'rd' || $two === 'rt' || $two === 'dt') {
			$this->string = substr_replace($this->string, 'd', -2, 2);
		}
	}

	public function vowels()
	{
		$exploded = str_split($this->string);
		$vowels = ['a', 'e', 'i', 'o', 'u'];

		for ($i=0; $i < count($exploded); $i++) {

			if($exploded[$i] === 'e' && $exploded[$i + 1] === 'v') {
				$exploded[$i] = 'a';
				$exploded[$i + 1] = 'f';
			}

			if(in_array($exploded[$i], $vowels)) {
				$exploded[$i] = 'a';
			}
		}

		$this->string = implode($exploded);
	}

	public function consonants()
	{
		$exploded = str_split($this->string);

		for ($i=0; $i < count($exploded); $i++) {

			if($exploded[$i] === 'k' && $exploded[$i + 1] === 'n') {
				unset($exploded[$i]);
			}

			if($exploded[$i] === 'q') {
				$exploded[$i] = 'g';
			}
			if($exploded[$i] === 'z') {
				$exploded[$i] = 's';
			}
			if($exploded[$i] === 'm') {
				$exploded[$i] = 'n';
			}

		}

		$this->string = implode($exploded);

	}

	public function lastChar()
	{
		$exploded = str_split($this->string);

		if(end($exploded) === 's' || end($exploded) === 'a' ) {
			$last = count($exploded) - 1;
			unset($exploded[$last]);
		}

		$this->string = implode($exploded);
	}

	public function results()
	{
		return strtoupper($this->string);
	}


}