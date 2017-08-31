#UPDATE
#/*
SELECT 
c.id, c.code_name 'c.name', co.code_name 'co.name', fs.code_name 'fs.name', f.code_name 'f.name'
FROM 
#*/
jos_componentarchitect_components c
LEFT JOIN jos_componentarchitect_componentobjects co ON co.component_id = c.id
LEFT JOIN jos_componentarchitect_fieldsets fs ON 		fs.component_id = c.id AND fs.component_object_id = co.id
LEFT JOIN jos_componentarchitect_fields f ON 			 f.component_id = c.id AND  f.component_object_id = co.id AND f.fieldset_id = fs.id 
#SET co.state = 1, co.default_fieldset_id = f.fieldset_id
WHERE 1
GROUP BY c.id
ORDER BY c.id, co.id, f.id 
