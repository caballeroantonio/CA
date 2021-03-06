<?php
/**
 * @tempversion
 * @name			[%%ArchitectComp_name%%]
 * @author			[%%COMPONENTAUTHOR%%] ([%%COMPONENTWEBSITE%%])
 * @package			[%%com_architectcomp%%]
 * @subpackage		[%%com_architectcomp%%].admin
 * @copyright		[%%COMPONENTCOPYRIGHT%%]
 * @license			GNU General Public License version 3 or later; See http://www.gnu.org/copyleft/gpl.html 
 * 
 * The following Component Architect header section must remain in any distribution of this file
 *
 * @version			$Id: compobjectadministrator.php 571 2016-01-04 15:03:02Z BrianWade $
 * @CAauthor		Component Architect (www.componentarchitect.com)
 * @CApackage		architectcomp
 * @CAsubpackage	architectcomp.admin
 * @CAtemplate		joomla_3_4_standard (Release 1.0.1)
 * @CAcopyright		Copyright (c)2013 - 2016  Simply Open Source Ltd. (trading as Component Architect). All Rights Reserved
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

JLoader::register('ContentHelper', JPATH_ADMINISTRATOR . '/components/[%%com_architectcomp%%]/helpers/[%%architectcomp%%].php');
/**
 * [%%CompObject_plural_name%%] component helper.
 *
 */
