<?php
/**
 * @version 		$Id: pluralise.php 577 2016-01-04 15:44:19Z BrianWade $
 * @name			Component Architect (Release 1.2.0)
 * @author			Component Architect (www.componentarchitect.com)
 * @package			com_componentarchitect
 * @subpackage		com_componentarchitect.admin
 * @copyright		Copyright (c)2013 - 2016 Simply Open Source Ltd. (trading as Component Architect). All Rights Reserved
 * @license			GNU General Public License version 3 or later; See http://www.gnu.org/copyleft/gpl.html 
 * 
 * The following Component Architect header section must remain in any distribution of this file
 *
 * @CAversion		Id: pluralise.php 386 2012-10-11 11:29:59Z BrianWade $
 * @CAauthor		Component Architect (www.componentarchitect.com)
 * @CApackage		architectcomp
 * @CAsubpackage	architectcomp.admin
 * @CAtemplate		joomla_2_5_enhanced (Release 1.0.0)
 * @CAcopyright		Copyright (c)2013 - 2016 Simply Open Source Ltd. (trading as Component Architect). All Rights Reserved
 * @Joomlacopyright Copyright (c)2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @CAlicense		GNU General Public License version 3 or later; See http://www.gnu.org/copyleft/gpl.html
 * 
 * This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
 */

defined('_JEXEC') or die;
/**
 * Pluralise word helper.
 *
 * 
 */
class ComponentArchitectPluraliseHelper
{

