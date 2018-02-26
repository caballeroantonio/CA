<?php
JHtml::_('bootstrap.tooltip', '.hasTooltip', array('placement' => 'bottom'));
JHtml::_('behavior.multiselect');
JHtml::_('jquery.framework');

if(JRequest::getBool('wo_scripts',1)){
    $doc= JFactory::getDocument();
    $scripts = [
    '/media/jui/js/jquery.min.js', 
    '/media/jui/js/jquery-noconflict.js', 
    '/media/jui/js/jquery-migrate.min.js', 
    '/media/jui/js/bootstrap.min.js', 
    '/media/system/js/core.js', 
    '/media/system/js/multiselect.js', 
    ];

    foreach ($scripts as $script){
        unset($doc->_scripts[JURI::root(true) . $script]);
    }
}
?>

empty2
<a href="index.php?option=[%%com_architectcomp%%]&view=[%%compobjectplural%%]&layout=tst_empty&tmpl=component&function=on_collapseModal">empty</a>