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
 * @version			$Id: modal.php 571 2016-01-04 15:03:02Z BrianWade $
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

$app = JFactory::getApplication();

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.framework', true);
JHtml::_('formbehavior.chosen', 'select');

$function	= $app->input->get('function', 'jSelect[%%CompObject%%]');
$list_order	= $this->escape($this->state->get('list.ordering'));
$list_dirn	= $this->escape($this->state->get('list.direction'));

$search		= $this->escape($this->state->get('filter.search',''));
// Get from global settings the text to use for an empty field
$component = JComponentHelper::getComponent( '[%%com_architectcomp%%]' );
$empty = $component->params->get('default_empty_field', '');

?>
<h3><?php echo JText::_('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SELECT_ITEM_LABEL'); ?></h3>
<form action="<?php echo JRoute::_('index.php?option=[%%com_architectcomp%%]&view=[%%compobjectplural%%]&layout=modal&tmpl=component&function='.$function.'&'.JSession::getFormToken().'=1');?>" method="post" name="adminForm" id="adminForm">
	<fieldset class="filter clearfix">
		<div class="btn-toolbar">
			<div class="btn-group pull-left input-append">
				<input type="text" name="filter_search" id="filter_search" value="<?php echo $search; ?>"  placeholder="<?php echo JText::_('JSEARCH_FILTER'); ?>" />
				<button type="submit" class="btn hasTooltip" title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_SUBMIT'); ?>">
					<i class="icon-search"></i>
				</button>
			</div>

			<div class="btn-group pull-left">
				<button type="button" class="btn hasTooltip js-stools-btn-clear" title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_CLEAR'); ?>">
					<?php echo JText::_('JSEARCH_FILTER_CLEAR');?>
				</button>
			</div>						
			<div class="clearfix"></div>				
		</div>
		<hr class="hr-condensed">
		<div class="filters pull-left">
			[%%FOREACH FILTER_FIELD%%]
				[%%IF FIELD_LINK%%]
			<select name="filter_[%%FIELD_CODE_NAME%%]" class="input-medium" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SELECT_[%%FIELD_FOREIGN_OBJECT_ACRONYM_UPPER%%]_[%%FIELD_FOREIGN_OBJECT_UPPER%%]');?></option>
				<?php echo JHtml::_('select.options', $this->[%%FIELD_FOREIGN_OBJECT_PLURAL%%], 'value', 'text', $this->state->get('filter.[%%FIELD_CODE_NAME%%]'));?>
			</select>
				[%%ELSE FIELD_LINK%%]
			<select name="filter_[%%FIELD_CODE_NAME%%]" class="input-medium js-stools-field-order" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_SELECT_[%%FIELD_CODE_NAME_UPPER%%]');?></option>
				<?php echo JHtml::_('select.options', $this->[%%FIELD_CODE_NAME%%]_values, 'value', 'text', $this->state->get('filter.[%%FIELD_CODE_NAME%%]'));?>
			</select>	
				[%%ENDIF FIELD_LINK%%]				
			[%%ENDFOR FILTER_FIELD%%]	

			[%%IF INCLUDE_STATUS%%]
			<select name="filter_state" class="input-medium" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('[%%COM_ARCHITECTCOMP%%]_SELECT_STATUS');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true);?>
			</select>
			[%%ENDIF INCLUDE_STATUS%%]
			
			[%%IF INCLUDE_ACCESS%%]
			<select name="filter_access" class="input-medium" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_ACCESS');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('access.assetgroups'), 'value', 'text', $this->state->get('filter.access'));?>
			</select>
			[%%ENDIF INCLUDE_ACCESS%%]
			[%%IF INCLUDE_CREATED%%]
			<select name="filter_created_by" class="input-medium" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('[%%COM_ARCHITECTCOMP%%]_SELECT_CREATED_BY');?></option>
				<?php echo JHtml::_('select.options', $this->creators, 'value', 'text', $this->state->get('filter.created_by'));?>
			</select>
			[%%ENDIF INCLUDE_CREATED%%]				
			[%%IF INCLUDE_LANGUAGE%%]
				[%%IF GENERATE_CATEGORIES%%]
			<?php if ($this->state->get('filter.forcedLanguage')) : ?>
				<select name="filter_category_id" class="input-medium" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_CATEGORY');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('category.options', '[%%com_architectcomp%%]', array('filter.language' => array('*', $this->state->get('filter.forcedLanguage')))), 'value', 'text', $this->state->get('filter.category_id'));?>
				</select>
				<input type="hidden" name="forcedLanguage" value="<?php echo $this->escape($this->state->get('filter.forcedLanguage')); ?>" />
				<input type="hidden" name="filter_language" value="<?php echo $this->escape($this->state->get('filter.language')); ?>" />
			<?php else : ?>
				<select name="filter_category_id" class="input-medium" onchange="this.form.submit()">
					<option value=""><?php echo JText::_('JOPTION_SELECT_CATEGORY');?></option>
					<?php echo JHtml::_('select.options', JHtml::_('category.options', '[%%com_architectcomp%%]'), 'value', 'text', $this->state->get('filter.category_id'));?>
				</select>
				<select name="filter_language" class="input-medium" onchange="this.form.submit()">
					<option value=""><?php echo JText::_('JOPTION_SELECT_LANGUAGE');?></option>
					<?php echo JHtml::_('select.options', JHtml::_('contentlanguage.existing', true, true), 'value', 'text', $this->state->get('filter.language'));?>
				</select>
			<?php endif; ?>
					[%%ELSE GENERATE_CATEGORIES%%]
			<select name="filter_language" class="input-medium" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_LANGUAGE');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('contentlanguage.existing', true, true), 'value', 'text', $this->state->get('filter.language'));?>
			</select>
				[%%ENDIF GENERATE_CATEGORIES%%]			
			[%%ELSE INCLUDE_LANGUAGE%%]
				[%%IF GENERATE_CATEGORIES%%]
			<select name="filter_category_id" class="input-medium" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_CATEGORY');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('category.options', '[%%com_architectcomp%%]'), 'value', 'text', $this->state->get('filter.category_id'));?>
			</select>
				[%%ENDIF GENERATE_CATEGORIES%%]	
			[%%ENDIF INCLUDE_LANGUAGE%%]
			[%%IF INCLUDE_TAGS%%]
			<select name="filter_tag" class="input-medium" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_TAG');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('tag.options', true, true), 'value', 'text', $this->state->get('filter.tag'));?>
			</select>
			[%%ENDIF INCLUDE_TAGS%%]				
		</div>
	</fieldset>

	<table class="table table-striped table-condensed">
		<thead>
			<tr>
				[%%IF INCLUDE_NAME%%]
				<th class="center nowrap">
					<?php echo JHtml::_('grid.sort',  '[%%COM_ARCHITECTCOMP%%]_HEADING_NAME', 'a.name', $list_dirn, $list_order); ?>
				</th>
				[%%ENDIF INCLUDE_NAME%%]				
				[%%FOREACH FILTER_FIELD%%]
				<th width="10%" class="center nowrap">
					[%%IF FIELD_SORT%%]
						[%%IF FIELD_LINK%%]
					<?php echo JHtml::_('grid.sort', '[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_HEADING_[%%FIELD_CODE_NAME_UPPER%%]', '[%%FIELD_FOREIGN_OBJECT_ACRONYM%%]_[%%FIELD_FOREIGN_OBJECT_CODE_NAME%%]_[%%FIELD_FOREIGN_OBJECT_LABEL_FIELD%%]', $list_dirn, $list_order); ?>
						[%%ELSE FIELD_LINK%%]
					<?php echo JHtml::_('grid.sort', '[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_HEADING_[%%FIELD_CODE_NAME_UPPER%%]', 'a.[%%FIELD_CODE_NAME%%]', $list_dirn, $list_order); ?>
						[%%ENDIF FIELD_LINK%%]
					[%%ELSE FIELD_SORT%%]
					<?php echo JTEXT::_('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_HEADING_[%%FIELD_CODE_NAME_UPPER%%]'); ?>						
					[%%ENDIF FIELD_SORT%%]						
				</th>	
				[%%ENDFOR FILTER_FIELD%%]					
				[%%IF GENERATE_CATEGORIES%%]
				<th width="20%" class="center nowrap">
					<?php echo JHtml::_('grid.sort', 'JCATEGORY', 'category_title', $list_dirn, $list_order); ?>
				</th>
				[%%ENDIF GENERATE_CATEGORIES%%]			
				[%%IF INCLUDE_STATUS%%]
				<th width="5%" class="center nowrap">
					<?php echo JHtml::_('grid.sort', 'JPUBLISHED', 'a.state', $list_dirn, $list_order); ?>
				</th>
				[%%ENDIF INCLUDE_STATUS%%]
				[%%IF INCLUDE_ACCESS%%]
				<th width="10%" class="center nowrap">
					<?php echo JHtml::_('grid.sort',  'JGRID_HEADING_ACCESS', 'a.access', $list_dirn, $list_order); ?>
				</th>	
				[%%ENDIF INCLUDE_ACCESS%%]
				[%%IF INCLUDE_LANGUAGE%%]
				<th width="5%" class="center nowrap">
					<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_LANGUAGE', 'a.language', $list_dirn, $list_order); ?>
				</th>		
				[%%ENDIF INCLUDE_LANGUAGE%%]					
					
				<th width="1%" class="center nowrap">
					<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $list_dirn, $list_order); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($this->items as $i => $item) : ?>
			[%%IF INCLUDE_LANGUAGE%%]
			<?php 
				if ($item->language) :
					$tag = JString::strlen($item->language);
					if ($tag == 5) :
						$lang = JString::substr($item->language, 0, 2);
					else :
						if ($tag == 6) :
							$lang = JString::substr($item->language, 0, 3);
						else :
							$lang = "";
						endif;
					endif;
				endif;
			?>
			[%%ENDIF INCLUDE_LANGUAGE%%]		
			<tr class="row<?php echo $i % 2; ?>">
				[%%IF INCLUDE_NAME%%]
				<td>
					<a href="javascript:void(0)" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $item->id; ?>', '<?php echo $this->escape(addslashes($item->name)); ?>');">
						<?php echo $this->escape($item->name); ?>
					</a>		
				</td>
				[%%ENDIF INCLUDE_NAME%%]
				[%%FOREACH FILTER_FIELD%%]
				<td class="center">
					[%%IF INCLUDE_NAME%%]
					<a class="pointer" href="javascript:void(0)" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $item->id; ?>', '<?php echo $this->escape(addslashes($item->name)); ?>');">
					[%%ELSE INCLUDE_NAME%%]
					<a class="pointer" href="javascript:void(0)" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $item->id; ?>');">
					[%%ENDIF INCLUDE_NAME%%]
						<?php 
							[%%FIELD_ADMIN_LIST_VALUE%%] 
						?>					
					</a>		
				</td>	
				[%%ENDFOR FILTER_FIELD%%]				
				[%%IF GENERATE_CATEGORIES%%]				
				<td class="center">
					[%%IF INCLUDE_NAME%%]
					<a class="pointer" href="javascript:void(0)" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $item->id; ?>', '<?php echo $this->escape(addslashes($item->name)); ?>');">
					[%%ELSE INCLUDE_NAME%%]
					<a class="pointer" href="javascript:void(0)" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $item->id; ?>');">
					[%%ENDIF INCLUDE_NAME%%]
						<?php echo $this->escape($item->category_title); ?>
					</a>		
				</td>	
				[%%ENDIF GENERATE_CATEGORIES%%]							
				[%%IF INCLUDE_STATUS%%]
				<td class="center">
					[%%IF INCLUDE_NAME%%]
					<a class="pointer" href="javascript:void(0)" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $item->id; ?>', '<?php echo $this->escape(addslashes($item->name)); ?>');">
					[%%ELSE INCLUDE_NAME%%]
					<a class="pointer" href="javascript:void(0)" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $item->id; ?>');">
					[%%ENDIF INCLUDE_NAME%%]
						<?php echo JHtml::_('jgrid.published', $item->state, $i, '[%%compobjectplural%%].', false, 'cb'); ?>
					</a>		
				</td>
				[%%ENDIF INCLUDE_STATUS%%]
				[%%IF INCLUDE_ACCESS%%]
				<td class="center">
					[%%IF INCLUDE_NAME%%]
					<a class="pointer" href="javascript:void(0)" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $item->id; ?>', '<?php echo $this->escape(addslashes($item->name)); ?>');">
					[%%ELSE INCLUDE_NAME%%]
					<a class="pointer" href="javascript:void(0)" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $item->id; ?>');">
					[%%ENDIF INCLUDE_NAME%%]
						<?php echo $this->escape($item->access_level); ?>
					</a>		
				</td>	
				[%%ENDIF INCLUDE_ACCESS%%]	
				[%%IF INCLUDE_LANGUAGE%%]
				<td class="center">
					[%%IF INCLUDE_NAME%%]
					<a class="pointer" href="javascript:void(0)" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $item->id; ?>', '<?php echo $this->escape(addslashes($item->name)); ?>');">
					[%%ELSE INCLUDE_NAME%%]
					<a class="pointer" href="javascript:void(0)" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $item->id; ?>');">
					[%%ENDIF INCLUDE_NAME%%]
					<?php if ($item->language=='*'):?>
						<?php echo JText::alt('JALL', 'language'); ?>
					<?php else:?>
						<?php echo $item->language_title ? $this->escape($item->language_title) : JText::_('JUNDEFINED'); ?>
					<?php endif;?>
					</a>		
				</td>
				[%%ENDIF INCLUDE_LANGUAGE%%]						
				<td class="center">
					[%%IF INCLUDE_NAME%%]
					<a class="pointer" href="javascript:void(0)" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $item->id; ?>', '<?php echo $this->escape(addslashes($item->name)); ?>');">
					[%%ELSE INCLUDE_NAME%%]
					<a class="pointer" href="javascript:void(0)" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $item->id; ?>');">
					[%%ENDIF INCLUDE_NAME%%]
						<?php echo $item->id; ?>
					</a>		
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="12">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>		
	</table>

	<input type="hidden" name="task" value="" />
	<input type="hidden" name="form_id" id="form_id" value="adminForm" />
	<input type="hidden" name="filter_order" value="<?php echo $list_order; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $list_dirn; ?>" />
	<?php echo JHtml::_('form.token'); ?>
</form>
