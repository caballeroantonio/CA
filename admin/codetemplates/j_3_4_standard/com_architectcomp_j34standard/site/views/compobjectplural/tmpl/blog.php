
<?php
/**
 * @tempversion
 * @name			[%%ArchitectComp_name%%]
 * @author			[%%COMPONENTAUTHOR%%] ([%%COMPONENTWEBSITE%%])
 * @package			[%%com_architectcomp%%]
 * @subpackage		[%%com_architectcomp%%].site
 * @copyright		[%%COMPONENTCOPYRIGHT%%]
 * @license			GNU General Public License version 3 or later; See http://www.gnu.org/copyleft/gpl.html 
 * 
 * The following Component Architect header section must remain in any distribution of this file
 *
 * @version			$Id: blog.php 571 2016-01-04 15:03:02Z BrianWade $
 * @CAauthor		Component Architect (www.componentarchitect.com)
 * @CApackage		architectcomp
 * @CAsubpackage	architectcomp.site
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

/*
 *	Add style sheets, javascript and behaviours here in the layout so they can be overridden, if required, in a template override 
 */

// Add css files for the [%%architectcomp%%] component and categories if they exist
$this->document->addStyleSheet(JUri::root().'media/[%%com_architectcomp%%]/css/site_[%%architectcomp%%].css');
$this->document->addStyleSheet(JUri::root().'media/[%%com_architectcomp%%]/css/site_[%%compobjectplural%%].css');

if ($lang->isRTL())
{
	$this->document->addStyleSheet(JUri::root().'media/[%%com_architectcomp%%]/css/site_[%%architectcomp%%]-rtl.css');
	$this->document->addStyleSheet(JUri::root().'media/[%%com_architectcomp%%]/css/site_[%%compobjectplural%%]-rtl.css');
}

// Add Javscript functions for field display
[%%IF INCLUDE_IMAGE%%]
JHtml::_('behavior.caption');
[%%ENDIF INCLUDE_IMAGE%%]				
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('dropdown.init');
JHtml::_('formbehavior.chosen', 'select');		

/*
 *	Layout HTML
 */
?>
<noscript>
<p style="color: red;"><?php echo JText::_('[%%COM_ARCHITECTCOMP%%]_WARNING_NOSCRIPT'); ?><p>
</noscript>
[%%IF INCLUDE_MICRODATA%%]
<div class="[%%architectcomp%%] [%%compobjectplural%%]-blog<?php echo $this->params->get('pageclass_sfx');?>" itemscope itemtype="http://schema.org/Blog">
[%%ELSE INCLUDE_MICRODATA%%]
<div class="[%%architectcomp%%] [%%compobjectplural%%]-blog<?php echo $this->params->get('pageclass_sfx');?>">
[%%ENDIF INCLUDE_MICRODATA%%]
	<?php if ($this->params->get('show_page_heading')): ?>
		<div class="page-header">
			<h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
		</div>
	<?php endif; ?>
	<?php if (empty($this->lead_items) AND empty($this->intro_items) AND empty($this->link_items)) : ?>
		<?php if ($this->params->get('show_no_[%%compobjectplural%%]',1)) : ?>
		<p><?php echo JText::_('[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]_NO_ITEMS'); ?></p>
		<?php endif; ?>
	<?php else : ?>
		<?php $leading_count=0 ; ?>
		<?php if (!empty($this->lead_items)) : ?>
		<div class="items-leading clearfix">
			<?php foreach ($this->lead_items as &$item) : ?>
				[%%IF INCLUDE_MICRODATA%%]
					[%%IF INCLUDE_STATUS%%]
				<div class="leading-<?php echo $leading_count; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
					[%%ELSE INCLUDE_STATUS%%]
				<div class="leading-<?php echo $leading_count; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
					[%%ENDIF INCLUDE_STATUS%%]
				[%%ELSE INCLUDE_MICRODATA%%]
					[%%IF INCLUDE_STATUS%%]
				<div class="leading-<?php echo $leading_count; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
					[%%ELSE INCLUDE_STATUS%%]
				<div class="leading-<?php echo $leading_count; ?>">
					[%%ENDIF INCLUDE_STATUS%%]
				[%%ENDIF INCLUDE_MICRODATA%%]
					<?php
						$this->item = &$item;
						echo $this->loadTemplate('item');
					?>
				</div>
				<?php $leading_count++; ?>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
		<?php
		$intro_count=(count($this->intro_items));
		$counter=0;
		?>
		<?php if (!empty($this->intro_items)) : ?>
			<?php foreach ($this->intro_items as $key => &$item) : ?>

				<?php
					$key= ($key-$leading_count)+1;
					$row_count=( ((int)$key-1) %	(int) $this->columns) +1;
					$row = $counter / $this->columns ;

					if ($row_count==1) :
				?>
					<div class="items-row cols-<?php echo (int) $this->columns;?> <?php echo 'row-'.$row ; ?> row-fluid clearfix">
				<?php endif; ?>
						<div class="span<?php echo round((12 / $this->columns));?>">
							[%%IF INCLUDE_MICRODATA%%]
								[%%IF INCLUDE_STATUS%%]
							<div class="item column-<?php echo $row_count;?><?php echo $item->state == 0 ? ' system-unpublished"' : null; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
								[%%ELSE INCLUDE_STATUS%%]
							<div class="item column-<?php echo $row_count;?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
								[%%ENDIF INCLUDE_STATUS%%]			
							[%%ELSE INCLUDE_MICRODATA%%]
								[%%IF INCLUDE_STATUS%%]
							<div class="item column-<?php echo $row_count;?><?php echo $item->state == 0 ? ' system-unpublished"' : null; ?>">
								[%%ELSE INCLUDE_STATUS%%]
							<div class="item column-<?php echo $row_count;?>">
								[%%ENDIF INCLUDE_STATUS%%]			
							[%%ENDIF INCLUDE_MICRODATA%%]
							<?php
								$this->item = &$item;
								echo $this->loadTemplate('item');
								?>
							</div>
							<?php $counter++; ?>
						</div>
				<?php if (($row_count == $this->columns) or ($counter ==$intro_count)): ?>
						<span class="row-separator"></span>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>

		<?php if (!empty($this->link_items)) : ?>
			<div class="items-more">
				<?php echo $this->loadTemplate('links'); ?>
			</div>
		<?php endif; ?>
		<?php if ($this->params->def('show_[%%compobject%%]_pagination', 2) == 1  OR ($this->params->get('show_[%%compobject%%]_pagination') == 2 AND $this->pagination->get('pages.total') > 1)) : ?>
		<div class="pagination">

				<?php if ($this->params->def('show_[%%compobject%%]_pagination_results', 1)) : ?>
					<p class="counter">
						<?php echo $this->pagination->getPagesCounter(); ?>
					</p>
				<?php  endif; ?>
						<?php echo $this->pagination->getPagesLinks(); ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>
</div>

