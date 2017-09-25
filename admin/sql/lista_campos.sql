#UPDATE
SELECT 
#c.id, co.id 'co.id', co.name 'co.name', f.id 'f.id', f.name 'f.name'
co.name, co.plural_name, co.code_name, co.plural_code_name
FROM 

jos_componentarchitect_components c
LEFT JOIN jos_componentarchitect_componentobjects co ON co.component_id = c.id
LEFT JOIN jos_componentarchitect_fieldsets fs ON 		fs.component_id = c.id AND fs.component_object_id = co.id
LEFT JOIN jos_componentarchitect_fields f ON 			 f.component_id = c.id AND  f.component_object_id = co.id AND f.fieldset_id = fs.id 
#SET co.plural_name = co.
WHERE 1
AND c.id = 2
#ORDER BY c.id, co.ordering, f.ordering
;