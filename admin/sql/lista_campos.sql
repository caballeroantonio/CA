UPDATE
#D_ELETE f FROM
/*
SELECT 
c.id 'c.id',	co.id 'co.id', co.code_name 'co.code_name', co.name 'co.name'
#,fs.id 'fs.id', fs.code_name 'fs.code_name'
,f.id 'f.id', f.state, f.code_name 'f.code_name', f.name 'f.name'
#, t.name 't.name', t.id 't.id'
#, CONCAT_WS(' ',f.mysql_datatype, f.mysql_size) 'size'
#,c3.dataIndex 'c3.dataIndex', c3.columnText
, l.id
FROM
*/
jos_componentarchitect_components c
LEFT JOIN jos_componentarchitect_componentobjects co ON co.component_id = c.id
LEFT JOIN jos_componentarchitect_fieldsets fs ON 		fs.component_id = c.id AND fs.component_object_id = co.id
LEFT JOIN jos_componentarchitect_fields f ON 			 f.component_id = c.id AND  f.component_object_id = co.id AND f.fieldset_id = fs.id 
LEFT JOIN jos_componentarchitect_fieldtypes t ON t.id = f.fieldtype_id
#LEFT JOIN gpcb.jt3_campos c3 ON c3.dataIndex = f.code_name AND c3.clave = co.code_name
LEFT JOIN gpcb.jtc_libros l ON co.code_name = l.clave
SET co.name = 'LIBRO DE AMPAROS *LOCOS*', l.nombre = 'LIBRO DE AMPAROS *LOCOS*'
WHERE 1
AND c.id = 1
AND co.name LIKE '%loco%'
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

#t_dataType naturales impementados
SELECT 
d1.co_code_name, d1.t_dataType, d1.f_id 'd1_f_id', d2.f_id 'd2_f_id' 
FROM jt3_vs_ca d1
LEFT JOIN jt3_vs_ca d2 ON d2.dic = 2 AND d1.co_code_name = d2.co_code_name AND d1.f_code_name = d2.f_code_name
WHERE 1
AND d1.dic = 1
AND d1.co_state = 1
AND d1.f_state = 1
AND d1.co_code_name LIKE 'l%'
AND d1.co_code_name NOT LIKE 'ljc__'
AND d1.co_code_name != 'lejemplo'
GROUP BY d1.t_dataType
#GROUP BY d1.f_id HAVING count(*)>1
#LIMIT 100