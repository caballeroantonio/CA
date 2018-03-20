<?php
JHtml::_('jquery.framework', false);
$doc = JFactory::getDocument();
//// add stylesheet
$doc->addStyleSheet('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
//$doc->addStyleSheet('//maxcdn.bootstrapcdn.com/bootstrap/2.3.2/css/bootstrap.min.css');
//$doc->addStyleSheet('components/com_realestatemanager/includes/animate.css');
//$doc->addScript('//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js');
//$doc->addStyleSheet('components/com_realestatemanager/includes/jQuerREL-ui.css');
//$doc->addStyleSheet('components/com_realestatemanager/includes/bootstrapREL.css');
$doc->addStyleSheet('components/com_realestatemanager/includes/realestatemanager.css');
//// $doc->addStyleSheet('components/com_realestatemanager/lightbox/css/lightbox.css');

//
//// add js
//$doc->addScript('components/com_realestatemanager/includes/functions.js');
//
//if(RemcaHelper::checkJavaScriptIncludedRE("jQuerREL-1.2.6.js") === false ) {
//  $doc->addScript('components/com_realestatemanager/lightbox/js/jQuerREL-1.2.6.js');
//} 
//
//$doc->addScriptDeclaration("jQuerREL=jQuerREL.noConflict();");
//
//if(RemcaHelper::checkJavaScriptIncludedRE("jQuerREL-ui.js") === false ) {
//  $doc->addScript('components/com_realestatemanager/includes/jQuerREL-ui.js');
//}
//
//$doc->addScript('components/com_realestatemanager/includes/wishlist.js');
//// $doc->addScript('components/com_realestatemanager/lightbox/js/lightbox-2.6.min.js');
//$doc->addScript('components/com_realestatemanager/includes/jquery.raty.js');
$doc->addScript('components/com_realestatemanager/TABS/tabcontent.js');
$doc->addStyleSheet('components/com_realestatemanager/TABS/tabcontent.css');
//
////add fancybox & swiper slider
$doc->addScript('components/com_realestatemanager/includes/swiper.js');
$doc->addStyleSheet('components/com_realestatemanager/includes/swiper.css');

/**
* fancyBox is licensed under the GPLv3 license for all open source applications. A commercial license is required for all commercial applications (including sites, themes and apps you plan to sell).
*/
$doc->addStyleSheet('media/com_remca/fancybox/jquery.fancybox-1.3.4.css');
$doc->addScript('media/com_remca/fancybox/jquery.fancybox-1.3.4.pack.js');