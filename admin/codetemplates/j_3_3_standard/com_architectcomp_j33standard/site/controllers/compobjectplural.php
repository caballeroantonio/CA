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
 * @version			$Id: compobjectplural.php 572 2016-01-04 15:03:33Z BrianWade $
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
 * [%%CompObject_plural_name%%] list controller class.
 *
 */
class [%%ArchitectComp%%]Controller[%%CompObjectPlural%%] extends JControllerLegacy
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 */
	protected $text_prefix = '[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]';
	/**
	 * @var		string	The name of the list view.
	 */	
	protected $view_list = '[%%compobjectplural%%]';
	/**
	 * Constructor
	 *
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		[%%IF INCLUDE_ORDERING%%]
		$this->registerTask('orderup','reorder');
		$this->registerTask('orderdown','reorder');
		[%%ENDIF INCLUDE_ORDERING%%]		
	}	
	/**
	 * Method to get a model object, loading it if required.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  object  The model.
	 * 
	 */
	public function getModel($name = '[%%CompObjectPlural%%]', $prefix = '[%%ArchitectComp%%]Model',$config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
}
 ?>