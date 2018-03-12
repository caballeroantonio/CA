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
 * @CAversion		Id: architectcomp.php 571 2016-01-04 15:03:02Z BrianWade $
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
/**
 * Realestatemanagerca component helper.
 *
 */
class RemcaHelper extends JHelperContent
{
        public static $doc;
        public static $params;
        public static $db;
	/**
	 * Constructor.
	 *
	 * @param	array An optional associative array of configuration settings.
	 * 
	 */
	public function __construct()
	{
            self::$doc = JFactory::getDocument();
            self::$params = JComponentHelper::getParams('com_remca');
            self::$db = JFactory::getDbo();
	}

    static function showRentRequest(& $houses, & $currentcat, & $params, & $tabclass,
     & $catid, & $sub_categories, $option) {
        $pageNav = new JPagination(0, 0, 0);
      
        HTML_realestatemanager::displayHouses($houses, $currentcat, $params, $tabclass,
         $catid, $sub_categories, $pageNav, $option);
        // add the formular for send to :-)
    }

    static function displayHouses_empty($rows, $currentcat, &$params, $tabclass, $catid,
           $categories, &$pageNav = null,$is_exist_sub_categories=false, $option) {
        positions_rem($params->get('allcategories01'));
        ?>
        <div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
             <?php echo $currentcat->header; ?>
        </div>
        <?php positions_rem($params->get('allcategories02')); ?>
        <table class="basictable table_48" border="0" cellpadding="4" cellspacing="0" width="100%">
            <tr>
                <td>
                    <?php echo $currentcat->descrip; ?>
                </td>     
                <td width="120" align="center">
                    <img src="./components/com_realestatemanager/images/rem_logo.png"
                     align="right" alt="Real Estate Manager logo"/>
                </td>
            </tr>
        </table>
        <?php
        if ($is_exist_sub_categories) {
            ?>
            <?php positions_rem($params->get('singlecategory07')); ?>
            <div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
            <?php echo JText::_( '_REALESTATE_MANAGER_LABEL_FETCHED_SUBCATEGORIES') . " : " .
             $params->get('category_name'); ?>
            </div>
            <?php positions_rem($params->get('singlecategory08')); ?>
            <?php
            HTML_realestatemanager::listCategories($params, $categories, $catid, $tabclass, $currentcat);
        }
    }

    static function displayHouses(&$rows, $currentcat, &$params, $tabclass, $catid, $categories, &$pageNav = null, $is_exist_sub_categories=false, $option, $layout = "default", $type = "alone_category") {
        global  $Itemid;  
        $type = 'alone_category';
        require getLayoutPath::getLayoutPathCom('com_realestatemanager', $type, $layout);
    }    

    static function displaySearchHouses(&$rows, $currentcat, &$params, $tabclass, $catid, $categories, &$pageNav = null, $is_exist_sub_categories=false, $option, $layout = "default", $layoutsearch = "default") {
        global  $Itemid; 
        $type = 'search_result';

        if($params->get('search_form_on_result_search_page_show')){
          PHP_realestatemanager::showSearchHouses($option, $catid, $option, $layoutsearch);  
        }
        require getLayoutPath::getLayoutPathCom('com_realestatemanager', $type, $layout);
    }


    /**
     * Displays the house
     */
    static function displayHouse(& $house, & $tabclass, & $params, & $currentcat, & $rating,
     & $house_photos,$videos,$tracks, $id, $catid, $option, & $house_feature, & $currencys_price, $layout = "default") {
        
        $type = 'view_house';
        require getLayoutPath::getLayoutPathCom('com_realestatemanager', $type, $layout);
    }

    

    /**
     * Display links to categories
     */
    static function showCategories(&$params, &$categories, &$catid, &$tabclass, &$currentcat, $layout) {
        
        $type = 'all_categories';
        require getLayoutPath::getLayoutPathCom('com_realestatemanager', $type, $layout);
    }
    //30.06.17
    static function showSearchButton() {
        
        ?>
        <form action="<?php
         echo sefRelToAbs("index.php?option=com_realestatemanager&amp;task=show_search_house"); ?>" method="post" name="search_button" enctype="multipart/form-data">
            <input  type="submit" name="submit" value="<?php
             echo JText::_( '_REALESTATE_MANAGER_LABEL_SEARCH'); ?>" class="button"/>
        </form>
        <?php
    }

    static function showAddButton($Itemid) {
      
    }

    static function showButtonMyHouses() {
        global $Itemid;
    }

    static function showOwnersButton() {
        global $Itemid;
    }

    static function showSearchHouses($params, $currentcat, $clist, $option, &$temp1, &$temp2, $layout = "default") {
        global  $task;
        //$type = $task == "search" ? "show_search_result" : "show_search_house";
        if($params->get('showsearchhouselayout')){
          $layout = $params->get('showsearchhouselayout');
        }
        $type = "show_search_house";
        require getLayoutPath::getLayoutPathCom('com_realestatemanager', $type, $layout);
    }

    /////////////////////////////////////




    static function showTabs(&$params, &$userid, &$username, &$comprofiler, &$option) {

        
        self::$doc->addStyleSheet('components/com_realestatemanager/TABS/tabcontent.css');
        self::$doc->addScript('components/com_realestatemanager/TABS/tabcontent.js');


?>

         <?php 
        if(RemcaHelper::checkJavaScriptIncludedRE("jQuerREL-1.2.6.js") === false ) {
        self::$doc->addScript(JURI::root(true) . '/components/com_realestatemanager/lightbox/js/jQuerREL-1.2.6.js');
        } 
    ?>
        <script type="text/javascript">jQuerREL=jQuerREL.noConflict();</script>
        </br> <!-- br for plugin simplemembership!!! -->
        <div class='tabs_buttons'>
            <ul id="countrytabs" class="shadetabs">
        <?php

        if ($params->get('show_edit_registrationlevel')) {
                        ?>
                <li>
                    <a class="my_houses_edit" href="<?php echo JRoute::_('index.php?option='
                     . $option .'&userId='.$userid . '&task=edit_my_houses' . $comprofiler, false);
                     ?>"><?php echo JText::_( '_REALESTATE_MANAGER_SHOW_TABS_SHOW_MY_HOUSES'); ?></a>
                </li>
            <?php
        }

        if ($params->get('show_rent')) {

            if ($params->get('show_rent_registrationlevel')) {
                ?>
                    <li>
                        <a class="my_houses_rent" href="<?php echo JRoute::_('index.php?option='
                         . $option . '&userId='.$userid . '&task=rent_requests' . $comprofiler , false);
                          ?>"><?php echo JText::_( '_REALESTATE_MANAGER_SHOW_TABS_RENT_REQUESTS'); ?></a>
                    </li>
                <?php
            }
        }
        if ($params->get('show_buy')) {
            if ($params->get('show_buy_registrationlevel')) {
                ?>
                    <li>
                        <a class="my_houses_buy" href="<?php echo JRoute::_('index.php?option='
                         . $option . '&userId='.$userid . '&task=buying_requests' . $comprofiler , false);
                          ?>"><?php echo JText::_( '_REALESTATE_MANAGER_SHOW_TABS_BUYING_REQUESTS'); ?></a>
                    </li>
                <?php
            }
        }
        if ($params->get('show_history')) {
            if ($params->get('show_history_registrationlevel')) {
                ?>
            <li>
                <a class="my_houses_history" href="<?php echo JRoute::_('index.php?option='
                 . $option . '&userId='.$userid . '&task=rent_history' . $comprofiler , false);
                 ?>"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_CBHISTORY_ML'); ?></a>
            </li>
                <?php
            }
        }
        ?>
            </ul>
        </div>
<script type="text/javascript">
    jQuerREL(document).ready(function(){
        var atr = jQuerREL("#adminForm div:first-child").attr("id");
        if(!atr){
            atr = jQuerREL("#adminForm table:first-child").attr("id");
        }
        jQuerREL("#countrytabs > li > a."+atr).addClass("selected");
         jQuerREL("#countrytabs > li > a").click(function(){
             jQuerREL("#countrytabs > li > a").removeClass("selected");
             jQuerREL(this).addClass("selected");
        });
    });

