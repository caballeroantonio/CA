<?php 
require_once('rem_scripts.php');

$remca_helper = new RemcaHelper();

$this->params->set('show_rentstatus',1);
$this->params->set('show_rentrequest',1);
$this->params->set('show_pricerequest',1);
$this->params->set('show_sale_separator',1);


$database = JFactory::getDBO();

if (!defined('_VALID_MOS') && !defined('_JEXEC')) 
  die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');
/**
 *
 * @package  RealestateManager
 * @copyright 2012 Andrey Kvasnevskiy-OrdaSoft(akbet@mail.ru); Rob de Cleen(rob@decleen.com);
 * Homepage: http://www.ordasoft.com
  * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version: 3.9 PRO
 *
 *
 */

global $hide_js, $mainframe, $Itemid, 
  $mosConfig_live_site, $my, $arr, $acl,$langContent;


$watermark_path = ($this->params->get('watermark_show') == 1) ? 'watermark/' : '';
$watermark = ($this->params->get('watermark_show') == 1) ? true : false;  

JHtml::_('behavior.framework', true);

if (!JFactory::getApplication()->get('os_lightbox')) 
  JFactory::getApplication()->set('os_lightbox', true);
// add os_lightbox
////////////Adding google map
if ($this->params->get('location_tab_show') 
    || $this->params->get('street_view_show')) {
  $api_key = $this->params->get('api_key') ? "key=" . $this->params->get('api_key') : JFactory::getApplication()->enqueueMessage("<a target='_blank' href='//developers.google.com/maps/documentation/geocoding/get-api-key'>" . JText::_('_REALESTATE_MANAGER_GOOGLEMAP_API_KEY_LINK_MESSAGE') . "</a>", JText::_('_REALESTATE_MANAGER_GOOGLEMAP_API_KEY_ERROR')); 
  $this->document->addScript("//maps.googleapis.com/maps/api/js?{$api_key}");
  require_once('dibujar_mapa.php');
}
?>
<div id="overDiv" ></div>

<?php
JPluginHelper::importPlugin('content');
$dispatcher = JDispatcher::getInstance();

?>  
<script language="javascript" type="text/javascript">

function review_submitbutton() {
    var form = document.review_house;
    // do field validation
    var rating_checked = false; 
    for (c = 0;  c < form.rating.length; c++){
        if (form.rating[c].checked){
            rating_checked = true;
            form.rating.value = c ;
        } 
    }
    if (form.title.value == "") {
        alert( "<?php echo JText::_('_REALESTATE_MANAGER_INFOTEXT_JS_REVIEW_TITLE'); ?>" );
    } else if (form.comment == "") {
        alert( "<?php echo JText::_('_REALESTATE_MANAGER_INFOTEXT_JS_REVIEW_COMMENT'); ?>" );
    } else if (! form.rating.value) {                
        alert( "<?php echo JText::_('_REALESTATE_MANAGER_INFOTEXT_JS_REVIEW_RATING'); ?>" );
    } else {
        form.submit();
    }
}
//*****************   begin add for show/hiden button "Add review" ********************
function button_hidden( is_hide ) {
    var el = document.getElementById('button_hidden_review');
    var el2 = document.getElementById('hidden_review');
    if(is_hide){
        el.style.display = 'none';
        el2.style.display = 'block';
    } else {
        el.style.display = 'block';
        el2.style.display = 'none';
    }
}

function buying_request_submitbutton() {
    var form = document.buying_request;
    if (form.customer_name.value == "") {
        document.getElementById('customer_name_warning').innerHTML =
         "<?php echo JText::_('_REALESTATE_MANAGER_INFOTEXT_JS_RENT_REQ_NAME'); ?>";
        document.getElementById('customer_name_warning').style.color = "red";
        document.getElementById('alert_name_buy').style.borderColor = "red";
        document.getElementById('alert_name_buy').style.color = "red";
    } else if (form.customer_email.value == ""|| !isValidEmail(form.customer_email.value)) {
        document.getElementById('customer_email_warning').innerHTML =
         "<?php echo JText::_('_REALESTATE_MANAGER_INFOTEXT_JS_RENT_REQ_EMAIL'); ?>";
        document.getElementById('customer_email_warning').style.color = "red";
        document.getElementById('alert_mail_buy').style.borderColor = "red";
        document.getElementById('alert_mail_buy').style.color = "red";
    } else if (!isValidPhoneNumber(form.customer_phone.value)){
        document.getElementById('customer_phone_warning').innerHTML =
         "<?php echo JText::_('_REALESTATE_MANAGER_REQUEST_PHONE'); ?>";
        document.getElementById('customer_phone_warning').style.color = "red";
        document.getElementById('customer_phone').style.borderColor = "red";
        document.getElementById('customer_phone').style.color = "red";
    } else {
        form.submit();
    }
}
function isValidPhoneNumber(str){
    myregexp = new RegExp("^([_0-9() -;,]*)$");
    mymatch = myregexp.exec(str);
    if(str == "")
        return true;
    if(mymatch != null)
        return true;
    return false;
}
function isValidEmail(str){
    myregexp = new RegExp("^([a-zA-Z0-9_-]+\.)*[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*\.[a-zA-Z]{2,6}$");
    mymatch = myregexp.exec(str);
    if(str == "")
        return false;
    if(mymatch != null)
        return true;
    return false;
}        
</script>

