<?php 
	//libraries\cms\html\bootstrap.php
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

				echo JHtml::_(
					'bootstrap.renderModal', //atajo
					'collapseModal', //selector jQuery('#collapseModal')
					array(
						'title'  => 'titulo',
						'footer' => $this->loadTemplate('footer'),
						'height' => 450,
						'url' => new JUri('index.php?option=com_jtsca&view=expedientes&layout=modal&tmpl=component&function=on_collapseModal')
					),
					$this->loadTemplate('body')
				); 
?>
<button data-toggle="modal" data-target="#collapseModal" class="btn btn-small">
	<i class="icon-checkbox-partial" title="title"></i>ejemplo modal
</button>
<a onclick="show_collapseModal()">show_collapseModal</a>

<?php /*?>
	<?php 
	//ya es basura
	
        $fieldset = $this->form->getFieldset('fieldset_[%%compobject%%]_fs');
        $field = $fieldset['jform_id_expediente'];
        $fieldname = (string) $field->fieldname;
        echo $this->form->renderField($fieldname, null, null, array('group_id' => 'field_'.$fieldname));
	$uri = new JUri('index.php?option=[%%com_architectcomp%%]&view=expedientes&layout=modal&tmpl=component&function=jSelectExpediente_jform_id_expediente');
	?>
	<a class="modal btn" title="Ejemplo modal código HTML"  href="<?= $uri ?>" rel="{handler: 'iframe', size: {x: 800, y: 450}}"><i class="icon-file"></i> Select Expediente</a></li>
<?php */?>


<script language="javascript">
function show_collapseModal(){
	jQuery('#collapseModal').modal('show');
	return;
}
function on_collapseModal(id, name, object){
	console.log(id);
	return;
}
</script>
