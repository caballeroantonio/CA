<?php
/**
 * @version 		$Id: componentobjectincludeassetaclrecord.php 577 2016-01-04 15:44:19Z BrianWade $
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
 * Form Rule class for the Object/Table - Include Asset ACL - Record Level field.
 */
class JFormRulecomponentobjectincludeassetaclrecord extends JFormRule
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
			$joomla_features = (array) $input->get('joomla_features');
			
			if ($input->get('component_id') > 0 AND ($value == '' OR $joomla_features['include_assetacl'] == ''))
			{
				$db = JFactory::getDBO();
				$query = $db->getQuery(true);

				// Build the query.
				$query->select('joomla_features');
				$query->from('#__componentarchitect_components');
				$query->where('id = ' . $db->quote($input->get('component_id')));

				// Set and query the database.
				$db->setQuery($query);
				$component_joomla_features = $db->loadResult();

				$registry = new JRegistry;
				$registry->loadString($component_joomla_features);
				$component_joomla_features = $registry->toArray();
				$registry = null; //release memory
				
				// If values are blank use the Joomla! feature from the component
				if ($value == '')
				{
					$include_assetacl_record = $component_joomla_features['include_assetacl_record'];
				}
				else
				{
					$include_assetacl_record = $value;
				}
				if ($joomla_features['include_assetacl'] == '')
				{
					$include_assetacl = $component_joomla_features['include_assetacl'];
				}
				else
				{
					$include_assetacl = $joomla_features['include_assetacl'];
				}
				
				if ($include_assetacl == '0' AND $include_assetacl_record == '1')
				{
					// Change to RuntimeException when Joomla! 2.5 no longer supported as JException (deprecated) and will be removed from Joomla
					return new JException(JText::_('COM_COMPONENTARCHITECT_COMPONENTOBJECTS_FIELD_INCLUDE_ASSETACL_RECORD_ERROR_ASSETACL_NOT_SET'), 1, E_WARNING);
				}				
			}
			else
			{
				if ($joomla_features['include_assetacl'] == '0' AND $value == '1')
				{
					// Change to RuntimeException when Joomla! 2.5 no longer supported as JException (deprecated) and will be removed from Joomla
					return new JException(JText::_('COM_COMPONENTARCHITECT_COMPONENTOBJECTS_FIELD_INCLUDE_ASSETACL_RECORD_ERROR_ASSETACL_NOT_SET'), 1, E_WARNING);
				}
			}	
			//[%%END_CUSTOM_CODE%%]		
			return true;
		}
	}	
}
