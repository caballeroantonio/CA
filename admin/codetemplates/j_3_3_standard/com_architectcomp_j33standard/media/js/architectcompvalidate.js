/**
 * @tempversion
 * @name			[%%ArchitectComp_name%%] (Release [%%COMPONENTSTARTVERSION%%])
 * @author			[%%COMPONENTAUTHOR%%] ([%%COMPONENTWEBSITE%%])
 * @package			[%%com_architectcomp%%]
 * @subpackage		[%%com_architectcomp%%].admin
 * @copyright		[%%COMPONENTCOPYRIGHT%%]
 * @license			GNU General Public License version 3 or later; See http://www.gnu.org/copyleft/gpl.html 
 * 
 * The following Component Architect header section must remain in any distribution of this file
 *
 * @version			$Id: architectcompvalidate.js 572 2016-01-04 15:03:33Z BrianWade $
 * @CAauthor		Component Architect (www.componentarchitect.com)
 * @CApackage		architectcomp
 * @CAsubpackage	architectcomp.admin
 * @CAtemplate		joomla_3_3_standard (Release 1.0.5)
 * @CAcopyright		Copyright (c)2013 - 2016  Simply Open Source Ltd. (trading as Component Architect). All Rights Reserved
 * @CAlicense		GNU General Public License version 3 or later; See http://www.gnu.org/copyleft/gpl.html
 * 
 * This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
 */
 
window.addEvent('domready', function() {
	document.formvalidator.setHandler('webaddress',
		function (value) {
			regex=/.*/;
			return regex.test(value);
	});
[%%FOREACH COMPONENT_OBJECT%%]
[%%FOREACH VALIDATE_FIELD%%]
	document.formvalidator.setHandler('[%%FIELD_VALIDATE_NAME%%]',
		function (value) {
			regex=/[%%FIELD_ALLOWED_INPUT%%]/;
			return regex.test(value);
	});
[%%ENDFOR VALIDATE_FIELD%%] 
[%%ENDFOR COMPONENT_OBJECT%%]	
});
