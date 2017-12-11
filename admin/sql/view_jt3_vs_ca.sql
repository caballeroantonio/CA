CREATE OR REPLACE VIEW jt3_vs_ca AS 
SELECT * FROM
(
SELECT 2 'dic', co.id 'co_id', co.state 'co_state', co.code_name 'co_code_name', co.name 'co_name', fs.id 'fs_id', f.id 'f_id', f.state 'f_state', f.name 'f_name', f.code_name 'f_code_name', f.ordering 'f_ordering', t.name 't_dataType'
FROM jpruebas.jos_componentarchitect_components c
LEFT JOIN jpruebas.jos_componentarchitect_componentobjects co ON co.component_id = c.id
LEFT JOIN jpruebas.jos_componentarchitect_fieldsets fs ON 		fs.component_id = c.id AND fs.component_object_id = co.id
LEFT JOIN jpruebas.jos_componentarchitect_fields f ON 			 f.component_id = c.id AND  f.component_object_id = co.id AND f.fieldset_id = fs.id 
LEFT JOIN jos_componentarchitect_fieldtypes t ON t.id = f.fieldtype_id
WHERE 1
AND c.id = 1
UNION
SELECT 1 'dic', l.id 'l_id', l.published 'l_published', l.clave 'l_clave', l.nombre 'l_nombre', 0 'fs_id', c.id 'c_id', c.published 'c_published', c.columnText 'c_columnText', c.dataIndex 'c_dataIndex', c.ordering 'c_ordering', c.dataType 'c_dataType'
FROM gpcb.jtc_libros l
LEFT JOIN gpcb.jt3_campos c ON c.clave = l.clave
WHERE 1
) d;