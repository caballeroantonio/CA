-- @version 		$Id:$
-- @name			RealEstateManagerCA
-- @author			caballeroantonio (caballeroantonio.com)
-- @package			com_remca
-- @subpackage		com_remca.admin
-- @copyright		
-- @license			GNU General Public License version 3 or later - See http://www.gnu.org/copyleft/gpl.html
--
-- The following Component Architect header section must remain in any distribution of this file
--
-- @CAversion		Id:install.architectcomp_mysql.utf8.sql 19 2012-01-12 16:33:49Z BrianWade $
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
-- Referential integrity
--

# root category - uncategorised
INSERT INTO `#__categories` (`asset_id`,`parent_id`,`lft`,`rgt`,`level`,`path`,`extension`,`title`,
`alias`,`note`,`description`,
`published`,`checked_out`,`checked_out_time`,`access`,`params`,
`metadesc`,`metakey`,`metadata`,`created_user_id`,`created_time`,`modified_user_id`,`modified_time`,`hits`,`language`,`version`) VALUES 
(0,1,1,2,1,'remca-house-categories','com_remca','uncategorised',
'remca-house-uncategorised','','Root Remca House uncategorised',
1,0,'0000-00-00 00:00:00',1,'{\"category_layout\":\"\",\"image\":\"\",\"image_alt\":\"\"}','','','{\"author\":\"\",\"robots\":\"\"}',1,'2011-01-01 00:00:01',0,'0000-00-00 00:00:00',0,'*',0);

SET FOREIGN_KEY_CHECKS=0;
SET SESSION sql_mode='NO_AUTO_VALUE_ON_ZERO';

#[%%START_CUSTOM_CODE%%]
INSERT IGNORE INTO `#__users` (`id`, `name`, `username`, `email`) VALUES ('0', 'undefined', 'undefined', 'undefined');
#[%%END_CUSTOM_CODE%%]

INSERT IGNORE INTO `#__rem_houses` (`id`, `name`, `description`, `ordering`, `state`) VALUES (0, "undefined", "undefined default option", 0, 0);

INSERT IGNORE INTO `#__rem_houses` (`id`, `name`, `description`, `ordering`, `state`) VALUES (0, "undefined", "undefined default option", 0, 0);

INSERT IGNORE INTO `#__rem_main_categories` (`id`, `name`, `description`, `ordering`, `state`) VALUES (0, "undefined", "undefined default option", 0, 0);

INSERT IGNORE INTO `#__rem_const` (`id`, `name`) VALUES (0, "undefined");

INSERT IGNORE INTO `#__rem_languages` (`id`, `name`) VALUES (0, "undefined");

INSERT IGNORE INTO `#__rem_houses` (`id`, `name`, `description`, `ordering`, `state`) VALUES (0, "undefined", "undefined default option", 0, 0);

INSERT IGNORE INTO `#__rem_feature` (`id`, `name`, `state`) VALUES (0, "undefined", 0);

INSERT IGNORE INTO `#__rem_rent` (`id`, `name`) VALUES (0, "undefined");

INSERT IGNORE INTO `#__rem_houses` (`id`, `name`, `description`, `ordering`, `state`) VALUES (0, "undefined", "undefined default option", 0, 0);

INSERT IGNORE INTO `#__rem_orders` (`id`, `name`) VALUES (0, "undefined");

INSERT IGNORE INTO `#__rem_houses` (`id`, `name`, `description`, `ordering`, `state`) VALUES (0, "undefined", "undefined default option", 0, 0);

INSERT IGNORE INTO `#__rem_houses` (`id`, `name`, `description`, `ordering`, `state`) VALUES (0, "undefined", "undefined default option", 0, 0);

INSERT IGNORE INTO `#__rem_houses` (`id`, `name`, `description`, `ordering`, `state`) VALUES (0, "undefined", "undefined default option", 0, 0);

INSERT IGNORE INTO `#__rem_houses` (`id`, `name`, `description`, `ordering`, `state`) VALUES (0, "undefined", "undefined default option", 0, 0);

INSERT IGNORE INTO `#__rem_houses` (`id`, `name`, `description`, `ordering`, `state`) VALUES (0, "undefined", "undefined default option", 0, 0);

INSERT IGNORE INTO `#__rem_houses` (`id`, `name`, `description`, `ordering`, `state`) VALUES (0, "undefined", "undefined default option", 0, 0);

INSERT IGNORE INTO `#__rem_houses` (`id`, `name`, `description`, `ordering`, `state`) VALUES (0, "undefined", "undefined default option", 0, 0);

INSERT IGNORE INTO `#__rem_houses` (`id`, `name`, `description`, `ordering`, `state`) VALUES (0, "undefined", "undefined default option", 0, 0);

INSERT IGNORE INTO `#__rem_lstates` (`id`, `name`, `ordering`, `state`) VALUES (0, "undefined", 0, 0);

INSERT IGNORE INTO `#__rem_countries` (`id`, `name`, `ordering`, `state`) VALUES (0, "undefined", 0, 0);

INSERT IGNORE INTO `#__rem_lmunicipalities` (`id`, `name`, `ordering`, `state`) VALUES (0, "undefined", 0, 0);

INSERT IGNORE INTO `#__rem_lstates` (`id`, `name`, `ordering`, `state`) VALUES (0, "undefined", 0, 0);

INSERT IGNORE INTO `#__rem_countries` (`id`, `name`, `ordering`, `state`) VALUES (0, "undefined", 0, 0);

