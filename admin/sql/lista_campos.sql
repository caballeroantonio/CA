#UPDATE
#/*
SELECT 
co.name 'co.name', fs.code_name 'fs.codename' , f.name 'f.name'
, co.description
FROM 
#*/
jpruebas.jos_componentarchitect_fields f
INNER JOIN jos_componentarchitect_fieldsets fs ON fs.id = f.fieldset_id
INNER JOIN jos_componentarchitect_componentobjects co ON co.id = fs.component_object_id AND co.id = f.component_object_id
INNER JOIN jos_componentarchitect_components c ON c.id = co.component_id AND c.id = fs.component_id AND c.id = f.component_id
#SET co.state = 1, co.default_fieldset_id = f.fieldset_id
WHERE 1
GROUP BY co.id
#ORDER BY f.id 