</script>
    <?php
}

            static function showMyHouses(&$houses, &$params, &$pageNav, $option,& $clist, &$language, & $rentlist,
           & $publist, & $search, $search_list, $ownerlist, $layout = "default") {
                global  $Itemid;

                

                //require(JPATH_SITE.
                // "/components/com_realestatemanager/views/my_houses/tmpl/".$layout.".php");
                $type = 'my_houses';
                require getLayoutPath::getLayoutPathCom('com_realestatemanager', $type, $layout);
            }

           static function showRentHouses($option, $house1, $rows, & $userlist, $type) {
                global $my,  $mainframe, $Itemid;
        ?>
        <?php 
        if(RemcaHelper::checkJavaScriptIncludedRE("jQuerREL-1.2.6.js") === false ) {
        self::$doc->addScript(JURI::root(true) . '/components/com_realestatemanager/lightbox/js/jQuerREL-1.2.6.js');
        } 
    ?>
        <script type="text/javascript">jQuerREL=jQuerREL.noConflict();</script>


        <?php 

            if(RemcaHelper::checkJavaScriptIncludedRE("jQuerREL-ui.js") === false ) {
            self::$doc->addScript(JURI::root(true) . 'components/com_realestatemanager/includes/jQuerREL-ui.js');
            }

        ?>

      <?php
        self::$doc->addScript('components/com_realestatemanager/includes/functions.js');
        self::$doc->addStyleSheet('components/com_realestatemanager/includes/realestatemanager.css');
        ?>
        <div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
        <form action="index.php" method="get" name="adminForm" id="adminForm">
                <?php
                if ($type == "rent" || $type == "edit_rent") {
                    ?>
                <div class="my_real_table_rent">
                    <div class="my_real">
                        <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_TO') . ":"; ?></span>
                        <span class="col_02"><?php echo $userlist; ?></span>

                    </div>
                    <div class="my_real">
                        <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_USER') . ":"; ?></span>
                        <span class="col_02"><input type="text" name="user_name" class="inputbox" /></span>
                    </div>
                    <div class="my_real">
                        <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_EMAIL') . ":"; ?></span>
                        <span class="col_02"><input type="text" name="user_email" class="inputbox" /></span>
                    </div>


                <script type="text/javascript">
                jQuerREL(document).ready(function($) {

                  jQuerREL('#userid').change(function(event) {

                    if(jQuerREL(this).val() == '-1'){
                      jQuerREL('.my_real [name=user_name]').val('');
                      jQuerREL('.my_real [name=user_email]').val('');
                      jQuerREL('[name=user_name], [name=user_email]').removeAttr('readonly');
                    }else{
                      jQuerREL.ajax({
                        type: "POST",
                        url: "index.php?option=com_realestatemanager&task=getUserData&userId="+jQuerREL(this).val()+"&format=raw",
                        success: function(user){
                          var user = jQuerREL.parseJSON(user);
                          jQuerREL('[name=user_name], [name=user_email]').attr('readonly','readonly');
                          jQuerREL('.my_real [name=user_name]').val(user.name);
                          jQuerREL('.my_real [name=user_email]').val(user.email);
                        }
                      });
                    }
                  });
                });
                </script>

                    <script>
                        Date.prototype.toLocaleFormat = function(format) {
                            var f = {Y : this.getYear() + 1900,m : this.getMonth() + 
                              1,d : this.getDate(),H : this.getHours(),M : this.getMinutes(),S : this.getSeconds()}
                            for(k in f)
                                format = format.replace('%' + k, f[k] < 10 ? "0" + f[k] : f[k]);
                            return format;
                        };
                                
                        window.onload = function ()

                        {
                            var today = new Date();
                            var date = today.toLocaleFormat("<?php echo self::$params->get('date_format') ?>");
                            document.getElementById('rent_from').value = date;
                            document.getElementById('rent_until').value = date;
                        };

                    </script>
 <!--///////////////////////////////calendar///////////////////////////////////////-->
          <?php
                  $house_id_fordate =  $house1->id;
                  $date_NA = available_dates($house_id_fordate);
          ?>  
               <script language="javascript" type="text/javascript">
                  var unavailableDates = Array();
                  jQuerREL(document).ready(function() {
                      //var unavailableDates = Array();
                      var k=0;
                      <?php if(!empty($date_NA)){?>
                          <?php foreach ($date_NA as $N_A){ ?>
                               unavailableDates[k]= '<?php echo $N_A; ?>';
                              k++;
                          <?php } ?>
                      <?php } ?>

                      function REMunavailableFrom(date) {
                          dmy = date.getFullYear() + "-" + ('0'+(date.getMonth() + 1)).slice(-2) + 
                              "-" + ('0'+date.getDate()).slice(-2);
                          if (jQuerREL.inArray(dmy, unavailableDates) == -1) {
                            return [true, ""];
                          } else {
                            return [false, "", "Unavailable"];
                          }
                      }

                      function REMunavailableUntil(date) {
                          dmy = date.getFullYear() + "-" + ('0'+(date.getMonth() + 1)).slice(-2) + 
                            "-" + ('0'+(date.getDate()-("<?php  if(!self::$params->get('special_price_show')) echo '1';?>"))).slice(-2);
                          if (jQuerREL.inArray(dmy, unavailableDates) == -1) {
                              return [true, ""];
                          } else {
                              return [false, "", "Unavailable"];
                          }
                      }

                      jQuerREL( "#rent_from" ).datepicker(
                      {
                        minDate: "+0",
                        dateFormat: "<?php echo transforDateFromPhpToJquery();?>",
                        beforeShowDay: unavailableFrom,
                      });

                      jQuerREL( "#rent_until" ).datepicker(
                      {
                        minDate: "+0",
                        dateFormat: "<?php echo transforDateFromPhpToJquery();?>",
                        beforeShowDay: unavailableUntil,
                      });
                  });



                  </script>


<!--///////////////////////////////////////////////////////////////////////////-->
                    <div class="my_real">
                        <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_FROM') . ":"; ?></span>
                           <p><input type="text" id="rent_from" name="rent_from"></p>
                    </div>
                    <div class="my_real">
                        <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_TIME'); ?></span>
                        <p><input type="text" id="rent_until" name="rent_until"></p>
                    </div>
                </div>


        <?php } else { 
               echo "";
        } 
                $all = JFactory::getDBO();
                $query = "SELECT * FROM #__rem_rent";
                $all->setQuery($query);
                $num = $all->loadObjectList();
                ?>
            <div class="table_63">

                <div class="row_01">
                    <span class="col_01">
        <?php if ($type != 'rent') {
            ?>
                            <input type="checkbox" name="toggle" value="" onClick="rem_checkAll(this);" />
                            <span class="toggle_check">check All</span>
        <?php } ?>
                    </span>
        
                </div>

        <?php
        
        
        if ($type == "rent")
        {
        ?>
            <td align="center">  <input class="inputbox"  type="checkbox"
              name="checkHouse" id="checkHouse" size="0" maxlength="0" value="on" /></td>
         <?php
        } else if ($type == "edit_rent"){ ?>
          <input type="hidden"  name="checkHouse" id="checkHouse" value="on" /></td>
         <?php
         }
        $assoc_title = '';
        for ($t = 0, $z = count($rows); $t < $z; $t++) {
          if($rows[$t]->id != $house1->id) $assoc_title .= " ".$rows[$t]->name;
        }
        
               print_r("
                  <td align=\"center\">". $house1->id ."</td>
                  <td align=\"center\">" . $house1->houseid . "</td>
                  <td align=\"center\">" . $house1->name . " ( " . $assoc_title ." ) " . "</td>
                  </tr>");
        

              for ($j = 0, $n = count($rows); $j < $n; $j++) {
                $row = $rows[$j];
                    
              ?>
                     
              
                    <input class="inputbox" type="hidden" name="houseid" id="houseid"
                     size="0" maxlength="0" value="<?php echo $house1->houseid; ?>" />
                    <input class="inputbox" type="hidden" name="id" id="id" size="0"
                     maxlength="0" value="<?php echo $row->id; ?>" />
                    <input class="inputbox" type="hidden" name="name" id="name"
                     size="0" maxlength="0" value="<?php echo $row->name; ?>" />
                <?php
                
                    $house = $row->id;
                    $data = JFactory::getDBO();
                    $query = "SELECT * FROM #__rem_rent WHERE fk_houseid=" . $house . " ORDER BY rent_return ";
                    $data->setQuery($query);
                    $allrent = $data->loadObjectList();
                    
                
               
                    $num = 1;
                    for ($i = 0, $nn = count($allrent); $i < $nn; $i++) {
                        ?>

                        <div class="box_rent_real">

                            <div class="row_01 row_rent_real">
                        <?php if (!isset($allrent[$i]->rent_return) && $type != "rent") {
                            ?>
                                    <span class="rent_check_vid">
                                        <input type="checkbox" id="cb<?php echo $i; ?>" 
                                          name="bid[]" value="<?php echo $allrent[$i]->id; ?>" 
                                          onClick="isChecked(this.checked);" />
                                    </span>
                        <?php } else {
                            ?>
                        <?php } ?>
                                <span class="col_01">id</span>
                                <span class="col_02"><?php echo $num; ?></span>
                            </div>

                            <div class="row_02 row_rent_real">
                                <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_PROPERTYID'); ?></span>  
                                <span class="col_02"><?php echo $row->houseid; ?></span>
                            </div>

                            <div class="row_03 row_rent_real">
                        <?php echo $row->name; ?>
                            </div>

                            <div class="from_until_return">
                                <div class="row_04 row_rent_real">
                                    <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_FROM'); ?></span>  
                                    <span class="col_02"><?php echo data_transform_rem($allrent[$i]->rent_from); ?></span>
                                </div>
                                <br />
                                <div class="row_05 row_rent_real">
                                    <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_UNTIL'); ?></span>  
                                    <span class="col_02"><?php echo data_transform_rem($allrent[$i]->rent_until); ?></span>
                                </div>
                                <br />
                                <div class="row_06 row_rent_real">
                                    <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_RETURN'); ?></span>  
                                    <span class="col_02"><?php echo data_transform_rem($allrent[$i]->rent_return); ?></span>
                                </div>
                            </div>

                        </div>
                        <?php
                        if ($allrent[$i]->fk_userid != null)
                            print_r("<div class='rent_user'>" . $allrent[$i]->user_name . "</div>");
                        else
                            print_r("<div class='rent_user'>" . $allrent[$i]->user_name . $allrent[$i]->user_email . "</div>");
                        $num++;
                    }
            
                }
                ?>
            </div> <!-- table_63 -->


            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" id="adminFormTaskInput" name="task" value="" />
            <input type="hidden" name="save" value="1" />
            <input type="hidden" name="boxchecked" value="1" />
                <?php
                if ($option != "com_realestatemanager") {
                    ?>
                <input type="hidden" name="is_show_data" value="1" />
                    <?php
                }
                ?>
            <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />

        <?php if ($type == "rent") { ?>
                <input type="button" name="rent_save" value="<?php 
                  echo JText::_( '_REALESTATE_MANAGER_LABEL_BUTTON_RENT'); ?>" onclick="rem_buttonClickRent(this)"/>
        <?php } ?>
        <?php if ($type == "rent_return") { ?>
                <input type="button" name="rentout_save" value="<?php 
                  echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_RETURN'); ?>" onclick="rem_buttonClickRent(this)"/>
        <?php } ?>
        </form>
        <?php
    }



 static function editRentHouses($option, $house1, $rows, $title_assoc, & $userlist, & $all_assosiate_rent, $type) {
    global $my,  $mainframe, $Itemid;
	

    ?>
     <?php 
        if(RemcaHelper::checkJavaScriptIncludedRE("jQuerREL-1.2.6.js") === false ) {
        self::$doc->addScript(JURI::root(true) . '/components/com_realestatemanager/lightbox/js/jQuerREL-1.2.6.js');
        } 
    ?>
    <script type="text/javascript">jQuerREL=jQuerREL.noConflict();</script>



    <?php 

      if(RemcaHelper::checkJavaScriptIncludedRE("jQuerREL-ui.js") === false ) {
        self::$doc->addScript(JURI::root(true) . '/components/com_realestatemanager/includes/jQuerREL-ui.js');
      }


     ?>



    <?php


    self::$doc->addScript('components/com_realestatemanager/includes/functions.js');
    self::$doc->addStyleSheet('components/com_realestatemanager/includes/realestatemanager.css');
    ?>

 <!--///////////////////////////////calendar///////////////////////////////////////-->
  <script language="javascript" type="text/javascript">
    jQuerREL(document).ready(function() {
        jQuerREL( "#rent_from, #rent_until" ).datepicker(
        {
          dateFormat: "<?php echo transforDateFromPhpToJquery();?>",
        });
    });



  </script>


        <div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>
        <form action="index.php" method="post" name="adminForm" id="adminForm">
                <?php
                if ($type == "rent" || $type == "edit_rent") {
                    ?>
                <div class="my_real_table_rent">
                    <div class="my_real">
                        <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_TO') . ":"; ?></span>
                        <span class="col_02"><?php echo $userlist; ?></span>
                    </div>
                    <div class="my_real">
                        <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_USER') . ":"; ?></span>
                        <span class="col_02"><input type="text" name="user_name" class="inputbox" /></span>
                    </div>
                    <div class="my_real">
                        <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_EMAIL') . ":"; ?></span>
                        <span class="col_02"><input type="text" name="user_email" class="inputbox" /></span>
                    </div>
                    <div class="my_real">
                        <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_FROM') . ":"; ?></span>
                           <p><input type="text" id="rent_from" name="rent_from"></p>
                    </div>
                    <div class="my_real">
                        <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_TIME'); ?></span>
                        <p><input type="text" id="rent_until" name="rent_until"></p>
                    </div>
                </div>

                <script type="text/javascript">
                jQuerREL(document).ready(function($) {

                  jQuerREL('#userid').change(function(event) {

                    if(jQuerREL(this).val() == '-1'){
                      jQuerREL('.my_real [name=user_name]').val('');
                      jQuerREL('.my_real [name=user_email]').val('');
                      jQuerREL('[name=user_name], [name=user_email]').removeAttr('readonly');
                    }else{
                      jQuerREL.ajax({
                        type: "POST",
                        url: "index.php?option=com_realestatemanager&task=getUserData&userId="+jQuerREL(this).val()+"&format=raw",
                        success: function(user){
                          var user = jQuerREL.parseJSON(user);
                          jQuerREL('[name=user_name], [name=user_email]').attr('readonly','readonly');
                          jQuerREL('.my_real [name=user_name]').val(user.name);
                          jQuerREL('.my_real [name=user_email]').val(user.email);
                        }
                      });
                    }
                  });
                });
                </script>

<!--/////////////////////////////////////////////-->



        <?php } else { 
                echo "";
        }
            $all = JFactory::getDBO();
            $query = "SELECT * FROM #__rem_rent ";
            $all->setQuery($query);
            $num = $all->loadObjectList();
            ?>

            <div class="table_63">

                <div class="row_01">
                    <span class="col_01">
                        </span>
                </div>

        <?php
                $assoc_title = ''; 
                for ($t = 0, $z = count($title_assoc); $t < $z; $t++) {
                  if($title_assoc[$t]->name != $house1->name) $assoc_title .= " ".$title_assoc[$t]->name; 
                }
                
                 //show rent history what we may change
                    ?>
                        
                <input class="inputbox" type="hidden"  name="houseid" id="houseid" size="0"
                 maxlength="0" value="<?php echo $house1->houseid; ?>" />
                <input class="inputbox"  type="hidden"  name="id" id="id" size="0" maxlength="0"
                 value="<?php echo $house1->id; ?>" />
                <input class="inputbox"  type="hidden"  name="id2" id="id2" size="0" maxlength="0"
                 value="<?php echo $house1->id; ?>" />   
          <?php

          if ($type == "edit_rent"){ ?>
            <input type="hidden"  name="checkHouse" id="checkHouse" value="on" />
           <?php
           }
          
          $num = 1;
          for ($y = 0, $n2 = count($all_assosiate_rent[0]); $y < $n2; $y++) {
              $assoc_rent_ids = '';
              for ($j = 0, $n3 = count($all_assosiate_rent); $j < $n3; $j++) {
                  if($assoc_rent_ids != "" ) $assoc_rent_ids .= ",".$all_assosiate_rent[$j][$y]->id;
                  else $assoc_rent_ids = $all_assosiate_rent[$j][$y]->id;
              }
              ?>

              <div class="box_rent_real">

                  <div class="row_01 row_rent_real">

                      <span class="rent_check_vid">
                          <input type="checkbox" id="cb<?php echo $y; ?>" name="bid[]"
                           value="<?php echo $assoc_rent_ids; ?>" onClick="Joomla.isChecked(this.checked);" />

                      </span>

                      <span class="col_01">id</span>
                      <span class="col_02"><?php echo $num; ?></span>
                  </div>

                  <div class="row_02 row_rent_real">
                      <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_PROPERTYID'); ?></span>
                      <span class="col_02"><?php echo $house1->houseid; ?></span>
                  </div>

                  <div class="row_03 row_rent_real">
                    <?php echo $house1->name . " ( " . $assoc_title ." ) " ?>
                  </div>

                  <div class="from_until_return">
                      <div class="row_04 row_rent_real">
                          <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_USER'); ?></span>
                          <span class="col_02"><?php echo $all_assosiate_rent[0][$y]->user_name; ?></span>
                      </div>
                      <br />
                      <div class="row_04 row_rent_real">
                          <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_FROM'); ?></span>
                          <span class="col_02"><?php echo data_transform_rem($all_assosiate_rent[0][$y]->rent_from); ?></span>
                      </div>
                      <br />
                      <div class="row_05 row_rent_real">
                          <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_UNTIL'); ?></span>
                          <span class="col_02"><?php echo data_transform_rem($all_assosiate_rent[0][$y]->rent_until); ?></span>
                      </div>
                      <br />
                      <div class="row_06 row_rent_real">
                          <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_RETURN'); ?></span>
                          <span class="col_02"><?php echo data_transform_rem($all_assosiate_rent[0][$y]->rent_return); ?></span>
                      </div>
                  </div>

              </div>

          <?php

           $num++;
          }

          ?>
          <div class="box_rent_real">
              <div class="row_01 row_rent_real">---------------------------------------
              </div>
          </div>

          <?php
                   //show rent history what we can't change
                  for ($j = 0, $n = count($rows); $j < $n; $j++) {
                    $row = $rows[$j];
                    if($row->rent_return == "" ) continue ;

                    $num = 1;
                    ?>


          <div class="box_rent_real">
              <div class="row_01 row_rent_real">
                      <span class="col_01">id</span>
                      <span class="col_02"><?php echo $num; ?></span>
              </div>
              <div class="row_01 row_rent_real">
                      <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_PROPERTYID'); ?></span>
                      <span class="col_02"><?php echo $row->houseid; ?></span>
              </div>
              <div class="row_02 row_rent_real"><?php echo $row->name ; ?> </div>
              <div class="from_until_return">
                  <div class="row_04 row_rent_real">
                      <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_USER'); ?></span>
                      <span class="col_02"><?php echo $row->user_name; ?></span>
                  </div>
                  <br />
                  <div class="row_04 row_rent_real">
                      <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_FROM'); ?></span>
                      <span class="col_02"><?php echo data_transform_rem($row->rent_from); ?></span>
                  </div>
                  <br />
                  <div class="row_05 row_rent_real">
                      <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_UNTIL'); ?></span>
                      <span class="col_02"><?php echo data_transform_rem($row->rent_until); ?></span>
                  </div>
                  <br />
                  <div class="row_06 row_rent_real">
                      <span class="col_01"><?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_RETURN'); ?></span>
                      <span class="col_02"><?php echo data_transform_rem($row->rent_return); ?></span>
                  </div>
              </div>
          </div>

            <?php } ?>



            </div> <!-- table_63 -->


            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" id="adminFormTaskInput" name="task" value="" />
            <input type="hidden" name="save" value="1" />
            <input type="hidden" name="boxchecked" value="1" />
            <?php
            if ($option != "com_realestatemanager") {
            ?>
                <input type="hidden" name="is_show_data" value="1" />
            <?php
            }
            ?>
            <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />

            <?php if ($type == "rent" ) { ?>
                    <input type="button" name="rent_save" value="<?php
                       echo JText::_( '_REALESTATE_MANAGER_LABEL_BUTTON_RENT'); ?>" onclick="rem_buttonClickRent(this)"/>
                  <?php } ?>
            <?php if ($type == "edit_rent") { ?>
                    <input type="button" name="edit_rent" value="<?php
                       echo JText::_( '_REALESTATE_MANAGER_TOOLBAR_ADMIN_EDIT_RENT'); ?>" onclick="rem_buttonClickRent(this)"/>
                    <input type="hidden" name="save" value="1" />
                  <?php } ?>
            <?php if ($type == "rent_return") { ?>
                    <input type="button" name="rentout_save" value="<?php
                     echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_RETURN'); ?>" onclick="rem_buttonClickRent(this)"/>
            <?php } ?>
        </form>
        <?php
    } 


    static function showRentHistory($option, $rows, $pageNav) {
        global $my, $Itemid,  $mainframe;
        $session = JFactory::getSession();
        $arr = $session->get("array", "default");
        self::$doc->addStyleSheet('components/com_realestatemanager/includes/realestatemanager.css');
        ?>
        <form action="index.php" method="get" name="adminForm" id="adminForm">
            <table id="my_houses_history" class="table_64 basictable">
                <tr>
                    <th align = "center" width="5%">#</th>
                    <th align = "center" class="title" width="5%" nowrap="nowrap"><?php
                     echo JText::_( '_REALESTATE_MANAGER_LABEL_PROPERTYID'); ?></th>
                    <th align = "center" class="title" width="25%" nowrap="nowrap"><?php
                     echo JText::_( '_REALESTATE_MANAGER_LABEL_TITLE'); ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap"><?php
                     echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_FROM'); ?></th>
                    <th align = "center" class="title" width="20%" nowrap="nowrap"><?php
                     echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_UNTIL'); ?></th>
                    <th align = "center" class="title" width="20%" nowrap="nowrap"><?php
                     echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_RETURN'); ?></th>
                </tr>
                <?php
                $numb = 0;
                for ($i = 0, $n = count($rows); $i < $n; $i++) {
                    $row = $rows[$i];
                    $house = $row->id;
                    $title = $row->name;
                    $numb++;
                    print_r("<td align=\"center\">" . $numb . "</td>
                         <td align=\"center\">" . $row->houseid . "</td>
                         <td align=\"center\">" . $row->name . "</td>
                         <td align=\"center\">" . data_transform_rem($row->rent_from) . "</td>
                         <td align=\"center\">" . data_transform_rem($row->rent_until) . "</td>
                         <td align=\"center\">" . data_transform_rem($row->rent_return) . "</td></tr>");
                }
                ?>

            </table>

            <div id="pagenavig">
            <?php
            $paginations = $arr;
            if ($paginations && ($pageNav->total > $pageNav->limit))
                echo $pageNav->getPagesLinks();
            ?>
            </div>

        </form>
        <?php
    }

    static function showRequestRentHouses($option, $rent_requests, &$pageNav) {
        global $my,  $mainframe, $Itemid;
		
        $session = JFactory::getSession();
        $arr = $session->get("array", "default");
        self::$doc->addScript('components/com_realestatemanager/includes/functions.js');
        self::$doc->addStyleSheet('components/com_realestatemanager/includes/realestatemanager.css');
        ?>
        <form action="index.php" method="get" name="adminForm" id="adminForm">
            <table id="my_houses_rent" cellpadding="4" cellspacing="0"
             border="0" width="100%" class="basictable table_65">
                <tr>
                    <th align = "center" width="20">
                        <input type="checkbox" name="toggle" value="" onClick="rem_checkAll(this);" />
                    </th>
                    <th align = "center" width="30">#</th>
                    <th align = "center" class="title" width="10%" nowrap="nowrap">
        <?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_FROM'); ?></th>
                    <th align = "center" class="title" width="10%" nowrap="nowrap">
        <?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_UNTIL'); ?></th>
                    <th align = "center" class="title" width="5%" nowrap="nowrap">
        <?php echo JText::_( '_REALESTATE_MANAGER_LABEL_PROPERTYID'); ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap">
        <?php echo JText::_( '_REALESTATE_MANAGER_LABEL_TITLE'); ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap">
        <?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_USER'); ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap">
                <?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_EMAIL'); ?></th>
                    <th align = "center" class="title" width="20%" nowrap="nowrap">
                <?php echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_ADRES'); ?></th>
                </tr>
        <?php
        for ($i = 0, $n = count($rent_requests); $i < $n; $i++) {
            $row = $rent_requests[$i];
            $assoc_title = ''; 
            $assoc_title = (isset($row->title_assoc))? " ( " . $row->title_assoc ." ) "  : '';
             if($assoc_title){
                for ($t = 0, $z = count($assoc_title); $t < $z; $t++) {
                   if($assoc_title[$t]->name != $row->name) 
                   $assoc_title .= " ".$assoc_title[$t]->name; 
                }
              }
            ?>
            <tr class="row<?php echo $i % 2; ?>">
                <td width="20" align="center">
                    <?php
                    echo mosHTML::idBox($i, $row->id, 0, 'bid');
                    ?>
                </td>
                <td align = "center"><?php echo $row->id; ?></td>
                <td align = "center">
                    <?php echo $row->rent_from; ?>
                </td>
                <td align = "center">
                  <?php echo $row->rent_until; ?>
                </td>
                <td align = "center">
            <?php
            $data = JFactory::getDBO();
            $query = "SELECT houseid FROM #__rem_houses where id = " . $row->fk_houseid . " ";
            $data->setQuery($query);
            $houseid = $data->loadObjectList();
            echo $houseid[0]->houseid;
            ?>
                        </td>
                        <td align = "center">
            <?php echo $row->name . $assoc_title; ?>
                        </td>
                        <td align = "center">
                    <?php echo $row->user_name; ?>
                        </td>
                        <td align = "center">
                            <a href=mailto:"<?php echo $row->user_email; ?>">
                    <?php echo $row->user_email; ?>
                            </a>
                        </td>
                        <td align = "center">
                <?php echo $row->user_mailing; ?>
                        </td>
                    </tr>
                <?php
            }
            ?>
            </table>

                    <div id="pagenavig">
            <?php
            $paginations = $arr;
            if ($paginations && ($pageNav->total > $pageNav->limit)) {
                echo $pageNav->getPagesLinks();
            }
            ?>
                    </div>

            <input type="hidden" name="option" value="<?php echo $option; ?>" />
        <?php
        if ($option != "com_realestatemanager") {
            ?>
                <input type="hidden" name="is_show_data" value="1" />
            <?php
        }
        ?>
            <input type="hidden" id="adminFormTaskInput" name="task" value="" />
            <input type="hidden" name="boxchecked" value="0" />
            <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
            <input type="button" name="acceptButton" value="<?php echo JText::_( '_REALESTATE_MANAGER_TOOLBAR_ADMIN_ACCEPT'); ?>"
             onclick="rem_buttonClickRentRequest(this)"/>
            <input type="button" name="declineButton" value="<?php echo JText::_( '_REALESTATE_MANAGER_TOOLBAR_ADMIN_DECLINE'); ?>"
             onclick="rem_buttonClickRentRequest(this)"/>
        </form>
        <?php
    }

 static function listCategories(&$params, $cat_all, $catid, $tabclass, $currentcat) {
                global $Itemid;
                self::$doc->addStyleSheet('components/com_realestatemanager/includes/realestatemanager.css');
                ?>
        <?php positions_rem($params->get('allcategories04')); ?>
        <div class="basictable table_58">
            <div class="row_01">
                <span class="col_01 sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
            <?php echo JText::_( '_REALESTATE_MANAGER_LABEL_CATEGORY'); ?>
                </span>
                
                <span class="col_02 sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>">
        <?php echo JText::_( '_REALESTATE_MANAGER_LABEL_HOUSES'); ?> 
                </span>
            </div>
            <br/>
            <div class="row_02">
        <?php positions_rem($params->get('allcategories05')); ?>
        <?php HTML_realestatemanager::showInsertSubCategory($catid, $cat_all, $params, $tabclass, $Itemid, 0); ?>
            </div>
        </div>

        <?php positions_rem($params->get('allcategories06')); ?>
    <?php
    }

    /* function for show subcategory */

    static function showInsertSubCategory($id, $cat_all, $params, $tabclass, $Itemid, $deep) {
        global $g_item_count;
        

        self::$doc->addStyleSheet('components/com_realestatemanager/includes/realestatemanager.css');

        $deep++;
        for ($i = 0; $i < count($cat_all); $i++) {
            if (($id == $cat_all[$i]->parent_id) && ($cat_all[$i]->display == 1)) {
                $g_item_count++;

                $link = 'index.php?option=com_realestatemanager&amp;task=showCategory&amp;catid='
                   . $cat_all[$i]->id . '&amp;Itemid=' . $Itemid;
                ?>
                <div class="table_59 <?php echo $tabclass[($g_item_count % 2)]; ?>">
                    <span class="col_01">
                <?php
                if ($deep != 1) {
                    $jj = $deep;
                    while ($jj--) {
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                    }
                    echo "&nbsp;|_";
                }
                ?>
                    </span>
                    <span class="col_01">
                <?php if (($params->get('show_cat_pic')) && ($cat_all[$i]->image != "")) { ?>
                            <img src="./images/stories/<?php echo $cat_all[$i]->image; ?>"
                               alt="picture for subcategory" height="48" width="48" />&nbsp;
                    <?php } else {
                    ?>
                            <a <?php echo "href='" . sefRelToAbs($link) . "'"; ?> class="category<?php
                             echo $params->get('pageclass_sfx'); ?>" style="text-decoration: none"><img
                              src="./components/com_realestatemanager/images/folder.png"
                               alt="picture for subcategory" height="48" width="48" /></a>&nbsp;
                <?php } ?>
                    </span>
                    <span class="col_02">
                        <a href="<?php echo sefRelToAbs($link); ?>"
                         class="category<?php echo $params->get('pageclass_sfx'); ?>">
                <?php echo $cat_all[$i]->title; ?>
                        </a>
                    </span>
                    <span class="col_03">
                <?php if ($cat_all[$i]->houses == '') echo "0";else echo $cat_all[$i]->houses; ?>
                    </span>
               
                </div>
                <?php
              if (self::$params->get('subcategory_show'))
                    HTML_realestatemanager::showInsertSubCategory($cat_all[$i]->id,
                     $cat_all, $params, $tabclass, $Itemid, $deep);
            }//end if ($id == $cat_all[$i]->parent_id)
        }//end for(...) 
    }

    /* function for ListCategories Big image */

    static function listCategoriesBigImg(&$params, $cat_all, $catid, $tabclass, $currentcat)
    {
        global $Itemid;
        ?>
        <?php positions_rem($params->get('allcategories04')); ?>
        <div class="basictable_12 basictable">
          <div class="row_02 REL-row">
            <?php positions_rem($params->get('allcategories05')); ?>
            <?php HTML_realestatemanager::showInsertSubCategoryBigImg($catid, $cat_all, $params, $tabclass, $Itemid, 0); ?>
          </div>
        </div>
        <?php positions_rem($params->get('allcategories06')); ?>

    <?php
    }
    /*
     * function for show subcategory
     */

    static function showInsertSubCategoryBigImg($id, $cat_all, $params, $tabclass, $Itemid, $deep)
    {
      global $g_item_count;
      
      $deep++;
      for ($i = 0; $i < count($cat_all); $i++) {
        if (($id == $cat_all[$i]->parent_id) && ($cat_all[$i]->display == 1))
        {
    //print_r($id . ':::::' . $cat_all[$i]->parent_id . ':::::' . $cat_all[$i]->display . '::::' . $tabclass[($g_item_count % 2)]);
          $g_item_count++;
          $link = 'index.php?option=com_realestatemanager&amp;task=alone_category&amp;catid=' .
          $cat_all[$i]->id . '&amp;Itemid=' . $Itemid;
    ?>
        <div class="row_img REL-collumn-lg-4 REL-collumn-md-4 REL-collumn-sm-6 REL-collumn-xs-12 <?php echo $tabclass[($g_item_count % 2)]; ?>">
          <div class="rem_cat_big" >
            <!-- <div class="rem_cat_img_container"> -->
    <?php
          if (($params->get('show_cat_pic')) && ($cat_all[$i]->image != "")) { ?>
              <a href="<?php echo sefRelToAbs($link);?>" class="category<?php
                  echo $params->get('pageclass_sfx'); ?>" style="text-decoration: none; " >

   <?php if (($params->get('show_cat_pic')) && ($cat_all[$i]->image != "")) { ?>
                            <img src="./images/stories/<?php echo $cat_all[$i]->image; ?>"
                               alt="picture for subcategory" height="48" width="48" />
                    <?php } 
                    ?>
              </a>
            <!--/div--><!-- end div class = rem_cat_img_container -->

            <?php } else
            {
                ?>
                <a href="<?php echo sefRelToAbs($link);?>" class="category<?php
                  echo $params->get('pageclass_sfx'); ?> cat_img" style="text-decoration: none; " >
                  <?php
                  if(!file_exists(JPATH_SITE . '/components/com_realestatemanager/photos/folder.png'))
                    copy ( JPATH_SITE."/components/com_realestatemanager/images/folder.png" ,
                        JPATH_SITE . '/components/com_realestatemanager/photos/folder.png');
                $file_name = self::rem_picture_thumbnail( 'folder.png',
                  self::$params->get('fotogallery_high'),
                  self::$params->get('fotogallery_width'));
                $file='components/com_realestatemanager/photos/'. $file_name;
                echo '<img alt="picture for subcategory" title="'.$cat_all[$i]->title.'" src="' .$file. '">';
                ?>
            </a>
            <?php } ?>
            <div class="bigm_title">
              <h4>
                <a href="<?php echo sefRelToAbs($link);?>">
                    <?php echo $cat_all[$i]->title ?>(<?php if ($cat_all[$i]->houses == '')
                    echo "0";else echo $cat_all[$i]->houses; ?>)
                </a>
              </h4>
            </div>
        <!-- /div--><!-- end div class = rem_cat_big  -->
        </div>
    </div>
    <?php
    }//end if ($id == $cat_all[$i]->parent_id)
  }//end for(...)
}

//end function showInsertSubCategory($id, $cat_all)
    


    static function showRequestBuyingHouses($option, $buy_requests, $pageNav, $Itemid) {

        global $my,  $mainframe;
        $session = JFactory::getSession();
        $arr = $session->get("array", "default");
        self::$doc->addScript('components/com_realestatemanager/includes/functions.js');
        self::$doc->addStyleSheet('components/com_realestatemanager/includes/realestatemanager.css');
        ?>
        <form action="index.php" method="get" name="adminForm" id="adminForm">

            <table id="my_houses_buy" cellpadding="4" cellspacing="0" border="0"
             width="100%" class="basictable table_66">
                <tr>
                    <th align = "center" width="5%"><input type="checkbox" name="toggle"
                     value="" onClick="rem_checkAll(this);" /></th>
                    <th align = "center" width="5%">#</th>
                    <th align = "center" class="title" width="10%" nowrap="nowrap"><?php
                     echo JText::_( '_REALESTATE_MANAGER_LABEL_PROPERTYID'); ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap"><?php
                     echo JText::_( '_REALESTATE_MANAGER_LABEL_ADDRESS'); ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap"><?php
                     echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_USER'); ?></th>
                    <th align = "center" class="title" width="20%" nowrap="nowrap"><?php
                     echo JText::_( '_REALESTATE_MANAGER_LABEL_COMMENT'); ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap"><?php
                     echo JText::_( '_REALESTATE_MANAGER_LABEL_RENT_EMAIL'); ?></th>
                    <th align = "center" class="title" width="15%" nowrap="nowrap"><?php
                     echo JText::_( '_REALESTATE_MANAGER_LABEL_BUYING_ADRES'); ?></th>
                </tr>
        <?php
        for ($i = 0, $n = count($buy_requests); $i < $n; $i++) {
            $row = $buy_requests[$i];
            ?>
                <tr class="row<?php echo $i % 2; ?>">
                    <td width="20">
                        <div align = "center">
                          <?php echo mosHTML::idBox($i, $row->id, 0, 'bid'); ?>
                        </div>
                    </td>
                    <td align = "center"><?php echo $row->id; ?></td>
                    <td align = "center"><?php echo $row->fk_houseid; ?></td>
                    <td align = "center"><?php echo $row->hlocation; ?></td>
                    <td align = "center"><?php echo $row->customer_name; ?></td>
                    <td align = "center" width="20%"><?php echo $row->customer_comment; ?></td>
                    <td align = "center">
                        <a href=mailto:"<?php echo $row->customer_email; ?>">
                          <?php echo $row->customer_email; ?>
                        </a>
                    </td>
                    <td align = "center"><?php echo $row->customer_phone; ?></td>
                </tr>
        <?php } ?>
            </table>

            <div id="pagenavig">
        <?php
        $paginations = $arr;
        if ($paginations && ($pageNav->total > $pageNav->limit)) {
            echo $pageNav->getPagesLinks();
        }
        ?>
            </div>

            <input type="hidden" name="option" value="<?php echo $option; ?>" />
        <?php
        if ($option != "com_realestatemanager") {
            ?>
                <input type="hidden" name="is_show_data" value="1" />
            <?php
        }
        ?>
            <input type="hidden" id="adminFormTaskInput" name="task" value="" />
            <input type="hidden" name="boxchecked" value="0" />
            <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
            <input type="button" name="acceptButton" value="<?php echo JText::_( '_REALESTATE_MANAGER_TOOLBAR_ADMIN_ACCEPT'); ?>"
             onclick="rem_buttonClickBuyRequest(this)"/>
            <input type="button" name="declineButton" value="<?php echo JText::_( '_REALESTATE_MANAGER_TOOLBAR_ADMIN_DECLINE'); ?>"
             onclick="rem_buttonClickBuyRequest(this)"/>
        </form>
        <?php
    }

  static function add_google_map($params, &$rows) {
    echo '<div id="map_canvas" class="re_map_canvas re_map_canvas_01"></div>';
    $layout = $params->get('house_layout', 'default');
    global   $Itemid;
	 
          $gmaps_api_key = self::$params->get('gmaps_api_key') ? "key=" . self::$params->get('gmaps_api_key') : JFactory::getApplication()->enqueueMessage("<a target='_blank' href='//developers.google.com/maps/documentation/geocoding/get-api-key'>" . JText::_( '_REALESTATE_MANAGER_GOOGLEMAP_API_KEY_LINK_MESSAGE') . "</a>", JText::_( '_REALESTATE_MANAGER_GOOGLEMAP_API_KEY_ERROR')); 
          self::$doc->addScript("//maps.googleapis.com/maps/api/js?$gmaps_api_key"); ?>


      <script type="text/javascript">
	  jQuery( initialize2 );

      function initialize2(){
          var map;
          var marker = new Array();
          var myOptions = {
              scrollwheel: false,
              zoomControlOptions: {
                  style: google.maps.ZoomControlStyle.LARGE
              },
              mapTypeId: google.maps.MapTypeId.ROADMAP
          };
          var imgCatalogPath = "components/com_realestatemanager/";
          var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
          var bounds = new google.maps.LatLngBounds ();

          var remove_id_list = [];
          <?php

          $newArr = explode(",", JText::_( '_REALESTATE_MANAGER_HOUSE_MARKER'));
          $j = 0; 
          for ($i = 0;$i < count($rows);$i++) { 
        $link = JRoute::_(RemcaHelperRoute::getHouseRoute($rows[$i]->slug, 
            $rows[$i]->catid, 
            $rows[$i]->language,
            $layout,									
            $rows[$i]->params->get('keep_house_itemid')));
        $link = RemcaHelper::sefRelToAbs($link);            
              
            if ($rows[$i]->hlatitude && $rows[$i]->hlongitude) {
              $numPick = '';
              if (isset($newArr[$rows[$i]->property_type])) {
                  $numPick = $newArr[$rows[$i]->property_type];
              }
          ?>
              var srcForPic = "<?php echo $numPick; ?>";
              var image = '';
              if(srcForPic.length){
                  var image = new google.maps.MarkerImage(imgCatalogPath + srcForPic,
                      new google.maps.Size(32, 32),
                      new google.maps.Point(0,0),
                      new google.maps.Point(16, 32));
              }
                  

         
              marker.push(new google.maps.Marker({
                  icon: image,
                  position: new google.maps.LatLng(<?php echo $rows[$i]->hlatitude; ?>,
                   <?php echo $rows[$i]->hlongitude; ?>),
                  map: map,
                  title: "<?php echo self::$db->Quote($rows[$i]->name); ?>"
              }));

              bounds.extend(new google.maps.LatLng(<?php echo $rows[$i]->hlatitude; ?>,
                <?php echo $rows[$i]->hlongitude; ?>));

    


              var infowindow  = new google.maps.InfoWindow({});
              google.maps.event.addListener(marker[<?php echo $j; ?>], 'mouseover', 
              function() {
                <?php
                if (strlen($rows[$i]->name) > 45)
                    $name = mb_substr($rows[$i]->name, 0, 25) . '...';
                else {
                    $name = $rows[$i]->name;
                }
                ?>
                var title =  "<?php echo $name ?>";
                <?php 
                  //for local images
                  $imageURL = ($rows[$i]->image_link);

                  if ($imageURL == '') $imageURL = _REALESTATE_MANAGER_NO_PICTURE_BIG;

                  $watermark_path = (self::$params->get('watermark_show') == 1) ? 'watermark/' : '';
                  $watermark = (self::$params->get('watermark_show') == 1) ? true : false;  
                      $file_name = self::rem_picture_thumbnail($imageURL,
                        self::$params->get('fotogal_width'),
                        self::$params->get('fotogal_high'), $watermark);
                      
                      $file = 'components/com_realestatemanager/photos/' . $file_name;
                ?>
                var imgUrl =  "<?php echo $file; ?>";
                      
                <?php if(!self::REMincorrect_price($rows[$i]->price)):?>
                  var price =  "<?php echo $rows[$i]->price; ?>";
                  var priceunit =  "<?php echo $rows[$i]->priceunit; ?>";
                <?php else:?>
                  var price =  "<?php echo $rows[$i]->price; ?>";
                  var priceunit="";
                <?php endif;?>


             var contentStr = '<div>'+
                '<a onclick=window.open("<?= $link ?>") >'+
               '<img width = "100%" src = "'+imgUrl+'">'+
               '</a>' +
                  '</div>'+
                  '<div id="marker_link">'+
                      '<a onclick=window.open("<?= $link ?>") >' + title + '</a>'+
                  '</div>'+
                  '<div id="marker_price">'+
                      '<a onclick=window.open("<?= $link ?>") >' + price +' ' + priceunit + '</a>'+
              '</div>';

                   infowindow.setContent(contentStr);
                   infowindow.setOptions( { maxWidth: <?php echo self::$params->get('fotogal_width') ; ?> });
                   infowindow.open(map,marker[<?php echo $j; ?>]);
              });


              var myLatlng = new google.maps.LatLng(<?php echo $rows[$i]->hlatitude;
               ?>,<?php echo $rows[$i]->hlongitude; ?>);
              var myZoom = <?php echo $rows[$i]->map_zoom; ?>;
          

              <?php
              $j++;
            }
          }
  ?>
          if (<?php echo $j; ?>>1) map.fitBounds(bounds);
          else if (<?php echo $j; ?>==1) {map.setCenter(myLatlng);map.setZoom(myZoom)}
          else {map.setCenter(new google.maps.LatLng(0,0));map.setZoom(0);}

        }
      </script>
  <?php    
  }

//    if (!function_exists('mosLoadModule')) {

      function REMmosLoadModule($name, $style = - 1) {
          ?><jdoc:include type="module" name="<?php echo $name ?>" style="<?php echo $style ?>" /><?php
      }

//    }
      
    /**
    * Legacy function, using <jdoc:include type="modules" /> instead
    *
    * @deprecated  As of version 1.5
    */
    //if (!function_exists('clearDate')) {
    //
    //    function clearDate($date) {
    //        $date = preg_replace('/%/', '', $date);
    //        return $date;
    //    }
    //
    //}
//    if (!function_exists('self::REMincorrect_price')) {
      private static function REMincorrect_price($price){
        if(preg_match('/\D/i',$price) == 1){
          return true;
        }else{
          return false;
        }
      }
//    }

//    if (!function_exists('CAT_Utils_categoryArray')) {
       function REMCAT_Utils_categoryArray() {
            
            // get a list of the menu items
            $query = "SELECT c.*, c.parent_id AS parent"
                    . "\n FROM #__rem_main_categories c"
                    . "\n WHERE section='com_realestatemanager'"
                    . "\n AND state <> -2"
                    . "\n ORDER BY ordering";
            self::$db->setQuery($query);
            $items = self::$db->loadObjectList();
            // establish the hierarchy of the menu
            $children = array();
            // first pass - collect children
            foreach ($items as $v) {
                $pt = $v->parent;
                $list = @$children[$pt] ? $children[$pt] : array();
                array_push($list, $v);
                $children[$pt] = $list;
            }
            // second pass - get an indent list of the items
            $array = mosTreeRecurseREM(0, '', array(), $children);
            return $array;
        }
//    }

//    if (!function_exists('mosMail')) {
      function REMmosMail($from, $fromname, $recipient, $subject, $body, $mode = 0, $cc = NULL, 
        $bcc = NULL, $attachment = NULL, $replyto = NULL, $replytoname = NULL) {
         return;
      }
//    }

//    if (!function_exists('mosLoadAdminModules')) {

      function REMmosLoadAdminModules($position = 'left', $style = 0) {
          // Select the module chrome function
          if (is_numeric($style)) {
              switch ($style) {
                  case 2:
                      $style = 'xhtml';
                      break;
                  case 0:
                  default:
                      $style = 'raw';
                      break;
              }
          }
          ?><jdoc:include type="modules" name="<?php echo $position ?>" style="<?php echo $style ?>" /><?php
      }

//    }
    /**
    * Legacy function, using <jdoc:include type="module" /> instead
    *
    * @deprecated  As of version 1.5
    */
//    if (!function_exists('mosLoadAdminModule')) {

      function REMmosLoadAdminModule($name, $style = 0) {
          ?><jdoc:include type="module" name="<?php echo $name ?>" style="<?php echo $style ?>" /><?php
      }

//    }
    /**
    * Legacy function, always use {@link JRequest::getVar()} instead
    *
    * @deprecated  As of version 1.5
    */
//    if (!function_exists('mosStripslashes')) {

      function REMmosStripslashes(&$value) {
          $ret = '';
          if (is_string($value)) {
              $ret = stripslashes($value);
          } else {
              if (is_array($value)) {
                  $ret = array();
                  foreach ($value as $key => $val)
                      $ret[$key] = mosStripslashes($val);
              } else
                  $ret = $value;
          }
          return $ret;
      }

//    }


//    if (!function_exists('imagecopymerge_alpha')) {
        function REMimagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
            // creating a cut resource
            $cut = imagecreatetruecolor($src_w, $src_h);

            // copying relevant section from background to the cut resource
            imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);

            // copying relevant section from watermark to the cut resource
            imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);

            imagealphablending($dst_im, false);
            imagesavealpha($dst_im,true);
            // insert cut resource to destination image
            imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
            return $dst_im;
        }
