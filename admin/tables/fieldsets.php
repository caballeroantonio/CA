<?php
/**
 * @version 			$Id:2017-09-17 20:14:05 caballeroantonio $
 * @name			Component Architect (Release 1.2.0)
 * @author			Component Architect (www.componentarchitect.com)
 * @package			com_componentarchitect
 * @subpackage		com_componentarchitect.admin
 * @copyright		Copyright (c)2013 - 2016 Simply Open Source Ltd. (trading as Component Architect). All Rights Reserved
 * @license			GNU General Public License version 3 or later; See http://www.gnu.org/copyleft/gpl.html 
 * 
 * The following Component Architect header section must remain in any distribution of this file
 *
 * @CAversion		Id: compobjectplural.php 806 2013-12-24 13:24:16Z BrianWade $
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
	jimport('joomla.html.parameter');
}

	
/**
 * Fieldset table
 *
 */
class ComponentArchitectTableFieldsets extends JTable
{

	/**
	 * @var    $state	Integer	Variable to hold state.
	 */
	var $state				= 1;
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  &$db  Database connector object
	 *
	 */
	public function __construct(&$db)
	{
		
		parent::__construct('#__componentarchitect_fieldsets', 'id', $db);
		
		$date	= JFactory::getDate();		
		$user = JFactory::getUser();	
		
		$this->created = $date->toSQL();
		$this->created_by = $user->id;

		$this->modified = $date->toSQL();
		$this->modified_by = $user->id;	


		JTableObserverContenthistory::createObserver($this, array('typeAlias' => 'com_componentarchitect.fieldset'));
	}

	/**
	 * Overloaded check function
	 *
	 * @return	boolean
	 * 
	 */
	public function check()
	{
		// Set name
		$this->name = htmlspecialchars_decode($this->name, ENT_QUOTES);



		return true;		
	}

	/**
	 * Overloaded bind function
	 *
	 * @param   array  $array   Named array to bind
	 * @param   mixed  $ignore  An optional array or space separated list of properties to ignore while binding.
	 * 
	 * @return	null|string	null is operation was satisfactory, otherwise returns an error
	 * 
	 */
	public function bind($array, $ignore = array())
	{
				
				

		return parent::bind($array, $ignore);
	}

		
	/**
	 * Stores a Fieldset
	 *
	 * @param	boolean	$update_nulls	True to update fields even if they are null.
	 * 
	 * @return	boolean	$result			True on success, false on failure.
	 * 
	 */
	public function store($update_nulls = false)
	{
		$date	= JFactory::getDate();
		$user	= JFactory::getUser();

	
					
		if (empty($this->id))
		{
			// New Fieldset. A created and created_by field can be set by the user,
			// so we don't touch either of these if they are set.
			if (!intval($this->created))
			{
				$this->created = $date->toSQL();
			}
			if (empty($this->created_by))
			{
				$this->created_by = $user->get('id');
			}
		}

		// Existing item
		$this->modified		= $date->toSQL();
		$this->modified_by	= $user->get('id');		




			
			
			
			
		


		// Attempt to store the data.
		return parent::store($update_nulls);
	}	
}

