SELECT 
t.type_title, t.content_history_options, h.version_note #, l.*
FROM jpruebas.jos_ucm_history h
INNER JOIN jpruebas.jos_content_types t ON t.type_id = h.ucm_type_id
#INNER JOIN jos_jtsca_ls01s l ON l.id = h.ucm_item_id #variable dependiente de t.table
WHERE 1
AND t.type_id = 10100
ORDER BY h.version_id desc;