//    }


//    if (!function_exists('getImageCreateFunction')) {
      function REMgetImageCreateFunction($type){
            switch ($type) {
                case 'jpeg':
                case 'jpg':
                    $imageCreateFunc = 'imagecreatefromjpeg';
                    break;

                case 'png':
                    $imageCreateFunc = 'imagecreatefrompng';
                    break;

                case 'bmp':
                    $imageCreateFunc = 'imagecreatefrombmp';
                    break;

                case 'gif':
                    $imageCreateFunc = 'imagecreatefromgif';
                    break;

                case 'vnd.wap.wbmp':
                    $imageCreateFunc = 'imagecreatefromwbmp';
                    break;

                case 'xbm':
                    $imageCreateFunc = 'imagecreatefromxbm';
                    break;

                default:
                    $imageCreateFunc = 'imagecreatefromjpeg';
                    break;
            }
            return $imageCreateFunc;
        }
//    }

//    if (!function_exists('getImageSaveFunction')) {
        function REMgetImageSaveFunction($type) {
            switch ($type) {
                case 'jpeg':
                    $imageSaveFunc = 'imagejpeg';
                    break;

                case 'png':
                    $imageSaveFunc = 'imagepng';
                    break;

                case 'bmp':
                    $imageSaveFunc = 'imagebmp';
                    break;

                case 'gif':
                    $imageSaveFunc = 'imagegif';
                    break;

                case 'vnd.wap.wbmp':
                    $imageSaveFunc = 'imagewbmp';
                    break;

                case 'xbm':
                    $imageSaveFunc = 'imagexbm';
                    break;

                default:
                    $imageSaveFunc = 'imagejpeg';
                    break;
            }
            return $imageSaveFunc;
        }
//    }

    // add watermark
//    if (!function_exists('rem_createWaterMark')) {

      function REMrem_createWaterMark($file_name, $params){
        return;
      }

//    }



//    if (!function_exists("formatMoney")) {

      function REMformatMoney($number, $fractional = false, $pattern = ".") {
          if(preg_match("/\d/", $pattern)){

              $msg = "Your separator: $pattern - incorrect, you can not use numbers, to split price" ;
              echo '<script>alert("'.$msg.'");</script>';
              $pattern = ".";      
          }
          if ($fractional) {
              $number = sprintf('%.2f', $number);
          }
          if ($pattern == ".")
              $number = str_replace(".", ",", $number);
          while (true) {
              $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1' . $pattern . '$2', $number);
              //echo $replaced."<br>";
              if ($replaced != $number) {
                  $number = $replaced;
              } else {
                  break;
              }
          }
          // $number = preg_replace('/\^/', $number, $pattern);
          return $number;
      }

//    }
    /**
    * Legacy function, use {@link JFolder::files()} or {@link JFolder::folders()} instead
    *
    * @deprecated  As of version 1.5
    */
//    if (!function_exists('mosReadDirectory')) {

      function REMmosReadDirectory($path, $filter = '.', $recurse = false, $fullpath = false) {
          $arr = array(null);
          // Get the files and folders
          jimport('joomla.filesystem.folder');
          $files = JFolder::files($path, $filter, $recurse, $fullpath);
          $folders = JFolder::folders($path, $filter, $recurse, $fullpath);
          // Merge files and folders into one array
          $arr = array();
          if (is_array($files))
              $arr = $files;
          if (is_array($folders))
              $arr = array_merge($arr, $folders);
          // Sort them all
          asort($arr);
          return $arr;
      }


//    }
    /**
    * Legacy function, use {@link JApplication::redirect() JApplication->redirect()} instead
    *
    * @deprecated  As of version 1.5
    */
//    if (!function_exists('date_to_data_ms')){
      function REMdate_to_data_ms($data_string){             // 2014-01-25 covetr to date in ms

          
    //        $date = data_transform_rem($data_string);

    /*        $query = "SELECT UNIX_TIMESTAMP('$data_string')"; 
          self::$db->setQuery($query);
          $rent_ms = self::$db->loadResult(); 

          return $rent_ms;*/
          if($data_string){
             $rent_mas = explode('-', $data_string);
             $month=$rent_mas[1];
             $day=$rent_mas[2];
             $year=$rent_mas[0];
             $rent_ms = mktime ( 0 ,0, 0, $month , $day , $year);
             return $rent_ms;
         }else{
              exit;
          }
      }
//    }
//    if (!function_exists('mosRedirect')) {

      function REMmosRedirect($url, $msg = '') {
          $mainframe = JFactory::getApplication(); // for J 1.6
          $mainframe->redirect($url, $msg);
      }

//    }
    /**
    * Legacy function, use {@link JArrayHelper::getValue()} instead
    *
    * @deprecated  As of version 1.5
    */
//    if (!function_exists('mosGetParam')) {

      function REMmosGetParam(&$arr, $name, $def = null, $mask = 0) {
          // Static input filters for specific settings
          static $noHtmlFilter = null;
          static $safeHtmlFilter = null;
          $var = JArrayHelper::getValue($arr, $name, $def, '');
          // If the no trim flag is not set, trim the variable
          if (!($mask & 1) && is_string($var))
              $var = trim($var);
          // Now we handle input filtering
          if ($mask & 2) {
              // If the allow html flag is set, apply a safe html filter to the variable
              if (is_null($safeHtmlFilter))
                  $safeHtmlFilter = JFilterInput::getInstance(null, null, 1, 1);
              $var = $safeHtmlFilter->clean($var, 'none');
          } elseif ($mask & 4) {
              // If the allow raw flag is set, do not modify the variable
              $var = $var;
          } else {
              // Since no allow flags were set, we will apply the most strict filter to the variable
              if (is_null($noHtmlFilter)) {
                  $noHtmlFilter = JFilterInput::getInstance(/* $tags, $attr, $tag_method, $attr_method, $xss_auto */
                  );
              }
              $var = $noHtmlFilter->clean($var, 'none');
          }
          return $var;
      }

//    }
    /**
    * Legacy function, use {@link JEditor::save()} or {@link JEditor::getContent()} instead
    *
    * @deprecated  As of version 1.5
    */
//    if (!function_exists('getEditorContents')) {

      function REMgetEditorContents($editorArea, $hiddenField) {
          jimport('joomla.html.editor');
          $editor = JFactory::getEditor();
          echo $editor->save($hiddenField);
      }

//    }
    /**
    * Legacy function, use {@link JFilterOutput::objectHTMLSafe()} instead
    *
    * @deprecated  As of version 1.5
    */
