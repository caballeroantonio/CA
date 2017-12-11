#libros faltantes
SELECT 
vs.*
FROM jt3_vs_ca vs
LEFT JOIN gpcb.jtc_libros l ON vs.dic = 2 AND l.clave = vs.co_code_name
LEFT JOIN jpruebas.jos_componentarchitect_componentobjects co ON vs.dic = 1 AND co.code_name = vs.co_code_name
WHERE 1
AND vs.co_state
AND vs.co_code_name NOT LIKE 'lspe__' #NOT implemented on dic 1
AND vs.co_code_name LIKE 'l%'
AND (
	#dic 2 sin match en dic1
	(
		vs.dic = 2 AND l.id IS NULL
	)
	#dic 1 sin match en dic2
	OR (
		vs.dic = 1 AND co.id IS NULL
	)
)
GROUP BY vs.dic,vs.co_id;

#campos excedentes
SELECT 
#cf.* 
vs.*
FROM(
SELECT 
vs.*
FROM jt3_vs_ca vs
LEFT JOIN gpcb.jt3_campos c ON vs.dic = 2 AND c.clave = co_code_name AND c.dataIndex = vs.f_code_name
LEFT JOIN jpruebas.jos_componentarchitect_componentobjects co ON vs.dic = 1 AND co.code_name = vs.co_code_name
LEFT JOIN jpruebas.jos_componentarchitect_fields f ON vs.dic = 1 AND f.component_object_id = co.id AND f.code_name = vs.f_code_name

WHERE 1
AND vs.co_state=1 AND vs.f_state = 1
AND vs.co_code_name NOT LIKE 'lspe__' #NOT implemented on dic 1
#AND vs.f_code_name NOT IN ('anoj', 'id_expediente', 'id_organo', 'id_secretaria') #Generados dinamicamente por dic 1

AND vs.co_code_name LIKE 'l%'
AND (
	#dic 2 sin match en dic1
	(
		vs.dic = 2 AND c.id IS NULL
	)
	#dic 1 sin match en dic2
	OR (
		vs.dic = 1 AND f.id IS NULL
	)
)
#excedentes sólo en dic=x
#AND dic = 1
) vs
WHERE 1
;