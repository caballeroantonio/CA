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
 * @CAversion		Id: modal.php 34 2014-03-12 12:11:19Z BrianWade $
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

$app = JFactory::getApplication();

$function	= $app->input->get('function', 'jSelectFieldType');
$list_order	= $this->escape($this->state->get('list.ordering'));
$list_dirn	= $this->escape($this->state->get('list.direction'));
$search		= $this->escape($this->state->get('filter.search',''));
// Get from global settings the text to use for an empty field
$component = JComponentHelper::getComponent( 'com_componentarchitect' );
$empty = $component->params->get('default_empty_field', '');
?>
<h3><?php echo JText::_('COM_COMPONENTARCHITECT_FIELDTYPES_SELECT_ITEM_LABEL'); ?></h3>
<form action="<?php echo JRoute::_('index.php?option=com_componentarchitect&view=fieldtypes&layout=modal&tmpl=component&function='.$function.'&'.JSession::getFormToken().'=1');?>" method="post" name="adminForm" id="adminForm">
	<fieldset class="filter clearfix">
			<?php if (version_compare(JVERSION, '3.2', 'ge')) : ?>
				<div class="clearfix"></div>
				<div class="js-stools-container-bar">
			<?php else : ?>
				<div class="filter-search fltlft">
			<?php endif; ?>						
					<?php if (version_compare(JVERSION, '3.2', 'ge')) : ?>
						<div class="btn-wrapper input-append">
							<input type="text" name="filter_search" id="filter_search" value="<?php echo $search; ?>"  placeholder="<?php echo JText::_('JSEARCH_FILTER'); ?>" />
							<button type="submit" class="btn hasTooltip" title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_SUBMIT'); ?>">
								<i class="icon-search"></i>
							</button>
						</div>
					<?php else : ?>
						<input type="text" name="filter_search" id="filter_search" value="<?php echo $search; ?>"  placeholder="<?php echo JText::_('JSEARCH_FILTER'); ?>" />
						<button type="submit" class="btn hasTip" title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>">
							<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>
						</button>
					<?php endif; ?>						
					<?php if (version_compare(JVERSION, '3.2', 'ge')) : ?>
						<div class="btn-wrapper hidden-phone">
							<button type="button" class="btn hasTooltip js-stools-btn-filter btn-primary" title="" data-original-title="Filter the list items">
								<?php echo JText::_('JSEARCH_TOOLS'); ?><i class="caret"></i>
							</button>
						</div>
					<?php endif ; ?>
					<?php if (version_compare(JVERSION, '3.2', 'ge')) : ?>
						<div class="btn-wrapper">
							<button type="button" class="btn hasTooltip js-stools-btn-clear" title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_CLEAR'); ?>">
							<?php echo JText::_('JSEARCH_FILTER_CLEAR');?>
						</button>
						</div>						
					<?php else : ?>
						<button type="button" class="btn hasTip" title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>">
							<?php echo JText::_('JSEARCH_FILTER_CLEAR');?>
						</button>
					<?php endif; ?>	
					<?php if (version_compare(JVERSION, '3.0', 'ge')) : ?>
						<div class="btn-group pull-right">
							<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?></label>
							<?php echo $this->pagination->getLimitBox(); ?>
						</div>
					<?php endif; ?>										
					<div class="clearfix"></div>				
				</div>
				<?php if (version_compare(JVERSION, '3.2', 'ge')) : ?>
					<div class="clearfix"></div>
					<div class="js-stools-container-filters hidden-phone clearfix shown" style="display: block;">
				<?php else : ?>
					<div class="filter-select fltrt">
				<?php endif; ?>					
					
					<?php if (version_compare(JVERSION, '3.2', 'ge')) : ?>
						<div class="js-stools-field-filter">	
					<?php endif; ?>		
							<select name="filter_category_id" class="input-medium" onchange="this.form.submit()">
								<option value=""><?php echo JText::_('JOPTION_SELECT_CATEGORY');?></option>
								<?php echo JHtml::_('select.options', JHtml::_('category.options', 'com_componentarchitect'), 'value', 'text', $this->state->get('filter.category_id'));?>
							</select>
					<?php if (version_compare(JVERSION, '3.2', 'ge')) : ?>
						</div>	
					<?php endif; ?>	
					</div>
		<hr class="hr-condensed">
		<div class="filters pull-left">

			<select name="filter_state" class="input-medium" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('COM_COMPONENTARCHITECT_SELECT_STATUS');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true);?>
			</select>
			
			<select name="filter_created_by" class="input-medium" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('COM_COMPONENTARCHITECT_SELECT_CREATED_BY');?></option>
				<?php echo JHtml::_('select.options', $this->creators, 'value', 'text', $this->state->get('filter.created_by'));?>
			</select>
		</div>
	</fieldset>
	<div class="clearfix clr"> </div>
	<?php if (empty($this->items)) : ?>
		<div class="alert alert-no-items">
			<?php echo JText::_('COM_COMPONENTARCHITECT_FIELDTYPES_NO_MATCHING_RESULTS'); ?>
		</div>
	<?php else : ?>	
		<table class="<?php echo version_compare(JVERSION, '3.0', 'ge') ? 'table table-striped table-condensed':'adminlist'; ?>">
			<thead>
				<tr>
					<th class="center nowrap">
						<?php echo JHtml::_('grid.sort',  'COM_COMPONENTARCHITECT_HEADING_NAME', 'a.name', $list_dirn, $list_order); ?>
					</th>
					<th width="20%" class="center nowrap">
						<?php echo JHtml::_('grid.sort', 'JCATEGORY', 'category_title', $list_dirn, $list_order); ?>
					</th>
				<th width="5%" class="center nowrap">
					<?php echo JHtml::_('grid.sort', 'JPUBLISHED', 'a.state', $list_dirn, $list_order); ?>
				</th>
					
				<th width="1%" class="center nowrap">
					<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $list_dirn, $list_order); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($this->items as $i => $item) : ?>
				<tr class="row<?php echo $i % 2; if($item->id == $this->state->get('list.current_id')) echo ' selected';?>" >
					<td>
						<a class="pointer" href="javascript:void(0)" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $item->id; ?>', '<?php echo $this->escape(addslashes($item->name)); ?>');">
							<?php echo $this->escape($item->name); ?>
						</a>		
					</td>
					<td class="center">
						<a class="pointer" href="javascript:void(0)" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $item->id; ?>', '<?php echo $this->escape(addslashes($item->name)); ?>');">
							<?php echo $this->escape($item->category_title); ?>
						</a>		
					</td>	
					<td class="center">
						<a class="pointer" href="javascript:void(0)" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $item->id; ?>', '<?php echo $this->escape(addslashes($item->name)); ?>');">
							<?php echo $item->id; ?>
						</a>		
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="12">
						<?php echo $this->pagination->getListFooter();?>
					</td>
				</tr>
			</tfoot>		
		</table>
	<?php endif; ?>

	<input type="hidden" name="task" value="" />
	<input type="hidden" name="form_id" id="form_id" value="adminForm" />
	<input type="hidden" name="filter_order" value="<?php echo $list_order; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $list_dirn; ?>" />
	<?php echo JHtml::_('form.token'); ?>
</form>
