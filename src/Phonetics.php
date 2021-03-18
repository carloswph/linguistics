<?php

namespace Linguistics;
/**
 * Organized use of PHP's phonetics functions and convertion of
 * words and entire sentences to the IPA phonetic symbols.
 *
 * @since   1.0.0
 * @author  Carlos Matos - carlos@wp-helpers.com
 */
class Phonetics
{

	public static function symbols(string $string, string $format = 'txt')
	{
		$words = explode(' ', strtolower($string));

		$results = [];

		foreach ($words as $word) {
			$json = file_get_contents(__DIR__ . '/data/en_us/' . $word[0] . '.json');
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

	public static function soundex(string $string, string $format = 'txt')
	{
		$words = explode(' ', strtolower($string));

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

	public static function metaphone(string $string, string $format = 'txt')
	{
		$words = explode(' ', strtolower($string));

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
}