//    if (!function_exists('mosMakeHtmlSafe')) {

      function REMmosMakeHtmlSafe(&$mixed, $quote_style = ENT_QUOTES, $exclude_keys = '') {
          JFilterOutput::objectHTMLSafe($mixed, $quote_style, $exclude_keys);
      }

//    }
    /**
    * Legacy utility function to provide ToolTips
    *
    * @deprecated As of version 1.5
    */
//    if (!function_exists('mosToolTip')) {

      function REMmosToolTip($tooltip, $title = '', $width = '', $image = 'tooltip.png', $text = '', $href = '', $link = 1) {
          // Initialize the toolips if required
          static $init;
          if (!$init) {
              JHTML::_('behavior.tooltip');
              $init = true;
          }
          return JHTML::_('tooltip', $tooltip, $title, $image, $text, $href, $link);
      }

//    }







    /**
    * Legacy function to replaces &amp; with & for xhtml compliance
    *
    * @deprecated  As of version 1.5
    */
//    if (!function_exists('mosTreeRecurseREM')) {

      function REMmosTreeRecurseREM($id, $indent, $list, &$children, $maxlevel = 9999, $level = 0, $type = 1) {
          if (@$children[$id] && $level <= $maxlevel) {
              $parent_id = $id;
              foreach ($children[$id] as $v) {
                  $id = $v->id;
                  if ($type) {
                      $pre = 'L ';
                      $spacer = '.      ';
                  } else {
                      $pre = '- ';
                      $spacer = '  ';
                  }
                  if ($v->parent == 0)
                      $txt = $v->name;
                  else
                      $txt = $pre . $v->name;
                  $pt = $v->parent;
                  $list[$id] = $v;
                  $list[$id]->treename = "$indent$txt";
                  $list[$id]->children = count(@$children[$id]);
                  $list[$id]->all_fields_in_list = count(@$children[$parent_id]);
                  $list = mosTreeRecurseREM($id, $indent . $spacer, $list, $children, $maxlevel, $level + 1, $type);
              }
          }
          return $list;
      }

//    }
//    if (!function_exists('getGroupsByUser')) {

      function REMgetGroupsByUser($uid, $recurse) {
          if (version_compare(JVERSION, "1.6.0", "lt")) {

          } else if (version_compare(JVERSION, "1.6.0", "ge")) {
              $database = JFactory::getDBO();
              // Custom algorythm
              $usergroups = array();
              if ($recurse == 'RECURSE') {
                  // [1]: Recurse getting the usergroups
                  $id_group = array();
                  $q1 = "SELECT group_id FROM `#__user_usergroup_map` WHERE user_id={$uid}";
                  self::$db->setQuery($q1);
                  $rows1 = self::$db->loadObjectList();
                  foreach ($rows1 as $v)
                      $id_group[] = $v->group_id;
                  for ($k = 0; $k < count($id_group); $k++) {
                      $q = "SELECT g2.id FROM `#__usergroups` g1 "
                       . " LEFT JOIN `#__usergroups` g2 ON g1.lft > g2.lft AND g1.lft < g2.rgt "
                       . " WHERE g1.id={$id_group[$k]} ORDER BY g2.lft";
                      self::$db->setQuery($q);
                      $rows = self::$db->loadObjectList();
                      foreach ($rows as $r)
                          $usergroups[] = $r->id;
                  }
                  $usergroups = array_unique($usergroups);
              }
              // [2]: Non-Recurse getting usergroups
              $q = "SELECT * FROM #__user_usergroup_map WHERE user_id = {$uid}";
              self::$db->setQuery($q);
              $rows = self::$db->loadObjectList();
              foreach ($rows as $k => $v)
                  $usergroups[] = $rows[$k]->group_id;
              // If user is unregistered, Joomla contains it into standard group (Public by default).
              // So, groupId for anonymous users is 1 (by default).
              // But custom algorythm doesnt do this: if user is not autorised, he will NOT connected to any group.
              // And groupId will be 0.
              if (count($rows) == 0)
                  $usergroups[] = - 2;
              return $usergroups;
          } else {
              echo "Sanity test. Error version check!";
              exit;
          }
      }

//    }
//    if (!function_exists('getWhereUsergroupsCondition')) {

            /**
            me parece una implementación incongruente ACL 
            */
      function REMgetWhereUsergroupsCondition($table_alias) { 
                    return ' 1 ';
          $my = JFactory::getUser();
          if (isset($my->id) AND $my->id != 0)
              $usergroups_sh = getGroupsByUser($my->id, '');
          else
              $usergroups_sh = array();
          $usergroups_sh[] = - 2;
          $s = '';
          for ($i = 0; $i < count($usergroups_sh); $i++) {
              $g = $usergroups_sh[$i];
              $s.= " {$table_alias}.params LIKE '%,{$g}' or {$table_alias}.params = '{$g}' or " . 
                "{$table_alias}.params LIKE '{$g},%' or {$table_alias}.params LIKE '%,{$g},%' ";
              if (($i + 1) < count($usergroups_sh))
                  $s.= ' or ';
          }
          return $s;
//      }

    }
//    if (!function_exists('addSubMenuRealEstate')) {

      function REMaddSubMenuRealEstate($vName) {
        if (!defined('_HEADER_NUMBER')) loadConstRem();
          JSubMenuHelper::addEntry(JText::_(_HEADER_NUMBER),
           'index.php?option=com_realestatemanager', $vName == 'Houses');
          JSubMenuHelper::addEntry(JText::_(_CATEGORIES_NAME),
           'index.php?option=com_realestatemanager&section=categories', $vName == 'Categories');
          JSubMenuHelper::addEntry(JText::_(_REALESTATE_MANAGER_ADMIN_RENT_REQUESTS),
           'index.php?option=com_realestatemanager&task=rent_requests', $vName == 'Rent Requests');
          JSubMenuHelper::addEntry(JText::_(_REALESTATE_MANAGER_ADMIN_RENT_HISTORY),
           'index.php?option=com_realestatemanager&task=users_rent_history', $vName == 'Users Booking History');
          JSubMenuHelper::addEntry(JText::_(_REALESTATE_MANAGER_ADMIN_SALE_MANAGER_MENU),
           'index.php?option=com_realestatemanager&task=buying_requests', $vName == 'Sale Manager');
          JSubMenuHelper::addEntry(JText::_(_REALESTATE_MANAGER_LABEL_FEATURED_MANAGER_FEATURE_MANAGER),
           'index.php?option=com_realestatemanager&section=featured_manager', $vName == 'Features Manager');
          JSubMenuHelper::addEntry(JText::_(_REALESTATE_MANAGER_LABEL_LANGUAGE_MENU),
           'index.php?option=com_realestatemanager&section=language_manager', $vName == 'Language Manager');
          JSubMenuHelper::addEntry(JText::_(_REALESTATE_MANAGER_ADMIN_LABEL_SETTINGS),
           'index.php?option=com_realestatemanager&task=config', $vName == 'Settings');
          JSubMenuHelper::addEntry(JText::_(_REALESTATE_MANAGER_ADMIN_ABOUT_ABOUT),
           'index.php?option=com_realestatemanager&task=about', $vName == 'About');
        }

//    }
//    if (!function_exists('loadConstRem')) {
      function REMloadConstRem() {
        
        $is_exception = false;
        self::$db->setQuery("SELECT * FROM #__rem_languages");
        $langs = self::$db->loadObjectList();
        $component_path = JPath::clean(JPATH_SITE . '/components/com_realestatemanager/lang/');
        $component_constans = array();
        if (is_dir($component_path) && ($component_constans =
          JFolder::files($component_path, '^[^_]*\.php$', false, true))) {
            //check and add constants file in DB
            foreach ($component_constans as $i => $file) {
              $file_name = pathinfo($file);
              $file_name = $file_name['filename'];
              if ($file_name === 'constant') {
                require(JPATH_SITE . "/components/com_realestatemanager/lang/$file_name.php");
                foreach ( $constMas as $mas ) {
                  self::$db->setQuery(
                    "INSERT IGNORE INTO #__rem_const (const, sys_type) VALUES ('".
                    $mas["const"]."','".$mas["value_const"]."')");
                  self::$db->query();
                }
              }
            }                
            //check and add new text files in DB
            $flag1=true;
            print_r("<b>These constants exit in Languages files but not exist in file constants:</b><br><br>");
            foreach ($component_constans as $i => $file) {
              $file_name = pathinfo($file);
              $file_name = $file_name['filename'];
              $LangLocal = '';
              if ($file_name != 'constant') {
                require(JPATH_SITE . "/components/com_realestatemanager/lang/$file_name.php");
                try {
                  self::$db->setQuery("INSERT IGNORE INTO #__rem_languages (lang_code,title) VALUES ('"
                            . $LangLocal['lang_code'] . "','" . $LangLocal['title'] . "')");
                  self::$db->query();
                  self::$db->setQuery("SELECT id FROM #__rem_languages " .
                     " WHERE lang_code = '" . $LangLocal['lang_code'] . "' AND title='".$LangLocal['title']."'");
                  $idLang = self::$db->loadResult();
                  foreach ($constLang as $item) { 
                    //if(!isset($item['value_const'])) var_dump($item);
                    self::$db->setQuery("SELECT id FROM #__rem_const WHERE const = '" . $item['const'] . "'");
                    $idConst = self::$db->loadResult();
                    if(!array_key_exists ( 'value_const'  , $item ) || !$idConst){
                         print_r($item['const']." not exist in file <b>'constant'</b> for this language:  <b>"
                       . $LangLocal['title']."</b>.");
                       $flag1 = false;
                    } else {
                      self::$db->setQuery(
                       "INSERT IGNORE INTO #__rem_const_languages (fk_constid,fk_languagesid,value_const) "
                       . " VALUES ($idConst, $idLang, " . self::$db->quote($item['value_const']) . ")");
                      self::$db->query();
                    }
                  }
                } catch (Exception $e) {
                  $is_exception = true;
                  //echo 'Send exception, please write to admin for language check: ',  $e->getMessage(), "\n";
                }
              }
            }
            if($flag1){
              print_r("<br /><p style='color:green;'><b>Everything is [ OK ]</b></p><br />");
            }
            else{
              print_r("<br><b style='color:red;'>This constants not loaded.!</b><br><br>");
            }

            //if text constant missing recover they in DB
            if (!defined('_HEADER_NUMBER')) {
              $query = "SELECT c.const, cl.value_const ";
              $query .= "FROM #__rem_const_languages as cl ";
              $query .= "LEFT JOIN #__rem_languages AS l ON cl.fk_languagesid=l.id ";
              $query .= "LEFT JOIN #__rem_const AS c ON cl.fk_constid=c.id ";
              $query .= "WHERE l.lang_code = 'en-GB'";
              self::$db->setQuery($query);
              $langConst = self::$db->loadObjectList();
              foreach ($langConst as $item) {
                if(!defined($item->const)){
                  defined($item->const) or define($item->const, $item->value_const);
                }
              }
            }
        }

        //if some language file missing recover it
        $component_path = JPath::clean(JPATH_SITE . '/components/com_realestatemanager/lang/');
        $component_constans = array();
        if (is_dir($component_path) && ($component_constans = JFolder::files($component_path, '^[^_]*\.php$', false, true))) {
          foreach ($component_constans as $i => $file) {
            $isLang = 0;
            $file_name = pathinfo($file);
            $file_name = $file_name['filename'];
            if ($file_name != 'constant') {
              require(JPATH_SITE . "/components/com_realestatemanager/lang/$file_name.php");
              //$fileMas[] = $LangLocal;
              $fileMas[] = $LangLocal['title']; 
            }
          }
        }


        self::$db->setQuery("SELECT title FROM #__rem_languages");
        if (version_compare(JVERSION, '3.0', 'lt')) {
          $langs = self::$db->loadResultArray();
        } else {
          $langs = self::$db->loadColumn();
        }
        if (count($langs) > count($fileMas)) {
          $results = array_diff($langs, $fileMas);
          foreach ($results as $result) {
            self::$db->setQuery("SELECT lang_code FROM #__rem_languages WHERE title = '$result'");
            $lang_code = self::$db->loadResult();
            $langfile = "<?php if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) "
             . "die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );";
            $langfile .= "\n\n/**\n*\n* @package  RealestateManager\n"
             . "* @copyright 2012 Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru); Rob de Cleen(rob@decleen.com);\n"
             . "* Homepage: http://www.ordasoft.com\n* @version: 3.0 Pro\n*\n* */\n\n";
            $langfile .= "\$LangLocal = array('lang_code'=>'$lang_code', 'title'=>'$result');\n\n";
            $langfile .= "\$constLang = array();\n\n";

            $query = "SELECT c.const, cl.value_const ";
            $query .= "FROM #__rem_const_languages as cl ";
            $query .= "LEFT JOIN #__rem_languages AS l ON cl.fk_languagesid=l.id ";
            $query .= "LEFT JOIN #__rem_const AS c ON cl.fk_constid=c.id ";
            $query .= "WHERE l.title = '$result'";

            self::$db->setQuery($query);
            $constlanguages = self::$db->loadObjectList();

            foreach ($constlanguages as $constlanguage) {
                $langfile .= "\$constLang[] = array('const'=>'" . $constlanguage->const
                 . "', 'value_const'=>'" . self::$db->quote($constlanguage->value_const) . "');\n";
            }

            // Write out new initialization file
            $fd = fopen(JPATH_SITE . "/components/com_realestatemanager/lang/$result.php", "w")
             or die("Cannot create language file.");
            fwrite($fd, $langfile);
            fclose($fd);
          }
        }
      } 
//    }

//    if (!function_exists('language_check')) {
      function REMlanguage_check($component_db_name = 'rem' ) {
                  
        self::$db->setQuery("SELECT * FROM #__".$component_db_name."_languages");
        $langIds = self::$db->loadObjectList();

        $flag2=true;
        print_r("<br /><b>These constants exit in file constants but not exist in Languages files:</b><br />");
        foreach ($langIds as $langId){
          $query = " SELECT  lc.*  FROM    #__".$component_db_name."_const as lc ";
          $query .= " WHERE  NOT EXISTS ";
          $query .= " ( SELECT  l1.*  FROM #__".$component_db_name."_const_languages as l1 ";
          $query .= " WHERE lc.id = l1.`fk_constid` and l1.fk_languagesid = ".$langId->id.") ";
          self::$db->setQuery($query);
          $badLangConsts = self::$db->loadObjectList();
            if($badLangConsts){
              $flag2 = false;
              print_r("<br />Languages: ".$langId->title."<br />");
              print_r($badLangConsts);
              echo "<br><br>";
            }
          } 
          if($flag2)  
            print_r("<br /><p style='color:green;'><b>Everything is [ OK ]</b></p><br /><br />");  
      }
//    }

//    if (!function_exists('remove_langs')) {
      function REMremove_langs($component_db_name = 'rem' ) {
           

          $query = " TRUNCATE TABLE #__".$component_db_name."_languages; ";
          self::$db->setQuery($query);
          self::$db->query();

          $query = " TRUNCATE TABLE #__".$component_db_name."_const; ";
          self::$db->setQuery($query);
          self::$db->query();

          $query = " TRUNCATE TABLE #__".$component_db_name."_const_languages ;";
          self::$db->setQuery($query);
          self::$db->query();

      }
//    }

    // Updated on June 25, 2011
    // accessgroupid - array which contains accepted user groups for this item
    // usersgroupid - groupId of the user
    // For anonymous user Uid = 0 and Gid = 0
//    if (!function_exists('checkAccess_REM')) {
      function REMcheckAccess_REM($accessgroupid, $recurse, $usersgroupid, $acl) {
          if (!is_array($usersgroupid)) {
              $usersgroupid = explode(',', $usersgroupid);
          }
          //parse usergroups
          $tempArr = array();
          $tempArr = explode(',', $accessgroupid);
          for ($i = 0; $i < count($tempArr); $i++) {
              if (((!is_array($usersgroupid) && $tempArr[$i] == $usersgroupid) OR
                     (is_array($usersgroupid) && in_array($tempArr[$i], $usersgroupid))) || $tempArr[$i] == - 2) {
                  //allow access
                  return true;
              } else {
                  if ($recurse == 'RECURSE') {
                      if (is_array($usersgroupid)) {
                          foreach ($usersgroupid as $j)
                              if (in_array($j, $tempArr))
                                  return 1;
                      } else {
                          if (in_array($usersgroupid, $tempArr))
                              return 1;
                      }
                  }
              }
          } // end for
          //deny access
          return 0;
      }

//    }
//    if (!function_exists('editorArea')) {

      function REMeditorArea($name, $content, $hiddenField, $width, $height, $col, $row, $option = true) {
          jimport('joomla.html.editor');
          $editor = JFactory::getEditor();
          echo $editor->display($hiddenField, $content, $width, $height, $col, $row, $option);
      }

//    }
//if(!function_exists('protectInjection')){
    function REMprotectInjection($element, $def = '', $filter = "STRING", $bypass_get = false) {
        
        if (!$bypass_get) {
            $value = JFactory::getApplication()->input->get($element, $def, $filter);
            // $value = $element;
        } else {
            $value = $element;
        }

        if (empty($value))
            return $value;


        if (is_array($value)) {
            $start_array = $value;
        } else {
            $hash_string_start = md5($value);
        }

        $value = str_ireplace(array("/*", "*/", "select", "insert", "update", "drop", "delete", "alter"), "", $value);

        if (is_array($value)) {
            $end_array = $value;
        } else {
            $hash_string_end = md5($value);
        }

        if ((!is_array($value) && $hash_string_start != $hash_string_end) ||
                is_array($value) && count(array_diff($start_array, $end_array))) {
            return protectInjection($value, $def, $filter, true);
        }

        if (is_array($value)) {
            foreach ($value as $key => $item_value) {
                $value[$key] = self::$db->quote($item_value);
            }
            return $value;
        }

        return self::$db->quote($value);
    }

//    }
//    if(!function_exists('protectInjectionWithoutQuote')){
    function REMprotectInjectionWithoutQuote($element, $def = '', $filter = "STRING", $bypass_get = false) {
        
        if (!$bypass_get) {
            $value = JFactory::getApplication()->input->get($element, $def, $filter);
            // $value = $element;
        } else {
            $value = $element;
        }

        if (empty($value))
            return $value;


        if (is_array($value)) {
            $start_array = $value;
        } else {
            $hash_string_start = md5($value);
        }

        $value = str_ireplace(array("/*", "*/", "select", "insert", "update", "drop", "delete", "alter"), "", $value);

        if (is_array($value)) {
            $end_array = $value;
        } else {
            $hash_string_end = md5($value);
        }

        if ((!is_array($value) && $hash_string_start != $hash_string_end) ||
                is_array($value) && count(array_diff($start_array, $end_array))) {
            return protectInjectionWithoutQuote($value, $def, $filter, true);
        }

        if (is_array($value)) {
            foreach ($value as $key => $item_value) {
                $value[$key] = self::$db->escape($item_value);
            }
            return $value;
        }

        return self::$db->escape($value);
    }

//    }
//    if (!function_exists('getLayoutsRem')) {

          function REMgetLayoutsRem($components, $type) {
              
              $database = JFactory::getDBO();
              // get current template on frontend
              $template = '';
              $query = "SELECT template FROM #__template_styles WHERE client_id=0 AND home=1"; 
              self::$db->setQuery($query);
              $template = self::$db->loadResult();

              // Build the template and base path for the layout
              $tPath = JPATH_SITE . '/templates/' . $template . '/html/' . $components . '/' . $type . '/';
              $cPath = JPATH_SITE . '/components/' . $components . '/views/' . $type . '/tmpl/';

              $layouts1 = array();
              $layouts3 = array();

              if (is_dir($tPath) && ($layouts1 = JFolder::files($tPath, '^[^_]*\.php$', false, true))) {

                  foreach ($layouts1 as $i => $file) {
                      $select_file_name = pathinfo($file);
                      $select_file_name = $select_file_name['filename'];
                      $layouts3[] = $select_file_name;
                  }
              } 
              $layouts2 = array();
              $layouts4 = array();

              if (is_dir($cPath) && ($layouts2 = JFolder::files($cPath, '^[^_]*\.php$', false, true))) {

                  foreach ($layouts2 as $i => $file) {
                      $select_file_name = pathinfo($file);
                      $select_file_name = $select_file_name['filename'];
                      $layouts4[] =  $select_file_name;
                  }
              } 
              $layouts = array_merge($layouts3,$layouts4);
              $layouts = array_unique($layouts);
              return $layouts;  
          }
//    }

