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
 * @version			$Id: query.php 572 2016-01-04 15:03:33Z BrianWade $
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
 * [%%ArchitectComp_name%%] Component Query Helper
 *
 */
class [%%ArchitectComp%%]HelperQuery
{
	[%%IF GENERATE_CATEGORIES%%]
	/**
	 * Translate an order code to a field for primary category ordering.
	 *
	 * @param	string	$order_by	The ordering code.
	 *
	 * @return	string	The SQL field(s) to order by.
	 * 
	 */
	public static function orderbyPrimary($order_by)
	{
		$db = JFactory::getDbo();

		switch ($order_by)
		{
			case 'alpha' :
				$order_by = $db->quoteName('c.path') . ', ';
				break;

			case 'ralpha' :
				$order_by = $db->quoteName('c.path') . ' DESC, ';
				break;
			case 'ordering' :
				$order_by = $db->quoteName('c.lft') . ', ';
				break;
			default :
				$order_by = '';
				break;
		}

		return $order_by;
	}
	/**
	 * Translate an order code to a field for secondary ordering.
	 *
	 * @param	string	$order_by	The ordering code.
	 * @param	string	$order_date	The ordering code for the date.
	 * @param	string	$default_sec	The default field to use for secondary order by.
	 *
	 * @return	string	The SQL field(s) to order by.
	 * 
	 */
	public static function orderbySecondary($order_by, $order_date, $default_sec = 'ordering')
	{
		$db = JFactory::getDbo();
		$query_date = self::getQueryDate($order_date);

		switch ($order_by)
		{
			case 'date' :

				if ($query_date == '')
				{
					$order_by = $db->quoteName('a.' . $default_sec);
				}
				else
				{			
					$order_by = $db->quoteName($query_date);
				}
				break;				

			case 'rdate' :
				if ($query_date == '')
				{
					$order_by = $db->quoteName('a.' . $default_sec) . ' DESC';
				}
				else
				{			
					$order_by = $db->quoteName($query_date) . ' DESC ';
				}
				break;
			case 'alpha' :
				$order_by = $db->quoteName('a.name');
				break;
			case 'ralpha' :
				$order_by = $db->quoteName('a.name') . ' DESC';
				break;
			case 'hits' :
				$order_by = $db->quoteName('a.hits') . ' DESC';
				break;
			case 'rhits' :
				$order_by = $db->quoteName('a.hits');
				break;
			case 'ordering' :
				$order_by = $db->quoteName('a.ordering');
				break;
			case 'created_by' :
				$order_by = $db->quoteName('created_by_name');
				break;
			case 'rcreated_by' :
				$order_by = $db->quoteName('created_by_name') . ' DESC';
				break;
			default :
				$order_by = $db->quoteName('a.' . $default_sec);

				break;
		}

		return $order_by;
	}
	[%%ENDIF GENERATE_CATEGORIES%%]
	/**
	 * Translate an order code to a field for ordering.
	 *
	 * @param	string	$order_date	The ordering code.
	 *
	 * @return	string	The SQL field(s) to order by.
	 * 
	 */
	public static function getQueryDate($order_date) 
	{
		$db = JFactory::getDbo();	
		$query_date = '';
		switch ($order_date)
		{
			[%%IF INCLUDE_MODIFIED%%]
			case 'modified' :
				$query_date = 'a.modified ';
				break;
			[%%ENDIF INCLUDE_MODIFIED%%]
			[%%IF INCLUDE_PUBLISHED_DATES%%]
			// use created if publish_up is not set
			case 'publish_up' :
				[%%IF INCLUDE_MODIFIED%%]
				$query_date = ' CASE WHEN '.$db->quoteName('a.publish_up').' = ' . $db->quote($db->getNullDate()) . ' THEN '.$db->quoteName('a.modified').' ELSE '.$db->quoteName('a.publish_up').' END ';
				[%%ENDIF INCLUDE_MODIFIED%%]
				[%%IF INCLUDE_CREATED%%]
				$query_date = ' CASE WHEN '.$db->quoteName('a.publish_up').' = ' . $db->quote($db->getNullDate()) . ' THEN '.$db->quoteName('a.created').' ELSE '.$db->quoteName('a.publish_up').' END ';
				[%%ENDIF INCLUDE_CREATED%%]
				break;
			[%%ENDIF INCLUDE_PUBLISHED_DATES%%]
			[%%IF INCLUDE_CREATED%%]
			case 'created' :
				$query_date = ' '.$db->quoteName('a.created').' ';
				break;
			[%%ENDIF INCLUDE_CREATED%%]
			default :
				break;
		}

		return $query_date;
	}
	/**
	 * Method to order the intro items array for ordering
	 * down the columns instead of across.
	 * The layout always lays the introtext items out across columns.
	 * Array is reordered so that, when items are displayed in index order
	 * across columns in the layout, the result is that the
	 * desired item ordering is achieved down the columns.
	 *
	 * @param	array	$items	Array of intro items
	 * @param	integer	$num_columns	Number of columns in the layout
	 *
	 * @return	array	Reordered array to achieve desired ordering down columns
	 * 
	 */
	public static function orderDownColumns(&$items, $num_columns = 1)
	{
		$count = count($items);

		// just return the same array if there is nothing to change
		if ($num_columns == 1 OR !is_array($items) OR $count <= $num_columns)
		{
			$return = $items;
		}
		// we need to re-order the intro items array
		else
		{
			// we need to preserve the original array keys
			$keys = array_keys($items);

			$max_rows = ceil($count / $num_columns);
			$num_cells = $max_rows * $num_columns;
			$num_empty = $num_cells - $count;
			$index = array();

			// calculate number of empty cells in the array


			// fill in all cells of the array
			// put -1 in empty cells so we can skip later

			for ($row = 1, $i = 1; $row <= $max_rows; $row++)
			{
				for ($col = 1; $col <= $num_columns; $col++)
				{
					if ($num_empty > ($num_cells - $i))
					{
						// put -1 in empty cells
						$index[$row][$col] = -1;
					}
					else
					{
						// put in zero as placeholder
						$index[$row][$col] = 0;
					}
					$i++;
				}
			}

			// layout the items in column order, skipping empty cells
			$i = 0;
			for ($col = 1; ($col <= $num_columns) AND ($i < $count); $col++)
			{
				for ($row = 1; ($row <= $max_rows) AND ($i < $count); $row++)
				{
					if ($index[$row][$col] != - 1)
					{
						$index[$row][$col] = $keys[$i];
						$i++;
					}
				}
			}

			// now read the $index back row by row to get items in right row/col
			// so that they will actually be ordered down the columns (when read by row in the layout)
			$return = array();
			$i = 0;
			for ($row = 1; ($row <= $max_rows) AND ($i < $count); $row++)
			{
				for ($col = 1; ($col <= $num_columns) AND ($i < $count); $col++)
				{
					$return[$keys[$i]] = $items[$index[$row][$col]];
					$i++;
				}
			}
		}
		return $return;
	}
}