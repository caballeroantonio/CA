
# Proceso para migrar datos de scraping vivanuncios a remca.houses



# almacena el ultimo rem_houses.id
SELECT 
@ordering:= AUTO_INCREMENT - 1 'AUTO_INCREMENT'
FROM  INFORMATION_SCHEMA.TABLES t
WHERE 1
AND t.TABLE_SCHEMA = DATABASE()
AND t.TABLE_NAME LIKE '%rem_houses';

#integridad referencial rh.id = va.id_remhouse
SET FOREIGN_KEY_CHECKS=0;
UPDATE
vivanuncios_items va
LEFT JOIN jos_rem_houses rh ON rh.id = va.id_remhouse
SET va.id_remhouse = @ordering := @ordering + 1
WHERE 1
AND rh.id IS NULL
;
SET FOREIGN_KEY_CHECKS=1;

#insertar registros de va a rh
INSERT INTO jos_rem_houses (`id`, `description`, `link`, `price`, `name`, `hcountry`, `hregion`, `hcity`, `hzipcode`, `hlocation`, `hlatitude`, `hlongitude`, `bathrooms`, `bedrooms`, `year`, `agent`, `image_link`)
SELECT 
va.id_remhouse, va.body, LEFT(va.url_pagina, 250) AS 'url_pagina', CAST(va.price AS SIGNED) AS 'price', LEFT(va.title, 200) AS 'title',
LEFT(va.country, 50) AS 'country', LEFT(va.state, 50) AS 'state', LEFT(va.city, 50) AS 'city', LEFT(va.zip_propiedad, 50) AS 'zip_propiedad',
LEFT(va.address, 100) AS 'address', LEFT(va.latitude, 20) AS 'latitude', LEFT(va.longitude, 20) AS 'longitude', va.bath, va.beds,
LEFT(va.year, 4) AS 'year', LEFT(va.nombre_vendedor, 45) AS 'nombre_vendedor', LEFT(va.image_name, 200) AS 'image_name'
FROM vivanuncios_items va
LEFT JOIN jos_rem_houses rh ON rh.id = va.id_remhouse
WHERE 1
AND rh.id IS NULL;

#insertar registros de rh a rc
INSERT INTO jos_rem_categories (iditem, idcat)
SELECT rh.id AS 'iditem', coalesce(rc.idcat, 1) AS 'idcat'
FROM jos_rem_houses rh
LEFT JOIN jos_rem_categories rc ON rc.iditem = rh.id
WHERE 1
AND rc.id IS NULL
;


#agregar constantes faltantes
UPDATE vivanuncios_items va
INNER JOIN jos_rem_houses rh ON rh.id = va.id_remhouse
SET rh.state = 1, rh.listing_type = 0, rh.priceunit = 'USD', rh.map_zoom = 14
;





# Actualizacion de id_country, id_state, id_municipality (vivanuncios -> houses)
UPDATE
/*
SELECT 
h.id, 

va.country, 
coalesce(c.id, 0), 
c.name, 

va.state, 
coalesce(s.id, 0), 
s.name, 

va.city, 
coalesce(m.id, 0), 
m.name 

FROM 
*/
jos_rem_houses h
INNER JOIN vivanuncios_items va ON h.id = va.id_remhouse 
LEFT JOIN jos_rem_countries c ON c.name = va.country and c.id not in (1002)
LEFT JOIN jos_rem_states s ON s.id_country = c.id AND (s.name = va.state or s.state = va.state)
LEFT JOIN jos_rem_municipalities m ON m.id_state = s.id AND m.name = va.city


SET 
h.id_country = coalesce(c.id, 0), 
h.id_state = coalesce(s.id, 0), 
h.id_municipality = coalesce(m.id, 0)

;


# Actualizacion de catid (vivanuncios -> houses) 
UPDATE
/*
SELECT 
count(h.id)

, va.tipoLetra
, coalesce(c.id, 0)
, c.title

FROM 
*/
vivanuncios_items va
INNER JOIN jos_rem_houses h ON h.id = va.id_remhouse 
LEFT JOIN jos_categories c ON c.title = va.tipoLetra


SET 
h.catid = coalesce(c.id, 0)

;




# jos_categories para remca
INSERT INTO `jos_categories` (`asset_id`,`parent_id`,`lft`,`rgt`,`level`,`path`,`extension`,`title`,`alias`,`note`,`description`,`published`,`checked_out`,`checked_out_time`,`access`,`params`,`metadesc`,`metakey`,`metadata`,`created_user_id`,`created_time`,`modified_user_id`,`modified_time`,`hits`,`language`,`version`) VALUES
(32,1,9,10,1,'uncategorised','com_remca','uncategorised','uncategorised','','',1,0,'0000-00-00 00:00:00',1,'{\"category_layout\":\"\",\"image\":\"\"}','','','{\"author\":\"\",\"robots\":\"\"}',42,'2011-01-01 00:00:01',0,'0000-00-00 00:00:00',0,'*',1)
, (75,1,11,12,1,'desarrollo','com_remca','Desarrollo','desarrollo','','',1,0,'0000-00-00 00:00:00',1,'{\"category_layout\":\"\",\"image\":\"\",\"image_alt\":\"\"}','','','{\"author\":\"\",\"robots\":\"\"}',1,'2018-03-10 00:31:41',1,'2018-03-10 00:31:51',0,'*',1)
, (76,1,13,14,1,'departamentos-en-venta','com_remca','Departamentos en Venta','departamentos-en-venta','','',1,0,'0000-00-00 00:00:00',1,'{\"category_layout\":\"\",\"image\":\"\",\"image_alt\":\"\"}','','','{\"author\":\"\",\"robots\":\"\"}',1,'2018-03-10 00:32:02',1,'2018-03-10 00:32:09',0,'*',1)
, (77,1,15,16,1,'casas-en-venta','com_remca','Casas en Venta','casas-en-venta','','',1,0,'0000-00-00 00:00:00',1,'{\"category_layout\":\"\",\"image\":\"\",\"image_alt\":\"\"}','','','{\"author\":\"\",\"robots\":\"\"}',1,'2018-03-10 00:32:31',1,'2018-03-10 00:32:37',0,'*',1)
;




SELECT 
	h.id
    , h.name 'house'
    , c.title 'category'
    , ct.name 'contry'
    , st.name 'state'
    , mn.name 'municipality'
FROM 
	jos_rem_houses h
INNER JOIN jos_categories c ON c.id = h.catid
LEFT JOIN jos_rem_countries ct ON ct.id = h.id_country
LEFT JOIN jos_rem_states st ON st.id_country = ct.id AND st.id = h.id_state
LEFT JOIN jos_rem_municipalities mn ON mn.id_state = st.id AND mn.id = h.id_municipality

;