//    if(!function_exists('transforDateFromPhpToJquery')){
      function REMtransforDateFromPhpToJquery(){
        
        $DateToFormat = str_replace("d",'dd',(str_replace("m",'mm',(str_replace("Y",'yy',(
          str_replace('%','',self::$params->get('date_format'))))))));
        return $DateToFormat;
      }
//    }



//    if (!function_exists('data_transform_rem')) {

      function REMdata_transform_rem($date, $date_format = "from") {
          global  $database;     

          if (strstr($date, "00:00:00") OR strlen($date) < 11) {
              $format = self::$params->get('date_format');
              $formatForDateFormat = 'Y-m-d';
          } else {
              $format = self::$params->get('date_format'). " "
                 . self::$params->get('datetime_format');
              $formatForDateFormat = 'Y-m-d H:i:s';
          }

          $formatForCreateObjDate = str_replace("%","",$format); 

          if(function_exists('date_format')){

              $dateObject = date_create_from_format($formatForCreateObjDate, $date);

              if($dateObject){
                  $date = date_format($dateObject, $formatForDateFormat);
              }else{
                  $dateObject = date_create_from_format($formatForDateFormat, $date);
                  if($dateObject){
                      $date = date_format($dateObject, $formatForDateFormat);
                  }  
              }  
          }else{
              $query = "SELECT STR_TO_DATE('$date','$format')"; 
              self::$db->setQuery($query);
              $normaDat = self::$db->loadResult(); 

              if(strlen($normaDat) > 0){
                  $date = $normaDat;
              }           
          }
          return $date;

      }

//    } 


//    if(!function_exists('checkRentDayNightREM')){


      function REMcheckRentDayNightREM ($from, $until, $rent_from, $rent_until, $params){

          if(1 && self::$params->get('special_price_show')){

              if (( $rent_from >= $from &&
                    $rent_from <= $until) || ($rent_from <= $from && 
                    $rent_until >= $until) || ( 
                    $rent_until >= $from && $rent_until <= $until))
                  {
                      return 'Sorry, this item not is available from " '. $from .' " until " '. $until . '"';
                  }
              }else{

                  if($rent_from === $rent_until){
                      return 'Sorry, not one night, not selected'; 
                  }

                  if($rent_from < $until && $rent_until > $from){
                      return 'Sorry, this item not is available from " '. $from .' " until " '. $until . '"';                       
                  }                              
              }
      }
//    }
//    if(!function_exists('createRentTable')){
          function REMcreateRentTable($rentTerm, $massage, $typeMessage){
              
                        if($typeMessage === 'error'){
                      echo '<div id ="message-here" style ="color: red; font-size: 18px;" >'.$massage.'</div>';
                  }else{
                      echo '<div id ="message-here" style ="color: gray; font-size: 18px;" >'.$massage.'</div>';            
                  }   

              echo '<div id ="SpecialPriseBlock">';
                  echo '<table class="adminlist_04" width ="100%" align ="center">';
                      echo '<tr>';
                          echo '<th class="title" align ="center" width ="25%">'.
                            _REALESTATE_MANAGER_RENT_PRICE_PER_DAY.'</th>';
                          echo '<th class="title" align ="center" width ="25%">'.
                            _REALESTATE_MANAGER_FROM.'</th>';
                          echo '<th class="title" align ="center" width ="25%" >'
                            ._REALESTATE_MANAGER_TO.'</th>';
                          echo '<th class="title" >'._REALESTATE_MANAGER_LABEL_REVIEW_COMMENT.'</th>';
                          echo '<th class="title" align ="center" width ="25%">'.
                            _REALESTATE_MANAGER_LABEL_CALENDAR_SELECT_DELETE.'</th>';
                      echo '</tr>';

                      for ($i = 0; $i < count($rentTerm); $i++) {  
                          $DateToFormat = str_replace("D",'d',(str_replace("M",'m',(str_replace('%','',
                            self::$params->get('date_format'))))));
                          $date_from = new DateTime($rentTerm[$i]->price_from);
                          $date_to = new DateTime($rentTerm[$i]->price_to);

                          echo '<tr>';
                              echo '<td align ="center">'.$rentTerm[$i]->special_price.'</td>';
                              echo '<td align ="center">'.date_format($date_from, $DateToFormat).'</td>';
                              echo '<td align ="center">'.date_format($date_to, $DateToFormat).'</td>';
                              echo '<td>'.$rentTerm[$i]->comment_price.'</td>';
                              echo '<td align ="center"><input type="checkbox" name="del_rent_sal[]" value="'
                               .$rentTerm[$i]->id.'"</td>';

                          echo '</tr>';
                      }   
                  echo '</table>';
                  echo '<p>';


                  echo '<p>';             
              echo '</div>' ;

              exit;
          } 
//    }

//    if(!function_exists('rentPriceREM')){


      function REMrentPriceREM($bid,$rent_from,$rent_until,$special_price,
        $comment_price,$currency_spacial_price){


          
          $rent_from_transf = data_transform_rem($rent_from);
          $rent_until_transf = data_transform_rem($rent_until);

          if($bid==''){
              $rentTerm = array();
              createRentTable($rentTerm, 'Please save or apply this item first','error');
              return;
          }

          $query = "SELECT * FROM #__rem_rent_sal where fk_houseid = " . $bid;
          self::$db->setQuery($query);
          $rentTerm = self::$db->loadObjectList();    


          if($special_price==''){
              createRentTable($rentTerm, 'You need fill Price','error');
          }
          if($rent_from==''){
              createRentTable($rentTerm, 'You need fill Check In','error');
          }
          if($rent_until==''){
              createRentTable($rentTerm, 'You need fill Check Out','error');
          }
          if($rent_from_transf >$rent_until_transf){
              createRentTable($rentTerm, 'Incorrect Check Out','error');
          }


          foreach ($rentTerm as $oneTerm){
              $returnMessage = checkRentDayNightREM (($oneTerm->price_from),($oneTerm->price_to),
                 $rent_from_transf, $rent_until_transf, $this->params);

              if(strlen($returnMessage) > 0){
                  createRentTable($rentTerm, $returnMessage, 'error');
              }   
          }                                        

          $sql = "INSERT INTO #__rem_rent_sal (fk_houseid, price_from, price_to,
             special_price, priceunit, comment_price) VALUES (" . $bid . ", '" .
              $rent_from_transf . "', '" . $rent_until_transf . "', '" .
               $special_price . "','" . $currency_spacial_price . "','" . 
               $comment_price . "')";             
          self::$db->setQuery($sql);
          self::$db->query(); 

          $query = "SELECT * FROM #__rem_rent_sal where fk_houseid = " . $bid;
          self::$db->setQuery($query);
          $rentTerm = self::$db->loadObjectList();

          createRentTable($rentTerm, 'Add special price on data: from "'.
            $rent_from.'" to "'.$rent_until.'"','');
      }
//    }


//    if(!function_exists('calculatePriceREM')){
      function REMcalculatePriceREM ($hid,$rent_from,$rent_until, $params,$database){      
          $rent_from = data_transform_rem($rent_from);
          $rent_until = data_transform_rem($rent_until);

          if($rent_from >$rent_until){
              echo '0';exit;
          }
          if(self::$params->get('special_price_show')){
              $query = "SELECT * FROM #__rem_rent_sal WHERE fk_houseid = ".$hid .
                  " AND (price_from <= ('" .$rent_until. "') AND price_to >= ('" .$rent_from. "'))";   
          }else{
              $query = "SELECT * FROM #__rem_rent_sal WHERE fk_houseid = ".$hid .
                  " AND (price_from < ('" .$rent_until. "') AND price_to > ('" .$rent_from. "'))";         
          }
          self::$db->setQuery($query);
          $data_for_price = self::$db->loadObjectList(); 

          $zapros = "SELECT price, priceunit FROM #__rem_houses WHERE id=" . $hid . ";";
          self::$db->setQuery($zapros);
          $item_rem = self::$db->loadObjectList(); 

          $rent_from_ms = date_to_data_ms($rent_from); 
          $rent_to_ms = date_to_data_ms($rent_until);

          if(self::$params->get('special_price_show')){                      
              $rent_to_ms = $rent_to_ms + (60*60*24);           
          }

          $count_day = (($rent_to_ms - $rent_from_ms)/60/60/24);
          $count_day = round($count_day);
          $array_day_between_to_from[0]=$rent_from; 

          for($i = 1; $i < $count_day; $i++){
              $array_day_between_to_from[]=date('Y-m-d',$rent_from_ms + (60*60*24)*($i));
          } 

          $count_day_spashal_price = 0;                 
          $comment_rent_price = '';
          $count_spashal_price = 0;

          foreach ($data_for_price as $one_period){
              $from = $one_period->price_from;
              $to = $one_period->price_to; 

              for ($day = 0; $day < $count_day; $day++){ 
                  $currentday = ($array_day_between_to_from[$day]);

                  if(1
                   && self::$params->get('special_price_show')){
                      if (($currentday >= $from) && ($currentday <= $to)){   
                          $count_day_spashal_price++;   
                          $count_spashal_price += $one_period->special_price;
                      }                     
                  }else{
                      if (($currentday >= $from) && ($currentday < $to)){   
                          $count_day_spashal_price++;   
                          $count_spashal_price += $one_period->special_price;
                      }                      
                  } 
              }        
          }


          if(!self::REMincorrect_price($item_rem[0]->price)){
            $count_day_not_sp_price = $count_day - $count_day_spashal_price;
            $sum_price_not_sp_price =  $count_day_not_sp_price * $item_rem[0]->price;
            $sum_price = $sum_price_not_sp_price + $count_spashal_price;

            $returnArr[0]=$sum_price; 
            $returnArr[1]=$item_rem[0]->priceunit; 
            $returnArr[2]=$comment_rent_price;
          }else{
            $returnArr[0]=0;
            $returnArr[1]=''; 
            $returnArr[2]='';
          }



          return $returnArr;
      }
//    }


//    if(!function_exists('getCountHouseForSingleUserREM')){


      function REMgetCountHouseForSingleUserREM($my,$database,$params){


          $user_group = userGID_REM($my->id);         
          $user_group_mas = explode(',', $user_group);
          $max_count_house = 0;

          foreach ($user_group_mas as $value) {            
              $count_house_for_single_group =
               self::$params->get("user_manager_rem_{$value}_count_homes");

              if($count_house_for_single_group>$max_count_house){
                  $max_count_house = $count_house_for_single_group;
              }            
          }

          $count_house_for_single_group = $max_count_house;  
          self::$db->setQuery("SELECT COUNT('houseid') as `count_homes` " .
           "FROM #__rem_houses WHERE owner_id= '" . $my->id. "'AND state='1'" );
          $house_single_user = self::$db->loadObject();
          $count_house_single_user = $house_single_user->count_homes;
          $returnarray = array();
          $returnarray[0] = $count_house_single_user;
          $returnarray[1] = $count_house_for_single_group;
          return $returnarray;      
      }
//    }




//    if(!function_exists('getPublicPlugin')){

      function REMgetPublicPlugin(){
               $db = JFactory::getDBO();
           $condtion = array(0 => '\'payment\'');
           $condtionatype = join(',',$condtion);
               if(JVERSION >= '1.6.0')
               {
                   $query = "SELECT extension_id as id,name,element,enabled as state
                       FROM #__extensions
                       WHERE folder in ($condtionatype) AND enabled=1";
               }
               else
               {
                   $query = "SELECT id,name,element,state
                       FROM #__plugins
                       WHERE folder in ($condtionatype) AND state=1";
               }
           $db->setQuery($query);
           $gatewayplugin = $db->loadobjectList();

           $retr = count($gatewayplugin);
               if($retr>0){
                   $ret_string = "";
                       for($i=0;$i<$retr;$i++){                                           
                               $ret_string .= "<option value='".$gatewayplugin[$i]->name."'>"
                                 .$gatewayplugin[$i]->name."</option>";
                       }
               return $ret_string;
               } 
               else{
                   return false;
               }

    }

//    }
//    if(!function_exists('saveAssociateCayegoriesREM')){

      function REMsaveAssociateCayegoriesREM($post, $database){

          $currentId = $post['id'];
          if($currentId){
              $i = 1;
              $assocArray = array();
              $assocCategoryId = array();

              while(isset($post['associate_category'.$i])){
                  $langAssoc = $post['associate_category_lang'.$i];
                  $valAssoc = $post['associate_category'.$i];
                  $assocArray[$langAssoc] = $valAssoc;
                  if($valAssoc){
                      $assocCategoryId[] = $valAssoc;  
                  }

                  $i++;
              }
              $currentId = $post['id'];
              $currentLang = $post['language'];
              $assocArray[$currentLang] = $currentId;
              $assocStr = serialize($assocArray);

              $query = "select `associate_category` from #__rem_main_categories where `id` = ".$currentId."";
              self::$db->setQuery($query);
              $oldAssociate = self::$db->loadResult(); 
              $oldAssociateArray = unserialize($oldAssociate);

              if($oldAssociateArray){
                  foreach ($oldAssociateArray as $key => $value) {
                      if($value && !isset($assocCategoryId[$value])){
                          $assocCategoryId[] = $value;                    
                      }
                  }    
              }

              if(!isset($assocCategoryId[$currentId])){
                  $assocCategoryId[] = $currentId;                    
              }

              $idToChange = implode(',' , $assocCategoryId);

              if(count($idToChange) && !empty($idToChange)){  
                  $query = "UPDATE #__rem_main_categories SET `associate_category`='"
                    .$assocStr."' where `id` in (".$idToChange.")";
                  self::$db->setQuery($query);
                  self::$db->query();       
              }       
          }  
      }
//    }

//    if(!function_exists('getAssociateHousesLang')){

      function REMgetAssociateHousesLang($hoseIds){

             
          $query = "select associate_house from #__rem_houses where id = ".$hoseIds.
            " and associate_house is not null";     
          self::$db->setQuery($query);
          $houseAssociateHouse = self::$db->loadResult();             
          if (!empty($houseAssociateHouse)){
              $houseLangIds = unserialize($houseAssociateHouse);
              return $houseLangIds;
          }
      }   
//    }

//    if(!function_exists('getAssociateHouses')){

      function REMgetAssociateHouses($hoseIds){

          
          $one = array();

          $query = "select associate_house from #__rem_houses where id = ".$hoseIds.
            " and associate_house is not null";

          self::$db->setQuery($query);
          $houseAssociateHouse = self::$db->loadResult(); 


          if (!empty($houseAssociateHouse)){
              $hoseIds = unserialize($houseAssociateHouse);

              foreach($hoseIds as $oneHouse){
                if($oneHouse != 0){
                    $one[] = $oneHouse;         
                }
              } 

          $bids = implode(',', $one);
          return $bids;
          }
      }   
//    }

//    if(!function_exists('getAssociateDiff')){

      function REMgetAssociateDiff($assocArray1,$assocArray2){

         
         $diff_ids = array();

          $diff = array_diff($assocArray1,$assocArray2);                  
          foreach($diff as $key => $value){
              if($value != 0){
                      $diff_ids[] = $value;                    
              }
          }               

          return $diff_ids ;
      }   
//    }





//    if(!function_exists('getAssociateOld')){
      function REMgetAssociateOld(){
          
          $id_check = JRequest::getVar('id', "");
            $query = "select `associate_house` from #__rem_houses where `id` = ".$id_check."";             
            self::$db->setQuery($query);
            $oldAssociate = self::$db->loadResult();           
            $oldAssoc_func = unserialize($oldAssociate);
          return $oldAssoc_func;
      }   
//    }

//    if(!function_exists('ClearAssociateDiff')){

      function REMClearAssociateDiff(){

        
        $old_ids_assoc=array();
        $new_ids_assoc=array();
        $id_check = JRequest::getVar('id', ""); 
        $language_post = JRequest::getVar('language', "");     
         $oldAssociateArray = getAssociateOld();
         $i = 1;
         $assocArray = array();
         while(count(JRequest::getVar("associate_house".$i))){           
                   $langAssoc = JRequest::getVar("associate_house_lang".$i);                
                   $valAssoc = JRequest::getVar("language_associate_house".$i);              
                   $assocArray[$langAssoc] = $valAssoc;                       
                   $i++;
               }             
         $assocArray[$language_post] = $id_check;
         if(!empty($oldAssociateArray) && !empty($assocArray))
        $old_ids_assoc = getAssociateDiff($oldAssociateArray,$assocArray);
                if(count($old_ids_assoc)>0)
                {   
                    foreach($old_ids_assoc as $key => $value) {             
                      $diff_assoc2 = getAssociateHouses($value);    
                      if(!empty($diff_assoc2)){
                        $ids_assoc_diff2 = explode(',', $diff_assoc2);
                        foreach ($ids_assoc_diff2 as $key2 => $value2){
                          if(!in_array($value2,$old_ids_assoc)){
                            $assoc_lang = getAssociateHousesLang($value);
                            foreach ($assoc_lang as $key3 => $value3){
                              if($value3 == $value2){
                                $assoc_lang[$key3] = 0;                    
                              } 
                            }
                            $houseLangIds = serialize($assoc_lang);
                            $query = "UPDATE #__rem_houses SET `associate_house`='".$houseLangIds.
                              "' where `id` = ".$value."";
                            self::$db->setQuery($query);
                            self::$db->query();                        
                          }
                        }
                      }                   
                    }
                }  
          if(!empty($oldAssociateArray) && !empty($assocArray))
          $new_ids_assoc = getAssociateDiff($assocArray,$oldAssociateArray);
          if(count($new_ids_assoc)>0)
          {   
              foreach($new_ids_assoc as $key => $value) {            
                $diff_assoc2 = getAssociateHouses($value);  
                if(!empty($diff_assoc2)){
                $ids_assoc_diff2 = explode(',', $diff_assoc2);
                  foreach ($ids_assoc_diff2 as $key2 => $value2){
                    if($value2 == $value || $value2 == 0 ) continue;
                    $assoc_lang = getAssociateHousesLang($value2);
                    foreach ($assoc_lang as $key3 => $value3){
                      if($value3 == $value){
                        $assoc_lang[$key3] = 0;                    
                      }
                    }                       
                    $houseLangIds = serialize($assoc_lang);
                    $query = "UPDATE #__rem_houses SET `associate_house`='".$houseLangIds.
                      "' where `id` = ".$value2."";
                    self::$db->setQuery($query);
                    self::$db->query(); 
                  }
                }                   
              }
          }  
      }   
//    }

//    if(!function_exists('edit_house_associate')){

      function REMedit_house_associate($house,$call_from){
        global $my, $database;

        $associateArray = array();
        $userid = $my->id;

        $query = "SELECT lang_code FROM `#__languages` ";
        self::$db->setQuery($query);
        $allLanguages =  self::$db->loadColumn(); 
        //bch
        if($call_from=='backend')
        {
            $query = "SELECT id,language,name FROM `#__rem_houses`";
        }
        else
        {
            $query = "SELECT id,language,name FROM `#__rem_houses` WHERE owner_id = " . $userid . "";
        }



        self::$db->setQuery($query);
        $allhouse =  self::$db->loadObjectlist(); 

        $query = "select associate_house from #__rem_houses where id =".$house->id;
        self::$db->setQuery($query);
        $houseAssociateHouse =  self::$db->loadResult(); 

        if(!empty($houseAssociateHouse)){
            $houseAssociateHouse = unserialize($houseAssociateHouse);
        }else{
            $houseAssociateHouse = array();
        }

        $i=0;
        foreach ($allLanguages as $oneLang) {
          $i++;
          $associate_house = array();
          $associate_house[] = mosHtml::makeOption(0, 'select'); 

          foreach($allhouse as $oneHouse){
              if($oneLang == $oneHouse->language && $oneHouse->id != $house->id){
                  $associate_house[] = mosHtml::makeOption(($oneHouse->id), $oneHouse->name);
              } 
          } 

          if($house->language != $oneLang){

            if(isset($houseAssociateHouse[$oneLang]) && 
              $houseAssociateHouse[$oneLang] !== $house->id ){
                $associateArray[$oneLang]['assocId'] = $houseAssociateHouse[$oneLang];
            }else{
                $associateArray[$oneLang]['assocId'] = 0;
            }

            $associate_house_list = mosHTML :: selectList($associate_house, 
              'language_associate_house'.$i,
              'class="inputbox" size="1"', 'value', 'text', 
              $associateArray[$oneLang]['assocId']); 

          }else{
              $associate_house_list = null;
          }

          $associateArray[$oneLang]['list'] = $associate_house_list;

          if(isset($houseAssociateHouse[$oneLang]) && 
            $houseAssociateHouse[$oneLang] !== $house->id ){
              $associateArray[$oneLang]['assocId'] = $houseAssociateHouse[$oneLang];
          }else{
              $associateArray[$oneLang]['assocId'] = 0;
          }
        }    
        return $associateArray;
      }    
