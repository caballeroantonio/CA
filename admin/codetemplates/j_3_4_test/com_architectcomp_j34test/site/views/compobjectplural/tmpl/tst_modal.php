<?php 
	// en libraries\cms\html\bootstrap.php se encuentra el snippet:
	/**
	 * Method to render a Bootstrap modal
	 *
	 * @param   string  $selector  The ID selector for the modal.
	 * @param   array   $params    An array of options for the modal.
	 *                             Options for the modal can be:
	 *                             - title        string   The modal title
	 *                             - backdrop     mixed    A boolean select if a modal-backdrop element should be included (default = true)
	 *                                                     The string 'static' includes a backdrop which doesn't close the modal on click.
	 *                             - keyboard     boolean  Closes the modal when escape key is pressed (default = true)
	 *                             - closeButton  boolean  Display modal close button (default = true)
	 *                             - animation    boolean  Fade in from the top of the page (default = true)
	 *                             - footer       string   Optional markup for the modal footer
	 *                             - url          string   URL of a resource to be inserted as an `<iframe>` inside the modal body
	 *                             - height       string   height of the `<iframe>` containing the remote resource
	 *                             - width        string   width of the `<iframe>` containing the remote resource
	 * @param   string  $body      Markup for the modal body. Appended after the `<iframe>` if the URL option is set
	 *
	 * @return  string  HTML markup for a modal
	 *
	 * @since   3.0
	 */
//	public static function renderModal($selector = 'modal', $params = array(), $body = '')
?>
<?php /*?><!--  begin código generado por el snippet-->
<link href="/borrame/media/jui/css/bootstrap-tooltip-extended.css?token" rel="stylesheet" />
<script src="/borrame/media/jui/js/bootstrap-tooltip-extended.min.js?token"></script>
jQuery(document).ready(function($) {
   $('#collapseModal')
   .on('show.bs.modal', function() {
       $('body').addClass('modal-open');
       var modalBody = $(this).find('.modal-body');
       modalBody.find('iframe').remove();
       modalBody.prepend('<iframe class="iframe" src="/borrame/index.php?option=com_remca&view=houses&layout=tst_empty&tmpl=component&function=on_collapseModal" name="titulo" height="450"></iframe>');
   })
   .on('shown.bs.modal', function() {
       var modalHeight = $('div.modal:visible').outerHeight(true),
           modalHeaderHeight = $('div.modal-header:visible').outerHeight(true),
           modalBodyHeightOuter = $('div.modal-body:visible').outerHeight(true),
           modalBodyHeight = $('div.modal-body:visible').height(),
           modalFooterHeight = $('div.modal-footer:visible').outerHeight(true),
           padding = document.getElementById('collapseModal').offsetTop,
           maxModalHeight = ($(window).height()-(padding*2)),
           modalBodyPadding = (modalBodyHeightOuter-modalBodyHeight),
           maxModalBodyHeight = maxModalHeight-(modalHeaderHeight+modalFooterHeight+modalBodyPadding);
       var iframeHeight = $('.iframe').height();
       if (iframeHeight > maxModalBodyHeight){;
           $('.modal-body').css({'max-height': maxModalBodyHeight, 'overflow-y': 'auto'});
           $('.iframe').css('max-height', maxModalBodyHeight-modalBodyPadding);
       }
   })
   .on('hide.bs.modal', function () {
       $('body').removeClass('modal-open');
       $('.modal-body').css({'max-height': 'initial', 'overflow-y': 'initial'});
       $('.modalTooltip').tooltip('destroy');
   });
});

<div id="collapseModal" tabindex="-1" class="modal hide fade">
	<div class="modal-header">
			<button type="button" class="close novalidate" data-dismiss="modal">×</button>
				<h3>titulo</h3>
	</div>
<div class="modal-body">
	soy el body</div>
</div>
<!--  end código generado por el snippet--><?php */?>

<?php
//deshabilitar el snippet
/*				echo JHtml::_(
					'bootstrap.renderModal', //atajo
					'collapseModal', //selector jQuery('#collapseModal')
					array(
						'title'  => 'titulo',
//						'footer' => $this->loadTemplate('footer'),
						'height' => 450,
						'url' => new JUri('index.php?option=[%%com_architectcomp%%]&view=[%%compobjectplural%%]&layout=tst_empty&tmpl=component&function=on_collapseModal')
					),
					$this->loadTemplate('body')
				); */
?>

<!-- con el snippet se repetirá el div -->
<div id="collapseModal" tabindex="-1" class="modal hide fade">
	<div class="modal-header">
			<button type="button" class="close novalidate" data-dismiss="modal">×</button>
				<h3>titulo</h3>
	</div>
<div class="modal-body">
	soy el body</div>
</div>
<code>
con J!_modal puedo navegar libremente en un modal gracias al IFRAME, pero sólo puedo configurar una dirección de inicio.
Con bootstrap_modal puedo cargar multiples direcciones pero no navegar porque se comen al padre.
Quiero aprender a poner iframes dentro de los modales bootstrap pero no he podido.
</code>
<button data-toggle="modal" data-target="#collapseModal" class="btn btn-small">
	<i class="icon-checkbox-partial" title="title"></i>call joomla modal
</button>
<a onclick="show_collapseModal(5)" class="btn btn-small">show joomla modal</a>

<a href="#" data-toggle="modal" data-target="#collapseModal" class="btn btn-small" data-remote="index.php?option=com_remca&view=houses&layout=tst_empty&tmpl=component&function=on_collapseModal" >show bootstrap modal</a>






<script language="javascript">
jQuery(document).ready(function($) {
   $('#collapseModal')
   .on('hide.bs.modal', function (e) {
        $(this).removeData('modal');
   })
   .on('show.bs.modal', {my_data:'e.data.my_data'}, function (e) {
  		console.log(e.data.my_data);
	})
   ;
});
function show_collapseModal(item_id){
	jQuery('#collapsibleModal').modal('show');
	var modalBody = jQuery(document).find('.modal-body');
	modalBody.find('iframe').remove();
	modalBody.prepend('<iframe class="iframe" src="index.php?option=com_remca&task=house.showHistory&item_id='+item_id+'" name="titulo" height="450"></iframe>');
	return;
}
function on_collapseModal(id, name, object){
	console.log(id);
	return;
}
</script>
