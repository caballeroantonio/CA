#UPDATE
#/*
SELECT 
c.id 'c.id',	co.id 'co.id', co.code_name 'co.code_name', co.name 'co.name', 
#fs.id 'fs.id', fs.code_name 'fs.code_name',
f.id 'f.id', f.state, f.code_name 'f.code_name', f.name 'f.name', t.name 't.name', t.id 't.id'
# CONCAT_WS(' ',f.mysql_datatype, f.mysql_size) 'size'#, c3.dataType, c3.id
FROM
#*/
jos_componentarchitect_components c
LEFT JOIN jos_componentarchitect_componentobjects co ON co.component_id = c.id
LEFT JOIN jos_componentarchitect_fieldsets fs ON 		fs.component_id = c.id AND fs.component_object_id = co.id
LEFT JOIN jos_componentarchitect_fields f ON 			 f.component_id = c.id AND  f.component_object_id = co.id AND f.fieldset_id = fs.id 
LEFT JOIN jos_componentarchitect_fieldtypes t ON t.id = f.fieldtype_id
#LEFT JOIN gpcb.jt3_campos c3 ON c3.dataIndex = f.code_name AND c3.clave = co.code_name
#SET f.mysql_size=10
WHERE 1
AND c.id IN (8) 
AND c.id NOT IN (6)#CA component
GROUP BY co.id
ORDER BY c.id, co.ordering, f.state,f.ordering
;


SELECT
#c.id 'c.id',	co.id 'co.id', co.code_name 'co.code_name', co.name 'co.name', 
co.id, co.code_name, co.name,
f.id 'f.id', f.code_name 'f.code_name', f.name 'f.name'
, c3.clave, c3.dataIndex,c3.dataType
, t.name 't.name',CONCAT_WS(' ', f.mysql_datatype, f.mysql_size) 'mysql_datatype size'
FROM
jos_componentarchitect_fields f 
LEFT JOIN jos_componentarchitect_fieldsets fs ON fs.id  = f.fieldset_id
LEFT JOIN jos_componentarchitect_componentobjects co ON co.id = fs.component_object_id AND co.id = f.component_object_id
LEFT JOIN jos_componentarchitect_components c ON c.id = co.component_id AND c.id = fs.component_id AND c.id = f.component_id
LEFT JOIN jos_componentarchitect_fieldtypes t ON t.id = f.fieldtype_id
LEFT JOIN gpcb.jt3_campos c3 ON c3.dataIndex = f.code_name AND c3.clave = co.code_name
WHERE 1
AND c.id = 8
GROUP BY c3.dataType
ORDER BY c.id, co.ordering, f.ordering
;