//    }
//    if(!function_exists('save_house_associate')){
      function REMsave_house_associate(){
      global  $database;
          $id_check = JRequest::getVar('id', "");
          $id_true = JRequest::getVar('idtrue', "");
          $language_post = JRequest::getVar('language', "");
          if($id_check){
            if(empty($id_true)){
          //----------get new values (what house we choose for chaque language) --------------------------//
            $i = 1;
            $assocArray = array();
            $assocHouseId = array();
            while(count(JRequest::getVar("associate_house".$i))){           
              $langAssoc = JRequest::getVar("associate_house_lang".$i, '');                
              $valAssoc = JRequest::getVar("language_associate_house".$i,'');
              if($valAssoc == '' ) {
                $i++;
                continue;
              }
              $assocArray[$langAssoc] = $valAssoc;              
              if($valAssoc){
                $assocHouseId[] = $valAssoc;  //----Array of new house_ids                   
              }            
              $i++;
            }
            if(count($assocArray) > 0 ) {
              $assocArray[$language_post] = $id_check;            
              $assocStr = serialize($assocArray);
          //-----------slect associate with old values------------------------------------------//
              $oldAssociateArray = getAssociateOld();
            //----------------------------------------------------------------//
              if(!isset($assocHouseId[$id_check])){        
                $assocHouseId[] = $id_check;                           
              }
              if($assocArray && $oldAssociateArray){
                ksort($assocArray);
                ksort($oldAssociateArray);
              }
              if($assocArray !== $oldAssociateArray){   //-----------compare old and new values--

            //---------set null for houses that are not more in associates----------------//
                ClearAssociateDiff();

            //---------set new associates for houses that are choosed----------------//
            //--ids of new houses  where we set new values for column associate_house
                $idToChange = implode(',' , $assocHouseId); 
                if(count($idToChange) && !empty($idToChange)){  
                  $query = "select * from #__rem_rent where `fk_houseid` in (".$idToChange.
                    ") and `rent_return` is NULL";
                  self::$db->setQuery($query);
                  $CheckAssociate = self::$db->loadObjectList(); 
                  if(!empty($CheckAssociate))
                  {
                    echo "<script> alert('"._REALESTATE_MANAGER_MUST_RETURN_HOUSES_FROM_RENT
                      ."'); window.history.go(-1); </script>";
                    exit;
                  }
                  $query = "UPDATE #__rem_houses SET `associate_house`='".$assocStr.
                    "' where `id` in (".$idToChange.")";
                  self::$db->setQuery($query);
                  self::$db->query();            
                }else{
                  $query = "UPDATE #__rem_houses SET `associate_house`= null where `id` = ".$id_check."";
                  self::$db->setQuery($query);
                  self::$db->query();     
                }
              }
            }
          }
        } 
      }
//    }

//    if(!function_exists('available_dates')){
      function REMavailable_dates($house_id){
        
        $date_NA = array();
        $query = "SELECT rent_from, rent_until FROM #__rem_rent WHERE fk_houseid='".$house_id.
          "' AND rent_return is null";
        self::$db->setQuery($query);
        $calenDate = self::$db->loadObjectList();
        // create a massiv of all dates when houses are in rent and then is used for 
        // make dates unavailable in calendar for rent 
        foreach($calenDate as $calenDate){     
          $not_av_from = $calenDate->rent_from;
          $not_av_until = $calenDate->rent_until;
          $not_av_from_begin = new DateTime( $not_av_from);
          $not_av_until_end = new DateTime( $not_av_until);
          if(self::$params->get('special_price_show')){
            $not_av_until_end = $not_av_until_end->modify( '+1 day' ); 
          }
          // else{
          //   $not_av_from_begin = $not_av_from_begin->modify( '+1 day' );
          // }
          $interval = new DateInterval('P1D');
          $daterange = new DatePeriod($not_av_from_begin, $interval, $not_av_until_end);
          foreach($daterange as $datess){
              $date_NA[] = $datess->format("Y-m-d");
              $date_NA[] = $datess->format("d-m-Y");
          }
        }               
      return $date_NA;
      }   
//    }
    ////////////////////////////STORE video/track functions START\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//    if (!function_exists('storeTrack')) {
      function REMstoreTrack(&$house) {
        
        for ($i = 1;isset($_FILES['new_upload_track' . $i]) 
          || array_key_exists('new_upload_track_url' . $i, $_POST);$i++) {
            $track_name = '';
            if (isset($_FILES['new_upload_track' . $i]) && $_FILES['new_upload_track' . $i]['name'] != "") {
              //storing e-Document
              $track = JRequest::getVar('new_upload_track' . $i, '', 'files');
              $ext = pathinfo($track['name'], PATHINFO_EXTENSION);
              $allowed_exts = explode(",", self::$params->get('allowed_exts_track'));
              $ext = strtolower($ext);
              if (!in_array($ext, $allowed_exts)) {
                echo "<script> alert(' File ext. not allowed to upload! - " . $ext .
                                     "'); window.history.go(-1); </script>\n";
                exit();
              }
              $code = guid();
              $track_name = $code . '_' . filter($track['name']);
              if (intval($track['error']) > 0 && intval($track['error']) < 4) {
                echo "<script> alert('" . JText::_( '_REALESTATE_MANAGER_LABEL_TRACK_UPLOAD_ERROR') . " - " .
                                     $track_name . "'); window.history.go(-1); </script>\n";
                exit();
              } else if (intval($track['error']) != 4) {
                $track_new = JPATH_SITE . self::$params->get('tracks_location') . $track_name;
                if (!move_uploaded_file($track['tmp_name'], $track_new)) {
                  echo "<script> alert('" . JText::_( '_REALESTATE_MANAGER_LABEL_TRACK_UPLOAD_ERROR') . " - " .
                                       $track_name . "'); window.history.go(-1); </script>\n";
                  exit();
                }
              }
            }
            if (array_key_exists('new_upload_track_kind' . $i, $_POST) 
              && $_POST['new_upload_track_kind' . $i] != "") {
                $uploadTrackKind = JRequest::getVar('new_upload_track_kind' . $i, '', 'post');
                $uploadTrackKind = strip_tags(trim($uploadTrackKind));
            }
            if (array_key_exists('new_upload_track_scrlang' . $i, $_POST) 
              && $_POST['new_upload_track_scrlang' . $i] != "") {
                $uploadTrackScrlang = JRequest::getVar('new_upload_track_scrlang' . $i, '', 'post');
                $uploadTrackScrlang = strip_tags(trim($uploadTrackScrlang));
            }
            if (array_key_exists('new_upload_track_label' . $i, $_POST) 
              && $_POST['new_upload_track_label' . $i] != "") {
                $uploadTrackLabel = JRequest::getVar('new_upload_track_label' . $i, '', 'post');
                $uploadTrackLabel = strip_tags(trim($uploadTrackLabel));
            }
            if (array_key_exists('new_upload_track_url' . $i, $_POST) && $_POST['new_upload_track_url' . $i] != "") {
              $uploadTrackURL = JRequest::getVar('new_upload_track_url' . $i, '', 'post');
              $uploadTrackURL = strip_tags(trim($uploadTrackURL));
              if (empty($track_name) && !empty($uploadTrackURL))
                saveTracks($house->id, $uploadTrackURL, $uploadTrackKind, $uploadTrackScrlang, $uploadTrackLabel);          
            }
            if (!empty($track_name)) 
              saveTracks($house->id, $track_name, $uploadTrackKind, $uploadTrackScrlang, $uploadTrackLabel);
        }
      }
//    }

//    if (!function_exists('checkMimeType')) {
      function REMcheckMimeType($ext) {
        
        self::$db->setQuery("SELECT mime_type FROM #__rem_mime_types WHERE mime_ext=".self::$db->quote($ext));
        $type = self::$db->loadResult();
        if(!$type)
          $type = 'unknown';
        return $type;
      }
//    }

//    if (!function_exists('filter')) {
      function REMfilter($value) {
        $value = str_replace(array("/", "|", "\\", "?", ":", ";", "*", "#", "%", "$", "+", "=", ";", " "), "_", $value);
        return $value;
      }
//    }

//    if (!function_exists('guid')) {
      function REMguid() {
        if (function_exists('com_create_guid')) {
          return com_create_guid();
        } else {
          mt_srand((double)microtime() * 10000); //optional for php 4.2.0 and up.
          $charid = strtoupper(md5(uniqid(rand(), true)));
          $hyphen = chr(45); // "-"
          $uuid = //chr(123)// "{"
          substr($charid, 0, 8) . $hyphen . substr($charid, 8, 4) . $hyphen . substr($charid, 12, 4) . $hyphen . substr($charid, 16, 4) . $hyphen . substr($charid, 20, 12);
          //.chr(125);// "}"
          return $uuid;
        }
      }
//    }
//    jimport( 'joomla.filesystem.file' );
//    if(!function_exists('rem_createImage')){
        static function rem_createImage($imgSrc, $imgDest, $width, $height, $crop = true) {
           if (JFile::exists($imgDest)) {
                $info = getimagesize($imgDest, $imageinfo);
                if (($info[0] == $width) && ($info[1] == $height)) {
                    return;
                }
            }
            if (JFile::exists($imgSrc)) {

                $info = getimagesize($imgSrc, $imageinfo);
                $sWidth = $info[0];
                $sHeight = $info[1];
                rem_resize_img($imgSrc, $imgDest, $width, $height, $crop);
            }
        }
//    }
//    if(!function_exists('rem_resize_img')){
        function REMrem_resize_img($imgSrc, $imgDest, $tmp_width, $tmp_height, $crop = true) {
           

            //some time return error
            $info = getimagesize($imgSrc, $imageinfo);
            $sWidth = $info[0];
            $sHeight = $info[1];
            $ext = str_replace('image/', '', $info['mime']);

            if($sWidth == 0 || $tmp_width == 0 ) {
              $logPath  = JPATH_SITE . "/administrator/components/com_realestatemanager/my_log.log";
              file_put_contents($logPath, "  rem_resize_img zero ".$imgSrc."::".$sWidth ."::" . $tmp_width."\n",  FILE_APPEND );

              $imgSrc = JPATH_SITE."/components/com_realestatemanager/photos/"."no-img_eng_big.gif";
              $info = getimagesize($imgSrc, $imageinfo);
              $sWidth = $info[0];
              $sHeight = $info[1];
              $ext = str_replace('image/', '', $info['mime']);
            }

            if ($sHeight / $sWidth > $tmp_height / $tmp_width) {
                $width = $sWidth;
                $height = round(($tmp_height * $sWidth) / $tmp_width);
                $sx = 0;
                $sy = round(($sHeight - $height) / 3);
            }
            else {
                $height = $sHeight;
                $width = round(($sHeight * $tmp_width) / $tmp_height);
                $sx = round(($sWidth - $width) / 2);
                $sy = 0;
            }

            if (!$crop) {
                $sx = 0;
                $sy = 0;
                $width = $sWidth;
                $height = $sHeight;
            }

            $ext = str_replace('image/', '', $info['mime']);
            $imageCreateFunc = rem_getImageCreateFunction($ext);
            $imageSaveFunc = rem_getImageSaveFunction($ext);

            $sImage = $imageCreateFunc($imgSrc);
            $dImage = imagecreatetruecolor($tmp_width, $tmp_height);

            // Make transparent
            if ($ext == 'png') {
                imagealphablending($dImage, false);
                imagesavealpha($dImage,true);
                $transparent = imagecolorallocatealpha($dImage, 255, 255, 255, 127);
                imagefilledrectangle($dImage, 0, 0, $tmp_width, $tmp_height, $transparent);
            }

            imagecopyresampled($dImage, $sImage, 0, 0, $sx, $sy, $tmp_width, $tmp_height, $width, $height);


            if ($ext == 'png') {
              //for png quality must be 0 - 9
              //0 - max quality no copress, 9 - low quality max compress
              $quality = 6;
              $imageSaveFunc($dImage, $imgDest, $quality);
            }
            else if ($ext == 'bmp') {
              $compressed = true;
              $imageSaveFunc($dImage, $imgDest, $compressed);
            }
            else if ($ext == 'gif') {
              $imageSaveFunc($dImage, $imgDest);
            }
            else if ($ext == 'vnd.wap.wbmp' || $ext == 'xbm') {
              $foreground = '';
              if(isset($foreground) && !empty($foreground)){
                $imageSaveFunc($dImage, $imgDest, $foreground);
              }
              else{
                $imageSaveFunc($dImage, $imgDest);
              }
            }
            else {
              //for jpg or jpeg
              //for png quality must be 0 - 100
              //0 - low quality max compress, 100 - max quality no copress
              $quality = 75;
              $imageSaveFunc($dImage, $imgDest, $quality);
            }
        }
//    }
//    if(!function_exists('rem_getImageCreateFunction')){
        function REMrem_getImageCreateFunction($type) {
            switch ($type) {
                case 'jpeg':
                case 'jpg':
                    $imageCreateFunc = 'imagecreatefromjpeg';
                    break;

                case 'png':
                    $imageCreateFunc = 'imagecreatefrompng';
                    break;

                case 'bmp':
                    $imageCreateFunc = 'imagecreatefrombmp';
                    break;

                case 'gif':
                    $imageCreateFunc = 'imagecreatefromgif';
                    break;

                case 'vnd.wap.wbmp':
                    $imageCreateFunc = 'imagecreatefromwbmp';
                    break;

                case 'xbm':
                    $imageCreateFunc = 'imagecreatefromxbm';
                    break;

                default:
                    $imageCreateFunc = 'imagecreatefromjpeg';
            }

            return $imageCreateFunc;
        }
//    }
//    if(!function_exists('rem_getImageSaveFunction')){
        function REMrem_getImageSaveFunction($type) {
            switch ($type) {
                case 'jpeg':
                    $imageSaveFunc = 'imagejpeg';
                    break;

                case 'png':
                    $imageSaveFunc = 'imagepng';
                    break;

                case 'bmp':
                    $imageSaveFunc = 'imagebmp';
                    break;

                case 'gif':
                    $imageSaveFunc = 'imagegif';
                    break;

                case 'vnd.wap.wbmp':
                    $imageSaveFunc = 'imagewbmp';
                    break;

                case 'xbm':
                    $imageSaveFunc = 'imagexbm';
                    break;

                default:
                    $imageSaveFunc = 'imagejpeg';
            }

            return $imageSaveFunc;
        }
//    }

    /**
     * Saves the record on an edit form submit
     * @param database A database connector object
     */
//    if (!function_exists('rem_picture_thumbnail')) {
      static function rem_picture_thumbnail($file, $high_original, $width_original, $watermark = false) {
          
          //min size in order to adding watermark

          if(!file_exists(JPATH_SITE . '/components/com_realestatemanager/photos/watermark')){
            mkdir(JPATH_SITE . '/components/com_realestatemanager/photos/watermark','755', true);
          }


          $min_image_width = self::$params->get('watermark_min_width');
          $min_image_high = self::$params->get('watermark_min_height');

          $watermark_path = ($watermark) ? 'watermark/' : '';

          $params3 = self::$params->get('thumb_param_show');
          $uploaddir = JPATH_SITE . '/components/com_realestatemanager/photos/';

          //file name and extention
          if($file === '' || !file_exists(JPATH_SITE .
               '/components/com_realestatemanager/photos/' . $file)){  
            $file = 'no-img_eng_big.gif';
          }elseif($watermark){
            if(!file_exists(JPATH_SITE . '/components/com_realestatemanager/photos/watermark/' . $file)){
              rem_createWaterMark($file, self::$params->get('watermark'));
            }
            if($high_original < $min_image_high || $width_original < $min_image_width){
              $watermark = false;
                // $file  = str_ireplace('watermark/', '', $file);
            }else{
                $file = $watermark_path.$file;
            }   
          }

          $file_inf = pathinfo($file);
          $file_type = '.' . $file_inf['extension'];
          $file_name = basename($file, $file_type);
          $file_name = $watermark_path . $file_name;
          $index = '';

          // Setting the resize parameters
          list($width, $height) = getimagesize(JPATH_SITE . '/components/com_realestatemanager/photos/' . $file);

          $size = "_" . $high_original . "_" . $width_original;

          if (file_exists(JPATH_SITE . '/components/com_realestatemanager/photos/' . $file_name . $size . $index . $file_type)) {
              return $file_name . $size . $index . $file_type;
          } else {
              if ($width < $height) {
                  if ($height > $high_original) {
                      $k = $height / $high_original;
                  } else if ($width > $width_original) {
                      $k = $width / $width_original;
                  }
                  else
                      $k = 1;
              } else {
                  if ($width > $width_original) {
                      $k = $width / $width_original;
                  } else if ($height > $high_original) {
                      $k = $height / $high_original;
                  }
                  else
                      $k = 1;
              }
              $w_ = $width / $k;
              $h_ = $height / $k;
          }

           if($params3 == 1){ 
             $index = "_2_";

             $CreateNewImage = RemcaHelper::rem_createImage($uploaddir.$file, $uploaddir.$file_name . $size . $index . $file_type, $high_original, $width_original);
             return $file_name . $size . $index . $file_type;
           }
          // Creating the Canvas
          $tn = imagecreatetruecolor($w_, $h_);
          $index = "_1_";
          switch (strtolower($file_type)) {
            case '.png':
              $source = imagecreatefrompng(JPATH_SITE . '/components/com_realestatemanager/photos/' . $file);
              $file = imagecopyresampled($tn, $source, 0, 0, 0, 0, $w_, $h_, $width, $height);
              imagepng($tn, JPATH_SITE . '/components/com_realestatemanager/photos/' . $file_name . $size . $index . $file_type);
              break;
            case '.jpg':
              $source = imagecreatefromjpeg(JPATH_SITE . '/components/com_realestatemanager/photos/' . $file);
              $file = imagecopyresampled($tn, $source, 0, 0, 0, 0, $w_, $h_, $width, $height);
              imagejpeg($tn, JPATH_SITE . '/components/com_realestatemanager/photos/' . $file_name . $size . $index . $file_type);
              break;
            case '.jpeg':
              $source = imagecreatefromjpeg(JPATH_SITE . '/components/com_realestatemanager/photos/' . $file);
              $file = imagecopyresampled($tn, $source, 0, 0, 0, 0, $w_, $h_, $width, $height);
              imagejpeg($tn, JPATH_SITE . '/components/com_realestatemanager/photos/' . $file_name . $size . $index . $file_type);
              break;
            case '.gif':
              $source = imagecreatefromgif(JPATH_SITE . '/components/com_realestatemanager/photos/' . $file);
              $file = imagecopyresampled($tn, $source, 0, 0, 0, 0, $w_, $h_, $width, $height);
              imagegif($tn, JPATH_SITE . '/components/com_realestatemanager/photos/' . $file_name . $size . $index . $file_type);
              break;
            default:
              echo 'not support';
              return;
          }

          return $file_name . $size . $index . $file_type;
      }
//    }

//    if (!function_exists('storeVideo')) {
      function REMstoreVideo(&$house) {
        
        for ($i = 1;isset($_FILES['new_upload_video' . $i]) 
          || array_key_exists('new_upload_video_url' . $i, $_POST) 
          || array_key_exists('new_upload_video_youtube_code' . $i, $_POST);$i++) {
            $video_name = '';
            if (isset($_FILES['new_upload_video' . $i]) && $_FILES['new_upload_video' . $i]['name'] != "") {
              //storing e-Document
              $video = JRequest::getVar('new_upload_video' . $i, '', 'files');
              $ext = pathinfo($video['name'], PATHINFO_EXTENSION);
              $allowed_exts = explode(",", self::$params->get('allowed_exts_video'));
              $ext = strtolower($ext);

              if (!in_array($ext, $allowed_exts)) {
                echo "<script> alert(' File ext. not allowed to upload! - " . $ext.
                                         "'); window.history.go(-1); </script>\n";
                exit();
              }

              $type = checkMimeType($ext);

              if (stripos($type, $video['type'])===false) {
                echo "<script> alert(' File ext. not allowed to upload! - " . $ext.
                                         "'); window.history.go(-1); </script>\n";
                exit();
              }
              $code = guid();
              $video_name = $code . '_' . filter($video['name']);
              if (intval($video['error']) > 0 && intval($video['error']) < 4) {
                echo "<script> alert('" . JText::_( '_REALESTATE_MANAGER_LABEL_VIDEO_UPLOAD_ERROR') . " - " .
                                       $video_name . "'); window.history.go(-1); </script>\n";
                exit();
              } else if (intval($video['error']) != 4) {
                $video_new = JPATH_SITE . self::$params->get('videos_location') . $video_name;
                if (!move_uploaded_file($video['tmp_name'], $video_new)) {
                  echo "<script> alert('" . JText::_( '_REALESTATE_MANAGER_LABEL_VIDEO_UPLOAD_ERROR') . " - " .
                                       $video_name . "'); window.history.go(-1); </script>\n";
                  exit();
                }
                saveVideos($video_name, $house->id, $type);
              }
            }
            if (array_key_exists('new_upload_video_url' . $i, $_POST) && $_POST['new_upload_video_url' . $i] != "") {
              $uploadVideoURL = JRequest::getVar('new_upload_video_url' . $i, '', 'post');
              $uploadVideoURL = strip_tags(trim($uploadVideoURL));
              $end = explode(".", $uploadVideoURL);
              $ext = end($end);
              $type = checkMimeType($ext);
              if(empty($video_name) && !empty($uploadVideoURL))
                saveVideos($uploadVideoURL, $house->id, $type);
            }
            if (array_key_exists('new_upload_video_youtube_code' . $i, $_POST) 
              && $_POST['new_upload_video_youtube_code' . $i] != "") {
                $uploadVideoYoutubeCode = JRequest::getVar('new_upload_video_youtube_code' . $i, '', 'post');
                $uploadVideoYoutubeCode = strip_tags(trim($uploadVideoYoutubeCode));
                saveYouTubeCode($uploadVideoYoutubeCode, $house->id);
            }
          }
      }