<?php

    if ($this->params->get('show_rentstatus') && $this->params->get('show_rentrequest') 
          && !$this->params->get('rent_save') && !$this->params->get('search_request')) {
?>

<!--///////////////////////////////calendar///////////////////////////////////////-->
<script language="javascript" type="text/javascript">  

<?php
    $house_id_fordate =  $this->item->id;
//    $date_NA = available_dates($house_id_fordate);    #luego lo reviso
?>

    var unavailableDates = Array();
    
    jQuery(document).ready(function() {
        var k=0;
        <?php 
        if(!empty($date_NA)){
            	foreach ($date_NA as $N_A){
                    echo "unavailableDates[k]={$N_A};k++;";
                }
        }
        ?>

        function unavailableFrom(date) {
            dmy = date.getFullYear() + "-" + ('0'+(date.getMonth() + 1)).slice(-2) + 
              "-" + ('0'+date.getDate()).slice(-2);
            if (jQuery.inArray(dmy, unavailableDates) == -1) {
                return [true, ""];
            } else {
                return [false, "", "Unavailable"];
            }
        }

        function unavailableUntil(date) {
            dmy = date.getFullYear() + "-" + ('0'+(date.getMonth() + 1)).slice(-2) + 
              "-" + ('0'+(date.getDate()-("<?php  if(!$this->params->get('special_price_show')) echo '1';?>"))).slice(-2);
            if (jQuery.inArray(dmy, unavailableDates) == -1) {
                return [true, ""];
            } else {
                return [false, "", "Unavailable"];
            }
        }



        jQuery( "#rent_from" ).datepicker(
        {
          minDate: "+0",
          dateFormat: "<?php echo RemcaHelper::transforDateFromPhpToJquery();?>",
          beforeShowDay: unavailableFrom,
          onClose: function () {
              jQuery.ajax({ 
                  type: "POST",
                  update: jQuery(" #alert_date "),
                  success: function( data ) {
                      jQuery("#alert_date").html("");
                  }
              });

              var rent_from = jQuery(" #rent_from ").val();
              var rent_until = jQuery(" #rent_until ").val();
              jQuery.ajax({ 
                  type: "POST",
                  url: "index.php?option=com_realestatemanager&task=ajax_rent_calcualete"
                    +"&bid=<?php echo $this->item->id; ?>&rent_from="+
                    rent_from+"&rent_until="+rent_until,
                  data: { " #do " : " #1 " },
                  update: jQuery(" #message-here "),
                  success: function( data ) {
                      jQuery("#message-here").html(data);
                      jQuery("#calculated_price").val(data);
                  }
              });
          }
        });          
        
        jQuery( "#rent_until" ).datepicker(
        {

          minDate: "+0",
          dateFormat: "<?php echo RemcaHelper::transforDateFromPhpToJquery();?>",
          beforeShowDay: unavailableUntil,
          onClose: function () {
              jQuery.ajax({ 
                  type: "POST",
                  update: jQuery(" #alert_date "),
                  success: function( data ) {
                      jQuery("#alert_date").html("");
                  }
              });

              var rent_from = jQuery(" #rent_from ").val();
              var rent_until = jQuery(" #rent_until ").val();
              jQuery.ajax({ 
                  type: "POST",
                  url: "index.php?option=com_realestatemanager&task=ajax_rent_calcualete"
                    +"&bid=<?php echo $this->item->id; ?>&rent_from="+
                    rent_from+"&rent_until="+rent_until,
                  data: { " #do " : " #1 " },
                  update: jQuery(" #message-here "),
                  success: function( data ) {
                      jQuery("#message-here").html(data);
                      jQuery("#calculated_price").val(data);
                  }
              });
          }
        }); 

    });

    <!--///////////////////////////////////////////////////////////////////////////-->

    function rem_rent_request_submitbutton() {
        var form = document.rent_request_form;
        var datef = form.rent_from.value;
        var dateu = form.rent_until.value;
        var dayornight = "<?php echo $this->params->get('special_price_show')?>";
        var frep = datef.replace(/\//gi,"-").replace(/\s/gi,"-").replace(/\*/gi,"-");
        var urep = dateu.replace(/\//gi,"-").replace(/\s/gi,"-").replace(/\*/gi,"-");
        var re = /\n*\-\d\d\d\d/;
        var found = urep.match(re);
        if(found){
            var dfrom = (frep.split ('-').reverse ());
            var duntil = (urep.split ('-').reverse ());
        } else {
            var dfrom = (frep.split ('-'));
            var duntil = (urep.split ('-'));
        }
       
        var dmin=dfrom[0]*10000+dfrom[1]*100+dfrom[2]*1;
        var dmax=duntil[0]*10000+duntil[1]*100+duntil[2]*1;
        if (form.user_name.value == "") {
            document.getElementById('user_name_warning').innerHTML =
             "<?php echo JText::_('_REALESTATE_MANAGER_INFOTEXT_JS_RENT_REQ_NAME'); ?>";
            document.getElementById('user_name_warning').style.color = "red";
            document.getElementById('alert_name').style.borderColor = "red";
            document.getElementById('alert_name').style.color = "red";
        } else if (form.user_email.value == "" || !isValidEmail(form.user_email.value)) {
            document.getElementById('user_email_warning').innerHTML =
             "<?php echo JText::_('_REALESTATE_MANAGER_INFOTEXT_JS_RENT_REQ_EMAIL'); ?>";
            document.getElementById('user_email_warning').style.color = "red";
            document.getElementById('alert_mail').style.borderColor = "red";
            document.getElementById('alert_mail').style.color = "red";
        } else if (dmax<dmin) {
             document.getElementById('alert_date').innerHTML =
              "<?php echo JText::_('_REALESTATE_MANAGER_INFOTEXT_JS_RENT_REQ_ALERT'); ?>";
             document.getElementById('alert_date').style.borderColor = "red";
             document.getElementById('alert_date').style.color = "red";
        } else if (unavailableDates.indexOf(form.rent_until.value) >= 0
         || unavailableDates.indexOf(form.rent_from.value) >= 0) {
            document.getElementById('alert_date').innerHTML =
             "<?php echo JText::_('_REALESTATE_MANAGER_INFOTEXT_JS_RENT_REQ_DATE'); ?>";
            document.getElementById('alert_date').style.borderColor = "red";
            document.getElementById('alert_date').style.color = "red";
        } else if (dmax==dmin && dayornight == 0) {
             document.getElementById('alert_date').innerHTML =
              "<?php echo JText::_('_REALESTATE_MANAGER_INFOTEXT_JS_RENT_REQ_ALERT'); ?>";
             document.getElementById('alert_date').style.borderColor = "red";
             document.getElementById('alert_date').style.color = "red";
        }else {
            form.submit();
        }
    }

</script>
<?php
    } 
?>  
<script  type="text/javascript" charset="utf-8" async defer>
    jQuery(document).ready(function () {
      jQuery('input,textarea').focus(function(){
        jQuery(this).data('placeholder',jQuery(this).attr('placeholder'))
        jQuery(this).attr('placeholder','')
        jQuery(this).css('color','#a3a3a3');
        jQuery(this).css('border-color','#ddd');
      });
      jQuery('input,textarea').blur(function(){
        jQuery(this).attr('placeholder',jQuery(this).data('placeholder'));
      });
    });



    function allreordering(){
        if(document.orderForm.order_direction.value=='asc')
            document.orderForm.order_direction.value='desc';
        else document.orderForm.order_direction.value='asc';

        document.orderForm.submit();
    }

</script>


    <?php

     RemcaHelper::positions_rem($this->params->get('view01')); ?>

<div class="REL-row">
<div class="REL-collumn-xs-12 REL-collumn-sm-8 REL-collumn-md-9 REL-collumn-lg-9">
<div id="rem_house_galery">
    <!-- ********************** begin add for show/hiden button "Edit house"___c************* -->

<?php

        $is_edit_all_houses = false ;
        if (checkAccess_REM($this->params->get('option_edit_registrationlevel'), 'RECURSE', userGID_REM($my->id), $acl)) {
            $is_edit_all_houses = true ;
        }

$user = JFactory::getUser();
$isroot = $user->authorise('core.admin');

if ($my->id == $this->item->owner_id && $my->id != '' || $isroot):

    global $option;

    if ($option != 'com_realestatemanager') {
        $form_action = "index.php?option=" . $option .
         "&task=edit_house&Itemid=" . $Itemid ;

    }

    else

      $form_action = "index.php?option=com_realestatemanager&task=edit_house&Itemid=" . $Itemid;
    ?>

<?php endif;?>
<!-- ************************* end  add for show/hiden button "Edit house"***************** -->
<div class="componentheading<?php echo $this->params->get('pageclass_sfx'); ?> ">
    
<?php if (trim($this->item->name)) { ?>
                <span class="col_text_2"><?php echo $this->item->name; ?></span>
<?php } ?> 
<?php if($this->params->get('show_pricerequest')){ ?>
    <div class="rem_house_price">
<?php


if(!incorrect_price($this->item->price)){

    if ($this->params->get('price_unit_show') == '1') {
        if ($this->params->get('show_sale_separator')) {
            echo "<div class=\"pricemoney\">
                    <span class=\"money\">" 
                    . formatMoney($this->item->price, $this->params->get('sale_fraction'), $this->params->get('price_format')) . 
                    "</span>";
            echo "<span class=\"price\">&nbsp;" . $this->item->priceunit . "</span></div>";
        } else {
            echo "<div class=\"pricemoney\"><span class=\"money\">" . $this->item->price . "</span>";
            echo "<span class=\"price\">&nbsp;" . $this->item->priceunit . "</span></div>";    
        }
    } else {
        if ($this->params->get('show_sale_separator')) {
            echo "<div class=\"pricemoney\"><span class=\"price\">" . $this->item->priceunit . "</span>";
            echo "&nbsp;<span class=\"money\">"
                 . formatMoney($this->item->price, $this->params->get('sale_fraction'), $this->params->get('price_format')) 
                 . "</span></div>";
        } else {
            echo "<div class=\"pricemoney\"><span class=\"price\">" . $this->item->priceunit . "</span>";
            echo "&nbsp;<span class=\"money\">" . $this->item->price . "</span></div>";
        }
    }    
	
/*******************end from realestatemanager.php***************************/
        $currencyArr = array();
        $currentCurrency='';
        $currencys = explode(';', $this->params->get('currency'));
        foreach ($currencys as $oneCurency) {
            $oneCurrArr = explode('=', $oneCurency);
            if(!empty($oneCurrArr[0]) && !empty($oneCurrArr[1])){
               $currencyArr[$oneCurrArr[0]] = $oneCurrArr[1]; 
               if( $this->item->priceunit == $oneCurrArr[0]){
                   $currentCurrency = $oneCurrArr[1];
               }
            }
        }

        if(empty( $this->item->price))  $this->item->price = 0;

        if($currentCurrency){
            foreach ($currencyArr as $key=>$value) {
                if(!incorrect_price( $this->item->price)){
                    $currencys_price[$key] = round($value / $currentCurrency *  $this->item->price, 2);
                }
            }
        }else{
            if( $this->item->owner_id == $my->id){
                JError::raiseWarning( 100, _REALESTATE_MANAGER_CURRENCY_ERROR);
            }
        }

/*******************end from realestatemanager.php***************************/
	
    if($currencys_price){
      foreach ($currencys_price as $key => $row) {
        if ($this->item->priceunit != $key) {
          if ($this->params->get('price_unit_show') == '1') {
            if ($this->params->get('show_sale_separator')) {
              echo "<div class=\"pricemoney\"><span class=\"money\">" 
                  . formatMoney($row, $this->params->get('sale_fraction'), $this->params->get('price_format')) . "</span>";
              echo "<span class=\"price\">&nbsp;" . $key . "</span></div>";
            } else {
              echo "<div class=\"pricemoney\"><span class=\"money\">" . $row . "</span>";
              echo "<span class=\"price\">&nbsp;" . $key . "</span></div>";    
            }
          } else {
            if ($this->params->get('show_sale_separator')) {
              echo "<div class=\"pricemoney\"><span class=\"price\">" . $key . "</span>";
              echo "&nbsp;<span class=\"money\">" 
                  . formatMoney($row, $this->params->get('sale_fraction'), $this->params->get('price_format')) . 
                  "</span></div>";
            } else {
              echo "<div class=\"pricemoney\"><span class=\"price\">" . $key . "</span>";
              echo "&nbsp;<span class=\"money\">" . $row . "</span></div>";
            }
          }
        }
      }
    }

}else{
   echo "<div class=\"pricemoney\"><span class=\"money\">" . $this->item->price . "</span>";
   echo "&nbsp;<span class=\"money\"></span></div>";
}
    ?>

    </div>
<?php 
      } ?>
</div>
<div style="clear:both"></div>

        
    <div class="rem_house_location">
                <i class="fa fa-map-marker"></i>
    <?php if (isset($this->item->hcountry) && trim($this->item->hcountry)) { ?>
                <span class="col_text_2"><?php echo $this->item->hcountry; ?></span>,

<?php     } if (isset($this->item->hregion) && trim($this->item->hregion)) { ?>
                <span class="col_text_2"><?php echo $this->item->hregion; ?></span>,

<?php     } if (isset($this->item->hcity) && trim($this->item->hcity)) { ?>
                <span class="col_text_2"><?php echo $this->item->hcity; ?></span>,

    <?php } if (isset($this->item->hzipcode) && trim($this->item->hzipcode)) { ?>
                <span class="col_text_2"><?php echo $this->item->hzipcode; ?></span>,

    <?php }  if (isset($this->item->hlocation) && trim($this->item->hlocation)) { ?>
                <span class="col_02"><?php echo $this->item->hlocation; ?></span>.
    <?php } ?>

    </div>
    <div style="clear:both"></div>

    <span class="col_img">
    
    <?php

    //for local images
$imageURL = ($this->item->image_link);
if ($imageURL == '') $imageURL = JText::_('_REALESTATE_MANAGER_NO_PICTURE_BIG');

     $file_name = RemcaHelper::rem_picture_thumbnail($imageURL,
        $this->params->get('fotomain_width'),
        $this->params->get('fotomain_high'));

     $file_name = $imageURL;
    $file = $mosConfig_live_site . '/components/com_realestatemanager/photos/' . $file_name;
echo '<div style="position:relative">';
if($this->params->get('show_house_slider')=='1') {
  $stdClassImage = new stdClass();
  $stdClassImage->main_img = $file_name;
  // $house_photos[] = $stdClassImage;
        $query = "select main_img from #__rem_photos WHERE fk_houseid='{$this->item->id}' order by img_ordering,id";
        $database->setQuery($query);
        $house_photos = $database->loadObjectList();
  array_unshift($house_photos, $stdClassImage);

  if(count($house_photos) > 0) { ?>
      <div class="swiper-container">
        <div class="swiper-wrapper">
    <?php for ($i = 0; $i < count($house_photos); $i++) : ?>
          <div class="swiper-slide">

            <?php  
          if ($this->item->listing_type){
            if ($this->item->listing_type != 1){
              echo '<div class="rem_col_sale view_veh" >'.JText::_('_REALESTATE_MANAGER_OPTION_FOR_SALE').'</div>';
            } else{
              echo '<div class="rem_col_rent view_veh">'.JText::_('_REALESTATE_MANAGER_OPTION_FOR_RENT').'</div>';
            }
          }

          if ($this->item->listing_status){
            if ($this->item->listing_status != 0){
              $listing_status1 = explode(',', JText::_('_REALESTATE_MANAGER_OPTION_LISTING_STATUS'));

              $ls = 1;
              foreach ($listing_status1 as $listing_status2) {
                  $listing_status[$ls] = $listing_status2;
                  $ls++;
              }

              echo '<div class="rem_listing_status view_veh">'.$listing_status[$this->item->listing_status].'</div>';
            }
          }
        $house_photos[$i]->main_img = str_ireplace('watermark/', '', $house_photos[$i]->main_img);


         ?> 

            <a href="./components/com_realestatemanager/photos/<?php 
               echo RemcaHelper::rem_picture_thumbnail($house_photos[$i]->main_img,
               $this->params->get('fotomain_width'),
               $this->params->get('fotomain_high'), $watermark); ?>" data-fancybox="slider" title="photo">
              <img alt="<?php echo $this->item->name; ?>" title="<?php echo $this->item->name; ?>" 
              src="./components/com_realestatemanager/photos/<?php 
               echo RemcaHelper::rem_picture_thumbnail($house_photos[$i]->main_img,
               $this->params->get('fotomain_width'),
               $this->params->get('fotomain_high'), $watermark); ?>"
 />
            </a>
    
          </div><!--end div class="swiper-slide"-->
<?php endfor;?>
      </div><!--end div class="swiper-wrapper"-->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div><!--end div class="swiper-container"-->
<?php
  }
}
else {
  echo '<img alt="' . $this->item->name . '" title="' . $this->item->name . '" src="' . $file . '"  >';
}
?>  
<!-- add wishlist marker -->
      <?php if ($this->params->get('show_add_to_wishlist')) { ?>
      <span class="fa-stack fa-lg i-wishlist i-wishlist-all"  >
      <?php if (in_array($this->item->id, $this->params->get('wishlist'))) { ?>
       <i class="fa fa-star fa-stack-1x" id="icon<?php echo $this->item->id ?>" title="<?php echo JText::_('_REALESTATE_MANAGER_LABEL_WISHLIST_REMOVE') ?>" onclick="addToWishlist(<?php echo $this->item->id ?>, <?php echo $my->id ?>)"> </i> 
      <?php } else { ?> 
      <i class="fa fa-star-o fa-stack-1x" id="icon<?php echo $this->item->id ?>" title="<?php echo JText::_('_REALESTATE_MANAGER_LABEL_WISHLIST_ADD') ?>" onclick="addToWishlist(<?php echo $this->item->id ?>, <?php echo $my->id ?>)"></i>
      <?php } ?>
      </span>
      <?php } 
      echo '</div>';?> 
      <!-- end add wishlist marker -->

    </span>

    <div class="table_gallery table_07">
<?php if (count($house_photos) > 0) { ?>
    <div class="gallery_img">
    <?php for ($i = 0;$i < count($house_photos);$i++) { ?>
        <div class="thumbnail viewHouses" 
              style="width: <?php echo $this->params->get('fotogal_width');?>px; height: <?php 
              echo $this->params->get('fotogal_high');?>px;" >

         <?php $house_photos[$i]->main_img = str_ireplace('watermark/', '', $house_photos[$i]->main_img) ?>

              <a href="./components/com_realestatemanager/photos/<?php 
               echo RemcaHelper::rem_picture_thumbnail($house_photos[$i]->main_img,
               $this->params->get('fotomain_width'),
               $this->params->get('fotomain_high'), $watermark); ?>" data-fancybox="gallery" title="photo" >
               <img alt="<?php echo $this->item->name; ?>" title="<?php echo $this->item->name; ?>" 
               src="./components/com_realestatemanager/photos/<?php 
               echo RemcaHelper::rem_picture_thumbnail($house_photos[$i]->main_img,
               $this->params->get('fotogal_width'),
               $this->params->get('fotogal_high'), $watermark); ?>" style = "vertical-align:middle;" />
              </a>
          </div>
           <?php
    }
    ?>
            </div>
    <?php }
?>
    </div>
</div>
<!--<form action="<?php //echo sefRelToAbs($form_action);
?>" method="post" name="house">-->
        <?php RemcaHelper::positions_rem($this->params->get('view02')); ?>

        <div id="rem_house_property">
                 <?php
            $listing_status[0] = JText::_('_REALESTATE_MANAGER_OPTION_SELECT');
            $listing_status1 = explode(',', JText::_('_REALESTATE_MANAGER_OPTION_LISTING_STATUS'));
            $i = 1;
            foreach ($listing_status1 as $listing_status2) {
                $listing_status[$i] = $listing_status2;
                $i++;
            }
            if ($this->item->listing_status != 0) {
                ?>
                <div class="row_text">
                    <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_LISTING_STATUS'); ?>:</span>
                    <span class="col_text_2"><?php echo $listing_status[$this->item->listing_status]; ?></span>
                </div>
                        <?php
                    }
            ?>

            <?php
            $property_type[0] = JText::_('_REALESTATE_MANAGER_OPTION_SELECT');
            $property_type1 = explode(',', JText::_('_REALESTATE_MANAGER_OPTION_PROPERTY_TYPE'));
            $i = 1;
            foreach ($property_type1 as $property_type2) {
                $property_type[$i] = $property_type2;
                $i++;
            }
            if ($this->item->property_type != 0) {
                ?>
                <div class="row_text">
                    <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_PROPERTY_TYPE'); ?>:</span>
                    <span class="col_text_2"><?php echo $property_type[$this->item->property_type]; ?></span>
                </div>
                <?php
            }
                ?>

                <?php if (trim($this->item->houseid)) { ?>
                <div class="row_text">
                    <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_PROPERTYID'); ?>:</span>
                    <span class="col_text_2"><?php echo $this->item->houseid; ?></span>
                </div>
                <?php
                }
                ?>
                <?php
                $listing_type[0] = JText::_('_REALESTATE_MANAGER_OPTION_SELECT');
                $listing_type[1] = JText::_('_REALESTATE_MANAGER_OPTION_FOR_RENT');
                $listing_type[2] = JText::_('_REALESTATE_MANAGER_OPTION_FOR_SALE');
                if ($this->item->listing_type != 0) {
                    ?>
                <div class="row_text">
                <span class="col_text_icon"></span>
                <span class="col_01"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_LISTING_TYPE'); ?>:</span>
                <span class="col_02"><?php echo $listing_type[$this->item->listing_type]; ?></span>
                </div>
                <?php
            }
            ?>
            <?php if ($this->params->get('extra1') == 1 && $this->item->extra1 != "") {
    ?>
            <div class="row_text">
                <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_EXTRA1'); ?>:</span>
                <span class="col_text_2"><?php echo $this->item->extra1; ?></span>
            </div>
                <?php
            }
            if ($this->params->get('extra2') == 1 && $this->item->extra2 != "") {
                ?>
            <div class="row_text">
                <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_EXTRA2'); ?>:</span>
                <span class="col_text_2"><?php echo $this->item->extra2; ?></span>
            </div>
                <?php
            }
            if ($this->params->get('extra3') == 1 && $this->item->extra3 != "") {
                ?>
            <div class="row_text">
                <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_EXTRA3'); ?>:</span>
                <span class="col_text_2"><?php echo $this->item->extra3; ?></span>
            </div>
    <?php
}
if ($this->params->get('extra4') == 1 && $this->item->extra4 != "") {
    ?>
            <div class="row_text">
                <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_EXTRA4'); ?>:</span>
                <span class="col_text_2"><?php echo $this->item->extra4; ?></span>
            </div>
                <?php
            }
            if ($this->params->get('extra5') == 1 && $this->item->extra5 != "") {
                ?>
            <div class="row_text">
                <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_EXTRA5'); ?>:</span>
                <span class="col_text_2"><?php echo $this->item->extra5; ?></span>
            </div>
    <?php
}
if ($this->params->get('extra6') == 1 && $this->item->extra6 > 0) {
    $extra1 = explode(',', JText::_('_REALESTATE_MANAGER_EXTRA6_SELECTLIST'));
    $i = 1;
    foreach ($extra1 as $extra2) {
        $extra[$i] = $extra2;
        $i++;
    }
    ?>
            <div class="row_text">
                <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_EXTRA6'); ?>:</span>
                <span class="col_text_2"><?php echo $extra[$this->item->extra6]; ?></span>
            </div>
    <?php
}
if ($this->params->get('extra7') == 1 && $this->item->extra7 > 0) {
    $extra1 = explode(',', JText::_('_REALESTATE_MANAGER_EXTRA7_SELECTLIST'));
    $i = 1;
    foreach ($extra1 as $extra2) {
        $extra[$i] = $extra2;
        $i++;
    }
    ?>
            <div class="row_text">
                <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_EXTRA7'); ?>:</span>
                <span class="col_text_2"><?php echo $extra[$this->item->extra7]; ?></span>
            </div>
    <?php
}
if ($this->params->get('extra8') == 1 && $this->item->extra8 > 0) {
    $extra1 = explode(',', JText::_('_REALESTATE_MANAGER_EXTRA8_SELECTLIST'));
    $i = 1;
    foreach ($extra1 as $extra2) {
        $extra[$i] = $extra2;
        $i++;
    }
    ?>
            <div class="row_text">
                <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_EXTRA8'); ?>:</span>
                <span class="col_text_2"><?php echo $extra[$this->item->extra8]; ?></span>
            </div>
    <?php
}
if ($this->params->get('extra9') == 1 && $this->item->extra9 > 0) {
    $extra1 = explode(',', JText::_('_REALESTATE_MANAGER_EXTRA9_SELECTLIST'));
    $i = 1;
    foreach ($extra1 as $extra2) {
        $extra[$i] = $extra2;
        $i++;
    }
    ?>
            <div class="row_text">
                <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_EXTRA9'); ?>:</span>
                <span class="col_text_2"><?php echo $extra[$this->item->extra9]; ?></span>
            </div>
            <?php
        }
        if ($this->params->get('extra10') == 1 && $this->item->extra10 > 0) {
            $extra1 = explode(',', JText::_('_REALESTATE_MANAGER_EXTRA10_SELECTLIST'));
            $i = 1;
            foreach ($extra1 as $extra2) {
                $extra[$i] = $extra2;
                $i++;
            }
            ?>
            <div class="row_text">
                <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_EXTRA10'); ?>:</span>
                <span class="col_text_2"><?php echo $extra[$this->item->extra10]; ?></span>
            </div>
            <?php }
        ?>
        <!--add edocument -->
        <?php
        if ($this->params->get('show_edocsrequest') && $this->item->edok_link != null) {
            $session = JFactory::getSession();
            $sid = $session->getId();
            $session->set("ssmid", $sid);
            setcookie('ssd', $sid, time() + 60 * 60 * 24, "/");
            ?>
            <div class="row_text">
                <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_EDOCUMENT'); ?>:</span>
                <span class="col_text_2">
                    <a href="<?php echo $this->item->edok_link; ?>" target="blank">
            <?php echo JText::_('_REALESTATE_MANAGER_LABEL_EDOCUMENT_DOWNLOAD'); ?>
                    </a>
                </span>
            </div>
    <?php
} //end if
?>
        </div>
        <?php
        if($this->params->get('energy_field_show')) {
          $result = $this->params->get('diagramma');
          if($result){ ?>
        <!-- <div class="diagramm"> -->
        <div class="diagramm">
          <?php echo $this->params->get('diagramma'); ?>
        </div>
      <?php
        }
      }
      ?>
<div class="tabs_buttons">
    <!--list of the tabs-->
    <ul id="countrytabs" class="shadetabs">
        <li>
            <a href="#" rel="country1" class="selected"><?php echo JText::_('_REALESTATE_MANAGER_TAB_DESCRIPTION'); ?>
            </a>
        </li>
        <?php
        if (($this->params->get('show_location') && $this->params->get('show_locationtab_registrationlevel'))
            || ($this->params->get('street_view') && $this->params->get('street_view_registrationlevel'))) {
            ?>
            <li>
              <a href="#" rel="country2" onmouseup="setTimeout('initialize()',10)">
                  <?php echo JText::_('_REALESTATE_MANAGER_TAB_LOCATION'); ?>
              </a>
            </li>
            <?php
        }
        ?>
        <?php
        if ($this->params->get('show_reviews_tab')) {
          if ($this->params->get('show_reviewstab_registrationlevel')) {
            ?>
            <li>
              <a href="#" rel="country4"><?php echo JText::_('_REALESTATE_MANAGER_TAB_REVIEWS'); ?></a>
            </li>
            <?php
          }
        }
        ?>
        <?php
        if ($this->params->get('calendar_show') && $this->item->listing_type == 1) {
            if ($this->params->get('calendar_option_registrationlevel','')) {
                ?>
                <li>
                    <a href="#" rel="country5"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_CALENDAR_CALENDAR'); ?></a>
                </li>
                <?php
            }
        }
        ?>
    </ul>
</div>
                <?php RemcaHelper::positions_rem($this->params->get('view03')); ?>

<!--begin tabs-->
<div id="tabs">
    <div id="country1" class="tabcontent">
        <div class="rem_type_house">
            <?php if (isset($this->item->rooms) && trim($this->item->rooms)) { ?>
                <div class="row_text">
                    <i class="fa fa-building-o"></i>
                    <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_ROOMS'); ?>:</span>
                    <span class="col_text_2"><?php echo $this->item->rooms; ?></span>
                </div>
            <?php } if (isset($this->item->bathrooms) && trim($this->item->bathrooms)) { ?>
                <div class="row_text">
                    <i class="fa fa-tint"></i>
                    <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_BATHROOMS'); ?>:</span>
                    <span class="col_text_2"><?php echo $this->item->bathrooms; ?></span>
                </div>
            <?php } if (isset($this->item->bedrooms) && trim($this->item->bedrooms)) { ?>
                <div class="row_text">
                    <i class="fa fa-inbox"></i>
                    <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_BEDROOMS'); ?>:</span>
                    <span class="col_text_2"><?php echo $this->item->bedrooms; ?></span>
                </div>
                        <?php
                    }
            ?>
            <?php if (isset($this->item->year) && trim($this->item->year)) { ?>
                <div class="row_text">
                    <i class="fa fa-calendar"></i>
                    <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_BUILD_YEAR'); ?>:</span>
                    <span class="col_text_2"><?php echo $this->item->year; ?></span>
                </div>
                <?php }   ?>
            <?php if (isset($this->item->garages) && trim($this->item->garages)) { ?>
                <div class="row_text">
                    <i class="fa fa-truck"></i>
                    <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_GARAGES'); ?>:</span>
                    <span class="col_text_2"><?php echo $this->item->garages; ?></span>
                </div>
                        <?php }
            if (isset($this->item->lot_size) && trim($this->item->lot_size)) {
                ?>
                <div class="row_text">
                    <i class="fa fa-arrows-alt"></i>
                    <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_LOT_SIZE'); ?>:</span>
                    <span class="col_text_2">
                        <?php echo $this->item->lot_size; ?> <?php echo JText::_('_REALESTATE_MANAGER_LABEL_SIZE_SUFFIX_AR'); ?>
                    </span>
                </div>
                <?php }
            if (isset($this->item->house_size) && trim($this->item->house_size)) {
                ?>
                <div class="row_text">
                    <i class="fa fa-expand"></i>
                    <span class="col_text_1"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_HOUSE_SIZE'); ?>:</span>
                    <span class="col_text_2">
                        <?php echo $this->item->house_size; ?> <?php echo JText::_('_REALESTATE_MANAGER_LABEL_SIZE_SUFFIX'); ?>
                    </span>
                </div>
                <?php }
////////////////////////////////////START show video\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
                      if (!empty($videos)) {
                        $youtubeCode = "";
                        $videoSrc = array();
                        $videoSrcHttp = "";
                        $videoType = array();
                        foreach($videos as $video) {
                            if ($video->youtube) {
                              $youtubeCode = $video->youtube;
                            } else if ($video->src) {
                              $videoSrc[] = $video->src;
                              if($video->type)
                                $videoType[] = $video->type;
                            }
                        }?>
                        <div class="row_06">
                          <span class="realestate_video">
                            <strong class="col_01"><?php echo JText::_('_REALESTATE_MANAGER_LABEL_VIDEO'); ?>:</strong>
                        <?php 
                        if (!empty($youtubeCode)) { ?>
                          <iframe width="420" height="315" frameborder="0" 
                            src="//www.youtube.com/embed/<?php echo $youtubeCode ?>"></iframe> 
                          <?php
                        } else if (!empty($videoSrc) && empty($youtubeCode)) { ?>
                          <video width="320" height="240" controls>
                            <?php
                            for ($i = 0;$i < count($videoSrc);$i++) {
                              if(!strstr($videoSrc[$i], "http") && $videoType) {
                              echo '<source src="' . $mosConfig_live_site . $videoSrc[$i] .'"'.
                                    ' type="' . $videoType[$i] .'">';
                              }else{
                               echo '<source src="' . $videoSrc[$i] .'"'.
                                    ' type="' . $videoType[$i] .'">';
                             }
                            }
                            if (!empty($tracks)) {
                              for ($i = 0;$i < count($tracks);$i++) {
                                ($i==0)?$default='default="default"':$default='';
                                if (!strstr($tracks[$i]->src, "http")) {
                                  echo '<track src="' . $mosConfig_live_site.$tracks[$i]->src . '"'.
                                      ' kind="' . $tracks[$i]->kind .'"'. 
                                      ' srclang="' . $tracks[$i]->scrlang .'"'.
                                      ' label="' . $tracks[$i]->label . '" '.$default.'>';
                                }else{
                                  echo '<track src="' .$src . '"'.
                                      ' kind="' . $tracks[$i]->kind .'"'. 
                                      ' srclang="' . $tracks[$i]->scrlang .'"'.
                                      ' label="'.$tracks[$i]->label.'" '.$default.'>';
                                }
                              }
                            } ?>
                          </video>
                            </span>
                          
                        <?php
                      } ?>
                      </div>
                      <?php
                    }
////////////////////////////////////END show video\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
            if (isset($this->item->description) && trim($this->item->description)) {
                ?>
                    <div class="rem_house_desciption"><?php echo $this->item->description; ?></div>
                <?php
            }
            ?>
        </div>
<div class="table_tab_01 table_03">
    
    <!--       *******************************************************************         -->
    <?php 
    if($this->params->get('special_price_show')){
        $switchTranslateDayNight = JText::_('_REALESTATE_MANAGER_RENT_SPECIAL_PRICE_PER_DAY');       
    }else{
        $switchTranslateDayNight = JText::_('_REALESTATE_MANAGER_RENT_SPECIAL_PRICE_PER_NIGHT');    
    }
    $query = "select * from #__rem_rent_sal WHERE fk_houseid='{$this->item->id}'";
    $database->setQuery($query);
    $rentTerm = $database->loadObjectList();
        if(isset($rentTerm[0]->special_price)) { ?>
            <div class = "row_17">
            <span class="col_01"><?php echo JText::_('_REALESTATE_MANAGER_RENT_SPECIAL_PRICE'); ?>:</span> </br>

                <table class="adminlist adminlist_04">
                    <tr>
                        <th class="title" width = "15%" align ='center' ><?php 
                          echo JText::_('_REALESTATE_MANAGER_FROM'); ?></th>
                        <th class="title" width = "15%" align ='center' ><?php 
                          echo JText::_('_REALESTATE_MANAGER_TO'); ?></th>
                        <th class="title" width = "15%" align ='center'><?php 
                          echo $switchTranslateDayNight; ?></th>
                        <th class="title" width = "20%" align ='center' ><?php 
                          echo JText::_('_REALESTATE_MANAGER_LABEL_REVIEW_COMMENT'); ?></th>
                    </tr>
                    <?php                                                
                        $DateToFormat = str_replace("D",'d',
                          (str_replace("M",'m',(str_replace('%','',
                          $this->params->get('date_format'))))));
                        for ($i = 0; $i < count($rentTerm); $i++) {   
                        $date_from = new DateTime($rentTerm[$i]->price_from);
                        $date_to = new DateTime($rentTerm[$i]->price_to);
                    ?>
                    <tr>
                        <td align ='center'><?php echo date_format($date_from, "$DateToFormat"); ?></td>
                        <td align ='center'><?php echo date_format($date_to, "$DateToFormat"); ?></td>
                        <?php
                                if ($this->params->get('sale_separator') == '1') { ?>
                                    <td align ='center'><?php 
                                      echo formatMoney($rentTerm[$i]->special_price, $this->params->get('sale_fraction'),
                                         $this->params->get('price_format')); ?></td>
                        <?php   } else { ?>
                                    <td align ='center'><?php echo $rentTerm[$i]->special_price; ?></td>
                        <?php   }
                            ?>

                        <td align ='center'><?php echo $rentTerm[$i]->comment_price; ?></td> 
                    </tr>
                    <?php } ?>  
                </table>
            </div>
<?php   } ?>

<?php //require_once ('house_feature.php'); ?>
        </div>
    </div><!--end of tab-->
<div id="country2" class="tabcontent">
        <!--if we are given the coordinates, then display latitude, longitude and a map with a marker -->
<?php if ($this->item->hlatitude && $this->item->hlongitude) {?> 
          <div class="table_latitude table_04">
            <?php
            if(($this->params->get('show_location') && $this->params->get('show_locationtab_registrationlevel'))){ ?>
              <div id="map_canvas" class="re_map_canvas re_map_canvas_02"></div>
            <?php
            }
            if($this->params->get('street_view') && $this->params->get('street_view_registrationlevel')){ ?>
              <div id="map_pano" class="re_map_canvas re_map_canvas_02"></div>
              <?php
            } ?>
          </div>
          <?php 
      } else
        echo JText::_('_REALESTATE_MANAGER_LABEL_NO_LOCATION_AVAILIBLE');
        ?>
    </div>
<?php 
//require_once('getReviews.php'); 
require_once('calendar.php')
?>
</div> <!--end all tabs -->

<script type="text/javascript">
    var countries=new ddtabcontent("countrytabs")
    countries.setpersist(true)
    countries.setselectedClassTarget("link") //"link" or "linkparent"
    countries.init()
</script>

</div>

<div class="REL-collumn-xs-12 REL-collumn-sm-4 REL-collumn-md-3 REL-collumn-lg-3">
<?php  RemcaHelper::positions_rem($this->params->get('view05')); ?>
<?php    if ($this->params->get('show_owner_line') ==1 && $this->params->get('show_owner_line') ==1) {
                ?>
   <div class="rem_house_contacts">
        <div id="rem_house_titlebox">
            <?php echo JText::_('_REALESTATE_MANAGER_LABEL_CONTACT_AGENT') ; ?>
        </div>    
                    <?php if (isset($this->item->agent) && trim($this->item->agent)) { ?>
                    <span class="col_02"><?php echo $this->item->agent; ?></span>
            <?php
            }
            ?>

            <?php
            if ($this->params->get('show_owner_line') && $this->item->ownername != '' || $this->item->owneremail != '') {
              if ($this->params->get('show_owner_registrationlevel')) {
            ?>
                    <span class="col_02"><?php echo $this->item->ownername, '</br>', $this->item->owneremail; ?></span>
            <?php
              }
            }
            ?>

            <?php
            if ($this->params->get('show_contacts_line')) {
              if ($this->params->get('show_contacts_registrationlevel')) {
                if (isset($this->item->contacts) && trim($this->item->contacts)) {
            ?>
                    <span class="col_02"><?php echo $this->item->contacts; ?></span>
            <?php
                }
              }
            }
            ?>
    </div>
            <?php
            }
            ?>
    <?php
    if($this->item->listing_type != 0 && ($this->params->get('show_buystatus') && $this->params->get('show_buyrequest'))) {?>
    <?php
    $hide_block = false;
    if(($this->item->listing_type == 1 && $this->params->get('show_rentrequest') && $this->params->get('show_rentstatus')) || 
      ($this->item->listing_type == 2 && $this->params->get('show_buystatus') && $this->params->get('show_buyrequest'))){
        $hide_block = true;
    }
    ?>
    <div class="rem_buying_house" <?php echo $hide_block ? '' : ' style="display: none;"'; ?>>
    <?php
     if ($this->item->listing_type == 1) {
      if ($this->params->get('show_rentrequest') && $this->params->get('show_rentstatus')) {
        if ($option != 'com_realestatemanager') {
          $form_action = "index.php?option=" . $option . "&task=save_rent_request&Itemid=" . $Itemid ;
        }
        else {
          $form_action = "index.php?option=com_realestatemanager&amp;task=save_rent_request&amp;Itemid=" . $Itemid;
        }
    ?>
      <div id="rem_house_titlebox">
    <?php echo JText::_('_REALESTATE_MANAGER_LABEL_BOOK_NOW') ; ?>
      </div>

      <form action="<?php echo sefRelToAbs($form_action); ?>" method="post" name="rent_request_form">  
        <div id="show_buying"> 
          <input type="hidden" name="bid[]" value="<?php echo $this->item->id; ?>" />
          <input type="hidden" name="houseid" id="houseid" value="<?php echo $this->item->id ?>" maxlength="80" />
          <input type="hidden" name="calculated_price" id="calculated_price" value="" maxlength="80" />
          <input type="hidden" name="price_unit" value="<?php echo $this->item->priceunit;?>" maxlength="80" />
    <?php 
        global $my;
        if($my->guest) {
    ?>
          <div class="row_01">
            <div id="user_name_warning"></div>
            <p>
              <input class="inputbox" id="alert_name" type="text" name="user_name" size="38" 
                        maxlength="80" placeholder="<?php echo JText::_('_REALESTATE_MANAGER_LABEL_RENT_REQUEST_NAME') ; ?>*" />
            </p>
          </div>
                    
          <div class="row_02">
            <div id="user_email_warning"></div>
            <p>
              <input class="inputbox" id="alert_mail" type="text" name="user_email" size="30" 
                       maxlength="80" placeholder="<?php echo JText::_('_REALESTATE_MANAGER_LABEL_RENT_REQUEST_EMAIL'); ?>*" />
            </p>
          </div>
    <?php
        }
        else {
    ?>
          <div class="row_03">
            <div id="user_name_warning"></div>
              <p>
                <input class="inputbox" id="alert_name"  type="text" name="user_name" size="38" 
                  maxlength="80" value="<?php echo $my->name; ?>" 
                  placeholder="<?php echo JText::_('_REALESTATE_MANAGER_LABEL_RENT_REQUEST_NAME'); ?>*" />
              </p>
          </div>
          <div class="row_04">
            <div id="user_email_warning"></div>
              <p>
                <input id="alert_mail" class="inputbox" type="text" name="user_email" size="30" 
                  maxlength="80" value="<?php echo $my->email; ?>" 
                  placeholder="<?php echo JText::_('_REALESTATE_MANAGER_LABEL_RENT_REQUEST_EMAIL'); ?>*" />
              </p>
          </div>
    <?php
        }
    ?>

    <script type="text/javascript">
        Date.prototype.toLocaleFormat = function(format) {
            var f = {Y : this.getYear() + 1900,m : this.getMonth() + 1,d : this.getDate(),
              H : this.getHours(),M : this.getMinutes(),S : this.getSeconds()}
            for(k in f)
                format = format.replace('%' + k, f[k] < 10 ? "0" + f[k] : f[k]);
            return format;
        };
        window.onload = function ()
        {
            var today = new Date();
            var date = today.toLocaleFormat("<?php echo $this->params->get('date_format') ?>");
           //fix later //first load date dug.
           // document.getElementById('rent_from').value = date;
           // document.getElementById('rent_until').value = date;
        }; 
    </script>

          <div class="row_05">
            <p>
              <textarea name="user_mailing" cols="50" rows="8" placeholder="<?php 
                echo JText::_('_REALESTATE_MANAGER_TAB_DESCRIPTION'); ?>" ></textarea>
            </p>
          </div>

          <div class="row_06">
            <p><?php echo JText::_('_REALESTATE_MANAGER_LABEL_RENT_REQUEST_FROM'); ?>:</p>
            <p><input type="text" id="rent_from" name="rent_from"></p>
          </div>
          <div class="row_07">
            <p><?php echo JText::_('_REALESTATE_MANAGER_LABEL_RENT_REQUEST_UNTIL'); ?>:</p>
            <p><input type="text" id="rent_until" name="rent_until"></p>
          </div>
        </div>
        <div id="alert_date" name = "alert_date"> <span id="alert_date"> </span>  </div>
  
      <?php if ($this->params->get('show_pricerequest')): ?> 

        <div id="price_1">
            <span><?php echo    _REALESTATE_MANAGER_LABEL_PRICE. ': '; ?></span>
            <span id="message-here"> </span> 
            <span><?php //echo $this->item->priceunit; ?></span>
        </div>
  
      <?php endif; ?> 

        <div id="message-here"> </div>
        
  <div id="captcha-block">   
<!--*************************   begin add antispam guest   ********************-->

<!--*********************** end add antispam guest   *************************-->
        <?php
        if ($this->params->get('show_rentstatus') && $this->params->get('show_rentrequest') 
              && !$this->params->get('rent_save') && !$this->params->get('search_request')) {
            ?>
            <br />
            <input type="button" value="<?php echo JText::_('_REALESTATE_MANAGER_LABEL_BUTTON_RENT_REQU') ; ?>" 
              class="button" onclick="rem_rent_request_submitbutton()" />
            <br />
    <?php
} else if ($this->params->get('show_rentstatus') && $this->params->get('show_rentrequest') && $this->params->get('rent_save') 
          && !$this->params->get('search_request')) {
    ?>
            <input type="button" class="button" value="<?php echo JText::_('_REALESTATE_MANAGER_LABEL_BUTTON_RENT_REQU_SAVE'); ?>" 
              onclick="rem_rent_request_submitbutton()" />
    <?php } else {
        ?>
            &nbsp;
        <?php
    }
    ?>
    </div>
  
  

        </form>
                    <?php
                } else
                    echo "</form>";
            } else if ($this->item->listing_type == 2) {
                ?>
    </form>
    <?php
    if ($this->params->get('show_buyrequest') && $this->params->get('show_buystatus')) {
        global $option;
        if ($option != 'com_realestatemanager') {
            $form_action = "index.php?option=" . $option 
            . "&task=buying_request&Itemid=" 
              . $Itemid ;
        } else
            $form_action = "index.php?option=com_realestatemanager&amp;task=buying_request&amp;Itemid=" . $Itemid;
        ?>
    <div id="rem_house_titlebox">
        <?php echo JText::_('_REALESTATE_MANAGER_LABEL_BUTTON_SEND_MESSAGE'); ?>
    </div>
    <div id="show_buying">
        <form action="<?php echo sefRelToAbs($form_action); ?>" method="post" name="buying_request">
            <div class="table_08">
    <?php
    global $my;
    if ($my->guest) {
        ?>      
            <div class="row_01">
              <div id="customer_name_warning"></div>
                <span class="col_02"><input id="alert_name_buy" class="inputbox" type="text" 
                  name="customer_name" size="38" maxlength="80" placeholder="<?php 
                  echo JText::_('_REALESTATE_MANAGER_LABEL_RENT_REQUEST_NAME') ; ?>*"/></span>
            </div>
            <div class="row_02">
              <div id="customer_email_warning"></div>
                <span class="col_02"><input id="alert_mail_buy" class="inputbox" type="text" 
                  name="customer_email" size="38" maxlength="80" placeholder="<?php 
                  echo JText::_('_REALESTATE_MANAGER_LABEL_RENT_REQUEST_EMAIL'); ?>*"/></span>
            </div>

        <?php
    } else {
        ?>
            <div class="row_03">
              <div id="customer_name_warning"></div>
                <span class="col_02">
                    <input id="alert_name_buy"  class="inputbox" type="text" name="customer_name" size="38" 
                  maxlength="80" placeholder="<?php echo JText::_('_REALESTATE_MANAGER_LABEL_RENT_REQUEST_NAME'); ?>" 
                  value="<?php echo $my->name; ?> " /></span>
            </div>
            <div class="row_04">
              <div id="customer_email_warning"></div>
                <span class="col_02">
                    <input id="alert_mail_buy"  class="inputbox" type="text" name="customer_email" size="38" 
                  maxlength="80" placeholder="<?php echo JText::_('_REALESTATE_MANAGER_LABEL_RENT_REQUEST_EMAIL'); ?>" 
                  value="<?php echo $my->email; ?>"/></span>
            </div>
            <?php
        }
        ?>
            <div class="row_05">
              <div id="customer_phone_warning"></div>
                <span class="col_02">
                    <input class="inputbox" type="text" id="customer_phone" name="customer_phone" 
                      size="38" maxlength="80" placeholder="<?php echo JText::_('_REALESTATE_MANAGER_REQUEST_PHONE'); ?>" />
                </span>
            </div>
            <div class="row_06">
                <textarea name="customer_comment" cols="50" rows="8" placeholder="<?php 
                  echo JText::_('_REALESTATE_MANAGER_TAB_DESCRIPTION'); ?>" ></textarea>        
                <input type="hidden" name="bid[]" value="<?php echo $this->item->id; ?>" />
            </div>

     
            <div class="row_07">
              <span class="col_01">
                <input type="button" value="<?php echo JText::_('_REALESTATE_MANAGER_LABEL_BUTTON_SEND_MESSAGE'); ?>" 
                      class="button" onclick="buying_request_submitbutton()"/>
              </span> 
            </div>
          </div>
        </form>
      </div>
        <?php
    }
} else
    echo "</form>";
?>
                
</div><!-- end div class='rem_buying_house' -->
<?php
}
?>
</div> <!-- end span3-->
</div>

 <?php RemcaHelper::positions_rem($this->params->get('similaires')); ?>
 
<div>
    <?php
	//reparar:
    //mosHTML::BackButton($params, $hide_js);
    ?>
</div>
<!-- Modal -->
<a href="#aboutus" class="rem-button-about"></a>
                    
<a href="#rem-modal-css" class="rem-overlay" id="rem-aboutus" style="display: none;"></a>
<div class="rem-popup">
    <div class="rem-modal-text">
        Please past text to modal
    </div>
     
    <a class="rem-close" title="Close" href="#rem-close"></a>
</div>

<?php 
  $slider_object_fit = $this->params->get('slider_object_fit');
  $slider_height = $this->params->get('slider_height')/100;
?>

<script type="text/javascript">
$(function() {
    var mySwiper = new Swiper ('#rem_house_galery .swiper-container', {
      nextButton: '#rem_house_galery .swiper-button-next',
      prevButton: '#rem_house_galery .swiper-button-prev'
    })
  // fancybox
   jQuery('[data-fancybox]').fancybox({
    thumbs : {
      autoStart : true
    }
  })


  var width = jQuery('#rem_house_galery .swiper-container').width();
  jQuery('#rem_house_galery .swiper-container .swiper-slide img').height(width*<?php echo $slider_height; ?>);
  jQuery('#rem_house_galery .swiper-container .swiper-slide img').css('object-fit','<?php echo $slider_object_fit; ?>');

  jQuery(window).resize(function(){
    var width = jQuery('#rem_house_galery .swiper-container').width();
    jQuery('#rem_house_galery .swiper-container .swiper-slide img').height(width*<?php echo $slider_height; ?>);
  })
});


</script>


