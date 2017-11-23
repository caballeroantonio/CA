#!/bin/bash
#
# This program dump CA definitions

#

mysqldump --no-defaults --host=localhost --user=root --password=4833 --protocol=tcp  --lock-tables=FALSE --port=3306 --comments=TRUE --dump-date=FALSE --default-character-set=utf8 --skip-triggers --no-data=FALSE --no-create-db --routines=FALSE --events=FALSE --force --compact=FALSE --databases jpruebas --tables jos_componentarchitect_codetemplates jos_componentarchitect_componentobjects jos_componentarchitect_components jos_componentarchitect_fields jos_componentarchitect_fieldsets jos_componentarchitect_fieldtypes jos_componentarchitect_sessiondata > ca.sql

mysqldump --no-defaults --host=localhost --user=root --password=4833 --protocol=tcp  --lock-tables=FALSE --port=3306 --comments=TRUE --dump-date=FALSE --default-character-set=utf8 --skip-triggers --no-data=FALSE --no-create-db --routines=FALSE --events=FALSE --force --compact=FALSE --databases gpcb --tables jtc_libros jt3_campos > no_ca.sql

sed --in-place 's/),(/),\r\n(/g' ca.sql
sed --in-place 's/),(/),\r\n(/g' no_ca.sql