<?php

namespace Linguistics;
use Linguistics\Nysiis;
/**
 * Organized use of PHP's phonetics functions and convertion of
 * words and entire sentences to the IPA phonetic symbols.
 *
 * @since   1.0.0
 * @author  Carlos Matos - carlos@wp-helpers.com
 */
class Phonetics
{

	/**
	 * Gives the correspondent phonetic IPA symbology to each word
	 * avoiding repetitions
	 *
	 * @since  1.0.0
	 * @param  string  $string  	The string to be parsed and processed
	 * @param  string  $format  	Response format, optional
	 * @param  string  $language 	Language code for future dictionaries available
	 *
	 * @return  $results OR echoes text correspondence
	 */
	public static function symbols(string $string, string $format = 'txt', string $language = 'en_us')
	{
		$words = array_unique(explode(' ', strtolower(preg_replace("/[^\w\s]/", "", $string))));

		$results = [];

		foreach ($words as $word) {
			$json = file_get_contents(__DIR__ . '/data/' . $language . '/' . $word[0] . '.json');
			$res = json_decode($json, true);

			switch ($format) {
				case 'txt':
					echo '[ ' . $word . ' ] => ' . $res[$word] . '<br>';
					break;

				case 'array':
					$results[$word] = explode(',', $res[$word]);
					break;

				case 'json':
					$results[$word] = explode(',', $res[$word]);
					break;
				
				default:
					# code...
					break;
			}
		}

		if($format == 'array') {
			return $results;
		}

		if($format == 'json') {
			return json_encode($results);
		}
	}

	/**
	 * Gives the correspondent phonetic Soundex algorithm to each word
	 * avoiding repetitions
	 *
	 * @since  1.0.0
	 * @param  string  $string  	The string to be parsed and processed
	 * @param  string  $format  	Response format, optional
	 * @param  string  $language 	Language code for future dictionaries available
	 *
	 * @return  $results OR echoes text correspondence
	 */
	public static function soundex(string $string, string $format = 'txt')
	{
		$words = array_unique(explode(' ', strtolower(preg_replace("/[^\w\s]/", "", $string))));

		$results = [];

		foreach ($words as $word) {

			switch ($format) {
				case 'txt':
					echo '[ ' . $word . ' ] => ' . soundex($word) . '<br>';
					break;

				case 'array':
					$results[$word] = soundex($word);
					break;

				case 'json':
					$results[$word] = soundex($word);
					break;
				
				default:
					# code...
					break;
			}
		}

		if($format == 'array') {
			return $results;
		}

		if($format == 'json') {
			return json_encode($results);
		}
	}

	/**
	 * Gives the correspondent phonetic Metaphone to each word
	 * avoiding repetitions
	 *
	 * @since  1.1.0
	 * @param  string  $string  	The string to be parsed and processed
	 * @param  string  $format  	Response format, optional
	 * @param  string  $language 	Language code for future dictionaries available
	 *
	 * @return  $results OR echoes text correspondence
	 */
	public static function metaphone(string $string, string $format = 'txt')
	{
		$words = array_unique(explode(' ', strtolower(preg_replace("/[^\w\s]/", "", $string))));

		$results = [];

		foreach ($words as $word) {

			switch ($format) {
				case 'txt':
					echo '[ ' . $word . ' ] => ' . metaphone($word) . '<br>';
					break;

				case 'array':
					$results[$word] = metaphone($word);
					break;

				case 'json':
					$results[$word] = metaphone($word);
					break;
				
				default:
					# code...
					break;
			}
		}

		if($format == 'array') {
			return $results;
		}

		if($format == 'json') {
			return json_encode($results);
		}
	}

	/**
	 * Gives the correspondent phonetic New York State Identification and
	 * Intelligence System Phonetic Code to each word
	 * avoiding repetitions
	 *
	 * @since  1.1.0
	 * @param  string  $string  	The string to be parsed and processed
	 * @param  string  $format  	Response format, optional
	 * @param  string  $language 	Language code for future dictionaries available
	 *
	 * @uses  Nysiis::encode() static method
	 * @see  Linguistics\Nysiis
	 *
	 * @return  $results OR echoes text correspondence
	 */
	public static function nysiis(string $string, string $format = 'txt')
	{
		$words = array_unique(explode(' ', strtolower(preg_replace("/[^\w\s]/", "", $string))));

		$results = [];

		foreach ($words as $word) {

			switch ($format) {
				case 'txt':
					echo '[ ' . $word . ' ] => ' . Nysiis::encode($word) . '<br>';
					break;

				case 'array':
					$results[$word] = Nysiis::encode($word);
					break;

				case 'json':
					$results[$word] = Nysiis::encode($word);
					break;
				
				default:
					# code...
					break;
			}
		}

		if($format == 'array') {
			return $results;
		}

		if($format == 'json') {
			return json_encode($results);
		}
	}
}