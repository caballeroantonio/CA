#UPDATE
#D_ELETE f FROM
#/*
SELECT 
c.id 'c.id',	co.id 'co.id', co.code_name 'co.code_name', co.name 'co.name'
#,fs.id 'fs.id', fs.code_name 'fs.code_name'
,f.id 'f.id', f.state, f.code_name 'f.code_name', f.name 'f.name'
#, t.name 't.name', t.id 't.id'
#, CONCAT_WS(' ',f.mysql_datatype, f.mysql_size) 'size'
FROM
#*/
jos_componentarchitect_components c
LEFT JOIN jos_componentarchitect_componentobjects co ON co.component_id = c.id
LEFT JOIN jos_componentarchitect_fieldsets fs ON 		fs.component_id = c.id AND fs.component_object_id = co.id
LEFT JOIN jos_componentarchitect_fields f ON 			 f.component_id = c.id AND  f.component_object_id = co.id AND f.fieldset_id = fs.id 
#LEFT JOIN jos_componentarchitect_fieldtypes t ON t.id = f.fieldtype_id
#LEFT JOIN gpcb.jt3_campos c3 ON c3.dataIndex = f.code_name AND c3.clave = co.code_name
LEFT JOIN gpcb.jtc_libros l ON l.clave = co.code_name
#SET f.state = 2
WHERE 1
#AND c.id NOT IN (6, 3)#CA component,Catalogo General 2
AND c.id = 2
#AND f.code_name NOT IN ('anoj', 'id_organo', 'id_expediente', 'id_secretaria')
#AND co.code_name LIKE 'ls%'
#GROUP BY co.id
#ORDER BY c.id, co.ordering, f.state,f.ordering
;


SELECT
c.id 'c.id',	co.id 'co.id', co.code_name 'co.code_name', co.name 'co.name'
,fs.id 'fs.id', fs.code_name 'fs.code_name'
,f.id 'f.id', f.state, f.code_name 'f.code_name', f.name 'f.name'
#, t.name 't.name', t.id 't.id'
#, CONCAT_WS(' ',f.mysql_datatype, f.mysql_size) 'size'
FROM
jos_componentarchitect_fields f 
LEFT JOIN jos_componentarchitect_fieldsets fs ON fs.id  = f.fieldset_id
LEFT JOIN jos_componentarchitect_componentobjects co ON co.id = fs.component_object_id AND co.id = f.component_object_id
LEFT JOIN jos_componentarchitect_components c ON c.id = co.component_id AND c.id = fs.component_id AND c.id = f.component_id
LEFT JOIN jos_componentarchitect_fieldtypes t ON t.id = f.fieldtype_id
#LEFT JOIN gpcb.jt3_campos c3 ON c3.dataIndex = f.code_name AND c3.clave = co.code_name
WHERE 1
#AND c.id = 8
AND f.name = 'FECHA Y HORA DE ENTRADA'
#GROUP BY c3.dataType
ORDER BY c.id, co.ordering, f.ordering
;