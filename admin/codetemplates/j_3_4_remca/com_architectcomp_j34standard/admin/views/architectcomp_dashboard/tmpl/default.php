<?php
/**
 * @tempversion
 * @name			[%%ArchitectComp_name%%]
 * @author			[%%COMPONENTAUTHOR%%] ([%%COMPONENTWEBSITE%%])
 * @package			[%%com_architectcomp%%]
 * @subpackage		[%%com_architectcomp%%].admin
 * @copyright		[%%COMPONENTCOPYRIGHT%%]
 * @license			GNU General Public License version 3 or later; See http://www.gnu.org/copyleft/gpl.html 
 * 
 * The following Component Architect header section must remain in any distribution of this file
 *
 * @version			$Id: edit.php 571 2016-01-04 15:03:02Z BrianWade $
 * @CAauthor		Component Architect (www.componentarchitect.com)
 * @CApackage		architectcomp
 * @CAsubpackage	architectcomp.admin
 * @CAtemplate		joomla_3_4_standard (Release 1.0.1)
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

?>
<div id="dashboard" style="width: 100%">
	<div style="clear:both;"></div>
	<div style="width: 50%; display:block; float:left">
		<div class="links">
			<?php
			foreach($this->buttons as $button)
			{
				if ($button['object'] == 'spacer')
				{
					$html = '<div style="float:left; width: 100%; padding-top: 30px;"></div>';
				}
				else
				{
					$url = 'onclick="document.location.href=\''.$button['link'].'\';"';
					$html = '<div style="float:left;width: 100%;" '.$url.' class="icon"><table width="100%"><tr><td style="text-align: center;" width="15%">';
					$html .= '<span class="icon-48-'.$button['object'].'" style="background-repeat:no-repeat;background-position:center;width:auto;height:48px" title="'.$button['text'].'"> </span>';
					$html .= '<span>'.$button['text'].'</span></td><td style="text-align:left;">'.$button['desc'].'</td></tr></table>';
					$html .= '</div>';	
				}				
				echo $html;
			}
			?>
		</div>
	</div>
	<div style="width: 45%; display:block; float:left; margin-left: 10px;">
		<h2 align="center">
			<?php echo JText::_('[%%COM_ARCHITECTCOMP%%]'); ?>
		</h2>
		<div class="description">
			<?php echo JText::_('[%%COM_ARCHITECTCOMP%%]_DASHBOARD_DESCRIPTION'); ?>
		</div>	
		<h3 align="center" style="margin-top: 30px;">
			<?php echo JText::_('[%%COM_ARCHITECTCOMP%%]_DASHBOARD_UPDATE_HEADER'); ?>
		</h3>		
		<div class="updated">
			<?php echo JText::_('[%%COM_ARCHITECTCOMP%%]_DASHBOARD_USE_JOOMLA_UPDATES'); ?>
		</div>	
		<div class="alert alert-message" style="width: 50%; margin-left: auto; margin-right: auto;">
			<p style="font-weight: bold; text-align: center; margin-bottom: 0px;"><?php echo JText::_('[%%COM_ARCHITECTCOMP%%]_DASHBOARD_CURRENT_RELEASE'); ?></p>
		</div>
		<h3 align="center" style="margin-top: 30px;">
			<?php echo JText::_('[%%COM_ARCHITECTCOMP%%]_DASHBOARD_COPYRIGHT_HEADER'); ?>
		</h3>		
		<div class="copyright">
			<?php echo JText::_('[%%COM_ARCHITECTCOMP%%]_DASHBOARD_COPYRIGHT'); ?><br/>
			<?php echo JText::_('[%%COM_ARCHITECTCOMP%%]_DASHBOARD_LICENSE'); ?>
			<br/><br/>
		</div>
		<div class="copyright">
			<br /><br />
			<em><?php echo JText::_('[%%COM_ARCHITECTCOMP%%]_JOOMLA_LOGO_DISCLAIMER'); ?></em>
		</div>	
	</div>
</div>