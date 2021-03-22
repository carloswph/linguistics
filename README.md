# Linguistics

 
[![Codacy Security Scan](https://github.com/carloswph/linguistics/actions/workflows/codacy-analysis.yml/badge.svg)](https://github.com/carloswph/linguistics/actions/workflows/codacy-analysis.yml)
[![License](https://img.shields.io/packagist/l/carloswph/linguistics.svg)](https://packagist.org/packages/carloswph/linguistics)

**NEW -->** Support to  NYSIIS encoding
**What's next? -->** Support to Caverphone, Arpabet

This package aims to provide a comprehensive group of new functions and methods to deal with linguistics and phonetics algorithms commonly used for developing or information technology. While PHP already offers functions to encode strings in metaphone and soundex algorithms, some other useful algorithms can't be reached from native functions.

Also, this package brings a dictionary to provide immediate conversion from almost any English word, from text to IPA phonetic symbols. For this moment, just en_US is available, but there are plans to include other languages or dialects eventually. 

# Installation

The easier way of using this package is to require it using Composer - although the package can be simply cloned and used, as long as the namespaces are respected.

`composer require carloswph/linguistics`

# Usage

This has been organized in independent classes. The first class Phonetics provide three different methods. The method symbols() converts a string in IPA phonetic symbols. If a longer string is provided, the class splits the string in words, returning the respective symbology to all words, excluding repetitions. Additionally, the class provides a bridge for applying the existent functions of PHP - metaphone() and soundex().

All methods offer three different possibilities of response: TXT, JSON or PHP array. It returns TXT by default, so if you want a different format, you can pass the additional argument in the method. A few examples will make it clearer:

```php

use Linguistics\Phonetics;

require __DIR__ . '/vendor/autoload.php';

$str = 'To be or not to be, that is the question';

Phonetics::symbols($str);
/*
Returns:

[ to ] => /ˈtu/, /tə/, /tɪ/
[ be ] => /ˈbi/, /bi/
[ or ] => /ˈɔɹ/, /ɝ/
[ not ] => /ˈnɑt/
[ that ] => /ˈðæt/, /ðət/
[ is ] => /ˈɪz/, /ɪz/
[ the ] => /ˈðə/, /ðə/, /ði/
[ question ] => /ˈkwɛstʃən/, /ˈkwɛʃən/
*/

Phonetics::soundex($str);
/*
Returns:

[ to ] => T000
[ be ] => B000
[ or ] => O600
[ not ] => N300
[ that ] => T300
[ is ] => I200
[ the ] => T000
[ question ] => Q235
*/
Phonetics::metaphone($str);
/*
Returns:

[ to ] => T
[ be ] => B
[ or ] => OR
[ not ] => NT
[ that ] => 0T
[ is ] => IS
[ the ] => 0
[ question ] => KSXN
*/

Phonetics::symbols($str, 'array');
/*
Returns:

array(8) { ["to"]=> array(3) { [0]=> string(6) "/ˈtu/" [1]=> string(6) " /tə/" [2]=> string(6) " /tɪ/" } ["be"]=> array(2) { [0]=> string(6) "/ˈbi/" [1]=> string(5) " /bi/" } ["or"]=> array(2) { [0]=> string(8) "/ˈɔɹ/" [1]=> string(5) " /ɝ/" } ["not"]=> array(1) { [0]=> string(8) "/ˈnɑt/" } ["that"]=> array(2) { [0]=> string(9) "/ˈðæt/" [1]=> string(8) " /ðət/" } ["is"]=> array(2) { [0]=> string(7) "/ˈɪz/" [1]=> string(6) " /ɪz/" } ["the"]=> array(3) { [0]=> string(8) "/ˈðə/" [1]=> string(7) " /ðə/" [2]=> string(6) " /ði/" } ["question"]=> array(2) { [0]=> string(15) "/ˈkwɛstʃən/" [1]=> string(14) " /ˈkwɛʃən/" } }
*/

Phonetics::symbols($str, 'json');
/*
Returns:

string(410) "{"to":["\/\u02c8tu\/"," \/t\u0259\/"," \/t\u026a\/"],"be":["\/\u02c8bi\/"," \/bi\/"],"or":["\/\u02c8\u0254\u0279\/"," \/\u025d\/"],"not":["\/\u02c8n\u0251t\/"],"that":["\/\u02c8\u00f0\u00e6t\/"," \/\u00f0\u0259t\/"],"is":["\/\u02c8\u026az\/"," \/\u026az\/"],"the":["\/\u02c8\u00f0\u0259\/"," \/\u00f0\u0259\/"," \/\u00f0i\/"],"question":["\/\u02c8kw\u025bst\u0283\u0259n\/"," \/\u02c8kw\u025b\u0283\u0259n\/"]}"
*/
```
## NYSIIS encoding

From v1.1.0, the Phonetics class was reinforced with an additional method which returns The New York State Identification and Intelligence System Phonetic Code, or NYSIIS, to every single word in a sentence (excluding repeated words). The use follows the same logic of the previous static methods.

```php
Phonetics::nysiis($str);
/*
Returns:

[ to ] => T
[ be ] => B
[ or ] => AR
[ not ] => NAT
[ that ] => THAT
[ is ] => A
[ the ] => TH
[ question ] => GAASTAAN
*/
```



# Underway

Three other classes are currently underway:

* An encoding class for Caverphone algorithm, versions 1.0 and 2.0
* An encoding class for Match Rating Approach comparison and string encoding implementation.
* An interesting legacy encoding on Arpabet algorithm
* Roger Root encoding?

The next stable version, 1.2.0, should already bring the Caverphone class, at least compatible for encoding the 1.0 version of this algorithm.
