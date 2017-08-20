<?php
/**
 * @tempversion
 * @name			[%%ArchitectComp_name%%] (Release [%%COMPONENTSTARTVERSION%%])
 * @author			[%%COMPONENTAUTHOR%%] ([%%COMPONENTWEBSITE%%])
 * @package			[%%com_architectcomp%%]
 * @subpackage		[%%com_architectcomp%%].site
 * @copyright		[%%COMPONENTCOPYRIGHT%%]
 * @license			GNU General Public License version 3 or later; See http://www.gnu.org/copyleft/gpl.html 
 * 
 * The following Component Architect header section must remain in any distribution of this file
 *
 * @version			$Id: association.php 571 2016-01-04 15:03:02Z BrianWade $
 * @CAauthor		Component Architect (www.componentarchitect.com)
 * @CApackage		architectcomp
 * @CAsubpackage	architectcomp.site
 * @CAtemplate		joomla_3_4_standard (Release 1.0.1)
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

JLoader::register('CategoryHelperAssociation', JPATH_ADMINISTRATOR . '/components/com_categories/helpers/association.php');

/**
 * [%%ArchitectComp%%] Component Association Helper
 *
 */
abstract class [%%ArchitectComp%%]HelperAssociation extends CategoryHelperAssociation
{
	/**
	 * Method to get the associations for a given item
	 *
	 * @param   integer  $id    Id of the item
	 * @param   string   $view  Name of the view
	 *
	 * @return  array   Array of associations for the item
	 *
	 */

	public static function getAssociations($id = 0, $view = null)
	{

		$app = JFactory::getApplication();
		$view = is_null($view) ? $app->input->get('view') : $view;
		$id = empty($id) ? $jinput->getInt('id') : $id;


		[%%FOREACH COMPONENT_OBJECT%%]
			[%%IF INCLUDE_LANGUAGE%%]
		if ($view == '[%%compobject%%]')
		{
			if ($id)
			{
				$associations = JLanguageAssociations::getAssociations('[%%com_architectcomp%%]', '[%%compobjectprefix%%][%%architectcomp%%]_[%%compobjectplural%%]', '[%%com_architectcomp%%].[%%compobject%%].item', $id);

				$return = array();

				foreach ($associations as $tag => $item)
				{
				[%%IF GENERATE_CATEGORIES%%]
					$return[$tag] = [%%ArchitectComp%%]HelperRoute::get[%%CompObject%%]Route($item->id, $item->catid, $item->language);
				[%%ELSE GENERATE_CATEGORIES%%]	
					$return[$tag] = [%%ArchitectComp%%]HelperRoute::get[%%CompObject%%]Route($item->id, $item->language);
				[%%ENDIF GENERATE_CATEGORIES%%]	
				}

				return $return;
			}
		}
			[%%ENDIF INCLUDE_LANGUAGE%%]
		[%%ENDFOR COMPONENT_OBJECT%%]

		[%%IF GENERATE_CATEGORIES%%]
		if ($view == 'category' || $view == 'categories')
		{
			return self::getCategoryAssociations($id, '[%%com_architectcomp%%]');
		}
		[%%ENDIF GENERATE_CATEGORIES%%]

		return array();
	}
}
