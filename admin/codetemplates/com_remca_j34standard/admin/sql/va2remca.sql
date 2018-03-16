# Proceso para migrar datos de scraping vivanuncios a remca.houses
CREATE TABLE `scrpng_vivanuncios` (
  `idPropiedad` text,
  `category_id` int(11) DEFAULT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type_popiedad` text,
  `title` text,
  `slug` text,
  `body` text,
  `image_name` text,
  `image_ext` text,
  `meta_keywords` text,
  `meta_desc` text,
  `status` int(11) DEFAULT NULL,
  `create_date` text,
  `updated_at` text,
  `address` text,
  `city` text,
  `state` text,
  `zip_propiedad` text,
  `country` text,
  `latitude` text,
  `longitude` text,
  `price` int(11) DEFAULT NULL,
  `beds` int(11) DEFAULT NULL,
  `services` text,
  `characteristics` text,
  `bath` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `features` text,
  `is_delete` int(11) DEFAULT NULL,
  `featured` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `related` text,
  `disponible` int(11) DEFAULT NULL,
  `tipoLetra` text,
  `tipoPublicado` text,
  `url_pagina` text,
  `url_vendedor` text,
  `nombre_vendedor` text,
  `id_anuncio` text,
  `leyenda` text,
  `sitio` text,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_remhouse` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vahouse_idx_idx` (`id_remhouse`),
  CONSTRAINT `fk_vahouse_idx` FOREIGN KEY (`id_remhouse`) REFERENCES `jos_rem_houses` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# almacena el ultimo rem_houses.id
SELECT 
@laih:= AUTO_INCREMENT - 1 'Last AI houses'
FROM  INFORMATION_SCHEMA.TABLES t
WHERE 1
AND t.TABLE_SCHEMA = DATABASE()
AND t.TABLE_NAME LIKE '%rem_houses';

# condiciones iniciales, cargué la información del CSV
SET @laih := 1; # Last AI houses - 1
DELETE FROM jos_rem_houses WHERE id > @laih;
SET @ordering := @laih;

# copy empty records to houses
INSERT INTO jos_rem_houses (id, description, images, state)
SELECT @ordering := @ordering + 1 AS 'id', '' AS 'description', '' AS 'images', 1 AS state 
FROM scrpng_vivanuncios va
;

# refer va.fk to h.pk empty records
SET @ordering := @laih;
UPDATE scrpng_vivanuncios
SET id_remhouse = @ordering := @ordering + 1
;

# update all values
UPDATE jos_rem_houses h
LEFT JOIN scrpng_vivanuncios va ON va.id_remhouse = h.id
SET 
h.description = coalesce(va.body, ''),
h.link = coalesce(va.url_pagina, ''),
h.price = coalesce(va.price, 0.00),
h.name = coalesce(va.title, ''),
h.hcountry = coalesce(va.country, ''),
h.hregion = coalesce(va.state, ''),
h.hcity = coalesce(va.city, ''),
h.hzipcode = coalesce(va.zip_propiedad, ''),
h.hlocation = coalesce(va.address, ''),
h.hlatitude = coalesce(va.latitude, ''),
h.hlongitude = coalesce(va.longitude, ''),
h.bathrooms = coalesce(va.bath, 0),
h.bedrooms = coalesce(va.beds, 0),
h.year = coalesce(va.year, ''),
h.agent = LEFT(coalesce(va.nombre_vendedor, ''), 45),
h.image_link = coalesce(va.image_name, '')
# WHERE va.id BETWEEN 60000 AND 70000
;

/**
* set country, mejorarlo quitando h.hcountry, h.hregion, h.hcity y agregando un va.id_country,
* id_lstate, y realizando este preoceso antes de copiar registros.
*/
 
UPDATE
scrpng_vivanuncios va
INNER JOIN jos_rem_houses h ON h.id = va.id_remhouse
INNER JOIN jos_rem_countries c ON c.name LIKE va.country AND c.state = 1
SET h.id_country = c.id
;

UPDATE 
scrpng_vivanuncios va 
INNER JOIN jos_rem_houses h ON h.id = va.id_remhouse 
INNER JOIN jos_rem_lstates l ON l.id_country = h.id_country 
    AND l.friendly_name LIKE va.state 
SET h.id_lstate = l.id

UPDATE
scrpng_vivanuncios va
INNER JOIN jos_rem_houses h ON h.id = va.id_remhouse
INNER JOIN jos_rem_lmunicipalities l ON l.id_country = h.id_country 
    AND l.id_lstate = h.id_lstate
    AND l.name LIKE va.city
SET h.id_lmunicipality = l.id
WHERE 1
AND h.id_country
AND h.id_lstate
;

-- 
-- En revisión, lo de abajo no lo he aprobado de nuevo.
-- 



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
SET rh.listing_type = 0
;
