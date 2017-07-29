<?php
/**
 * @version 		$Id: components.php 577 2016-01-04 15:44:19Z BrianWade $
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
	jimport('joomla.application.component.modellist');
}
/**
 * Methods supporting a list of component records.
 *
 */
class ComponentArchitectModelComponents extends JModelList
{
	/**
	 * Context string for the model type.  This is used to handle uniqueness
	 * within sessions data.
	 *
	 * @var    string
	 */
	protected $context = 'com_componentarchitect.components';
	/**
	 * Prefix string for pagination.  This is used to handle unique paging.
	 *
	 * @var    string
	 */
	protected $pagination_prefix = '';	
	/**
	 * Constructor.
	 *
	 * @param	array	$config	An optional associative array of configuration settings.
	 * 
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.id',
				'name', 'a.name',
				'checked_out', 'a.checked_out',
				'checked_out_time', 'a.checked_out_time',
				'created', 'a.created',
				'created_by', 'a.created_by',
				'ordering', 'a.ordering',				
			);
		}

		parent::__construct($config);
	}
	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * 
	 * @return	JTable	A database object
	 */
	public function getTable($type = 'Components', $prefix = 'ComponentArchitectTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}	
	
	/**
	 * Method to auto-populate the model state.
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 * Note. Calling getState in this method will result in recursion.
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		
		$app = JFactory::getApplication('administrator');

		// Adjust the context to support modal layouts.
		if ($layout = $app->input->getString('layout'))
		{
			$this->context .= '.'.$layout;
		}

		$current_id = $this->getUserStateFromRequest($this->context.'.list.current_id', 'currentid', 0, 'int');
		$this->setState('list.current_id', $current_id);

		// Load the filter state.
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
		
		
		
	
		
		$created_by = $this->getUserStateFromRequest($this->context.'.filter.created_by', 'filter_created_by', 0, 'int');
		$this->setState('filter.created_by', $created_by);
				
		
		
		// Load the parameters.
		$params = JComponentHelper::getParams('com_componentarchitect');
		$this->setState('params', $params);
		
		// List state information.
		parent::populateState('a.name', 'asc');		
		
		$value = $this->getUserStateFromRequest($this->context.'.limit', $this->pagination_prefix.'limit', $app->getCfg('list_limit'), 'uint');
		$limit = $value;
		$this->setState('list.limit', $limit);

		$value = $this->getUserStateFromRequest($this->context.'.limitstart', $this->pagination_prefix.'limitstart', 0, 'uint');
		$limitstart = ($limit != 0 ? (floor($value / $limit) * $limit) : 0);
		$this->setState('list.start', $limitstart);
				

	}
	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param	string		$id	A prefix for the store id.
	 * 
	 * @return	string		A store id.
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id	.= ':'.$this->getState('filter.search');
		$id	.= ':'.$this->getState('filter.created_by');	
		return parent::getStoreId($id);
	}	
	/**
	 * Build an SQL query to load the list data.
	 * 
	 * @return	JDatabaseQuery
	 */
	protected function getListQuery()
	{
		
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$app	= JFactory::getApplication();

		// Select the required components from the table.
		$query->select(
			$this->getState(
					'list.select',
					'a.*'
			)
		);
		$query->from($db->quoteName('#__componentarchitect_components').' AS a');

		
		// Join over the users for the checked out user.
		$query->select($db->quoteName('uc.name').' AS editor');
		$query->join('LEFT', $db->quoteName('#__users').' AS uc ON '.$db->quoteName('uc.id').' = '.$db->quoteName('a.checked_out'));
		
		// Join over the users for the creator.
		$query->select('ua.name AS created_by_name');
		$query->join('LEFT', '#__users AS ua ON ua.id = a.created_by');		
		
		// Filter by search in name
		$search = $this->getState('filter.search');
		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where($db->quoteName('a.id').' = '.(int) JString::substr($search, 3));
			}
			else
			{
				$search = $db->quote('%'.$db->escape($search, true).'%');
				$where = $db->quoteName('a.name').' LIKE '.$search;
				$query->where('('.$where.')');
			}
		}


		
		
		
		// Filter by access level.
		if ($created_by = $this->getState('filter.created_by'))
		{
			$query->where($db->quoteName('a.created_by').' = ' . (int) $created_by);
		}	
				
		
		
		// Filter by and return name for default_object_id level.
		$query->select($db->quoteName('o.name').' AS o_component_object_name');
		$query->select($db->quoteName('o.ordering').' AS o_component_object_ordering');

		$query->join('LEFT', '#__componentarchitect_componentobjects AS o ON o.id = a.default_object_id');	
		
