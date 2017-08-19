<?php
/**
 * @tempversion
 * @name			[%%ArchitectComp_name%%] (Release [%%COMPONENTSTARTVERSION%%])
 * @author			[%%COMPONENTAUTHOR%%] ([%%COMPONENTWEBSITE%%])
 * @package			[%%com_architectcomp%%]
 * @subpackage		[%%com_architectcomp%%].install
 * @copyright		[%%COMPONENTCOPYRIGHT%%]
 * @license			GNU General Public License version 3 or later; See http://www.gnu.org/copyleft/gpl.html 
 * 
 * The following Component Architect header section must remain in any distribution of this file
 * 
 * @CAversion		Id: view.html.php 147 2014-05-07 14:53:41Z BrianWade $
 * @CAauthor		Component Architect (www.componentarchitect.com)
 * @CApackage		architectcomp
 * @CAsubpackage	architectcomp.install
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

defined('_JEXEC') or die('Restricted access');

if (version_compare(JVERSION, '3.0', 'lt'))
{
	jimport('joomla.application.component.view');
}	
/**
 * MVC View for Dashboard
 *
 */
class [%%ArchitectComp%%]ViewDashboard extends JViewLegacy
{
	protected $params;
	
	public function display($tpl = null)
	{
		$this->state	= $this->get('State');


		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		$buttons = $this->prepareButtons();
		$this->assignRef('buttons',$buttons);
		
		$this->addToolbar();
		$this->prepareDocument();


		parent::display($tpl);
	}
	/**
	 * Add the page title and toolbar.
	 *
	 * 
	 */
	protected function addToolbar()
	{

		
		JToolbarHelper::title(JText::_('[%%COM_ARCHITECTCOMP%%]_VIEW_DASHBOARD_HEADER'), 'componentarchitect.png');
		
		JToolbarHelper::preferences('[%%com_architectcomp%%]');
		JToolbarHelper::help('JHELP_COMPONENTS_[%%COM_ARCHITECTCOMP%%]_DASHBOARD', true, null, '[%%com_architectcomp%%]');
	}
	
	/**
	 * Prepare the dashboard buttons
	 */
	protected function prepareButtons()
	{
		$buttons = array();

		//[ % % START_CUSTOM_CODE % % ]
		//[ % % END_CUSTOM_CODE % % ]
		//no hace la recursión
		[%%FOREACH COMPONENT_OBJECT%%]
		$buttons[] = array('link'=>'index.php?option=[%%com_architectcomp%%]&view=[%%compobjectplural%%]',
						   'object'=>'[%%compobjectplural%%]',
						   'text'=>JText::_('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]'),
						   'desc'=>JText::_('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECT%%]_DESCRIPTION')//_DASHBOARD
						   );
		[%%ENDFOR COMPONENT_OBJECT%%]
		return $buttons;
	}	
	/**
	 * Prepares the document
	 */
	protected function prepareDocument()
	{
		$this->document->setTitle(JText::_('[%%COM_ARCHITECTCOMP%%]_VIEW_DASHBOARD_HEADER'));

		// Include custom admin css
		$this->document->addStyleSheet(JUri::root().'media/[%%com_architectcomp%%]/css/admin.css');
		$this->document->addStyleSheet(JURI::root()."media/[%%com_architectcomp%%]/css/categories.css");		

		// Add Javscript functions for field display
		JHtml::_('behavior.tooltip');
	
	}
}