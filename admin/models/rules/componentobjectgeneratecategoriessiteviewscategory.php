<?php
/**
 * @version 		$Id: componentobjectgeneratecategoriessiteviewscategory.php 577 2016-01-04 15:44:19Z BrianWade $
 * @name			Component Architect (Release 1.2.0)
 * @author			Component Architect (www.componentarchitect.com)
 * @package			com_componentarchitect
 * @subpackage		com_componentarchitect.admin
 * @copyright		Copyright (c)2013 - 2016 Simply Open Source Ltd. (trading as Component Architect). All Rights Reserved
 * @license			GNU General Public License version 3 or later; See http://www.gnu.org/copyleft/gpl.html 
 * 
 * The following Component Architect header section must remain in any distribution of this file
 *
 * @CAversion		Id: compobjectfieldvalidate.php 799 2013-12-12 15:13:40Z BrianWade $
 * @CAauthor		Component Architect (www.componentarchitect.com)
 * @CApackage		architectcomp
 * @CAsubpackage	architectcomp.admin
 * @CAtemplate		joomla_3_x_enhanced (Release 1.0.0)
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
 
if (version_compare(JVERSION, '3.0', 'lt'))
{
	jimport('joomla.form.formrule');
}	 
/**
 * Form Rule class for the Object/Table - Generate Categories - Site Category View field.
 */
class JFormRulecomponentobjectgeneratecategoriessiteviewscategory extends JFormRule
{
	/**
	 * The regular expression.
	 *
	 * @access	protected
	 * @var		string
	 */
	protected $regex = '.*';
	/**
	 * @param	SimpleXMLElement	$element	The JXmlElement object representing the <field /> tag for the form field object.
	 * @param   mixed				$value		The form field value to validate.
	 * @param   string				$group		The field name group control value. This acts as as an array container for the field.
	 *											For example if the field has name="foo" and the group value is set to "bar" then the
	 *											full field name would end up being "bar[foo]".
	 * @param   JRegistry			$input		An optional JRegistry object with the entire data set to validate against the entire form.
	 * @param   JForm				$form		The form object for which the field is being tested.
	 *
	 * @return  boolean  True if the value is valid, false otherwise.
	 */
	public function test(SimpleXMLElement $element, $value, $group = null, JRegistry $input = null, JForm $form = null)
	{
		if(!parent::test($element, $value, $group, $input, $form))
		{
			return false;
		}
		else
		{
			//[%%START_CUSTOM_CODE%%]
			$joomla_parts = (array) $input->get('joomla_parts');
			if (($joomla_parts['generate_categories'] == '0' OR $joomla_parts['generate_site'] == '0') AND $value == '1')
			{
				// Change to RuntimeException when Joomla! 2.5 no longer supported as JException (deprecated) and will be removed from Joomla
				return new JException(JText::_('COM_COMPONENTARCHITECT_COMPONENTOBJECTS_FIELD_GENERATE_CATEGORIES_SITE_VIEW_CATEGORY_ERROR_CATEGORIES_SITE_NOT_SET'), 1, E_WARNING);
			}
			//[%%END_CUSTOM_CODE%%]			
			return true;
		}
	}	
}