		// Add the list ordering clause.
		$order_col	= '';
		$order_dirn	= $this->getState('list.direction');

		


		if ($this->getState('list.ordering') == 'a.ordering' OR $this->getState('list.ordering') == 'ordering')
		{
			$order_col	= '';
			$order_col	.= $db->quoteName('a.ordering').' '.$order_dirn;		
			
		}
		
		if ($order_col == '' AND $this->getState('list.ordering') != '')
		{
			$order_col	=  $db->quoteName($this->getState('list.ordering')).' '.$order_dirn;
		}
		// If order column still blank then set it to default order
		if ($order_col == '')
		{
			$order_col =  $db->quoteName('a.ordering').' '.$order_dirn;
		}
			
		$query->order($db->escape($order_col));

		return $query;
	}
	/**
	 * Method to get a set of records.
	 *
	 * @return	mixed	Objects on success, false on failure.
	 */
	public function getItems()
	{
		if ($items = parent::getItems())
		{
			// Include any manipulation of the data on the record e.g. expand out Registry fields
			// NB The params registry field - if used - is done automatcially in the JAdminModel parent class
			foreach ($items as $item)
			{
				$db = $this->getDbo();
				$query = $db->getQuery(true);
				$query->select('COUNT(*)');
				$query->from($db->quoteName('#__componentarchitect_componentobjects').' AS a');
				$query->where($db->quoteName('a.component_id').' = ' . $db->quote($item->id));
				
				$db->setQuery($query);
				$item->componentobjects_count = $db->loadResult();

				//[%%START_CUSTOM_CODE%%]
				$query->clear();
				$query->select('COUNT(*)');
				$query->from($db->quoteName('#__componentarchitect_fieldsets').' AS a');
				$query->where($db->quoteName('a.component_id').' = ' . $db->quote($item->id));
				
				$db->setQuery($query);
				$item->fieldsets_count = $db->loadResult();
				
				$query->clear();
				$query->select('COUNT(*)');
				$query->from($db->quoteName('#__componentarchitect_fields').' AS a');
				$query->where($db->quoteName('a.component_id').' = ' . $db->quote($item->id));
				
				$db->setQuery($query);
				$item->fields_count = $db->loadResult();	
				
				$query->clear();
				$query->select('COUNT(*)');
				$query->from($db->quoteName('#__componentarchitect_fields').' AS a');
				$query->where($db->quoteName('a.component_id').' = ' . $db->quote($item->id));
				$query->where($db->quoteName('a.predefined_field').' = 0');
				
				$db->setQuery($query);
				$item->fields_custom_count = $db->loadResult();	
				//[%%END_CUSTOM_CODE%%]
						
				$registry = new JRegistry;
				$registry->loadString($item->joomla_parts);
				$item->joomla_parts = $registry->toArray();
				$registry = null; //release memory	
				$registry = new JRegistry;
				$registry->loadString($item->joomla_features);
				$item->joomla_features = $registry->toArray();
				$registry = null; //release memory	
			}
		}

		return $items;
	}	
	/**
	 * Build a list of created_by/authors
	 *
	 * @return  array List of creators
	 */
	public function getCreators()
	{
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);

		// Construct the query
		$query->select('u.id AS value, u.name AS text');
		$query->from('#__users AS u');
		$query->join('INNER', '#__componentarchitect_components AS a ON a.created_by = u.id');
		$query->group('u.id, u.name');
		$query->order('u.name');

		// Setup the query
		$db->setQuery($query);

		// Return the result
		return $db->loadObjectList();
	}	
	/**
	 * Method to get a JPagination object for the data set.
	 * Overriden ModelList method as that does not use a prefix as a parameter
	 *
	 * @param	string		Prefix to use for variables
	 * 
	 * @return  JPagination  A JPagination object for the data set.
	 */
	public function getPagination($prefix = '')
	{
		if ($prefix != '')
		{
			$prefix .= '_';
			$this->pagination_prefix = $prefix;
			$this->context .= '.'.$prefix;
		}
			
		// Get a storage key.
		$store = $this->getStoreId('getPagination');

		// Try to load the data from internal storage.
		if (isset($this->cache[$store]))
		{
			return $this->cache[$store];
		}

		// Create the pagination object.
		if (version_compare(JVERSION, '3.0', 'lt'))
		{
			jimport('joomla.html.pagination');
		}			
		$limit = (int) $this->getState('list.limit') - (int) $this->getState('list.links');
		$page = new JPagination($this->getTotal(), $this->getStart(), $limit, $prefix);

		// Add the object to the internal cache.
		$this->cache[$store] = $page;

		return $this->cache[$store];
	}	
}