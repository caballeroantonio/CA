<?php
/**
 * @version 		$Id:$
 * @name			RealEstateManagerCA
 * @author			caballeroantonio (caballeroantonio.com)
 * @package			com_remca
 * @subpackage		com_remca.site
 * @copyright		
 * @license			GNU General Public License version 3 or later; See http://www.gnu.org/copyleft/gpl.html 
 * 
 * The following Component Architect header section must remain in any distribution of this file
 *
 * @CAversion		Id: default.php 604 2016-01-14 13:05:26Z BrianWade $
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

require_once( __DIR__.'/../../house/tmpl/rem_scripts.php');

$remca_helper = new RemcaHelper();

$watermark_path = ($this->params->get('watermark_show',0) == 1) ? 'watermark/' : '';
$watermark = ($this->params->get('watermark_show',0) == 1) ? true : false;  
?>

<!--begin maps-->
<?php 
if ( $this->params->get('location_map',1)){
    RemcaHelper::add_google_map($this->params, $this->items);
} ?>
<!--end maps-->

<!--begin blocks-->

<?php if (count($this->items) > 0):?>

    <div id="gallery_rem"
    data-collumn-lg="<?php echo $this->params->get('rel_data_columns_adv_lg',3); ?>"
    data-collumn-md="<?php echo $this->params->get('rel_data_columns_adv_md',3); ?>"
    data-collumn-sm="<?php echo $this->params->get('rel_data_columns_adv_sm',2); ?>"
    data-collumn-xs="<?php echo $this->params->get('rel_data_columns_adv_xs',2); ?>"
    >
<?php
    $total = count($this->items);
    foreach($this->items as $row): ?>

    <?php
//        $tmphouse = new mosRealEstateManager($database);
//        $tmphouse->load($row->id);
//        $tmphouse->setCatIds();
//        $option = 'com_realestatemanager';
        $link = JRoute::_(RemcaHelperRoute::getHouseRoute($row->slug, 
            $row->catid, 
            $row->language,
            $layout,									
            $row->params->get('keep_house_itemid')));
        $link = RemcaHelper::sefRelToAbs($link);
        $imageURL = $row->image_link;
    ?>

            <div class="okno_R" id="imageBlock">
                <div id="divamage" style = "position: relative; text-align:center;">

                    <a href="<?= $link ?>" style="text-decoration: none">
                        <?php
                        if ($imageURL == '') $imageURL = 'no-img_eng_big.gif';
                        $file_name = RemcaHelper::rem_picture_thumbnail($imageURL,
                        $this->params->get('fotocategory_width',400),
                        $this->params->get('fotocategory_high',250), $watermark);
                        $file = 'components/com_realestatemanager/photos/' . $file_name;
                        echo '<img alt="' . $row->name . '" title="' . $row->name . '" src="' .
                        $file . '" border="0" class="little">';
                        ?>
                    </a>
                    <?php 
                        if ($row->listing_status){
                          if ($row->listing_status != 0){
                            $listing_status1 = explode(',', JText::_('_REALESTATE_MANAGER_OPTION_LISTING_STATUS'));
                            $ls = 1;
                            foreach ($listing_status1 as $listing_status2) {
                                $listing_status[$ls] = $listing_status2;
                                $ls++;
                            }
                            echo '<div class="rem_listing_status">'.$listing_status[$row->listing_status].'</div>';
                          }
                        }
                    ?>
                     <div class="col_rent">
                            <?php
        if ($this->params->get('show_housestatus',0)) {
            if ($this->params->get('show_houserequest',0)) {
                $data1 = JFactory::getDBO();
                $query = "SELECT  b.rent_from , b.rent_until  FROM #__rem_rent AS b "
                 . " LEFT JOIN #__rem_houses AS c ON b.id_house = c.id "
                  . " WHERE c.id=" . $row->id
                   . " AND c.state='1' AND c.approved='1' AND b.rent_return IS NULL";
                $data1->setQuery($query);
                $rents1 = $data1->loadObjectList();
?>
                            <?php
                if ($row->listing_type == 1) {
                    echo JText::_( '_REALESTATE_MANAGER_LABEL_ACCESSED_FOR_RENT' );
                }
                if($row->listing_type == 2){
                    echo JText::_( '_REALESTATE_MANAGER_LABEL_ACCESSED_FOR_SALE' );
                }
?>
                            <?php
            }
        }
?>
                    </div><!-- col_rent -->
                  
                </div>
                <div class="texthouse">
                    <div class="titlehouse">
                        <a href="<?= $link ?>" >
                    <?php
        if (strlen($row->name) > 45) echo mb_substr($row->name, 0, 25), '...';
        else {
            echo $row->name;
        }
?>
                        </a>
                    </div>
                            <div style="clear: both;"></div>
            <div class="rem_type_Allhouses">
                     <?php if (trim($row->house_size)):?>
                        <div class="row_text">
                            <i class="fa fa-expand"></i>
                            <span class="col_text_2">
                                <?php echo $row->house_size; ?>
                                <?php echo JText::_('_REALESTATE_MANAGER_LABEL_SIZE_SUFFIX'); ?>
                            </span>
                        </div>
                    <?php endif; ?>

                    <?php if (trim($row->rooms)):?>
                    <div class="row_text">
                        <i class="fa fa-building-o"></i>
                        <span class="col_text_1"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_ROOMS' ); ?>:</span>
                        <span class="col_text_2"><?php echo $row->rooms; ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (trim($row->year)): ?>
                <div class="row_text">
                    <i class="fa fa-calendar"></i>
                    <span class="col_text_1"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_BUILD_YEAR' ); ?>:</span>
                    <span class="col_text_2"><?php echo $row->year; ?></span>
                </div>
                <?php endif; ?>

                <?php if (trim($row->bedrooms)):?>
            <div class="row_text">
                <i class="fa fa-inbox"></i>
                <span class="col_text_1"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_BEDROOMS' ); ?>:</span>
                <span class="col_text_2"><?php echo $row->bedrooms; ?></span>
            </div>
            <?php endif; ?>

    </div>
    
                    </div>
                    <div class="rem_house_viewlist">
                    <a href="<?= $link ?>" style="display: block">
                        <?php
        if ($this->params->get('show_pricerequest',0)) {
?>
        <?php if(!RemcaHelper::incorrect_price($row->price)){ ?> 
                        <div class="price">
                        <?php
            if ($this->params->get('price_unit_show',1) == '1') {
                if ($this->params->get('sale_separator',1))
                 echo formatMoney($row->price, $this->params->get('sale_fraction',1), $this->params->get('price_format','.')), ' ', $row->priceunit;
                else echo $row->price, ' ', $row->priceunit;
            } else {
                if ($this->params->get('sale_separator',1))
                 echo $row->priceunit, ' ', formatMoney($row->price, $this->params->get('sale_fraction',1), $this->params->get('price_format','.'));
                else echo $row->priceunit, ' ', $row->price;
            }
?>
                        </div>
                        <?php
            }else{
                echo '<div class="price">'.$row->price.'</div>';
            }
        }
?>
                        <span><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_VIEW_LISTING' ); ?></span>
                    </a>
    <div style="clear: both;"></div>
            </div>
        </div>
<?php endforeach; ?>
    </div>

<?php endif; ?>

<!--end blocks-->

<!--begin pagination-->
			<?php if (($this->params->def('show_house_pagination', 2) == 1  OR ($this->params->get('show_house_pagination') == 2)) AND ($this->pagination->get('pages.total') > 1)) : ?>
			<div class="pagination">

				<?php if ($this->params->def('show_house_pagination_results', 0)) : ?>
				<p class="counter">
						<?php echo $this->pagination->getPagesCounter(); ?>
				</p>
				<?php endif; ?>

				<?php echo $this->pagination->getPagesLinks(); ?>
			</div>
			<?php endif; ?>
<!--end pagination-->