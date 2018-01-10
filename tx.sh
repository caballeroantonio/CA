#!/bin/bash

ADMIN_SQL_UPDATES_MYSQL=admin/sql/updates/mysql

# This program dump CA definitions
mysqldump --no-defaults --host=localhost --user=root --password=4833 --protocol=tcp  --lock-tables=FALSE --port=3306 --comments=TRUE --dump-date=FALSE --default-character-set=utf8 --skip-triggers --no-data=FALSE --no-create-db --routines=FALSE --events=FALSE --force --compact=FALSE --databases jpruebas --tables jos_componentarchitect_codetemplates jos_componentarchitect_componentobjects jos_componentarchitect_components jos_componentarchitect_fields jos_componentarchitect_fieldsets jos_componentarchitect_fieldtypes jos_categories > $ADMIN_SQL_UPDATES_MYSQL/ca.sql
sed --in-place 's/),(/),\r\n(/g' $ADMIN_SQL_UPDATES_MYSQL/ca.sql

# This program dump NO CA definitions
mysqldump --no-defaults --host=localhost --user=root --password=4833 --protocol=tcp  --lock-tables=FALSE --port=3306 --comments=TRUE --dump-date=FALSE --default-character-set=utf8 --skip-triggers --no-data=FALSE --no-create-db --routines=FALSE --events=FALSE --force --compact=FALSE --databases gpcb --tables jtc_libros jt3_campos > $ADMIN_SQL_UPDATES_MYSQL/no_ca.sql
sed --in-place 's/),(/),\r\n(/g' $ADMIN_SQL_UPDATES_MYSQL/no_ca.sql

##después de editar properties y antes de compilar
#The encoded file to be converted to ASCII, can't be netbeans properties because generate two bytes for each quote, like ó => \u00c3\u00b3
ADMIN_LANGUAGE_EN_GB=admin/codetemplates/j_3_4_standard/com_architectcomp_j34standard/admin/language/en-GB
native2ascii -encoding UTF-8 -reverse $ADMIN_LANGUAGE_EN_GB/com_architectcomp_es_ES.properties $ADMIN_LANGUAGE_EN_GB/../es-ES/es-ES.com_architectcomp.ini

## despues de compilar
#Cambio de nombre de tablas para el componente jtca
TMP_JTCA="D:/www/htdocs/JPruebas/tmp/com_jtca_j34standard"
sed -i 's/#__jtca_/jt_/' $(find $TMP_JTCA -type f -not -name "*.png" | grep -v .git)