<?php

namespace Linguistics;
use Linguistics\Phonetics;
/**
 * ARPABET (also spelled ARPAbet) is a set of phonetic transcription codes 
 * developed by Advanced Research Projects Agency (ARPA) as a part of their 
 * Speech Understanding Research project in the 1970s. It represents phonemes 
 * and allophones of General American English with distinct sequences of 
 * ASCII characters.
 *
 * This class implements a process to transform IPA symbology retrieved by
 * this package's Phonetics class into ASCII ARPAbet encoding
 *
 * @since   1.2.0
 * @author  Carlos Matos - carlos@wp-helpers.com
 */
class Arpabet
{
	public $string;

	public $ipa = [
		'ɑ' => 'AA',
		'æ' => 'AE',
		'ʌ' => 'AH',
		'ɔ' => 'AO',
		'aʊ' => 'AW',
		'ə' => 'AX',
		'ɚ' => 'ER',
		'ɝ' => 'ER',
		'aɪ' => 'AY',
		'ɛ' => 'EH'
	];

	public function __construct(string $string)
	{

		$this->string = $string;
		return 'PO';
	}

	public function getIPA()
	{
		
		$this->string = Phonetics::symbols($this->string, $format = 'array', $language = 'en_us');
		var_dump($this->string);
	}

	public function encode()
	{
		foreach ($this->string as $key => $value) {
			$symbols = str_split($value);
			for ($i=0; $i < count($symbols); $i++) {
				$symbols[$i] = $this->ipa[$symbols[$i]];
			}
			$this->string[$i] = implode($symbols);
		}
	}
}