INSERT IGNORE INTO `#__rem_countries` (`id`, `name`, `ordering`, `state`) VALUES (0, "undefined", 0, 0);

--					
-- CUSTOM CODE es necesario modificar ca.fields.mysql_size para que acepte INT UNSIGNED porque de otro modo no se pueden los constraints					
--

ALTER TABLE `#__rem_buying_request` ADD CONSTRAINT `fk2919_fk_houseid`
FOREIGN KEY (`fk_houseid`) REFERENCES `#__rem_houses` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_buying_request` ADD CONSTRAINT `fk2920_fk_userid`
FOREIGN KEY (`fk_userid`) REFERENCES `#__users` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_categories` ADD CONSTRAINT `fk2927_iditem`
FOREIGN KEY (`iditem`) REFERENCES `#__rem_houses` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_categories` ADD CONSTRAINT `fk2928_idcat`
FOREIGN KEY (`idcat`) REFERENCES `#__rem_main_categories` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_const_language` ADD CONSTRAINT `fk2931_fk_constid`
FOREIGN KEY (`fk_constid`) REFERENCES `#__rem_const` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_const_language` ADD CONSTRAINT `fk2932_fk_languagesid`
FOREIGN KEY (`fk_languagesid`) REFERENCES `#__rem_languages` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_feature_houses` ADD CONSTRAINT `fk2937_fk_houseid`
FOREIGN KEY (`fk_houseid`) REFERENCES `#__rem_houses` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_feature_houses` ADD CONSTRAINT `fk2938_fk_featureid`
FOREIGN KEY (`fk_featureid`) REFERENCES `#__rem_feature` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_houses` ADD CONSTRAINT `fk2941_fk_rentid`
FOREIGN KEY (`fk_rentid`) REFERENCES `#__rem_rent` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_houses` ADD CONSTRAINT `fk2990_owner_id`
FOREIGN KEY (`owner_id`) REFERENCES `#__users` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_orders` ADD CONSTRAINT `fk3010_fk_user_id`
FOREIGN KEY (`fk_user_id`) REFERENCES `#__users` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_orders` ADD CONSTRAINT `fk3015_fk_house_id`
FOREIGN KEY (`fk_house_id`) REFERENCES `#__rem_houses` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_orders_details` ADD CONSTRAINT `fk3024_fk_order_id`
FOREIGN KEY (`fk_order_id`) REFERENCES `#__rem_orders` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_orders_details` ADD CONSTRAINT `fk3025_fk_user_id`
FOREIGN KEY (`fk_user_id`) REFERENCES `#__users` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_orders_details` ADD CONSTRAINT `fk3030_fk_house_id`
FOREIGN KEY (`fk_house_id`) REFERENCES `#__rem_houses` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_photos` ADD CONSTRAINT `fk3040_fk_houseid`
FOREIGN KEY (`fk_houseid`) REFERENCES `#__rem_houses` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_rent` ADD CONSTRAINT `fk3044_fk_houseid`
FOREIGN KEY (`fk_houseid`) REFERENCES `#__rem_houses` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_rent` ADD CONSTRAINT `fk3045_fk_userid`
FOREIGN KEY (`fk_userid`) REFERENCES `#__users` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_rent_request` ADD CONSTRAINT `fk3052_fk_houseid`
FOREIGN KEY (`fk_houseid`) REFERENCES `#__rem_houses` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_rent_request` ADD CONSTRAINT `fk3053_fk_userid`
FOREIGN KEY (`fk_userid`) REFERENCES `#__users` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_rent_sal` ADD CONSTRAINT `fk3061_fk_houseid`
FOREIGN KEY (`fk_houseid`) REFERENCES `#__rem_houses` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_review` ADD CONSTRAINT `fk3072_fk_houseid`
FOREIGN KEY (`fk_houseid`) REFERENCES `#__rem_houses` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_review` ADD CONSTRAINT `fk3073_fk_userid`
FOREIGN KEY (`fk_userid`) REFERENCES `#__users` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_track_source` ADD CONSTRAINT `fk3081_fk_house_id`
FOREIGN KEY (`fk_house_id`) REFERENCES `#__rem_houses` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_video_source` ADD CONSTRAINT `fk3091_fk_house_id`
FOREIGN KEY (`fk_house_id`) REFERENCES `#__rem_houses` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_lmunicipalities` ADD CONSTRAINT `fk3447_id_lstate`
FOREIGN KEY (`id_lstate`) REFERENCES `#__rem_lstates` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_lstates` ADD CONSTRAINT `fk3449_id_country`
FOREIGN KEY (`id_country`) REFERENCES `#__rem_countries` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_houses` ADD CONSTRAINT `fk3457_id_lmunicipality`
FOREIGN KEY (`id_lmunicipality`) REFERENCES `#__rem_lmunicipalities` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_houses` ADD CONSTRAINT `fk3458_id_lstate`
FOREIGN KEY (`id_lstate`) REFERENCES `#__rem_lstates` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_houses` ADD CONSTRAINT `fk3459_id_country`
FOREIGN KEY (`id_country`) REFERENCES `#__rem_countries` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
										
ALTER TABLE `#__rem_lmunicipalities` ADD CONSTRAINT `fk3463_id_country`
FOREIGN KEY (`id_country`) REFERENCES `#__rem_countries` (`id`)
ON DELETE RESTRICT ON UPDATE CASCADE;
					
--
-- CUSTOM CODE
--				

SET FOREIGN_KEY_CHECKS=1;
SET SESSION sql_mode='';
