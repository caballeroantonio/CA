18 - Query Time: 38298.91 ms After last query: 7.78 ms

SELECT a.*,`c`.`title` AS category_title, `c`.`alias` AS category_alias, `c`.`access` AS category_access, `c`.`path` AS category_route,`parent`.`title` AS parent_title, `parent`.`id` AS parent_id, `parent`.`alias` AS parent_alias, `parent`.`path` AS parent_route,ROUND(`v`.`rating_sum` / `v`.`rating_count`, 0) AS rating, `v`.`rating_count` as rating_count,`m`.`name` AS m_lmunicipality_name,`m`.`ordering` AS m_lmunicipality_ordering,`s`.`name` AS s_lstate_name,`s`.`ordering` AS s_lstate_ordering,`c1`.`name` AS c1_country_name,`c1`.`ordering` AS c1_country_ordering,`r`.`name` AS r_rent_name,`r`.`id` AS r_rent_id,`u`.`name` AS u_user_name,`u`.`id` AS u_user_id

  FROM `jos_rem_houses` AS a

  LEFT JOIN `jos_categories` AS c 
  ON `c`.`id` = `a`.`catid`

  LEFT JOIN `jos_categories` as parent 
  ON `parent`.`id` = `c`.`parent_id`

  LEFT JOIN `jos_rem_rating` AS v 
  ON `a`.`id` = `v`.`content_id` 
  AND `v`.`content_type` = 'houses'

  LEFT JOIN `jos_rem_lmunicipalities` AS m 
  ON `m`.`id` = `a`.`id_lmunicipality`

  LEFT JOIN `jos_rem_lstates` AS s 
  ON `s`.`id` = `a`.`id_lstate`

  LEFT JOIN `jos_rem_countries` AS c1 
  ON `c1`.`id` = `a`.`id_country`

  LEFT JOIN `jos_rem_rent` AS r 
  ON `r`.`id` = `a`.`id_rent`

  LEFT JOIN `jos_users` AS u 
  ON `u`.`id` = `a`.`owner_id`

  WHERE `a`.`state` = 1

  ORDER BY `name` ASC #el ordenamiento es el costoso
  LIMIT 5
  
  
  
  41 - Query Time: 25018.63 ms After last query: 1.72 ms
  
  SELECT COUNT(*)

  FROM `jos_rem_houses` AS a

  LEFT JOIN `jos_categories` AS c 
  ON `c`.`id` = `a`.`catid`

  LEFT JOIN `jos_categories` as parent 
  ON `parent`.`id` = `c`.`parent_id`

  LEFT JOIN `jos_rem_rating` AS v 
  ON `a`.`id` = `v`.`content_id` 
  AND `v`.`content_type` = 'houses'

  LEFT JOIN `jos_rem_lmunicipalities` AS m 
  ON `m`.`id` = `a`.`id_lmunicipality`

  LEFT JOIN `jos_rem_lstates` AS s 
  ON `s`.`id` = `a`.`id_lstate`

  LEFT JOIN `jos_rem_countries` AS c1 
  ON `c1`.`id` = `a`.`id_country`

  LEFT JOIN `jos_rem_rent` AS r 
  ON `r`.`id` = `a`.`id_rent`

  LEFT JOIN `jos_users` AS u 
  ON `u`.`id` = `a`.`owner_id`

  WHERE `a`.`state` = 1