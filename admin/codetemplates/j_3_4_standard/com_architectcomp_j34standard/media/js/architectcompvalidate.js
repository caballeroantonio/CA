/**
 * @tempversion
 * @name			[%%ArchitectComp_name%%]
 * @author			[%%COMPONENTAUTHOR%%] ([%%COMPONENTWEBSITE%%])
 * @package			[%%com_architectcomp%%]
 * @subpackage		[%%com_architectcomp%%].admin
 * @copyright		[%%COMPONENTCOPYRIGHT%%]
 * @license			GNU General Public License version 3 or later; See http://www.gnu.org/copyleft/gpl.html 
 * 
 * The following Component Architect header section must remain in any distribution of this file
 *
 * @version			$Id: architectcompvalidate.js 571 2016-01-04 15:03:02Z BrianWade $
 * @CAauthor		Component Architect (www.componentarchitect.com)
 * @CApackage		architectcomp
 * @CAsubpackage	architectcomp.admin
 * @CAtemplate		joomla_3_4_standard (Release 1.0.1)
 * @CAcopyright		Copyright (c)2013 - 2016  Simply Open Source Ltd. (trading as Component Architect). All Rights Reserved
 * @CAlicense		GNU General Public License version 3 or later; See http://www.gnu.org/copyleft/gpl.html
 * 
 * This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
 */
 
jQuery(function() {
	document.formvalidator.setHandler('webaddress',
		function (value) {
			regex=/.*/;
			return regex.test(value);
	});
	document.formvalidator.setHandler('date',
		function (value) {
			regex=/^(|\d{4}-\d{2}-\d{2}|\d{4}-\d{2}-\d{2} (\d{2}:){0,2}\d{2})$/;//empty|%Y-%m-%d|%Y-%m-%d %H:%M
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
