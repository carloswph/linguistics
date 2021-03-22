<?php

namespace Linguistics;
/**
 * Process a string for returning The New York State Identification and 
 * Intelligence System Phonetic Code, commonly known as NYSIIS.
 *
 * @since   1.1.0
 * @author  Carlos Matos - carlos@wp-helpers.com
 * @link  https://naldc.nal.usda.gov/download/27833/PDF
 */
class Nysiis
{

	public $string;
	public $initial;

	public function __construct(string $string)
	{
		$this->string = strtolower($string);
		$this->initial = strtoupper($string[0]);

		$this->firstLetters();
		$this->lastLetters();
		$this->vowels();
		$this->consonants();
		$this->letterH();
		$this->letterW();
		$this->digraph();
		$this->lastChar();
	}

	public static function encode(string $string)
	{
		$encode = new self($string);
		return $encode->results();
	}

	/**
	 * Applies changes required by the algorithm for the first letters
	 * 
	 * If the first letters of the name are: 
	 * --> 'MAC' then change these letters to 'MCC'
	 * --> 'KN' then change these letters to 'NN'
	 * --> 'K' then change this letter to 'C'
	 * --> 'PH' then change these letters to 'FF'
	 * --> 'PF' then change these letters to 'FF'
	 * --> 'SCH' then change these letters to 'SSS'
	 *
	 * @since 1.1.1
	 * @return  void
	 */
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

	/**
	 * Applies changes required by the algorithm for the last letters
	 *
	 * If the last letters of the name are:
	 * 'EE' then change these letters to 'Y'
	 * 'IE' then change these letters to 'Y'
	 * 'DT' or 'RT' or 'RD' or 'NT' or 'ND' then change these letters to 'D'
	 *
	 * @since  1.1.1
	 * @return  void
	 */
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

	/**
	 * General vowels processing based on the algorithm
	 *
	 * If the current position is a vowel (AEIOU) then if equal to 'EV' then 
	 * change to 'AF' otherwise change current position to 'A'.
	 *
	 * @since  1.1.1
	 * @return  void
	 */
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

	/**
	 * General consonants processing based on the algorithm
	 *
	 * If the current position is the letter 'K' then if the next letter 
	 * is 'N' then replace the current position by 'N' otherwise replace 
	 * the current position by 'C'
	 *
	 * If the current position is the letter:
	 * --> 'Q' then change the letter to 'G'
	 * --> 'Z' then change the letter to 'S'
	 * --> 'M' then change the letter to 'N'
	 *
	 * @since  1.1.1
	 * @return  void
	 */
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

	public function letterH()
	{
		$exploded = str_split($this->string);
		$vowels = ['a', 'e', 'i', 'o', 'u'];

		for ($i=0; $i < count($exploded); $i++) {
			if($exploded[$i] === 'h') {
				if(in_array($exploded[$i + 1], $vowels) || in_array($exploded[$i - 1], $vowels)) {

				} else {
					unset($exploded[$i]);
				}
			} 
		}

		$this->string = implode($exploded);
	}

	public function letterW()
	{
		$exploded = str_split($this->string);
		$vowels = ['a', 'e', 'i', 'o', 'u'];

		for ($i=0; $i < count($exploded); $i++) {
			if($exploded[$i] === 'w') {
				if(in_array($exploded[$i - 1], $vowels)) {
					unset($exploded[$i]);
				}
			} 
		}

		$this->string = implode($exploded);
	}

	public function digraph()
	{
		$this->string = str_replace('sch', 'sss', $this->string);
		$this->string = str_replace('ph', 'ff', $this->string);
	}

	/**
	 * Manages rules to the last or second last characters
	 * --> If the last character of the NYSIIS code is the letter 'S' then remove it.
	 * --> If the last two characters of the NYSIIS code are the letters 'AY' then replace them with the single character 'Y'.
	 * --> If the last character of the NYSIIS code is the letter 'A' then remove this letter.
	 *
	 * @since  1.1.0
	 * @return  void
	 */
	public function lastChar()
	{
		$exploded = str_split($this->string);

		if(end($exploded) === 's' || end($exploded) === 'a' ) {
			$last = count($exploded) - 1;
			unset($exploded[$last]);
		}

		if(end($exploded) === 'y' && prev($exploded) === 'a') {
			$last = count($exploded) - 2;
			unset($exploded[$last]);
		}

		$this->string = implode($exploded);
	}

	/**
	 * Return the results after applying the full algorithm
	 *
	 * @since  1.1.0
	 * @return  $this->string (uppercase)
	 */
	public function results()
	{
		return strtoupper($this->string);
	}


}