	/**
	 * Constructor.
	 *
	 * @param	array An optional associative array of configuration settings.
	 * 
	 */
	public function __construct()
	{

	}		
	/**
	* Capitalise a word in the same way as a sample word
	* 
	* pluralises the given singular noun.  There are three ways to call it:
	*   pluralise(noun) -> pluralNoun
	*     Returns the plural of the given noun.
	*   Example: 
	*     pluralise("person") -> "people"
	*     pluralise("me") -> "us"
	*
	*   pluralise(noun, count) -> plural or singular noun
	*   Inflect the noun according to the count, returning the singular noun
	*   if the count is 1.
	*   Examples:
	*     pluralise("person", 3) -> "people"
	*     pluralise("person", 1) -> "person"
	*     pluralise("person", 0) -> "people"
	*
	*   pluralise(noun, count, plural) -> plural or singular noun
	*   you can provide an irregular plural yourself as the 3rd argument.
	*   Example:
	*     pluralise("ch�teau", 2 "ch�teaux") -> "ch�teaux"
	* 
	* @param		string	Word to pluralise
	* 
	* @return		string	Capitalised Word
	*/ 	 
	public static function pluralise($word)
	{
		$userDefined = array();

		// words that are always singular, always plural, or the same in both forms.
		$uninflected = 'aircraft,advice,blues,corn,molasses,equipment,gold,information,cotton,jewelry,kin,legislation,luck,luggage,moose,music,offspring,rice,silver,trousers,wheat,bison,bream,breeches,britches,carp,chassis,clippers,cod,contretemps,corps,debris,diabetes,djinn,eland,elk,flounder,gallows,graffiti,headquarters,herpes,high,homework,innings,jackanapes,mackerel,measles,mews,mumps,news,pincers,pliers,proceedings,rabies,salmon,scissors,sea,series,shears,species,swine,trout,tuna,whiting,wildebeest,pike,oats,tongs,dregs,snuffers,victuals,tweezers,vespers,pinchers,bellows,cattle';

		$irregular = array
		(
			// pronouns
			'I' => 'we',
			'you' => 'you',
			'he' => 'they',
			'it' => 'they',  // or them
			'me' => 'us',
			'you' => 'you',
			'him' => 'them',
			'them' => 'them',
			'myself' => 'ourselves',
			'yourself' => 'yourselves',
			'himself' => 'themselves',
			'herself' => 'themselves',
			'itself' => 'themselves',
			'themself' => 'themselves',
			'oneself' => 'oneselves',

			'child' => 'children',
			'dwarf' => 'dwarfs',  // dwarfs are real; dwarves are fantasy.
			'mongoose' => 'mongooses',
			'mythos' => 'mythoi',
			'ox' => 'oxen',
			'soliloquy' => 'soliloquies',
			'trilby' => 'trilbys',
			'person' => 'people',
			'forum' => 'forums', // fora is ok but uncommon.

			// latin plural in popular usage.
			'syllabus' => 'syllabi',
			'alumnus' => 'alumni', 
			'genus' => 'genera',
			'viscus' => 'viscera',
			'stigma' => 'stigmata'
		);

		$suffixRules = array
		(
			// common suffixes
			'/man$/i' => 'men',
			'/([lm])ouse$/i' => '$1ice',
			'/tooth$/i' => 'teeth',
			'/goose$/i' => 'geese',
			'/foot$/i' => 'feet',
			'/zoon$/i' => 'zoa',
			'/([tcsx])is$/i' => '$1es',

			// fully assimilated suffixes
			'/ix$/i' => 'ices',
			'/^(cod|mur|sil|vert)ex$/i' => '$1ices',
			'/^(agend|addend|memorand|millenni|dat|extrem|bacteri|desiderat|strat|candelabr|errat|ov|symposi)um$/i' => '$1a',
			'/^(apheli|hyperbat|periheli|asyndet|noumen|phenomen|criteri|organ|prolegomen|\w+hedr)on$/i' => '$1a',
			'/^(alumn|alg|vertebr)a$/i' => '$1ae',
			
			// churches, classes, boxes, etc.
			'/([cs]h|ss|x)$/i' => '$1es',

			// words with -ves plural form
			'/([aeo]l|[^d]ea|ar)f$/i' => '$1ves',
			'/([nlw]i)fe$/i' => '$1ves',

			// -y
			'/([aeiou])y$/i' => '$1ys',
			'/y$/i' => 'ies',

			// -o
			'/([aeiou])o$/i' => '$1os',
			'/^(pian|portic|albin|generalissim|manifest|archipelag|ghett|medic|armadill|guan|octav|command|infern|phot|ditt|jumb|pr|dynam|ling|quart|embry|lumbag|rhin|fiasc|magnet|styl|alt|contralt|sopran|bass|crescend|temp|cant|sol|kimon)o$/i' => '$1os',
			'/o$/i' => 'oes',

			// words ending in s...
			'/s$/i' => 'ses'
		);	
		// handle the empty string reasonably.

		$lowerWord = strtolower($word);

		// user defined rules have the highest priority.
		if ( in_array($lowerWord, $userDefined ))
		{
			return self::capitaliseSame($userDefined[$lowerWord], $word);
		}

		// single letters are pluralised with 's, "I got five A's on
		// my report card."
		if ( preg_match('/^[A-Z]$/', $word) ) return $word.'s';

		// some word don't change form when plural.
		if ( preg_match('/fish$|ois$|sheep$|deer$|pox$|itis$/i', $word) ) return $word;
		if ( preg_match('/^[A-Z][a-z]*ese$/', $word) ) return $word;  // Nationalities.
		
		$uninflected = self::toKeys($uninflected);
		if ( array_key_exists($lowerWord, $uninflected)) return $word;

		// there's a known set of words with irregular plural forms.
		if ( array_key_exists($lowerWord, $irregular))
		{
			return self::capitaliseSame($irregular[$lowerWord], $word);
		}
		
		// try to pluralise the word depending on its suffix.
		foreach ($suffixRules as $rule => $plural)
		{
			if ( preg_match($rule, $word) )
			{
				$result = preg_replace($rule, $plural, $word);
				return $result;
			}
		}

		// if all else fails, just add s.
		return $word.'s';
	}
	/**
	* Capitalise a word in the same way as a sample word
	* 
	* @param		string	Word in lower case
	* @param		string	Word to match the capitalisation of
	* 
	* @return		string	Capitalised Word
	*/ 	
	protected static function capitaliseSame($word, $sampleWord)
	{
		if ( preg_match('/^[A-Z]/', $sampleWord) )
		{
			return ucwords($word);
		}
		else
		{
			return $word;
		}
	}
	/**
	* Convert a string of comma separated words in to any array with index of word and value of 1
	* 
	* @param		string	Comma separated list of words
	* 
	* @return		array	Words with value set to 1
	*/ 	
	protected static function toKeys($keys)
	{
		$keys = explode(',', $keys);
		$keys_count = count($keys);
		$table = array();
		for ($i = 0; $i < $keys_count; $i++ )
		{
			$table[$keys[$i] ] = 1;
		}
		return $table;
	}
}