abstract class JHtml[%%CompObject%%]Administrator
{
	[%%IF INCLUDE_LANGUAGE%%]
	/**
	 * Render the list of associated items
	 * 
	 * @param	integer $[%%compobject%%]_id	The [%%compobject_name%%] item id
	 * 
	 * @return  string  The language HTML
     */
	public static function association($[%%compobject%%]_id)
	{
		// Get the associations
		// Defaults
		$html = '';

		// Get the associations
		[%%IF INCLUDE_ALIAS%%]
			[%%IF GENERATE_CATEGORIES%%]
		if ($associations = JLanguageAssociations::getAssociations('[%%com_architectcomp%%]', '#__[%%architectcomp%%]_[%%compobjectplural%%]', '[%%com_architectcomp%%].[%%compobject%%].item',  $[%%compobject%%]_id, 'id', 'alias', 'catid'))
			[%%ELSE GENERATE_CATEGORIES%%]
		if ($associations = JLanguageAssociations::getAssociations('[%%com_architectcomp%%]', '#__[%%architectcomp%%]_[%%compobjectplural%%]', '[%%com_architectcomp%%].[%%compobject%%].item',  $[%%compobject%%]_id, 'id', 'alias', null))
			[%%ENDIF GENERATE_CATEGORIES%%]
		[%%ELSE INCLUDE_ALIAS%%]
			[%%IF GENERATE_CATEGORIES%%]
		if ($associations = JLanguageAssociations::getAssociations('[%%com_architectcomp%%]', '#__[%%architectcomp%%]_[%%compobjectplural%%]', '[%%com_architectcomp%%].[%%compobject%%].item',  $[%%compobject%%]_id, 'id', null, 'catid'))
			[%%ELSE GENERATE_CATEGORIES%%]
		if ($associations = JLanguageAssociations::getAssociations('[%%com_architectcomp%%]', '#__[%%architectcomp%%]_[%%compobjectplural%%]', '[%%com_architectcomp%%].[%%compobject%%].item',  $[%%compobject%%]_id, 'id', null, null))
			[%%ENDIF GENERATE_CATEGORIES%%]
		[%%ENDIF INCLUDE_ALIAS%%]
		{		
			foreach ($associations as $tag => $associated)
			{
				$associations[$tag] = (int) $associated->id;
			}

			// Get the associated menu items
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('a.*');
			$query->from($db->quoteName('#__[%%architectcomp%%]_[%%compobjectplural%%]').' as a');
			[%%IF GENERATE_CATEGORIES%%]
			$query->select($db->quoteName('c.title').' as category_title');
			$query->join('LEFT', $db->quoteName('#__categories').' as c ON '.$db->quoteName('c.id').' = '.$db->quoteName('a.catid'));
			[%%ENDIF GENERATE_CATEGORIES%%]
			$query->where($db->quoteName('a.id').' IN ('.implode(',', array_values($associations)).')');
			$query->join('LEFT', $db->quoteName('#__languages').' as l ON '.$db->quoteName('a.language').' = '.$db->quoteName('l.lang_code'));
			$query->select($db->quoteName('l.image'));
			$query->select($db->quoteName('l.title').' as language_title');
			$query->select($db->quoteName('l.sef').' as lang_sef');
			
			$db->setQuery($query);

			try
			{
				$items = $db->loadObjectList('id');
			}
			catch (runtimeException $e)
			{
				throw new Exception($e->getMessage(), 500);
			}

			if ($items)
			{
				foreach ($items as &$item)
				{
					$text = strtoupper($item->lang_sef);
					$url = JRoute::_('index.php?option=[%%com_architectcomp%%]&task=[%%compobject%%].edit&id=' . (int) $item->id);
					$tooltip_parts = array(
						JHtml::_('image', 'mod_languages/' . $item->image . '.gif',
							$item->language_title,
							array('title' => $item->language_title),
							true
						),
					[%%IF INCLUDE_NAME%%]
						[%%IF GENERATE_CATEGORIES%%]
						$item->name,
						'(' . $item->category_title . ')'
						[%%ELSE GENERATE_CATEGORIES%%]
						$item->name
						[%%ENDIF GENERATE_CATEGORIES%%]
					[%%ELSE INCLUDE_NAME%%]
						[%%IF GENERATE_CATEGORIES%%]
						'(' . $item->category_title . ')'
						[%%ENDIF GENERATE_CATEGORIES%%]
					[%%ENDIF INCLUDE_NAME%%]						
					);
					$item->link = JHtml::_('tooltip', implode(' ', $tooltip_parts), null, null, $text, $url, null, 'hasTooltip label label-association label-' . $item->lang_sef);
				}
			}

			$html = JLayoutHelper::render('joomla.content.associations', $items);
		}
		return $html;
	}
	[%%ENDIF INCLUDE_LANGUAGE%%]
	[%%IF INCLUDE_FEATURED%%]
	/**
	 * Show the feature/unfeature links
	 *
	 * @param   int      $value      The state value
	 * @param   int      $i          Row number
	 * @param   boolean  $can_change  Is user allowed to change?
	 *
	 * @return  string       HTML code
	 */
	public static function featured($value = 0, $i, $can_change = true)
	{
		JHtml::_('bootstrap.tooltip');
			
		// Array of image, task, title, action
		$states	= array(
			0	=> array('unfeatured', '[%%compobjectplural%%].featured', '[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_UNFEATURED', 'JGLOBAL_TOGGLE_FEATURED'),
			1	=> array('featured', '[%%compobjectplural%%].unfeatured', '[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_FEATURED', 'JGLOBAL_TOGGLE_FEATURED'),
		);
		$state	= JArrayHelper::getValue($states, (int) $value, $states[1]);
		$icon	= $state[0];
		if ($can_change)
		{
			$html	= '<a href="#" onclick="return listItemTask(\'cb'.$i.'\',\''.$state[1].'\')" class="btn btn-micro hasTooltip' . ($value == 1 ? ' active' : '') . '" title="'.JText::_($state[3]).'"><i class="icon-'
					. $icon.'"></i></a>';
		}
		else
		{
			$html	= '<a class="btn btn-micro hasTooltip disabled' . ($value == 1 ? ' active' : '') . '" title="'.JText::_($state[2]).'"><i class="icon-'
					. $icon.'"></i></a>';
		}
		return $html;
	}
	[%%ENDIF INCLUDE_FEATURED%%]
}
