#!/bin/bash

ADMIN_SQL_UPDATES_MYSQL=admin/sql/updates/mysql

# This program dump CA definitions
mysqldump --defaults-file=~/my.ini --protocol=tcp  --lock-tables=FALSE --port=3306 --comments=TRUE --dump-date=FALSE --default-character-set=utf8 --skip-triggers --no-data=FALSE --no-create-db --routines=FALSE --events=FALSE --force --compact=FALSE --databases jpruebas --tables jos_componentarchitect_codetemplates jos_componentarchitect_componentobjects jos_componentarchitect_components jos_componentarchitect_fields jos_componentarchitect_fieldsets jos_componentarchitect_fieldtypes jos_categories > $ADMIN_SQL_UPDATES_MYSQL/ca.sql
sed --in-place 's/),(/),\r\n(/g' $ADMIN_SQL_UPDATES_MYSQL/ca.sql


## despues de compilar en CA
TMP_BUILD="D:/www/htdocs/JPruebas/tmp/com_remca_j34standard"
sed -i 's/#__remca_jusers/#__users/' $(find $TMP_BUILD -type f -not -name "*.png" | grep -v .git)
sed -i 's/#__remca_/#__rem_/' $(find $TMP_BUILD -type f -not -name "*.png" | grep -v .git)