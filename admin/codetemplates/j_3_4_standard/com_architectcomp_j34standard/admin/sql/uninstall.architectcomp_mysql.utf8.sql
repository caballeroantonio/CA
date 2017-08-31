-- @tempversion
-- @name			[%%ArchitectComp_name%%] (Release [%%COMPONENTSTARTVERSION%%])
-- @author			[%%COMPONENTAUTHOR%%] ([%%COMPONENTWEBSITE%%])
-- @package			[%%com_architectcomp%%]
-- @subpackage		[%%com_architectcomp%%].admin
-- @copyright		[%%COMPONENTCOPYRIGHT%%]
-- @license			GNU General Public License version 3 or later - See http://www.gnu.org/copyleft/gpl.html 
--
-- The following Component Architect header section must remain in any distribution of this file
--
-- @version			$Id:uninstall.architectcomp_mysql.utf8.sql 19 2012-01-12 16:33:49Z BrianWade $
-- @CAauthor		Component Architect (www.componentarchitect.com)
-- @CApackage		architectcomp
-- @CAsubpackage	architectcomp.admin
-- @CAtemplate		joomla_3_4_standard (Release 1.0.1)
-- @CAcopyright		Copyright (c)2013 - 2016  Simply Open Source Ltd. (trading as Component Architect). All Rights Reserved
-- @CAlicense		GNU General Public License version 3 or later - See http://www.gnu.org/copyleft/gpl.html
--
-- This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by
-- the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
--
-- This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY, without even the implied warranty of
-- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
-- --------------------------------------------------------
--
-- Uninstall of `#__[%%architectcomp%%]` tables
--
[%%FOREACH COMPONENT_OBJECT%%]
DROP TABLE IF EXISTS `[%%compobjectprefix%%][%%architectcomp%%]_[%%compobjectplural%%]`;
DELETE FROM #__content_types WHERE `type_alias` = '[%%com_architectcomp%%].[%%compobject%%]';
DELETE FROM `#__menu` WHERE `title`='[%%COM_ARCHITECTCOMP%%]_[%%COMPOBJECTPLURAL%%]' AND `type`='component';
[%%ENDFOR COMPONENT_OBJECT%%]

[%%IF GENERATE_PLUGINS_VOTE%%] 
DROP TABLE IF EXISTS `#__[%%architectcomp%%]_rating`;
[%%ENDIF GENERATE_PLUGINS_VOTE%%] 

DELETE FROM `#__assets` WHERE `name` LIKE '%[%%com_architectcomp%%]%';
DELETE FROM `#__extensions` WHERE `name`='[%%com_architectcomp%%]' AND `type`='component';
DELETE FROM `#__menu` WHERE `title`='[%%COM_ARCHITECTCOMP%%]' AND `type`='component';

[%%IF GENERATE_CATEGORIES%%] 
DELETE FROM `#__categories` WHERE `extension`='[%%com_architectcomp%%]';
DELETE FROM #__content_types WHERE `type_alias` = '[%%com_architectcomp%%].category';
DELETE FROM `#__menu` WHERE `title`='[%%COM_ARCHITECTCOMP%%]_CATEGORIES' AND `type`='component';
[%%ENDIF GENERATE_CATEGORIES%%]
