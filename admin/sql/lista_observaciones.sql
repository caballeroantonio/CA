SELECT 
co.id 'co.id', co.name 'Libro', co.description 'descripción'
FROM 
jos_componentarchitect_components c
LEFT JOIN jos_componentarchitect_componentobjects co ON co.component_id = c.id
LEFT JOIN jos_componentarchitect_fieldsets fs ON 		fs.component_id = c.id AND fs.component_object_id = co.id
LEFT JOIN jos_componentarchitect_fields f ON 			 f.component_id = c.id AND  f.component_object_id = co.id AND f.fieldset_id = fs.id 
WHERE 1
AND c.id = 2
AND co.id NOT IN (1,29,30)
GROUP BY co.id
ORDER BY c.id, co.id, f.id ;