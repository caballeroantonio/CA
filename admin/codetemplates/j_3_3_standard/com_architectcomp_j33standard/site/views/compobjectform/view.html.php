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
 * @version			$Id: view.html.php 572 2016-01-04 15:03:33Z BrianWade $
 * @CAauthor		Component Architect (www.componentarchitect.com)
 * @CApackage		architectcomp
 * @CAsubpackage	architectcomp.site
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

defined('_JEXEC') or die;

/**
 * HTML [%%CompObject_name%%] View class for the [%%ArchitectComp_name%%] component
 *
 */
class [%%ArchitectComp%%]View[%%CompObject%%]Form extends JViewLegacy
{
	protected $state;
	protected $item;
	protected $return_page;
	protected $form;
	
	/**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise a Error object.
	 */
	public function display($tpl = null)
	{
		
		$user = JFactory::getUser();

		// Get model data.
		$this->state		= $this->get('State');
		$this->item			= $this->get('Item');
		$this->form			= $this->get('Form');
		$this->return_page	= $this->state->get('return_page');

		// Create a shortcut for $item.
		$item = $this->item;

		[%%IF INCLUDE_TAGS%%]
		if (version_compare(JVERSION, '3.0', 'ge'))
		{		
			if (!empty($item->id))
			{	
				$item->tags = new JHelperTags;
				$item->tags->getItemTags('[%%com_architectcomp%%].[%%compobject%%]', $item->id);
			}	
		}
		[%%ENDIF INCLUDE_TAGS%%]

		[%%IF INCLUDE_ASSETACL%%]
		if (empty($item->id))
		{
			$authorised = $user->authorise('core.create', '[%%com_architectcomp%%]') 
			[%%IF GENERATE_CATEGORIES%%]
			OR (count($user->getAuthorisedCategories('[%%com_architectcomp%%]', 'core.create')))
			[%%ENDIF GENERATE_CATEGORIES%%]
			;
		}
		else
		{
			$authorised = $item->params->get('access-edit');
		}

		if ($authorised !== true)
		{
			JError::raiseError(403, JText::_('JERROR_ALERTNOAUTHOR'));
			return false;
		}
		[%%ENDIF INCLUDE_ASSETACL%%]

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseWarning(500, implode("\n", $errors));
			return false;
		}

		// Create a shortcut to the parameters.
		$params	= &$this->state->params;

		//Escape strings for HTML output
		$this->pageclass_sfx = htmlspecialchars($params->get('pageclass_sfx'));

		$this->params	=	$params;
		$this->user		=	$user;

		[%%IF GENERATE_CATEGORIES%%]
		if ($this->params->get('enable_category') == 1)
		{
			$this->form->setFieldAttribute('catid', 'default',  $params->get('catid', 1));
		}
		[%%ENDIF GENERATE_CATEGORIES%%]

		$this->prepareDocument();
		parent::display($tpl);
	}

	/**
	 * Prepares the document
	 */
	protected function prepareDocument()
	{
		$app		= JFactory::getApplication();
		$menus		= $app->getMenu();
		$lang		= JFactory::getLanguage();		
		$pathway	= $app->getPathway();
		$title 		= null;

		// Because the application sets a default page title,
		// we need to get it from the menu item itself
		$menu = $menus->getActive();
		if ($menu  AND $menu->params->get('show_page_heading'))
		{
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		}
		else
		{
			$this->params->def('page_heading', JText::_('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_EDIT_ITEM'));
		}

		if (!is_null($this->item->id))
		{
			$title = $this->params->def('page_title', JText::_('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_EDIT_ITEM'));
			
			[%%IF INCLUDE_NAME%%]
			$pathway->addItem(JText::sprintf('[%%COM_ARCHITECTCOMP%%]_EDIT_ITEM', $this->escape($this->item->name)),''); 
			[%%ELSE INCLUDE_NAME%%]
			$pathway->addItem(JText::sprintf('[%%COM_ARCHITECTCOMP%%]_EDIT_ITEM', JText::sprintf('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_ID_TITLE', $this->item->id)),''); 
			[%%ENDIF INCLUDE_NAME%%]	
		}
		else
		{
			$title = $this->params->def('page_title', JText::_('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_CREATE_ITEM'));
			
			$pathway->addItem(JText::_('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_CREATE_ITEM'),'');
		}

		
		if ($app->get('sitename_pagetitles', 0))
		{
			$title = JText::sprintf('JPAGETITLE', htmlspecialchars_decode($app->get('sitename')), $title);
		}
		$this->document->setTitle($title);
		
		// Get Menu Item meta description, Keywords and robots instruction to insert in page header
		
		if ($this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}

		if ($this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}

		if ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}

		// If there is a pagebreak heading or title, add it to the page title
		if (!empty($this->item->page_title))
		{
			[%%IF INCLUDE_NAME%%]
			$[%%compobject_code_name%%]->name = $[%%compobject_code_name%%]->name .' - '. $[%%compobject_code_name%%]->page_title;
			[%%ENDIF INCLUDE_NAME%%]			
			$this->document->setTitle($[%%compobject_code_name%%]->page_title.' - '.JText::sprintf('[%%COM_ARCHITECTCOMP%%]_PAGEBREAK_PAGE_NUM', $this->state->get('page.offset') + 1));
		}
		
		// Include Helpers
		JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');		
	}
}