//    }

//    if (!function_exists('saveTracks')) {
        function REMsaveTracks($h_id, $src, $uploadTrackKind, $uploadTrackScrlang, $uploadTrackLabel) {
            
            if ($src != "" && !strstr($src, "http")) {
              $query = "INSERT INTO #__rem_track_source (fk_house_id,src,kind,scrlang,label)".
                        "\n VALUE ($h_id,
                                  '" . self::$params->get('tracks_location').$src . "',
                                  '" . $uploadTrackKind . "',
                                  '" . $uploadTrackScrlang . "',
                                  '" . $uploadTrackLabel . "')";
            }else{
              $query ="INSERT INTO #__rem_track_source (fk_house_id,src,kind,scrlang,label)".
                      "\n VALUE ($h_id,
                                '" . $src."',
                                '" . $uploadTrackKind . "',
                                '" . $uploadTrackScrlang . "',
                                '" . $uploadTrackLabel . "')";
            }
            self::$db->setQuery($query);
            self::$db->query();
        }
//    }

//    if (!function_exists('saveVideos')) {
      function REMsaveVideos($src, $h_id, $type) {
        
        if ($src != "" && strstr($src, "http")) {
          $query = "INSERT INTO #__rem_video_source(fk_house_id, src, type)".
                                                      "\n VALUE($h_id,'" . $src . "', '" . $type . "')";
        }else{
          $query = "INSERT INTO #__rem_video_source(fk_house_id,src,type)".
                    "\n VALUE($h_id,
                            '".self::$params->get('videos_location').$src."',
                            '".$type."')";
        }
        self::$db->setQuery($query);
        self::$db->query();
      }
//    }

