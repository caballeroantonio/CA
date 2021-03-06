<?php
/**
 * @version		$Id: view.html.php 577 2016-01-04 15:44:19Z BrianWade $
 * @name			Component Architect (Release 1.2.0)
 * @author			Component Architect (www.componentarchitect.com)
 * @package			com_componentarchitect
 * @subpackage		com_componentarchitect.admin
 * @copyright		Copyright (c)2013 - 2016 Simply Open Source Ltd. (trading as Component Architect). All Rights Reserved
 * @license			GNU General Public License version 3 or later; See http://www.gnu.org/copyleft/gpl.html 
 * 
 * This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
 */

//[%%START_CUSTOM_CODE%%]
// No direct access
defined('_JEXEC') or die;

if (version_compare(JVERSION, '3.0', 'lt'))
{
	jimport('joomla.application.component.view');
}	

/**
 * View class for a a generate component dialog.
 *
 */
class ComponentArchitectViewGenerateDialog extends JViewLegacy
{
	protected $state;
	protected $form;
	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state	= $this->get('State');	
		$this->form		= $this->get('Form');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->document->setTitle(JText::_('COM_COMPONENTARCHITECT_GENERATE_DIALOG'));

		$this->addToolbar();
		$this->_prepareDocument();
		parent::display($tpl);
		JRequest::setVar('hidemainmenu', true);
	}
	/**
	 * Add the page title and toolbar.
	 *
	 * 
	 */
	protected function addToolbar()
	{
		JToolBarHelper::title(JText::_('COM_COMPONENTARCHITECT_GENERATE_DIALOG_HEADER'), 'generate.png');

		$bar = JToolBar::getInstance('toolbar');
		$url = 'index.php?option=com_componentarchitect&view=components';
		$bar->appendButton( 'Link', 'cancel', JText::_('JTOOLBAR_CANCEL'), $url);		

		JToolBarHelper::divider();

		JToolbarHelper::help('JHELP_COMPONENTS_COMPONENTARCHITECT_GENERATE', true, null, 'com_componentarchitect');
		
	}
	
	/**
	 * Prepares the document
	 */
	protected function _prepareDocument()
	{
		$this->document->setTitle(JText::_('COM_COMPONENTARCHITECT_GENERATE_DIALOG_HEADER'));
		// Include custom admin css
		$this->document->addStyleSheet(JUri::root()."media/com_componentarchitect/css/generate.css");

		// Add Javscript functions for validation
		JHtml::_('behavior.formvalidation');
		JHtml::_('behavior.keepalive');
		
		if (version_compare(JVERSION, '3.0', 'lt'))
		{		
			JHtml::_('behavior.tooltip');	
		}
		else
		{
			JHtml::_('bootstrap.tooltip');		
			JHtml::_('formbehavior.chosen', 'select');		
		}				
		// load jQuery, if not loaded before in Joomla! 2.5
		if (version_compare(JVERSION, '3.0', 'lt') AND !JFactory::getApplication()->get('jquery'))
		{
			JFactory::getApplication()->set('jquery',true);
			$this->document->addScript(JUri::root()."media/com_componentarchitect/js/jquery.js");
			$this->document->addCustomTag( '<script type="text/javascript">jQuery.noConflict();</script>' );
		}
		// Load main generate javascript
		$this->document->addScript(JUri::root()."media/com_componentarchitect/js/generate.js");

		$this->document->addStyleSheet(JUri::root()."media/com_componentarchitect/css/admin.css");

		$this->document->addScript(JUri::root() .'media/com_componentarchitect/js/formsubmitbutton.js');

		JText::script('COM_COMPONENTARCHITECT_ERROR_ON_FORM');		
	}	
}
//[%%END_CUSTOM_CODE%%]
