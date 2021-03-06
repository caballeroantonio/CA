<?php
/**
 * @tempversion 
 * @name			[%%ArchitectComp_name%%] (Release [%%COMPONENTSTARTVERSION%%])
 * @author			[%%COMPONENTAUTHOR%%] ([%%COMPONENTWEBSITE%%])
 * @package			[%%com_architectcomp%%]
 * @subpackage		[%%com_architectcomp%%].admin
 * @copyright		[%%COMPONENTCOPYRIGHT%%]
 * @license			GNU General Public License version 3 or later; See http://www.gnu.org/copyleft/gpl.html 
 * 
 * The following Component Architect header section must remain in any distribution of this file
 *
 * @version			$Id: compobject.php 572 2016-01-04 15:03:33Z BrianWade $
 * @CAauthor		Component Architect (www.componentarchitect.com)
 * @CApackage		architectcomp
 * @CAsubpackage	architectcomp.admin
 * @CAtemplate		joomla_3_3_standard (Release 1.0.5)
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

defined('JPATH_BASE') or die;

JFormHelper::loadFieldClass('list');

/**
 * [%%CompObject%%] Field class from the Joomla! Framework.
 *
 */
class JFormField[%%CompObject%%] extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * 
	 */
	protected $type = '[%%CompObject%%]';

	/**
	 * Method to get the field options.
	 *
	 * @return	array	The field options.
	 * 
	 */
	public function getOptions()
	{
		// Initialize variables.
		$options = array();

		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		[%%IF INCLUDE_NAME%%]
		$query->select($db->quoteName('id').' AS value, '.$db->quoteName('name').' AS text');
		$query->from($db->quoteName('#__[%%architectcomp%%]_[%%compobjectplural%%]').' AS a');
		$query->order($db->quoteName('a.name'));
		[%%ELSE INCLUDE_NAME%%]
			[%%IF INCLUDE_ORDERING%%]
		$query->select($db->quoteName('id').' AS value, '.$db->quoteName('name').' AS text');
		$query->from($db->quoteName('#__[%%architectcomp%%]_[%%compobjectplural%%]').' AS a');
		$query->order('a.ordering');
			[%%ELSE INCLUDE_ORDERING%%]
		$query->select($db->quoteName('id').' AS value, '.$db->quoteName('name').' AS text');
		$query->from($db->quoteName('#__[%%architectcomp%%]_[%%compobjectplural%%]').' AS a');
		$query->order($db->quoteName('a.id'));
			[%%ENDIF INCLUDE_ORDERING%%]
		[%%ENDIF INCLUDE_NAME%%]		
				
		// Get the options.
		$db->setQuery($query);
		try
		{
			$options = $db->loadObjectList();
		}
		catch (RuntimeException $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}
		return $options;
	}
}