//    if (!function_exists('saveYouTubeCode')) {
      function REMsaveYouTubeCode($youtube_code, $h_id) {
        
          self::$db->setQuery("SELECT id FROM #__rem_video_source 
                                WHERE youtube != '' 
                                AND fk_house_id = $h_id");
          self::$db->query();
          $youtubeId = self::$db->LoadResult();
        if ($youtube_code != '' && !empty($youtubeId)) {
          $query = "UPDATE #__rem_video_source".
                    "\n SET youtube = '" . $youtube_code . "'".
                    "\n WHERE id = $youtubeId";
        } else {
          $query = "INSERT INTO #__rem_video_source (fk_house_id,youtube)". 
                    "\n VALUE($h_id,'" . $youtube_code . "')";
        }
        self::$db->setQuery($query);
        self::$db->query();
      }
//    }


    ////////////////////////////STORE video/track functions END\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

    ///////////////////////////DELETE video/track functions START\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//    if (!function_exists('deleteTracks')) {
      function REMdeleteTracks($h_id) {
        
        self::$db->setQuery("SELECT id FROM #__rem_track_source where fk_house_id = $h_id;");
        $tdiles_id = self::$db->loadColumn();
        $deleteTr_id = array();
        foreach($tdiles_id as $key => $value) {
          if (isset($_POST['track_option_del' . $value])) {
            array_push($deleteTr_id, JRequest::getVar('track_option_del' . $value, '', 'post'));
          }
        }
        if ($deleteTr_id) {
          $del_tid = implode(',', $deleteTr_id);
          $sql = "SELECT src FROM #__rem_track_source WHERE id IN (" .$del_tid . ")";
          self::$db->setQuery($sql);
          $tracks = self::$db->loadColumn();
          if ($tracks) {
            foreach($tracks as $name) {
              if (substr($name, 0, 4) != "http") unlink(JPATH_SITE . $name);
            }
          }
          $sql = "DELETE FROM #__rem_track_source WHERE (id IN (" . $del_tid . ")) 
                  AND (fk_house_id = $h_id)";
          self::$db->setQuery($sql);
          self::$db->query();
        }
      }
//    }

//    if (!function_exists('deleteVideos')) {
      function REMdeleteVideos($h_id) {
        
        self::$db->setQuery("SELECT id FROM #__rem_video_source where fk_house_id = $h_id;");
        $vdiles_id = self::$db->loadColumn();
        $deleteVid_id = array();
        foreach($vdiles_id as $key => $value) {
          if (isset($_POST['video_option_del' . $value])) {
            array_push($deleteVid_id, JRequest::getVar('video_option_del' . $value, '', 'post'));
          }
        }
        self::$db->setQuery("SELECT id FROM #__rem_video_source where fk_house_id = $h_id AND youtube IS NOT NULL;");
        $youtubeid = self::$db->loadResult();
        if (!empty($youtubeid)) {
          if (isset($_POST['youtube_option_del' . $youtubeid])) {
            $y_t_id = mosGetParam($_REQUEST, 'youtube_option_del' . $youtubeid, '');
            $sql = "DELETE FROM #__rem_video_source 
                    WHERE id = $y_t_id 
                    AND fk_house_id=$h_id";
            self::$db->setQuery($sql);
            self::$db->query();
          }
        }
        if ($deleteVid_id) {
          $del_id = implode(',', $deleteVid_id);
          $sql = "SELECT src FROM #__rem_video_source WHERE id IN (". $del_id . ")";
          self::$db->setQuery($sql);
          $videos = self::$db->loadColumn();
          if ($videos) {
            foreach($videos as $name) {
              if (substr($name, 0, 4) != "http" && file_exists(JPATH_SITE . $name)) 
                unlink(JPATH_SITE . $name);
            }
          }
          $sql = "DELETE FROM #__rem_video_source 
                  WHERE (id IN (" . $del_id . ")) 
                  AND (fk_house_id=$h_id)";
          self::$db->setQuery($sql);
          self::$db->query();
        }
      }
//    }
    ///////////////////////////DELETE video/track fucntions END\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//    if(!function_exists('return_bytes')){
        function REMreturn_bytes($val)
        {
            if (empty($val))
            {
                return 0;
            }

            $val = trim($val);

            preg_match('#([0-9]+)[\s]*([a-z]+)#i', $val, $matches);

            $last = '';

            if (isset($matches[2]))
            {
                $last = $matches[2];
            }

            if (isset($matches[1]))
            {
                $val = (int) $matches[1];
            }

            switch (strtolower($last))
            {
                case 'g':
                case 'gb':
                    $val *= 1024;
                case 'm':
                case 'mb':
                    $val *= 1024;
                case 'k':
                case 'kb':
                    $val *= 1024;
            }

            return (int) $val;
        }

//    }

//    if(!function_exists('getAvilableRM')){
      function REMgetAvilableRM ($calenDate,$month,$year, $params,$day){
        global $flag3;
        if(strlen($month) == 1){
            $month = '0'.$month ;
          }
          if(strlen($day) == 1){
            $day = '0'.$day ;                     
          }
          $toDay = $day+1;
          if(strlen($toDay) == 1){
            $toDay = '0'.$toDay ;
          }
        $cheackDataFrom = $year.'-'.$month.'-'.$day;
        $cheackDataTo = $year.'-'.$month.'-'.$toDay;
        foreach ($calenDate as $oneTerm){
          $from=explode(' ',$oneTerm->rent_from);
          $until=explode(' ',$oneTerm->rent_until);
          if($cheackDataFrom >= $oneTerm->rent_until)continue;
          $resultmsg = checkRentDayNightREM (($oneTerm->rent_from),($oneTerm->rent_until), $cheackDataFrom, $cheackDataTo, $this->params);       
          if($cheackDataTo <= date('Y-m-d') && strlen($resultmsg) > 1){
            if(!self::$params->get('special_price_show') 
                && ($cheackDataFrom == $until[0] || $cheackDataFrom == $from[0] )){
              if($flag3){
                $flag3 = false;
                return 'calendar_day_gone_not_avaible_night_end';
              }else{
                $flag3 = true;
                return 'calendar_day_gone_not_avaible_night_start';
              }
            }
            return 'calendar_day_gone_not_avaible';
          } 
          if(strlen($resultmsg) > 1){
            if(!self::$params->get('special_price_show') 
              && ($cheackDataFrom == $until[0] || $cheackDataFrom == $from[0] )){
              if($flag3){
                $flag3 = false;
                return 'calendar_not_available_night_end';
              }else{
                $flag3 = true;
                return 'calendar_not_available_night_start';
              }  
            }
            return 'calendar_not_available';
          }
          if($cheackDataTo <= date('Y-m-d')){
            return 'calendar_day_gone_avaible';
          }
        }
        if(isset($cheackDataTo) && $cheackDataTo <= date('Y-m-d')){
          return 'calendar_day_gone_avaible';
        }
        return 'calendar_available';
      }
//    }
//    if(!function_exists('com_house_categoryTreeList')){
        function REMcom_house_categoryTreeList($id, $action, $is_new, &$options = array(), $catid='', $lang='') {
            
            if($lang){
                $list = com_house_categoryArray($lang);
            } else {
                $list = com_house_categoryArray();
            }
            $cat = new mainRealEstateCategories($database);
            $cat->load($id);

            $this_treename = '';
            $childs_ids = Array();
            foreach ($list as $item) {
                if ($item->id == $cat->id || array_key_exists($item->parent_id, $childs_ids))
                    $childs_ids[$item->id] = $item->id;
            }
            foreach ($list as $item) {
                if ($this_treename) {
                    if ($item->id != $cat->id
                            && strpos($item->treename, $this_treename) === false
                            && array_key_exists($item->id, $childs_ids) === false) {
                        $options[] = mosHTML::makeOption($item->id, $item->treename);
                    }
                } else {
                    if ($item->id != $cat->id) {
                        $options[] = mosHTML::makeOption($item->id, $item->treename);
                    } else {
                        $this_treename = "$item->treename/";
                    }
                }
            }

            $parent = null;
            $parent = mosHTML::selectList($options, 'catid', 'class="inputbox" size="1" style="width: 115px"', 'value', 'text', $catid);
            return $parent;
        }
//    }

//    if(!function_exists('com_house_categoryArray')){
        function REMcom_house_categoryArray($lang='') {
            global $my, $acl;
            // get a list of the menu items
              $query = "SELECT c.*, c.parent_id AS parent, c.params AS access"
                    . "\n FROM #__rem_main_categories c"
                    . "\n WHERE section='com_realestatemanager'"
                    . "\n AND state <> 0 ";
            if($lang){
                $query .=  " AND ($lang)"
                      . "\n ORDER BY ordering";
            } else {
                $query .= " ORDER BY ordering";
            }
            self::$db->setQuery($query);
            $items = self::$db->loadObjectList();
            foreach ($items as $r => $cat_item) {
                if (!checkAccess_REM($cat_item->access, 'NORECURSE', userGID_REM($my->id), $acl)) {
                //if have not access then remove item from search
                    unset($items[$r]);
                }
            } 
            $items = array_values($items);
            // establish the hierarchy of the menu
            $children = array();
            // first pass - collect children
            foreach ($items as $v) {
                $pt = $v->parent;
                $list = @$children[$pt] ? $children[$pt] : array();
                array_push($list, $v);
                $children[$pt] = $list;
            }
            // second pass - get an indent list of the items
            $array = mosTreeRecurseREM(0, '', array(), $children);

            return $array;
        }
//    }
//    if (!function_exists('checkJavaScriptIncludedRE')) {
      function checkJavaScriptIncludedRE($name) {

          

          foreach(self::$doc->_scripts as $script_path=>$value){
            if(strpos( $script_path, $name ) !== false ) return true ;
          }
          return false;
      }
//    }  
      
//            if (!function_exists('sefreltoabs')) {

                function sefRelToAbs($value) {
                    $url = str_replace('&amp;', '&', $value);
                    if (substr(strtolower($url), 0, 9) != "index.php")
                        return $url;
                    $uri = JURI::getInstance();
                    $prefix = $uri->toString(array('scheme', 'host', 'port'));
                    return $prefix . JRoute::_($url);
                    return $url;
                }

//            }
//            if (!function_exists('editorArea')) {

                function editorArea($name, $content, $hiddenField, $width, $height, $col, $row) {
                    jimport('joomla.html.editor');
                    $editor = JFactory::getEditor();
                    echo $editor->display($hiddenField, $content, $width, $height, $col, $row);
                }

//            }
//com_realestatemanager_free_2018_01_10\site\realestatemanager.class.php
    function check() {
        
        // check for existing houseid

        if(!self::$params->get('price_string')){
            $this->price = floatval(preg_replace('/[\s,]/', '', $this->price));
        }

        if (trim($this->houseid) == "") {
            $this->setError(_REALESTATE_MANAGER_ADMIN_INFOTEXT_JS_EDIT_HOUSEID_CHECK);
            return false;
        }
        return true;
    }

    function setCatIds() {
        $this->_db->setQuery("SELECT idcat FROM #__rem_categories WHERE iditem=$this->id");
        if (version_compare(JVERSION, "3.0.0", "lt"))
            $this->catid = $this->_db->loadResultArray();
        else
            $this->catid = $this->_db->loadColumn();
    }

    function saveCatIds($categs) {
        if (is_array($categs)) {
            foreach ($categs as $categ)
                $temp[] = '(' . $this->id . ',' . $categ . ')';
            $queryvalue = implode(', ', $temp);
        } else
            $queryvalue = "('" . $this->id . "','" . $categs . "')";
        $this->catid = $categs;
        $this->_db->setQuery("DELETE FROM #__rem_categories WHERE iditem='" . $this->id . "';");
        $this->_db->query();
        $this->_db->setQuery("INSERT INTO #__rem_categories (iditem,idcat) VALUES $queryvalue");
        $this->_db->query();
        echo $this->_db->getErrorMsg();
    }

    //check access to house
    function getAccess_REM() {
        $this->setCatIds();
        $categoriesid = implode(',', $this->catid);
        if (!$categoriesid)
            return;
        $this->_db->setQuery("SELECT params FROM #__rem_main_categories WHERE id IN ($categoriesid)");
        if (version_compare(JVERSION, "3.0.0", "lt"))
            $accesses = $this->_db->loadResultArray();
        else {
            $accesses = $this->_db->loadColumn();
        }
        foreach ($accesses as $key => $access)
            if ($access == '')
                $accesses[$key] = '-2';
        return implode(',', $accesses);
    }

    function getUnusedHouseId() {
        $this->_db->setQuery("SELECT houseid FROM $this->_tbl");
        if (version_compare(JVERSION, "3.0.0", "lt"))
            $houseids_ids = $this->_db->loadResultArray();
        else
            $houseids_ids = $this->_db->loadColumn();
        for ($i = 1; in_array($i, $houseids_ids); $i++) {
            
        }
        return $i;
    }

    function setOwnerName() {
        $this->_db->setQuery("SELECT name FROM #__users WHERE email='$this->owneremail'");
        $this->ownername = $this->_db->loadResult();
    }

    function getOwnerUsername() {
        $this->_db->setQuery("SELECT name FROM #__users WHERE email='$this->owneremail'");
        return $this->_db->loadResult();
    }

    function getReviews() {
        $this->_db->setQuery("SELECT id FROM #__rem_review WHERE fk_houseid='$this->id' ORDER BY id");
        if (version_compare(JVERSION, "3.0.0", "lt"))
            $tmp = $this->_db->loadResultArray();
        else
            $tmp = $this->_db->loadColumn();
        $retVal = array();
        for ($i = 0, $j = count($tmp); $i < $j; $i++) {
            $help = new mosRealEstateManager_review($this->_db);
            $help->load(intval($tmp[$i]));
            $retVal[$i] = $help;
        }
        return $retVal;
    }

    function getRent() {
        $rent = null;
        if ($this->fk_rentid != null && $this->fk_rentid != 0) {
            $rent = new mosRealEstateManager_rent($this->_db);
            // load the row from the db table
            $rent->load(intval($this->fk_rentid));
        }
        return $rent;
    }

    function getAllRents($exclusion = "") {
        $this->_db->setQuery("SELECT id FROM #__rem_rent WHERE fk_houseid='$this->id' " . $exclusion . " ORDER BY fk_houseid");
        if (version_compare(JVERSION, "3.0.0", "lt"))
            $tmp = $this->_db->loadResultArray();
        else
            $tmp = $this->_db->loadColumn();
        $retVal = array();
        for ($i = 0, $j = count($tmp); $i < $j; $i++) {
            $help = new mosRealEstateManager_rent($this->_db);
            $help->load(intval($tmp[$i]));
            $retVal[$i] = $help;
        }
        return $retVal;
    }

    function getAllRentRequests($exclusion = "") {
        $this->_db->setQuery("SELECT id FROM #__rem_rent_request WHERE fk_houseid='$this->id'" . $exclusion . " ORDER BY id");
        if (version_compare(JVERSION, "3.0.0", "lt"))
            $tmp = $this->_db->loadResultArray();
        else
            $tmp = $this->_db->loadColumn();
        $retVal = array();
        for ($i = 0, $j = count($tmp); $i < $j; $i++) {
            $help = new mosRealEstateManager_rent_request($this->_db);
            $help->load(intval($tmp[$i]));
            $retVal[$i] = $help;
        }
        return $retVal;
    }

    function getAllBuyingRequests($exclusion = "") {
        $this->_db->setQuery("SELECT id FROM #__rem_buying_request WHERE fk_houseid='$this->id'" . $exclusion . " ORDER BY id");
        if (version_compare(JVERSION, "3.0.0", "lt"))
            $tmp = $this->_db->loadResultArray();
        else {
            $tmp = $this->_db->loadColumn();
        }
        $retVal = array();
        for ($i = 0, $j = count($tmp); $i < $j; $i++) {
            $help = new mosRealEstateManager_buying_request($this->_db);
            $help->load(intval($tmp[$i]));
            $retVal[$i] = $help;
        }
        return $retVal;
    }

    function getAllImages($exclusion = "") {
        $this->_db->setQuery("SELECT thumbnail_img, main_img FROM #__rem_photos WHERE fk_houseid='$this->id'" . $exclusion . " ORDER BY id");
        $retVal = $this->_db->loadObjectList();
        return $retVal;
    }

    function getAllVideos($exclusion = ""){
        $this->_db->setQuery(
          "SELECT sequence_number, src, type, media, youtube FROM #__rem_video_source WHERE fk_house_id='$this->id'"
           . $exclusion . " ORDER BY id");
        $retVal = $this->_db->loadObjectList();
        return $retVal;
    }

    function getAllTracks($exclusion = ""){
        $this->_db->setQuery(
          "SELECT sequence_number, src, kind, scrlang, label FROM #__rem_track_source WHERE fk_house_id='$this->id'"
           . $exclusion . " ORDER BY id");
        $retVal = $this->_db->loadObjectList();
        return $retVal;
    }

    function getAllHouseFeatures($exclusion = "") {
        $this->_db->setQuery("SELECT * FROM #__rem_feature_houses WHERE fk_houseid='$this->id' " . $exclusion . " ORDER BY id");
        $retVal = $this->_db->loadObjectList();
        return $retVal;
    }
    
    function getAllRentSal($exclusion = "") {
        $this->_db->setQuery("SELECT * FROM #__rem_rent_sal WHERE fk_houseid='$this->id' " . $exclusion . " ORDER BY id");
        $retVal = $this->_db->loadObjectList();
        return $retVal;
    }
    
    function toXML3($xmlDoc, $all) {
        //create and append name element
        $retVal = $xmlDoc->createElement("house");
        $houseid = $xmlDoc->createElement("houseid");
        $houseid->appendChild($xmlDoc->createTextNode($this->houseid));
        $retVal->appendChild($houseid);
        $catid = $xmlDoc->createElement("catid");
        $catid->appendChild($xmlDoc->createTextNode($this->catid));
        $retVal->appendChild($catid);
        $fk_rentid = $xmlDoc->createElement("fk_rentid");
        $fk_rentid->appendChild($xmlDoc->createTextNode($this->fk_rentid));
        $retVal->appendChild($fk_rentid);
        $sid = $xmlDoc->createElement("sid");
        $sid->appendChild($xmlDoc->createTextNode($this->sid));
        $retVal->appendChild($sid);
        //
        $description = $xmlDoc->createElement("description");
        $description->appendChild($xmlDoc->createCDATASection($this->description));
        $retVal->appendChild($description);
        $link = $xmlDoc->createElement("link");
        $link->appendChild($xmlDoc->createTextNode($this->link));
        $retVal->appendChild($link);
        $listing_type = $xmlDoc->createElement("listing_type");
        $listing_type->appendChild($xmlDoc->createCDATASection($this->listing_type));
        $retVal->appendChild($listing_type);
        $price = $xmlDoc->createElement("price");
        $price->appendChild($xmlDoc->createTextNode($this->price));
        $retVal->appendChild($price);
        $name = $xmlDoc->createElement("name");
        $name->appendChild($xmlDoc->createCDATASection($this->name));
        $retVal->appendChild($name);
        $hlocation = $xmlDoc->createElement("hlocation");
        $hlocation->appendChild($xmlDoc->createCDATASection($this->hlocation));
        $retVal->appendChild($hlocation);
        $hlatitude = $xmlDoc->createElement("hlatitude");
        $hlatitude->appendChild($xmlDoc->createTextNode($this->hlatitude));
        $retVal->appendChild($hlatitude);
        $hlongitude = $xmlDoc->createElement("hlongitude");
        $hlongitude->appendChild($xmlDoc->createTextNode($this->hlongitude));
        $retVal->appendChild($hlongitude);
        $map_zoom = $xmlDoc->createElement("map_zoom");
        $map_zoom->appendChild($xmlDoc->createTextNode($this->map_zoom));
        $retVal->appendChild($map_zoom);
        //recommended fields
        $rooms = $xmlDoc->createElement("rooms");
        $rooms->appendChild($xmlDoc->createTextNode($this->rooms));
        $retVal->appendChild($rooms);
        $bathrooms = $xmlDoc->createElement("bathrooms");
        $bathrooms->appendChild($xmlDoc->createTextNode($this->bathrooms));
        $retVal->appendChild($bathrooms);
        $bedrooms = $xmlDoc->createElement("bedrooms");
        $bedrooms->appendChild($xmlDoc->createTextNode($this->bedrooms));
        $retVal->appendChild($bedrooms);
        $image_link = $xmlDoc->createElement("image_link");
        $image_link->appendChild($xmlDoc->createCDATASection($this->image_link));
        $retVal->appendChild($image_link);
        $listing_status = $xmlDoc->createElement("listing_status");
        $listing_status->appendChild($xmlDoc->createTextNode($this->listing_status));
        $retVal->appendChild($listing_status);
        $price_type = $xmlDoc->createElement("price_type");
        $price_type->appendChild($xmlDoc->createTextNode($this->price_type));
        $retVal->appendChild($price_type);
        $property_type = $xmlDoc->createElement("property_type");
        $property_type->appendChild($xmlDoc->createTextNode($this->property_type));
        $retVal->appendChild($property_type);
        $year = $xmlDoc->createElement("year");
        $year->appendChild($xmlDoc->createTextNode($this->year));
        $year->appendChild($year);
        //optional fields
        $agent = $xmlDoc->createElement("agent");
        $agent->appendChild($xmlDoc->createCDATASection($this->agent));
        $retVal->appendChild($agent);
        $expiration_date = $xmlDoc->createElement("expiration_date");
        $expiration_date->appendChild($xmlDoc->createTextNode($this->expiration_date));
        $retVal->appendChild($expiration_date);
        $lot_size = $xmlDoc->createElement("lot_size");
        $lot_size->appendChild($xmlDoc->createCDATASection($this->lot_size));
        $retVal->appendChild($lot_size);
        $house_size = $xmlDoc->createElement("house_size");
        $house_size->appendChild($xmlDoc->createCDATASection($this->house_size));
        $retVal->appendChild($house_size);
        $garages = $xmlDoc->createElement("garages");
        $garages->appendChild($xmlDoc->createCDATASection($this->garages));
        $retVal->appendChild($garages);
        $hits = $xmlDoc->createElement("hits");
        $hits->appendChild($xmlDoc->createTextNode($this->hits));
        $retVal->appendChild($hits);
        $date = $xmlDoc->createElement("date");
        $date->appendChild($xmlDoc->createTextNode($this->date));
        $retVal->appendChild($date);
        $state = $xmlDoc->createElement("state");
        $state->appendChild($xmlDoc->createTextNode($this->state));
        $retVal->appendChild($state);
        $extra1 = $xmlDoc->createElement("extra1");
        $extra1->appendChild($xmlDoc->createTextNode($this->extra1));
        $retVal->appendChild($extra1);
        $extra2 = $xmlDoc->createElement("extra2");
        $extra2->appendChild($xmlDoc->createTextNode($this->extra2));
        $retVal->appendChild($extra2);
        $extra3 = $xmlDoc->createElement("extra3");
        $extra3->appendChild($xmlDoc->createTextNode($this->extra3));
        $retVal->appendChild($extra3);
        $extra4 = $xmlDoc->createElement("extra4");
        $extra4->appendChild($xmlDoc->createTextNode($this->extra4));
        $retVal->appendChild($extra4);
        $extra5 = $xmlDoc->createElement("extra5");
        $extra5->appendChild($xmlDoc->createTextNode($this->extra5));
        $retVal->appendChild($extra5);
        $extra6 = $xmlDoc->createElement("extra6");
        $extra6->appendChild($xmlDoc->createTextNode($this->extra6));
        $retVal->appendChild($extra6);
        $extra7 = $xmlDoc->createElement("extra7");
        $extra7->appendChild($xmlDoc->createTextNode($this->extra7));
        $retVal->appendChild($extra7);
        $extra8 = $xmlDoc->createElement("extra8");
        $extra8->appendChild($xmlDoc->createTextNode($this->extra8));
        $retVal->appendChild($extra8);
        $extra9 = $xmlDoc->createElement("extra9");
        $extra9->appendChild($xmlDoc->createTextNode($this->extra9));
        $retVal->appendChild($extra9);
        $extra10 = $xmlDoc->createElement("extra10");
        $extra10->appendChild($xmlDoc->createTextNode($this->extra10));
        $retVal->appendChild($extra10);
        $language = $xmlDoc->createElement("language");
        $language->appendChild($xmlDoc->createTextNode($this->language));
        $retVal->appendChild($language);
        $owner_id = $xmlDoc->createElement("owner_id");
        $owner_id->appendChild($xmlDoc->createTextNode($this->owner_id));
        $associate_house = $xmlDoc->createElement("associate_house");
        $associate_house->appendChild($xmlDoc->createTextNode($this->associate_house)); 
        $retVal->appendChild($associate_house);
        $pixUpdtedDt= $xmlDoc->createElement("pixUpdtedDt");
        $pixUpdtedDt->appendChild($xmlDoc->createCDATASection($this->pixUpdtedDt));
        $retVal->appendChild($pixUpdtedDt);
        $energy_value = $xmlDoc->createElement("energy_value");
        $energy_value->appendChild($xmlDoc->createCDATASection($this->energy_value));
        $retVal->appendChild($energy_value);
        $climate_value = $xmlDoc->createElement("climate_value");
        $climate_value->appendChild($xmlDoc->createCDATASection($this->climate_value));
        $retVal->appendChild($climate_value);
        if ($all) {
            //$rents_data = $this->getRent();
            $exclusion = "";
            $rents = $xmlDoc->createElement("rents");
            $rents_data = $this->getAllRents($exclusion);
            foreach ($rents_data as $rent_data)
                $rents->appendChild($rent_data->toXML3($xmlDoc));
            $retVal->appendChild($rents);
            $rentrequests = $xmlDoc->createElement("rentrequests");
            $rentrequests_data = $this->getAllRentRequests($exclusion);
            foreach ($rentrequests_data as $rentrequest_data)
                $rentrequests->appendChild($rentrequest_data->toXML3($xmlDoc));
            $retVal->appendChild($rentrequests);
            $buyingrequests = $xmlDoc->createElement("buyingrequests");
            $buyingrequests_data = $this->getAllBuyingRequests($exclusion);
            foreach ($buyingrequests_data as $buyingrequest_data)
                $buyingrequests->appendChild($buyingrequest_data->toXML3($xmlDoc));
            $retVal->appendChild($buyingrequests);
            $reviews = $xmlDoc->createElement("reviews");
            $reviews_data = $this->getReviews();
            foreach ($reviews_data as $review_data)
                $reviews->appendChild($review_data->toXML3($xmlDoc));
            $retVal->appendChild($reviews);
            $images = $xmlDoc->createElement("images");
            $images_data = $this->getAllImages();
            foreach ($images_data as $image_data) {
                $image = $xmlDoc->createElement("image");
                $image_thumbnail_img = $xmlDoc->createElement("thumbnail_img");
                $image_thumbnail_img->appendChild($xmlDoc->createTextNode($image_data->thumbnail_img));
                $image->appendChild($image_thumbnail_img);
                $image_main_img = $xmlDoc->createElement("main_img");
                $image_main_img->appendChild($xmlDoc->createTextNode($image_data->main_img));
                $image->appendChild($image_main_img);
                $images->appendChild($image);
            }
            $retVal->appendChild($images);
        }
        return $retVal;
    }

    function toXML2($all) {
        $this->setCatIds();
        if (count($this->catid) < 1) {
            echo _REALESTATE_MANAGER_ERROR_CATEGORIES;
            exit;
        }
        foreach ($this->catid as $catid)
            $catids[] = "<catid>" . $catid . "</catid>\n";
        $catids = implode('', $catids);
        $retVal = "<house>\n";
        $retVal.= "<id>" . $this->id . "</id>\n";
        $retVal.= "<houseid>" . $this->houseid . "</houseid>\n";
        $retVal.= "<catids>" . $catids . "</catids>\n";
        $retVal.= "<fk_rentid>" . $this->fk_rentid . "</fk_rentid>\n";
        $retVal.= "<sid>" . $this->sid . "</sid>\n";
        $retVal.= "<description><![CDATA[" . $this->description . "]]></description>\n";
        $retVal.= "<link><![CDATA[" . $this->link . "]]></link>\n";
        $retVal.= "<listing_type>" . $this->listing_type . "</listing_type>\n";
        $retVal.= "<price>" . $this->price . "</price>\n";
        $retVal.= "<priceunit><![CDATA[" . $this->priceunit . "]]></priceunit>\n";
        $retVal.= "<name><![CDATA[" . $this->name . "]]></name>\n";
        $retVal.= "<hcountry><![CDATA[" . $this->hcountry . "]]></hcountry>\n";
        $retVal.= "<hregion><![CDATA[" . $this->hregion . "]]></hregion>\n";
        $retVal.= "<hcity><![CDATA[" . $this->hcity . "]]></hcity>\n";
        $retVal.= "<hdistrict><![CDATA[" . $this->hdistrict . "]]></hdistrict>\n";
        $retVal.= "<hzipcode><![CDATA[" . $this->hzipcode . "]]></hzipcode>\n";
        $retVal.= "<hlocation><![CDATA[" . $this->hlocation . "]]></hlocation>\n";
        $retVal.= "<hlatitude>" . $this->hlatitude . "</hlatitude>\n";
        $retVal.= "<hlongitude>" . $this->hlongitude . "</hlongitude>\n";
        $retVal.= "<map_zoom>" . $this->map_zoom . "</map_zoom>\n";
        $retVal.= "<rooms>" . $this->rooms . "</rooms>\n";
        $retVal.= "<bathrooms>" . $this->bathrooms . "</bathrooms>\n";
        $retVal.= "<bedrooms>" . $this->bedrooms . "</bedrooms>\n";
        $retVal.= "<contacts>" . $this->contacts . "</contacts>\n"; //<contacts>
        $retVal.= "<image_link><![CDATA[" . $this->image_link . "]]></image_link>\n";
        $retVal.= "<listing_status>" . $this->listing_status . "</listing_status>\n";
        $retVal.= "<price_type>" . $this->price_type . "</price_type>\n";
        $retVal.= "<property_type>" . $this->property_type . "</property_type>\n";
        $retVal.= "<year>" . $this->year . "</year>\n";
        $retVal.= "<agent><![CDATA[" . $this->agent . "]]></agent>\n";
        $retVal.= "<expiration_date>" . $this->expiration_date . "</expiration_date>\n";
        $retVal.= "<lot_size>" . $this->lot_size . "</lot_size>\n";
        $retVal.= "<house_size>" . $this->house_size . "</house_size>\n";
        $retVal.= "<garages><![CDATA[" . $this->garages . "]]></garages>\n";
        $retVal.= "<date>" . $this->date . "</date>\n";
        $retVal.= "<hits>" . $this->hits . "</hits>\n";
        $retVal.= "<state>" . $this->state . "</state>\n";
        $retVal.= "<owneremail><![CDATA[" . $this->owneremail . "]]></owneremail>\n";
        $retVal.= "<featured_clicks><![CDATA[" . $this->featured_clicks . "]]></featured_clicks>\n";
        $retVal.= "<featured_shows><![CDATA[" . $this->featured_shows . "]]></featured_shows>\n";
        $retVal.= "<pixUpdtedDt><![CDATA[" . $this->pixUpdtedDt . "]]></pixUpdtedDt>\n";
        $retVal.= "<extra1><![CDATA[" . $this->extra1 . "]]></extra1>\n";
        $retVal.= "<extra2><![CDATA[" . $this->extra2 . "]]></extra2>\n";
        $retVal.= "<extra3><![CDATA[" . $this->extra3 . "]]></extra3>\n";
        $retVal.= "<extra4><![CDATA[" . $this->extra4 . "]]></extra4>\n";
        $retVal.= "<extra5><![CDATA[" . $this->extra5 . "]]></extra5>\n";
        $retVal.= "<extra6><![CDATA[" . $this->extra6 . "]]></extra6>\n";
        $retVal.= "<extra7><![CDATA[" . $this->extra7 . "]]></extra7>\n";
        $retVal.= "<extra8><![CDATA[" . $this->extra8 . "]]></extra8>\n";
        $retVal.= "<extra9><![CDATA[" . $this->extra9 . "]]></extra9>\n";
        $retVal.= "<extra10><![CDATA[" . $this->extra10 . "]]></extra10>\n";
        $retVal.= "<language><![CDATA[" . $this->language . "]]></language>\n";
        $retVal.= "<owner_id><![CDATA[" . $this->owner_id . "]]></owner_id>\n";
        $retVal.= "<associate_house><![CDATA[" . $this->associate_house . "]]></associate_house>\n";
        $retVal.= "<energy_value>" . $this->energy_value . "</energy_value>\n";
        $retVal.= "<climate_value>" . $this->climate_value . "</climate_value>\n";
        if ($all) {
            $exclusion = "";
            $retVal.= "<rents>\n";
            $rents = $this->getAllRents($exclusion);
            foreach ($rents as $rent)
                $retVal.= $rent->toXML2();
            $retVal.= "</rents>\n";
            $retVal.= "<rentrequests>\n";
            $rentrequests = $this->getAllRentRequests($exclusion);
            foreach ($rentrequests as $rentrequest)
                $retVal.= $rentrequest->toXML2();
            $retVal.= "</rentrequests>\n";
            $retVal.= "<buyingrequests>\n";
            $buyingrequests = $this->getAllBuyingRequests($exclusion);
            foreach ($buyingrequests as $buyingrequest)
                $retVal.= $buyingrequest->toXML2();
            $retVal.= "</buyingrequests>\n";
            $retVal.= "<reviews>\n";
            $reviews = $this->getReviews($exclusion);
            foreach ($reviews as $review)
                $retVal.= $review->toXML2();
            $retVal.= "</reviews>\n";
            $retVal.= "<images>\n";
            $images_data = $this->getAllImages();
            foreach ($images_data as $image_data) {
                $retVal.= "<image>\n";
                $retVal.= "<thumbnail_img><![CDATA[" . $image_data->thumbnail_img . "]]></thumbnail_img>\n";
                $retVal.= "<main_img><![CDATA[" . $image_data->main_img . "]]></main_img>\n";
                $retVal.= "</image>\n";
            }
            $retVal.= "</images>\n";

            $retVal .= "<videos>\n";
            $videos_data = $this->getAllVideos();
            foreach ($videos_data as $video_data) {
                $retVal .= "<video>\n";
                $retVal .= "<sequence_number><![CDATA[" . $video_data->sequence_number . "]]></sequence_number>\n";
                $retVal .= "<src><![CDATA[" . $video_data->src . "]]></src>\n";
                $retVal .= "<type><![CDATA[" . $video_data->type . "]]></type>\n";
                $retVal .= "<media><![CDATA[" . $video_data->media . "]]></media>\n";
                $retVal .= "<youtube><![CDATA[" . $video_data->youtube . "]]></youtube>\n";
                $retVal .= "</video>\n";
            }
            $retVal .= "</videos>\n";

            $retVal .= "<tracks>\n";
            $tracks_data = $this->getAllTracks();
            foreach ($tracks_data as $track_data) {
                $retVal .= "<track>\n";
                $retVal .= "<sequence_number><![CDATA[" . $track_data->sequence_number . "]]></sequence_number>\n";
                $retVal .= "<src><![CDATA[" . $track_data->src . "]]></src>\n";
                $retVal .= "<kind><![CDATA[" . $track_data->kind . "]]></kind>\n";
                $retVal .= "<scrlang><![CDATA[" . $track_data->scrlang . "]]></scrlang>\n";
                $retVal .= "<label><![CDATA[" . $track_data->label . "]]></label>\n";
                $retVal .= "</track>\n";
            }
            $retVal .= "</tracks>\n";

            $retVal.= "<features_houses>\n";
            $features_data = $this->getAllHouseFeatures();
            foreach ($features_data as $feature_data) {
                $retVal.= "<features_house>\n";
                $retVal.= "<fk_featureid><![CDATA[" . $feature_data->fk_featureid . "]]></fk_featureid>\n";
                $retVal.= "</features_house>\n";
            }
            $retVal.= "</features_houses>\n";
            $retVal.= "<rent_sals>\n";
            $rentsals_data = $this->getAllRentSal();
            foreach ($rentsals_data as $rentsal_data) {
                $retVal.= "<rent_sal>\n";
                $retVal.= "<price_from><![CDATA[" . $rentsal_data->price_from . "]]></price_from>\n";
                $retVal.= "<price_to><![CDATA[" . $rentsal_data->price_to . "]]></price_to>\n";
                $retVal.= "<special_price><![CDATA[" . $rentsal_data->special_price . "]]></special_price>\n";
                $retVal.= "<priceunit><![CDATA[" . $rentsal_data->priceunit . "]]></priceunit>\n";
                $retVal.= "</rent_sal>\n";
            }
            $retVal.= "</rent_sals>\n";
        }
            $retVal.= "</house>\n";
            return $retVal;
    }
}



/*
//lineas que han quedado fuera:

    if (!1) {
      require_once (JPATH_ROOT . '/' . 'administrator' . '/' . 'components' . '/'
       . 'com_realestatemanager' . '/' . 'realestatemanager.class.conf.php' );
    }



    if (!class_exists('getLayoutPath')) {

      class getLayoutPath {

          static function getLayoutPathCom($components, $type, $layout = 'default') {
              $template = JFactory::getApplication()->getTemplate();
              $defaultLayout = $layout;

              if (strpos($layout, ':') !== false) {
                  // Get the template and file name from the string
                  $temp = explode(':', $layout);
                  $template = ($temp[0] == '_') ? $template : $temp[0];
                  $layout = $temp[1];
                  $defaultLayout = ($temp[1]) ? $temp[1] : 'default';
              }

              // Build the template and base path for the layout
              $tPath = JPATH_THEMES . '/' . $template . '/html/' . $components . '/' . $type . '/' . $layout . '.php';
              $cPath = JPATH_BASE . '/components/' . $components . '/views/' . $type . '/tmpl/' . $layout . '.php';
              $dPath = JPATH_BASE . '/components/' . $components . '/views/' . $type . '/tmpl/default.php';
              // If the template has a layout override use it
              if (file_exists($tPath)) {
                  return $tPath;
              } else if (file_exists($cPath)) {
                  return $cPath;
              } else if (file_exists($dPath)) {
                  return $dPath;
              } else {
                  echo "Bad layout path, please write to admin";
                  exit;
              }
          }

      }

//    }

*/