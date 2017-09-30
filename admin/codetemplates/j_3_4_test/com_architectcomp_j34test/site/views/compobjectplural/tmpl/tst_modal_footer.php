<?php
// ejemplo manual
//$function	= $app->input->get('function', 'jSelectExpediente');
//$empty = $component->params->get('default_empty_field', '');
?>
<?php /*?><a class="pointer" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $item->id; ?>', '<?php echo $this->escape(addslashes($item->name)); ?>');"><?php */?>

<a onclick="if (window.parent) window.parent.on_collapseModal('1', '1/2015 toca');" class="pointer">1/2015 toca</a>

		<div class="btn-toolbar">
			<div class="btn-group">
				<button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('ls05.save')">
					<span class="icon-ok"></span>&#160;<?php echo JText::_('JSAVE') ?>
				</button>
			</div>
			<div class="btn-group">
				<button type="button" class="btn" onclick="Joomla.submitbutton('ls05.cancel')">
					<span class="icon-cancel"></span>&#160;<?php echo JText::_('JCANCEL') ?>
				</button>
			</div>
		</div>		