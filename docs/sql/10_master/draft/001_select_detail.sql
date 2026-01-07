SELECT
		eateries.id          AS id
	, eateries.area        AS area_id
	, areas.name           AS area_name
	, eateries.name        AS name
	, eateries.address     AS address
	, eateries.description AS description
	, eateries.image       AS image
FROM eateries
JOIN areas ON eateries.area = areas.id 
WHERE eateries.id = 5
ORDER BY eateries.id;